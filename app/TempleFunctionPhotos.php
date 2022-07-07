<?php
namespace App;

// classname - TemplelFunctionPhotos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the TempleFunctions Photos table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class TempleFunctionPhotos extends Model
{
    // name of table temple_function_photos see in Database
    protected $table = 'temple_function_photos';
    protected $fillable = ['TempleFunctionID','Photo','Createdby', 'CreatedOn'];
    protected $primaryKey = 'TempleFunction_PhotosID';
    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;

   
    public function temple_functions()
    {
           return $this->belongsTo('App\TempleFunctions', 'TempleFunctionID');
    }
}
