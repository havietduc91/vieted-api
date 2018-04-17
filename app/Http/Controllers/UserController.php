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
}