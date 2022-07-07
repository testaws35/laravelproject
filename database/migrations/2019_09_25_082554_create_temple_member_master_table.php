<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempleMemberMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temple_member_master', function (Blueprint $table) {
            $table->increments('TempleMemberID');
            $table->integer('TempleID');
            $table->integer('UserID');
			$table->string('Position',100);
            $table->datetime('Memberfromwhen');
            $table->string('MembershipType',100);
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
        Schema::dropIfExists('temple_member_master');
    }
}
