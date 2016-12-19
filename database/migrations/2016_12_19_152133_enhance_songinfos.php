<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnhanceSonginfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->string('key')->nullable();
            $table->time('duration')->nullable();
            $table->string('original_performer')->nullable();
            $table->string('link_to_original')->nullable();
            $table->integer('soundfile')->nullable();
            $table->text('extrainfo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('key','duration','original_performer','link_to_original','soundfile','extrainfo');
        });
    }
}
