<?php

namespace App;
// classname - Category.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Category (of Products) table
// created date - Nov 2019


use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $table = 'demo_category';
    protected $fillable = ['CategoryName', 'Status'];
    protected $primaryKey = 'CategoryID';


    /**
     * This table has relationship with SubCategories
     */
    public function Categories()
    {
         return $this->hasMany('Subcategory');
    }


    /**
     * This table has relationship with Products
     */
    public function products() 
    {
      return $this->hasMany('App\Product');
    }


}
