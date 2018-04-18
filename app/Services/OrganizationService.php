<?php
namespace App\Services;

use App\Organization;
use GuzzleHttp\Client;
  
class OrganizationService
{
    public function saveOrganizationsToElearning($organizations)
    {
		$client = new Client();
		foreach ($organizations as $organization) {
			$organization = self::formatOrganizationForApi($organization);
            $organization['data_type'] = 'evn';
            $client->request('POST', 'http://vlms.local/category/data/insert-organization-from-api', [
                'form_params' => $organization
            ]);
		}

		return 'Save organizations to vieted lms';
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