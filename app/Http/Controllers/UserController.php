<?php

namespace App\Http\Controllers;

use App\User;
use App\Log;
use App\Services\UserService;
use http\Exception;

class UserController extends Controller
{
    public function saveUsersToElearning(UserService $userService)
    {
        $log = new Log();
        $startUpdatedAt = $log->getLastTimeSaveLog('user', 'read', [Log::STATUS_FAILED, Log::STATUS_DONE]);
        $endUpdatedAt = date('Y-m-d H:i:s', time());

        try {
            $log->insertByTableName('user', 'read', '');
            $query = User::where('user_enable', 'yes')
                ->where('updated_at', '<=', $endUpdatedAt);

            if (!empty($startUpdatedAt)) {
                $query = $query->where('updated_at', '>=', $startUpdatedAt);
            }

            $query->chunk(100, function ($users) use ($userService) {
                $userService->saveUsersToElearning($users);
            });
            $log->updateStatus('user', 'read', Log::STATUS_DONE);
        } catch (Exception $ex) {
            $log->updateStatus('user', 'read', Log::STATUS_FAILED);
        }
        
         return response('Update new users successful', 200)
                  ->header('Content-Type', 'text/plain');
    }
}