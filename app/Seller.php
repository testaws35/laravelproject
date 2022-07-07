<?php
namespace App;
// classname - Seller.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Seller table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class Seller extends Model
{
    protected $table = 'seller';
    protected $fillable = ['UserID', 'Name', 'CompanyName', 'Description', 'Location', 'seller_Mobile','Createdby', 'CreatedOn','Updatedby','UpdatedOn','Status'];
    protected $primaryKey = 'SellerID';
}
