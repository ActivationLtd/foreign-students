<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('foreign_student_applications')->where('is_payment_verified','!=',1)->orWhereNull('is_payment_verified')
            ->update(['is_payment_verified'=>0]);

        DB::table('foreign_student_applications')->where('is_document_verified','!=',1)->orWhereNull('is_document_verified')
            ->update(['is_document_verified'=>0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkbox_fields_in_foreign_student_application', function (Blueprint $table) {
            //
        });
    }
};
