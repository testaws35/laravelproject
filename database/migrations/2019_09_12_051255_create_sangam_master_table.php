<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSangamMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sangam_master', function (Blueprint $table) {
            $table->increments('SangamID');
            $table->string('Sangam_Name',100);
            $table->string('Sangam_Location');
            $table->text('Sangam_Description');
            $table->datetime('Sangam_StartedOn');
            $table->boolean('Sangam_Status');
            $table->string('Sangam_Photo');
			$table->integer('Num_of_members');
            $table->string('Sangam_Activities');
            $table->integer('Createdby');
            $table->datetime('CreatedOn');
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
        Schema::dropIfExists('sangam_master');
    }
}
