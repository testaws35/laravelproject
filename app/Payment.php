<?php
namespace App;
// classname - Payment.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Payment table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
     // name of table personal_function_photos see in Database
     protected $table = 'payments';
     protected $fillable = ['Vendor_PaymentID','UserID','TransactionDate','TransactionTime','TransactionAmount','TransactionType','TransactionStatus','PaymentMethod','created_at'];
     protected $primaryKey = 'TransactionID';
     
     // this is added if we are not using Laravel default CreatedOn field.
     public $timestamps = false;
}

