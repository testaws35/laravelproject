<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalFunctionPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_function_photos', function (Blueprint $table) {
            $table->increments('PersonalFunction_PhotosID');
            $table->integer('PersonalFunctionID');
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
        Schema::dropIfExists('personal_function_photos');
    }
}
