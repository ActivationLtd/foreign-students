<?php

namespace App\Projects\DgmeStudents\Commands;

use App\Projects\DgmeStudents\Mails\ApplicationSummaryEmail;
use Illuminate\Console\Command;

class SendApplicationSummaryEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-application-summary-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send summary email to admins';

    /**
     * Execute the console command.
     * Invoice invoice
     *
     * @return mixed
     */
    public function handle()
    {
        \Mail::to(ApplicationSummaryEmail::recipients())
            ->send(new ApplicationSummaryEmail());
    }
}