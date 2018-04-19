<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function insertCourseFromElearning(Request $request)
    {
        //TODO: Check authenticate via IP
        $input = $request->all();

        try {
            $res = Course::where('code', '=', $input['code'])->first();
            if ($res) {
                $input['elearning_status'] = NULL;
                $course = Course::where('code', '=', $input['code'])
                    ->update($input);
            } else {
                $courseModel = new Course();
                $input['elearning_status'] = 'I';
                $course = $courseModel->insertCourse($input);
            }
        } catch (\Exception $ex) {
            return false;
        }

        return $course;
    }
}