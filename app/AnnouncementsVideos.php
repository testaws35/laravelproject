<?php

namespace App;

// classname - AnnouncementsVideos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Announcements Videos table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;

class AnnouncementsVideos extends Model
{
    protected $table = 'announcements_videos';
    protected $fillable = ['AnnouncementsID','Video','Createdby', 'CreatedOn'];
    protected $primaryKey = 'Announcements_VideosID';

    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
   
   /**
     * This table has relationship with Announcements
     */
    public function announcements()
    {
         return $this->belongsTo('App\Announcements', 'AnnouncementsID');
    }
}
