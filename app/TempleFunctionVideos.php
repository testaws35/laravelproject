<?php
namespace App;
// classname - TemplelFunctionVideos.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the TempleFunctions Videos  table
// created date - Nov 2019


use Illuminate\Database\Eloquent\Model;
class TempleFunctionVideos extends Model
{
    protected $table = 'temple_function_videos';
    protected $fillable = ['TempleFunctionID ','Video','Createdby', 'CreatedOn'];
    protected $primaryKey = 'TempleFunction_VideosID';
    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
   
    public function temple_functions()
    {
          return $this->belongsTo('App\TempleFunctions', 'TempleFunctionID ');
    }

}
