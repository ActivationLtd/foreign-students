<?php

namespace App\Projects\DgmeStudents\Commands;

use Illuminate\Console\Command;

class DeleteRelationsOfDeletedApplication extends Command
{
    // Todo : Register this command in \App\Projects\DgmeStudents\Providers\AppServiceProvider::$commands
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-relations-applications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will get all removed applications and soft delete the relations';

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
        \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication::onlyTrashed()
            ->chunk(100, function ($applications) {
                foreach ($applications as $application) {
                    if($application->applicationExaminations()->exists()){
                        $application->applicationExaminations()->delete();
                    }
                    if($application->applicationLanguageProfiencies()->exists()){
                        $application->applicationLanguageProfiencies()->delete();
                    }
                    if($application->uploads()->exists()){
                        $application->uploads()->delete();
                    }
                    // write your email send code here
                }
            });
    }
}