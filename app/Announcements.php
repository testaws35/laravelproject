<?php

namespace App;

// classname - Announcements.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Announcements table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
   
    protected $table = 'announcements';
    protected $fillable = ['UserID','Title','Function_Content','FunctionDate','Createdby','CreatedOn','Status','Post_Status'];
    protected $primaryKey = 'AnnouncementsID';
     // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
    protected $dates = ['FunctionDate'];


    /**
     * This table has relationship with AnnouncementsPhotos
     */
    public function AnnouncementsPhotos()
    {
        return $this->hasMany('App\AnnouncementsPhotos');
    }

    /**
     * This table has relationship with AnnouncementsVideos
     */
    public function AnnouncementsVideos()
    {
        return $this->hasMany('App\AnnouncementsVideos');
        
    }

}
