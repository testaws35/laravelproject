<?php
namespace App;
// classname - SangamMembers.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the SangamMembers table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class SangamMembers extends Model
{
    // name of table sangam_meeting_photos see in Database
    protected $dates = ['MembershipFromWhen'];
    protected $table = 'sangam_member_master';
    protected $fillable = ['SangamMemberID','SangamID', 'UserID', 'Position', 'MembersFromWhen', 'MembershipType'];
    protected $primaryKey = 'SangamMemberID';

    public function sangam_master()
    {
        return $this->hasMany('App\SangamMaster', 'SangamID');
    }
}
