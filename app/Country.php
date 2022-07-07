<?php
namespace App;
// classname - Country.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Country list
// created date - Nov 2019


use Illuminate\Database\Eloquent\Model;
class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [ 'name'];
    protected $primaryKey = 'id';
}
