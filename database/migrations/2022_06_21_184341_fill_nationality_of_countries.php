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
        //
        $nationalities = [
            '23'=>'Afghan',
            '200'=>'American',
            '132'=>'Bhutanese',
            '187'=>'British',
            '214'=>'Canadian',
            '121'=>'Indian',
            '15'=>'Lesotho',
            '78'=>'Malaysian',
            '239'=>'Maldivian',
            '102'=>'Nepalese',
            '220'=>'Pakistani',
            '146'=>'Palestinian',
            '50'=>'Sri Lankan',
        ];
        foreach($nationalities as $key => $value ){
            \App\Country::where('id',$key)->update([
                'nationality'=>$value
            ]);
        }
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
