<?php

// classname - RazorpayController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Seller feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Razorpay\Api\Api;
use Session;
use Redirect;

class RazorpayController extends Controller
{
    public function getRazorPaymentDetails(Request $request)
    { 
        $paymentId = $request->paymentId;
    	 
       	$curl = curl_init();
    	$url = env('RAZORPAY_URL')."/payments/".$paymentId;
     	curl_setopt_array($curl, array(
    	  CURLOPT_URL => $url,
    	  CURLOPT_RETURNTRANSFER => true,
    	  CURLOPT_ENCODING => "",
    	  CURLOPT_MAXREDIRS => 10,
    	  CURLOPT_TIMEOUT => 0,
    	  CURLOPT_FOLLOWLOCATION => true,
    	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	  CURLOPT_CUSTOMREQUEST => "GET",
    	  CURLOPT_HTTPHEADER => array(
    		"Authorization: Basic ".env("RAZORPAY_KEY_COMBINATION")
    	  ),
    	));
    	$response = curl_exec($curl);
    	
    	$resp = json_decode($response);
        if( isset($resp) && (isset($resp->error )))
        {
             return response()->json($resp->error->description, 201);
        }
    
          $resStr= $resp->status;
    
    
           $amount = $resp->amount;
           
           
           //usha - second step for capturing the payment in razorpay dashbaord  
           $curl1 = curl_init();
           
           $url1 = env('RAZORPAY_URL')."/payments/".$paymentId."/capture";
           
           curl_setopt_array($curl1, array(
               
               CURLOPT_URL => $url1,
               
               CURLOPT_RETURNTRANSFER => true,
               
               CURLOPT_ENCODING => "",
               
               CURLOPT_MAXREDIRS => 10,
               
               CURLOPT_TIMEOUT => 0,
               
               CURLOPT_FOLLOWLOCATION => true,
               
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               
               CURLOPT_CUSTOMREQUEST => "POST",
               
               CURLOPT_POSTFIELDS =>'{"amount":"'.$amount.'"}',
               
               CURLOPT_HTTPHEADER => array(
               
               "Authorization: Basic ".env("RAZORPAY_KEY_COMBINATION"),
               
               "Content-Type: application/json"
               
               ),
               
               ));
               $response1 = curl_exec($curl1);
               curl_close($curl1);
    
    
            curl_close($curl);		
         	return  $response1;
                
           
   
	
   }
    
    
}