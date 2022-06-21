<?php

namespace App\Projects\DgmeStudents\Commands;

use App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession;
use App\User;
use Illuminate\Console\Command;
use DB;

class PopulateGenderInApplication extends Command
{
    // Todo : Register this command in \App\Projects\DgmeStudents\Providers\AppServiceProvider::$commands
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:populate-gender-applications';

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

        User::whereNotNull('gender')->chunk(50,function($users){
            foreach($users as $user){
                $user->applications()->update(['gender'=>$user->gender]);
            }

        });
    }
}