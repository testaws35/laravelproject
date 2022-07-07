<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasteMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caste_master', function (Blueprint $table) {
            $table->increments('CasteID');
            $table->string('CasteName',200);
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
        Schema::dropIfExists('caste_master');
    }
}
