<?php
namespace App;
// classname - SangamMaster.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the SangamMaster  table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class SangamMaster extends Model
{
    // name of table sangam_meeting_photos see in Database
    protected $dates = ['Sangam_StartedOn'];
    protected $table = 'sangam_master';
    protected $fillable = ['SangamID','Sangam_Name', 'Sangam_Location', 'Sangam_Description', 'Sangam_StartedOn', 'Sangam_Status', 'Sangam_Photo', 'Num_of_members','Sangam_Activities', 'Createdby', 'CreatedOn'];
    protected $primaryKey = 'SangamID';

    public function sangam_meetings()
    {
        return $this->hasMany('App\SangamMeetings', 'SangamID');
    }
}
