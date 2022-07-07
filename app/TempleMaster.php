<?php
namespace App;
// classname - TempleMaster.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the TempleMaster table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class TempleMaster extends Model
{
    // name of table sangam_meeting_photos see in Database
    protected $dates = ['Temple_StartedOn'];
    protected $table = 'temple_master';
    protected $fillable = [ 'TempleID', 'Temple_Name', 'Temple_Description', 'Temple_StartedOn', 'Temple_Head', 'Temple_Address', 'Temple_Nearby_City', 'Temple_BusRoute', 'Temple_OwnedBy_Subsect', 'Temple_SharedWith_Anyone', 'Temple_Location',   'Temple_Status', 'Temple_Photo',   'Createdby', 'CreatedOn', ];
    protected $primaryKey = 'TempleID';

    public function temple_functions()
    {
        return $this->hasMany('App\TempleFunctions', 'TempleID');
    }
}
