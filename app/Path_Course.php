<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Path_Course extends Model
{
    /**
     * The table is relation between path and course tables.
     *
     * @var string
     */
    protected $table = 'path_course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path_code', 'course_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
