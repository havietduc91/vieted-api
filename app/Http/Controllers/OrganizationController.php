<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Log;
use App\Services\OrganizationService;
use http\Exception;

class OrganizationController extends Controller
{
    public function saveOrganizationsToElearning(OrganizationService $organizationService)
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
        return response('Update new organizations successful', 200)
                  ->header('Content-Type', 'text/plain');
    }
}