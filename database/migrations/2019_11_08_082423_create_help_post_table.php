<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_post', function (Blueprint $table) {
            $table->increments('HelpID');
            $table->string('Description');
			$table->string('Type');
            $table->boolean('Status');
            $table->integer('NumReplies');
            $table->date('ClosedOn');
            $table->integer('user_id')->unsigned();
            $table->binary('Photo');
			$table->datetime('CreatedOn');
            $table->integer('CreatedBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_post');
    }
}
