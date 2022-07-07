<?php
namespace App;
// classname - ContactUS.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the ContactUs page  table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class ContactUS extends Model
{
    public $table = 'contactus';
    public $fillable = ['name','email','message'];
}
