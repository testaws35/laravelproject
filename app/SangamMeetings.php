<?php
namespace App;
// classname - SangamMeetings.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the SangamMeetings table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class SangamMeetings extends Model
{
    protected $dates = ['MeetingDate'];
    protected $table = 'sangam_meetings';
    protected $fillable = ['SangamID','Title','Meeting_Content','MeetingDate','Status', 'Createdby','CreatedOn','Post_Status'];
    protected $primaryKey = 'SangamMeetingID';
    public $timestamps = false;

    public function SangamMeetingPhotos()
    {
        return $this->hasMany('App\SangamMeetingPhotos');
    }

    public function SangamMeetingVideos()
    {
        return $this->hasMany('App\SangamMeetingVideos');
        
    }

    public function SangamMaster()
    {
        return $this->belongsTo('App\SangamMaster');
        
    }

}
