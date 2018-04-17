<?php
namespace App\Services;

use App\User;
use GuzzleHttp\Client;
  
class UserService
{
    public function saveUsersToElearning($users)
    {
		$client = new Client();
		foreach ($users as $user) {
			$user = self::formatUserForApi($user);
			//TODO: Change another api to save user
			$result = $client->post('http://vlms.local/user/new', [
	            'params' => $user
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