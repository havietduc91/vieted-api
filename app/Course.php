<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'elearning_status', 'org_id', 'object', 'content', 'start_time', 'end_time', 'goal'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function paths()
    {
        return $this->belongsToMany('App\Path', 'path_course', 'course_code', 'path_code');
    }

    public function insertCourse($courseData)
    {
        //DB::enableQueryLog();
        $nextId = DB::table('course')->max('id') + 1;

        $course = new Course();

        $course->id = $nextId;
        $course->code = $courseData['code'];
        $course->name = DB::raw("N'{$courseData['name']}'");
        $course->elearning_status = $courseData['elearning_status'];
        $course->org_id = $courseData['org_id'];
        $course->object = DB::raw("N'{$courseData['object']}'");
        $course->content = DB::raw("N'{$courseData['content']}'");
        $course->goal = DB::raw("N'{$courseData['goal']}'");
        $course->start_time = $courseData['start_time'];
        $course->end_time = $courseData['end_time'];

        return $course->save();
        //DB::getQueryLog();
    }
}
