<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('AnnouncementsID');
            $table->integer('UserID');
            $table->string('Title',200);
            $table->string('Function_Content');
            $table->datetime('FunctionDate');
            $table->integer('Createdby');
            $table->dateTime('CreatedOn');
            $table->boolean('Status');
			$table->boolean('Post_Status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
