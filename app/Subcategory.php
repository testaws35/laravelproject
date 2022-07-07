<?php
namespace App;
// classname - Subcategory.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Subcategory table
// created date - Nov 2019

use App\Product;
use Illuminate\Database\Eloquent\Model;
class Subcategory extends Model
{
    protected $table = 'demo_subcategory';
    protected $fillable = ['CategoryID', 'SubCategoryName', 'Status'];
    protected $primaryKey = 'SubCategoryID';
  
   
    public function subcategory()
    {
        return $this->belongsTo('App\Category', 'CategoryID');
    }
}
