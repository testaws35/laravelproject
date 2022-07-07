<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSangamMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sangam_meetings', function (Blueprint $table) {
            $table->increments('SangamMeetingID');
            $table->integer('SangamID');
            $table->string('Title',200);
            $table->string('Meeting_Content');
            $table->datetime('MeetingDate');
            $table->integer('Createdby');
            $table->dateTime('CreatedOn');
            $table->boolean('Status');
            $table->boolean('Post_Status');
            $table->time('deleted_at');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sangam_meetings');
    }
}
