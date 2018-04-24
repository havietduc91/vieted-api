<?php
namespace App\Services;

use App\Log;
use App\Organization;
use GuzzleHttp\Client;
use http\Exception;

class OrganizationService
{
    public function flowToSaveOrganizationsToElearning(OrganizationService $organizationService)
    {
        $log = new Log();
        $startUpdatedAt = $log->getLastTimeSaveLog('organization', 'read', [Log::STATUS_FAILED, Log::STATUS_DONE]);
        $endUpdatedAt = date('Y-m-d H:i:s', time());

        $failedOrganizationCodes = [];
        $successfulOrganizationCodes = [];
        try {
            $log->insertByTableName('organization', 'read', '');
            $query = Organization::where('updated_at', '<=', $endUpdatedAt);

            if (!empty($startUpdatedAt)) {
                $query = $query->where('updated_at', '>=', $startUpdatedAt);
            }

            $query->chunk(100, function ($organizations) use ($organizationService, &$failedOrganizationCodes, &$successfulOrganizationCodes) {
                $r = $organizationService->saveOrganizationsToElearning($organizations);
                $failedOrganizationCodes = array_merge($failedOrganizationCodes, $r['failedOrganizationCodes']);
                $successfulOrganizationCodes = array_merge($successfulOrganizationCodes, $r['successfulOrganizationCodes']);
            });
            $status = Log::STATUS_DONE;
            if (count($failedOrganizationCodes) > 0) {
                $status = Log::STATUS_FAILED;
            }

        } catch (Exception $ex) {
            $status = Log::STATUS_FAILED;
        }

        $log->updateStatus('organization', 'read', $status);
    }

    public function saveOrganizationsToElearning($organizations)
    {
		$client = new Client();
		$failedOrganizationCodes = [];
		$successfulOrganizationCodes = [];
		foreach ($organizations as $organization) {
			$organization = self::formatOrganizationForApi($organization);
            $organization['data_type'] = 'evn';
            $res = $client->request('POST', env('ELEARNING_URL') . '/category/data/insert-organization-from-api', [
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