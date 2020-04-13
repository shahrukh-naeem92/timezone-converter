<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertDataTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('times')->insert(
            [
                'time' => '10:00',
                'timezone_id' => 1,
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            ]
        );
        DB::table('times')->insert(
            [
                'time' => '17:00',
                'timezone_id' => 2,
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            ]
        );
        DB::table('times')->insert(
            [
                'time' => '12:00',
                'timezone_id' => 3,
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            ]
        );
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
}
