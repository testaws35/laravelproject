<?php
namespace App;

// classname - SellerPaymentTransaction.php
// author - Aruna 
// release version - 1.0
// Description-  This Model represents the Seller PaymentTransactions
// created date - July 2020

use Illuminate\Database\Eloquent\Model;

class SellerPaymentTransaction extends Model
{
    protected $table = 'seller_payment_transactions';
    protected $fillable = ['PaymentSellerID', 'PaymentFinalAmount', 'PaymentVendorName', 'PaymentVendorTransactionID', 'PaymentVendorTransactionStatus', 'PaymentType', 'PaymentDate', 'PaymentUserID', 'PaymentMethod'];
    protected $primaryKey = 'PaymentID';

    // this is added if we are not using Laravel default CreatedOn field.
    public $timestamps = false;
}
