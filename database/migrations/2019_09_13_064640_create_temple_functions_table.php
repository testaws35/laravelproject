<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempleFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temple_functions', function (Blueprint $table) {
            $table->increments('TempleFunctionID');
            $table->integer('TempleID');
            $table->string('Title',200);
            $table->string('Function_Content');
            $table->datetime('FunctionDate');
            $table->integer('Createdby');
            $table->dateTime('CreatedOn');
            $table->boolean('Status');
			$table->string('Post_Status',10);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temple_functions');
    }
}
