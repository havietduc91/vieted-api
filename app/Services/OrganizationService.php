<?php
namespace App\Services;

use App\Organization;
use GuzzleHttp\Client;
  
class OrganizationService
{
    public function saveOrganizationsToElearning($organizations)
    {
		$client = new Client();
		$failedOrganizationCodes = [];
		$successfulOrganizationCodes = [];
		foreach ($organizations as $organization) {
			$organization = self::formatOrganizationForApi($organization);
            $organization['data_type'] = 'evn';
            $res = $client->request('POST', 'http://vlms.local/category/data/insert-organization-from-api', [
                'form_params' => $organization
            ]);
            $r = json_decode($res->getBody()->getContents());
            if ($r->success == true) {
                $successfulOrganizationCodes[] = $organization['code'];
            } else {
                $failedOrganizationCodes[] = $organization['code'];
            }
		}

		return [
		    'successfulOrganizationCodes' => $successfulOrganizationCodes,
		    'failedOrganizationCodes' => $failedOrganizationCodes,
        ];
    }

    public static function formatOrganizationForApi(Organization $organization)
    {
    	$formattedOrganization = [];
    	foreach ($organization->getFillable() as $filterValue) {
            $formattedOrganization[$filterValue] = $organization->$filterValue;
    	}

    	return $formattedOrganization;
    }
}