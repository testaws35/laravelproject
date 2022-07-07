<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrimonyRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrimony_registration', function (Blueprint $table) {
            $table->increments('RegistrationID');
            $table->integer('Profile_User_ID');
            $table->string('ProfileUser_Name',100);
            $table->string('ProfileUser_Gender',10);
            $table->integer('ProfileUser_Age');
            $table->string('ProfileUser_MaritalStatus',15);
		    $table->string('ProfileUser_Mobile',10);
            $table->string('ProfileUser_email',100);
            $table->string('ProfileUser_AnyDisability');
		    $table->string('ProfileUser_PlaceofBirth');
            $table->string('ProfileUser_LocationID');
            $table->string('ProfileUser_Address');
            $table->string('ProfileUser_DOB',15);
		    $table->binary('ProfileUser_Photo');
            $table->binary('ProfileUser_Horoscope');

            $table->string('ProfileUser_Degree',100);
            $table->Year('ProfileUser_Deg_FinishingYear');
            $table->string('ProfileUser_CurrentDesignation',100);
            $table->string('ProfileUser_CurrentCompany',100);
            $table->date('ProfileUser_EmplSinceWhen');
			
            $table->string('ProfileUser_FatherName',100);
            $table->date('ProfileUser_MotherName',100);
            $table->integer('ProfileUser_Sisters_Num');
            $table->integer('ProfileUser_MarriedSis_Num');
            $table->integer('ProfileUser_Brothers_Num');
            $table->integer('ProfileUser_MarriedBro_Num');
            $table->string('ProfileUser_Rashi',100);
            $table->string('ProfileUser_Natchithram',100);
            $table->string('ProfileUser_AnyDosam');
            $table->string('ProfileUser_PreferredSCaste');
            $table->string('ProfileUser_PreferredStar',100);
            $table->string('ProfileUser_Description_Expectation');
			
			
			
            $table->string('ProfileUser_payment_Status',10);
            $table->float('ProfileUser_payment_Amount');
            $table->string('ProfileUser_payment_mode',100);
            $table->datetime('ProfileUser_payment_Date');
            $table->string('ProfileUser_Category',10);

            $table->string('ProfileUser_TOB',100);
            $table->string('ProfileUser_Height',100);
            $table->string('ProfileUser_Weight',100);
            $table->string('ProfileUser_BodyType',100);
            $table->string('ProfileUser_BloodGroup',100);
            $table->string('ProfileUser_PhysicalStatus',10);
            $table->string('ProfileUser_PhysicallyChallengedDetails',250);
            
            $table->boolean('Status',10);
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
        Schema::dropIfExists('matrimony_registration');
    }
}
