<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSangammeetingVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sangammeeting_videos', function (Blueprint $table) {
            $table->increments('SangamMeeting_VideosID');
            $table->integer('SangamMeetingID');
            $table->string('Video')->nullable();
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
        Schema::dropIfExists('sangammeeting_videos');
    }
}
