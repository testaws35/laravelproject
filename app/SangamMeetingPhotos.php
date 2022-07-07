<?php
namespace App;
// classname - SangamMeetingPhotos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the SangamMeetingPhotostable
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class SangamMeetingPhotos extends Model
{
    // name of table sangam_meeting_photos see in Database
    protected $table = 'sangam_meeting_photos';
    protected $fillable = ['SangamMeetingID','Photo','Createdby', 'CreatedOn'];
    protected $primaryKey = 'SangamMeeting_PhotosID';
    public $timestamps = false;

    public function sangam_meetings()
    {
      return $this->belongsTo('App\SangamMeetings', 'SangamMeetingID');
    }

}
