<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstrumentUserTableEnhancements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instrument_user', function (Blueprint $table) {
            $table->integer('instrument_id');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instrument_user', function (Blueprint $table) {
            $table->dropColumn('instrument_id','user_id');
        });
    }
}
