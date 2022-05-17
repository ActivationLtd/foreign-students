<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInForeignStudentApplications extends Migration
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
            $table->tinyInteger('is_payment_verified')->nullable()->default(null)->after('payment_transaction_id');
            $table->tinyInteger('is_document_verified')->nullable()->default(null)->after('is_payment_verified');
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
