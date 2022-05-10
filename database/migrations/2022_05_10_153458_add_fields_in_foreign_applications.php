<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInForeignApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foreign_student_applications', function (Blueprint $table) {
            $table->integer('application_session_id')->nullable()->default(null)->after('status')->index();
            $table->string('application_session_name', 255)->nullable()->default(null)->after('application_session_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foreign_student_applications', function (Blueprint $table) {
            //
        });
    }
}
