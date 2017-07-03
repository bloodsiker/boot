<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TestCron:sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $user = 'Dfcz';
        Mail::send('site.emails.index', compact('user'), function ($message) {
            $message->from('info@boot.com.ua', 'BOOT');
            $message->to(config('mail.support_email'))->to('do@generalse.com')->subject('Новая заявка для сервисного центра ');
        });
    }
}
