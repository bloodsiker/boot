<?php

namespace App\Console\Commands;

use App\Services\UserRequestService;
use Illuminate\Console\Command;

class NotificationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotificationEmail:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification of overdue requests';
    /**
     * @var UserRequestService
     */
    private $requestService;

    /**
     * Create a new command instance.
     *
     * @param UserRequestService $requestService
     */
    public function __construct(UserRequestService $requestService)
    {
        parent::__construct();
        $this->requestService = $requestService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->requestService->notificationEmail();
    }
}
