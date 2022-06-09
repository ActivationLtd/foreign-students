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
        Schema::table('foreign_student_applications', function (Blueprint $table) {
            //
            $table->tinyInteger('is_valid')->default(1)->after('payment_transaction_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foriegn_student_application', function (Blueprint $table) {
            //
        });
    }
};
