<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Path extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'path';

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

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'path_course', 'path_code', 'course_code');
    }

    public function insertPath($pathData)
    {
        $nextId = DB::table('path')->max('id') + 1;

        $path = new Path();

        $path->id = $nextId;
        $path->code = $pathData['code'];
        $path->name = $pathData['name'];
        $path->elearning_status = $pathData['elearning_status'];
        $path->org_id = $pathData['org_id'];
        $path->object = $pathData['object'];
        $path->content = $pathData['content'];
        $path->goal = $pathData['goal'];
        $path->start_time = $pathData['start_time'];
        $path->end_time = $pathData['end_time'];

        return $path->save();
    }
}
