<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempleMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temple_master', function (Blueprint $table) {
            $table->increments('TempleID');
            $table->string('Temple_Name');
            $table->string('Temple_Head',100);
            $table->string('Temple_OwnedBy_Subsect');
            $table->string('Temple_SharedWith_Anyone');
            $table->integer('Temple_Location');
            $table->string('Temple_Description');
            $table->datetime('Temple_StartedOn');
            $table->boolean('Temple_Status');
            $table->binary('Temple_Photo');
            $table->string('Temple_Address');
            $table->string('Temple_BusRoute',100);
            $table->integer('Temple_Nearby_City');
            $table->date('CreatedOn');
            $table->integer('Createdby');
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
        Schema::dropIfExists('temple_master');
    }
}
