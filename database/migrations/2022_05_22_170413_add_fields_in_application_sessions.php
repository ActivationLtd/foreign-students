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
        Schema::table('application_sessions', function (Blueprint $table) {
            //
            $table->string('code', 50)->nullable()->default(null)->after('name');
            $table->string('selection_completed', 5)->nullable()->default('No')->after('status');
            $table->string('admission_completed', 5)->nullable()->default('No')->after('selection_completed');
            $table->bigInteger('academic_session_id')->nullable()->default(null)->after('admission_completed');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_sessions', function (Blueprint $table) {
            //
        });
    }
};
