<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcasteMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcaste_master', function (Blueprint $table) {
            $table->increments('SubCasteID');
            $table->integer('CasteID');
            $table->string('SubCaste_Name',200);
            $table->boolean('Status');
            $table->dateTime('CreatedOn'); 
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
        Schema::dropIfExists('subcaste_master');
    }
}
