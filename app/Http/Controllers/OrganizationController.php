<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Log;
use App\Services\OrganizationService;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    /**
     * Get organizations.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $updatedAt = '2018-04-5 02:00:00';
        $organizations = DB::table('organization')
            ->where('updated_ts', '>=', $updatedAt)
            ->get();

        return response()
        ->json(
            $organizations,
            200, 
            [
                'Content-type'=> 'application/json; charset=utf-8'
            ], 
            JSON_UNESCAPED_UNICODE
        );
    }

    public function saveOrganizationsToElearning(OrganizationService $organizationService)
    {
        //TODO: Get $startUpdatedAt is latest of ts from LOG table
        $startUpdatedAt = '2018-04-05 02:00:00';
        $endUpdatedAt = date('Y-m-d H:i:s', time());

        $failedOrganizationCodes = [];
        $successfulOrganizationCodes = [];
        $log = new Log();
        try {
            $log->insertByTableName('organization', 'read', '');
            Organization::where('updated_at', '<=', $endUpdatedAt)
            // ->where('updated_at', '>=', $startUpdatedAt)
            ->chunk(100, function ($organizations) use ($organizationService, &$failedOrganizationCodes, &$successfulOrganizationCodes) {
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