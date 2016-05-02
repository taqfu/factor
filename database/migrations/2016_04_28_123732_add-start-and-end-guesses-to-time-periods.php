<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartAndEndGuessesToTimePeriods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_periods', function (Blueprint $table) {
            $table->dropColumn('guess');
            $table->boolean("startGuess");
            $table->boolean("endGuess");
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_periods', function (Blueprint $table) {
            //
        });
    }
}
