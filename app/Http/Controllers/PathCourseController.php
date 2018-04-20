<?php

namespace App\Http\Controllers;

use App\Path;
use Illuminate\Http\Request;

class PathCourseController extends Controller
{
    public function insertPathCoursesFromElearning(Request $request)
    {
        $input = $request->all();

        $pathCode = $input['path_code'];
        $courseCodes = $input['course_codes'];

        try {
            $path = Path::where('code', '=', $pathCode)->first();
            if ($path) {
                foreach ($courseCodes as $courseCode) {
                    $path->courses()->attach($courseCode);
                }
            }
        } catch (\Exception $ex) {
            return;
        }

        return 1;
    }
}