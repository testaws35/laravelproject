<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elder_details', function (Blueprint $table) {
            $table->increments('ElderID');
            $table->integer('UserID');
            $table->boolean('Status');
            $table->datetime('CreatedOn');
            $table->integer('Createdby');
            $table->integer('Num_Queries_Answered');
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
        Schema::dropIfExists('elder_details');
    }
}
