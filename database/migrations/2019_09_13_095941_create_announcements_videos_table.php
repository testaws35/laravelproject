<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements_videos', function (Blueprint $table) {
            $table->increments('Announcements_VideosID');
            $table->integer('AnnouncementsID');
            $table->binary('Video')->nullable();
            $table->integer('Createdby');
            $table->dateTime('CreatedOn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements_videos');
    }
}
