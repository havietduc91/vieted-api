<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class SaveUsersToElearning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:save_users_to_elearning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save users to elearning';

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
        $userService = new UserService();
        $userService->flowToSaveUsersToElearning();

        $this->info('Save users to elearning successfully!');
    }
}
