<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Country::whereIn('id', [251])->delete(['is_active' => 0]); // Delete - Europe
        \App\Country::where('id', [252])->update(['name' => 'Other']); // Change - Rest of the world -> Other
        \App\ForeignStudentApplication::where('domicile_country_id', 252)->update(['domicile_country_name' => 'Other']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
