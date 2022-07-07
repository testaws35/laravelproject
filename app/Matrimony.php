<?php
namespace App;
// classname - Matrimony.php
// author - Raveendra 
// release version - 1.0
// Description-  This model represents the Matrimony registration table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class Matrimony extends Model
{
    protected $table = 'matrimony_registration';
    protected $fillable = ['Profile_User_ID','ProfileUser_Name','ProfileUser_Gender','ProfileUser_Age','ProfileUser_MaritalStatus','ProfileUser_Mobile','ProfileUser_email','ProfileUser_AnyDisability','ProfileUser_PlaceofBirth','ProfileUser_LocationID','ProfileUser_Address','ProfileUser_DOB','ProfileUser_Photo','ProfileUser_Horoscope','ProfileUser_Degree','ProfileUser_Deg_FinishingYear','ProfileUser_CurrentDesignation','ProfileUser_Salary','ProfileUser_CurrentCompany','ProfileUser_EmplSinceWhen','ProfileUser_FatherName','ProfileUser_FatherCaste', 'ProfileUser_Father_Occupation','ProfileUser_MotherName','ProfileUser_MotherCaste','ProfileUser_Mother_Occupation','ProfileUser_Sisters_Num','ProfileUser_MarriedSis_Num','ProfileUser_Brothers_Num','ProfileUser_MarriedBro_Num','ProfileUser_Rashi','ProfileUser_Natchithram','ProfileUser_AnyDosam','ProfileUser_PreferredCaste','ProfileUser_PreferredStar','ProfileUser_Description_Expectation','ProfileUser_payment_Status','ProfileUser_payment_Amount','ProfileUser_payment_mode','ProfileUser_payment_Date','ProfileUser_Category','ProfileUser_TOB','ProfileUser_Height','ProfileUser_Weight','ProfileUser_BodyType','ProfileUser_BloodGroup','ProfileUser_PhysicalStatus','ProfileUser_PhysicallyChallengedDetails','Status','Createdby','CreatedOn'];
    // primary key of the table is registrationid
    protected $primaryKey = 'RegistrationID';

}
