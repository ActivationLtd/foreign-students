<?php

namespace App\Projects\DgmeStudents\Commands;

use App\Projects\DgmeStudents\Mails\AdminUpdatesEmail;
use Illuminate\Console\Command;

class EmailApplicationSummary extends Command
{
    // Todo : Register this command in \App\Projects\DgmeStudents\Providers\AppServiceProvider::$commands
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:email-application-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send summary email to admins';

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
     * Invoice invoice
     *
     * @return mixed
     */
    public function handle()
    {
        \Mail::to(project_config('admin_update_emails'))
            ->send(new AdminUpdatesEmail());
    }
}