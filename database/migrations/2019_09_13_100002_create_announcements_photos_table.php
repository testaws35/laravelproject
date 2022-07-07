<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements_photos', function (Blueprint $table) {
            $table->increments('Announcements_PhotosID');
            $table->integer('AnnouncementsID');
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
        Schema::dropIfExists('announcements_photos');
    }
}
