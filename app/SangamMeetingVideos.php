<?php
namespace App;
// classname - SangamMeetingVideos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the SangamMeetingVideos table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class SangamMeetingVideos extends Model
{
    protected $table = 'sangammeeting_videos';
    protected $fillable = ['SangamMeetingID','Video','Createdby', 'CreatedOn'];
    protected $primaryKey = 'SangamMeeting_VideosID';
    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
   
    public function sangam_meetings()
    {
         return $this->belongsTo('App\SangamMeetings', 'SangamMeetingID');
    }

}
