<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organization';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'org_id', 'level', 'parent_id',
        'is_tct', 'is_active', 'elearning_status', 'hrms_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
