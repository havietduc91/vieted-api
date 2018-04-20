<?php

namespace App\Http\Controllers;

use App\Path_Course;
use App\Path;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                //TODO: Move to saveMany syntax of laravel
                $deletedStatus = DB::table('path_course')->where('path_code', $pathCode)->delete();
                if ($deletedStatus) {
                    foreach ($courseCodes as $courseCode) {
                        $pathCourse = new Path_Course();

                        $pathCourse->path_code = trim($pathCode);
                        $pathCourse->course_code = trim($courseCode);

                        $pathCourse->save();
                    }
                }
            }
        } catch (\Exception $ex) {
            return;
        }

        return 1;
    }
}