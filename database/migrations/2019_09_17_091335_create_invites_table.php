<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email');
        $table->string('Mobile_Number',10);
        $table->string('Invitee_Name',100);
        $table->boolean('Status');
        $table->string('Invitedby',100);
        $table->string('invitationid', 100)->unique();
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
        Schema::dropIfExists('invites');
    }
}
