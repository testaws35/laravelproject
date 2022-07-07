<?php

// classname - PagesController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Community feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SangamMaster;
use App\TempleMaster;
use App\Seller;
use DB;
use Auth;
use Razorpay\Api;


class PagesController extends Controller
{

   
   /**
     * Display Community menu pages.
     *
     */
    public function community(){

       //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
          return view('auth.SessionTimeout');
        }
        $sangams = DB::table('sangam_master')
                      ->where('Sangam_Status','=',1)
                      ->get();
        
        $temples = DB::table('temple_master')
                      ->where('Temple_Status','=',1)
                      ->get();
                      
        $sellers = DB::table('seller')
                        ->where('Status','=',1)
                        ->get();
                        
        $users = DB::table('users')
                    ->select('name','id')
                    ->where('IsActive','=','1')
                    ->get();
                    
        return view('pages.community',compact('sangams', 'temples','sellers','users'));
    } 


}
