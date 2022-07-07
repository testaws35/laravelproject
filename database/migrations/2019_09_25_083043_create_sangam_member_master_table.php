<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSangamMemberMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sangam_member_master', function (Blueprint $table) {
            $table->increments('SangamMemberID');
            $table->integer('SangamID');
            $table->integer('UserID');
            $table->string('Position',100);
            $table->Date('MembersFromWhen');
			$table->string('MembershipType',100);
			$table->boolean('Status');
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
        Schema::dropIfExists('sangam_member_master');
    }
}
