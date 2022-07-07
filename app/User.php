<?php
namespace App;

// classname - User.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents User in the application
// created date - Nov 2019


use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


//Laravel framework itself take care of Authentication in different model
// 1. Simple DB check for User
// 2. DB check and mail verification etc..
// T


//Aruna commented interface MustVerifyEmail interface implementatiion
class User extends Authenticatable //implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    
    protected $fillable = ['name', 'email', 'password', 'username', 'User_InvitationID', 'User_Caste', 'User_Subcaste', 'User_Phone', 'User_Gender', 'User_MaritalStatus', 'User_Country', 'User_State', 'User_City', 'User_Address', 'User_photo', 'User_Father_Name', 'User_Mother_Name', 
        'User_Brother_Num', 'User_Sister_Num', 'User_Native','UserroleID','User_Occupation','IsReginMatrimony',
        'MatrimonyMembershipExpiry','User_MatrimonyMembershipType','IsTempleMember','SellerMembershipExpiryDate',
        'IsSeller','IsElder','IsSangamMember'];

    protected $primaryKey = 'id';
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getImageAttribute()
    {
       return $this->User_photo;
    }


}
