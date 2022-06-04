<?php

namespace App\Projects\DgmeStudents\Commands;

use App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession;
use Illuminate\Console\Command;
use DB;

class PopulateSessionIdInApplication extends Command
{
    // Todo : Register this command in \App\Projects\DgmeStudents\Providers\AppServiceProvider::$commands
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:populate-session-id-applications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will take the latest session and fill the application session id accordingly';

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
        // Execute some code

        $latestSession=ApplicationSession::latestOpenSession();
        DB::table('foreign_student_applications')->whereNull('application_session_id')
            ->where('is_active',1)->whereNull('deleted_at')->update([
               'application_session_id' =>$latestSession->id,
               'application_session_name' =>$latestSession->name,
            ]);
    }
}