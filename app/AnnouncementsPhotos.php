<?php

namespace App;

// classname - AnnouncementsPhotos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Announcements Photos table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;

class AnnouncementsPhotos extends Model
{
     protected $table = 'announcements_photos';
     protected $fillable = ['AnnouncementsID','Photo','Createdby', 'CreatedOn','Status'];
     protected $primaryKey = 'Announcements_PhotosID';
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
