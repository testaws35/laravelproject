<?php
namespace App;

// classname - TemplelFunctions.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the TempleFunctions  table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class TempleFunctions extends Model
{
    protected $table = 'temple_functions';
    protected $fillable = ['TempleID','Title','Function_Content','FunctionDate','Createdby','CreatedOn','Status','Post_Status'];
    protected $primaryKey = 'TempleFunctionID';
    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
    protected $dates = ['FunctionDate'];

    public function TempleFunctionPhotos()
    {
        return $this->hasMany('App\TempleFunctionPhotos');
    }

   
    public function TempleFunctionVideos()
    {
        return $this->hasMany('App\TempleFunctionVideos');
        
    }

}
