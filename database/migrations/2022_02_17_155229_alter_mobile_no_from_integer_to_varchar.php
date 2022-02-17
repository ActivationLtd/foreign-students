<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMobileNoFromIntegerToVarchar extends Migration
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
            $table->string('applicant_mobile_no',100)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('mobile',100)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('integer_to_varchar', function (Blueprint $table) {
            //
        });
    }
}
