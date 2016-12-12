<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePivotIntrumentUserInSongcasts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songcasts', function (Blueprint $table) {
            $table->renameColumn('instrument_user_id','cast_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songcasts', function (Blueprint $table) {
	        $table->renameColumn('cast_id','instrument_user_id');
        });
    }
}
