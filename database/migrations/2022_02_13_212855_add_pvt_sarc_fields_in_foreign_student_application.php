<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPvtSarcFieldsInForeignStudentApplication extends Migration
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
            $table->string('application_category',100)->nullable()->default(null)->after('course_name');
            $table->tinyInteger('is_saarc')->nullable()->default(null)->after('application_category');
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
