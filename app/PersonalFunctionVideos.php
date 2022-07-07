<?php

namespace App;
// classname - PersonalFunctionsVideos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the PersonalFunctions Videos table
// created date - Nov 2019


use Illuminate\Database\Eloquent\Model;

class PersonalFunctionVideos extends Model
{
    protected $table = 'personal_function_videos';
    protected $fillable = ['PersonalFunctionID','Video','Createdby', 'CreatedOn'];
    protected $primaryKey = 'PersonalFunction_VideosID';
    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
   
    public function personal_functions()
    {
         return $this->belongsTo('App\PersonalFunctions', 'PersonalFunctionID');
    }
}
