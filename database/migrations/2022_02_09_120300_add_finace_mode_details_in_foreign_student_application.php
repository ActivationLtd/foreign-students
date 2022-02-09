<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinaceModeDetailsInForeignStudentApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foreign_student_applications', function (Blueprint $table) {
            //
            $table->text('finance_mode_other')->nullable()->default(null)->after('financing_mode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foreign_student_application', function (Blueprint $table) {
            //
        });
    }
}
