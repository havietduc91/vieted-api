<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $updatedAt = '2018-04-16 02:00:00';
        $users = DB::table('user')
            ->where('user_enable', 'yes')
            ->where('updated_ts', '>=', $updatedAt)
            ->get();

        $usersData = [];
        foreach ($users as $user) {
            $usersData[] = [
                'ns_id' => $user->id,
                'full_name' => $user->full_name,
                'login_name' => $user->login_name,
                'org_id' => utf8_encode($user->org_id),
                'department_name' => utf8_encode($user->department_name),
                'job_title' => utf8_encode($user->job_title),
                'phone' => utf8_encode($user->phone),
                'sex' => utf8_encode($user->sex),
                'ns_number' => utf8_encode($user->ns_number),
                'mail' => utf8_encode($user->mail),
                'birthday' => utf8_encode($user->birthday),
                'elearning_status' => utf8_encode($user->elearning_status),
                'hrms_status' => utf8_encode($user->hrms_status),
                'user_ad' => utf8_encode($user->user_ad),
                'user_enable' => utf8_encode($user->user_enable),
                'created_ts' => utf8_encode($user->created_ts),
                'updated_ts' => utf8_encode($user->updated_ts),
            ];
        }

        return response()->json(['users' => $usersData, 'success' => true],200);
    }
}