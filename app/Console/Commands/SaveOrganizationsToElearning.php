<?php

namespace App\Console\Commands;

use App\Services\OrganizationService;
use Illuminate\Console\Command;

class SaveOrganizationsToElearning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:save_organizations_to_elearning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save organizations to elearning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $organizationService = new OrganizationService();
        $organizationService->flowToSaveOrganizationsToElearning();

        $this->info('Save organizations to elearning successfully!');
    }
}
