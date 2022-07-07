<?php
namespace App;

// classname - PersonalFunctionsPhotos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the PersonalFunctions Photos table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class PersonalFunctionPhotos extends Model
{
     // name of table personal_function_photos see in Database
     protected $table = 'personal_function_photos';
     protected $fillable = ['PersonalFunctionID','Photo','Createdby', 'CreatedOn'];
     protected $primaryKey = 'PersonalFunction_PhotosID';
     // this is added if we are not using Laravel default CreatedOn field.
     public $timestamps = false;
 
     public function personal_functions()
     {
        return $this->belongsTo('App\PersonalFunctions', 'PersonalFunctionID');
     }
}
