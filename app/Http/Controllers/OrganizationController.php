<?php

namespace App\Http\Controllers;

use App\Services\OrganizationService;

class OrganizationController extends Controller
{
    public function saveOrganizationsToElearning(OrganizationService $organizationService)
    {
        $organizationService->flowToSaveOrganizationsToElearning($organizationService);

        return response('Update new organizations successful', 200)
                  ->header('Content-Type', 'text/plain');
    }
}