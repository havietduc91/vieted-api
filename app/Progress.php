<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Progress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'progress';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ns_id', 'course_code', 'path_code', 'item_type', 'progress', 'score', 'pass', 'elearning_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function insertProgress($progressData)
    {
        $nextId = DB::table('progress')->max('id') + 1;

        $progress = new Progress();

        $progress->id = $nextId;
        $progress->ns_id = $progressData['ns_id'];
        $progress->course_code = !empty($progressData['course_code']) ? $progressData['course_code'] : '';
        $progress->path_code = !empty($progressData['path_code']) ? $progressData['path_code'] : '';
        $progress->item_type = $progressData['item_type'];
        $progress->progress = $progressData['progress'];
        $progress->score = $progressData['score'];
        $progress->pass = $progressData['pass'];
        $progress->elearning_status = $progressData['elearning_status'];

        return $progress->save();
    }
}
