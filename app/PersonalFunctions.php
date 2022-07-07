<?php

namespace App;
// classname - PersonalFunctions.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the PersonalFunctions table
// created date - Nov 2019


use Illuminate\Database\Eloquent\Model;

class PersonalFunctions extends Model
{
  
    protected $table = 'personal_functions';
    protected $fillable = ['UserID','Title','Function_Content','FunctionDate','Createdby','CreatedOn','Status','Post_Status'];
    protected $primaryKey = 'PersonalFunctionID';
    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
    protected $dates = ['FunctionDate'];



    public function PersonalFunctionPhotos()
    {
        return $this->hasMany('App\PersonalFunctionPhotos');
    }

   
    public function PersonalFunctionVideos()
    {
        return $this->hasMany('App\PersonalFunctionVideos');
    }

}
