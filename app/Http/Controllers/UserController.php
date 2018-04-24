<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    public function saveUsersToElearning(UserService $userService)
    {
        $userService->flowToSaveUsersToElearning($userService);
        
        return response('Update new users successful', 200)
              ->header('Content-Type', 'text/plain');
    }
}