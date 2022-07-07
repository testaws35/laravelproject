<?php
namespace App;
// classname - ContactUsLand.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Landing page Contact Mail sending
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class ContactUsLand extends Model
{
    public $table = 'contactusland';
    public $fillable = ['name','email','message'];
}
