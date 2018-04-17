<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'ns_id', 'login_name', 'full_name', 
        'org_id', 'department_name', 'job_title', 'phone', 'sex', 'ns_number', 
        'mail', 'birthday', 'elearning_status', 'hrms_status', 
        'user_ad', 'user_enable', 'created_ts', 'updated_ts'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
