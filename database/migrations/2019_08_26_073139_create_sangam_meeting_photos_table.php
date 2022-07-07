<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSangamMeetingPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sangam_meeting_photos', function (Blueprint $table) {
            $table->increments('SangamMeeting_PhotosID');
            $table->integer('SangamMeetingID');
            $table->binary('Photo');
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
        Schema::dropIfExists('sangam_meeting_photos');
    }
}
