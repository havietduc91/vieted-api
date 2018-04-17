<?php

namespace App\Http\Controllers;

use App\User;
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
        $updatedAt = '2018-04-5 02:00:00';
        $users = DB::table('user')
            ->where('user_enable', 'yes')
            ->where('updated_ts', '>=', $updatedAt)
            ->get();
        
        return response()
        ->json(
            $users, 
            200, 
            [
                'Content-type'=> 'application/json; charset=utf-8'
            ], 
            JSON_UNESCAPED_UNICODE
        );
    }

    public function getUsersAndCallSaveUsersApi()
    {
        $startUpdatedAt = '2018-04-05 02:00:00';
        $endUpdatedAt = '2018-04-25 02:00:00';

        //TODO: Log to log table
        User::where('user_enable', 'yes')
            // ->where('updated_ts', '>=', $startUpdatedAt)
            // ->where('updated_ts', '<=', $endUpdatedAt)
            ->chunk(2, function ($users) {
                $client = new Client(); //GuzzleHttp\Client
                $result = $client->post('your-request-uri', [
                    'form_params' => [
                        'sample-form-data' => 'value'
                    ]
                ]);
                //Call save users to VietED LMS 
            });

        //TODO: Update status for log table
         return response('Update new users successful', 200)
                  ->header('Content-Type', 'text/plain');
    }
}