<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInForeignStudentApplication extends Migration
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
            $table->dateTime('submitted_at')->nullable()->default(null)->after('finance_mode_other');
            $table->string('payment_transaction_id',255)->nullable()->default(null)->after('submitted_at');
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
