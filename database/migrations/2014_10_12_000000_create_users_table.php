<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
           // $table->integer('User_InvitationID');
          // $table->string('User_InvitationID', 100)->unique();
            $table->string('User_InvitationID', 100);
            $table->string('User_Caste',200);
            $table->string('User_Subcaste',200);
            $table->string('User_Phone',10)->unique();
            $table->integer('otp')->nullable();
            $table->string('User_Gender',10);
            $table->string('User_MaritalStatus',15);
            $table->integer('User_Country');
            $table->integer('User_State');
            $table->integer('User_City');
            $table->string('User_Address');
            $table->binary('User_photo');
            $table->string('User_Father_Name',100);
            $table->string('User_Mother_Name',100);
            $table->string('User_Brother_Num');
            $table->string('User_Sister_Num');
            $table->string('User_Native');
          //  $table->string('google_id')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
