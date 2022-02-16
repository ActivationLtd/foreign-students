<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExaminationTypeInForeignApplicationExaminations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foreign_application_examinations', function (Blueprint $table) {
            //
            $table->string('examination_type',255)->nullable()->default(null)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foreign_application_examinations', function (Blueprint $table) {
            //
        });
    }
}
