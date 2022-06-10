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
        Schema::table('application_sessions', function (Blueprint $table) {
            $table->string('allowed_category_options')->nullable()->default(null)->after('academic_session_id');
            $table->string('allowed_is_saarc_options')->nullable()->default(null)->after('allowed_category_options');
            $table->string('allowed_course_id_options')->nullable()->default(null)->after('allowed_is_saarc_options');
            $table->string('allowed_country_id_options')->nullable()->default(null)->after('allowed_course_id_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session', function (Blueprint $table) {
            //
        });
    }
};
