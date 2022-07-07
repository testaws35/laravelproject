<?php
namespace App;
// classname - Product.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Product table
// created date - Nov 2019
  
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['SellerID', 'ProductName', 'Description', 'Photo', 'Weight', 'Price', 'Carats','Createdby', 'CreatedOn', 'Status', 'Modifiedby', 'ModifiedOn', 'SubCategoryID'];
    protected $primaryKey = 'ProductID';
}