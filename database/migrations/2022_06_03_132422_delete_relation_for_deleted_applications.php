<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
