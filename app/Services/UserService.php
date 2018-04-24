<?php
namespace App\Services;

use App\Log;
use App\User;
use GuzzleHttp\Client;
use http\Exception;

class UserService
{
    public function flowToSaveUsersToElearning(UserService $userService)
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
    }

    public function saveUsersToElearning($users)
    {
		$client = new Client();
		foreach ($users as $user) {
			$user = self::formatUserForApi($user);
            $user['data_type'] = 'evn';
            $client->request('POST', env('ELEARNING_URL') . '/user/data/insert-user-from-api', [
                'form_params' => $user
            ]);
		}

		return 'Save users to vieted lms';
    }

    public static function formatUserForApi(User $user)
    {
    	$formattedUser = [];
    	foreach ($user->getFillable() as $filterValue) {
    		$formattedUser[$filterValue] = $user->$filterValue;
    	}

    	return $formattedUser;
    }
}