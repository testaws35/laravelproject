<?php

// classname - SellerController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Seller feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\User;
use App\SellerPaymentTransaction;
use DB;
use Auth;
use Lang;

use Session;
use Redirect;

class SellerController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        $success = $request->success;
                                   
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
        if(isset($request->mon))
        {

            switch($request->mon){
            case '0':
                     $curMonth =  date('Y-m-d', strtotime("now") );
                     break;
            case '1':
                     $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                     break;
            case '2':
                     $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                     break;
            case '3':
                     $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                     break;
            case '4':
                     $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                     break;
            case '5':
                     $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                     break;
            case '6':
                     $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                     break;
            default:
                     $curMonth= Date('Y-m-d');
            }
        }
        else
        {
                     $curMonth= Date('Y-m-d');
        }

        $currentYear =  date("Y",strtotime($curMonth) );
        $currentMonth = date("m",strtotime($curMonth) );
        $currentMonthName=  date("M",strtotime($curMonth) );
        
       
        $sellers = DB::table('seller')
                        ->where('Status','=',1)
                        ->whereYear('seller.CreatedOn','=',$currentYear)
                        ->whereMonth('seller.CreatedOn','=',$currentMonth)
                        ->orderBy('Name', 'Asc')
                        ->get();
                        

        if (isset($sellers)  && count($sellers) > 0  ){
                    return view('sellers.index', compact('sellers','currentYear','currentMonthName','success')); 
        }
        else 
        {

                    $sellers=null;
                    $Failed = Lang::get('home.seller_failed').$currentMonthName. '  , ' .$currentYear;
             
                    return view('sellers.index',compact('sellers', 'Failed','success'));
       }               
        

    }

    /**
      * Show the form for creating a new resource.
      * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
          }
          
          $razorPayKey = env("RAZOR_PAY_KEY"); 
          $user = DB::table("users")
        							->where("id","=",Auth::user()->id)
        							->first();
          
          return view('sellers.create',compact('razorPayKey','user'));
    }

     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
        try 
        {
            
            // Transaction
             $exception = DB::transaction(function() use ($request) 
             {
                $paymentobj      = (object) ($request->payment);
                $sellerobj        = (object) ($request->seller);
            
       
                // Storing the Seller Details
                                
                $input =  new Seller;
              
                $input->Name = $sellerobj->Name;
                $input->CompanyName = $sellerobj->CompanyName;
                $input->Description = $sellerobj->Description;
                $input->Location = $sellerobj->Location;
                $input->seller_Mobile = $sellerobj->Phone;
                $input->SellerMembershipExpiryDate = date('Y-m-d', strtotime(' + 1 year'));
                $input->UserID =Auth::user()->id;
                
                $input->Status =1;
                $input->Createdby = Auth::user()->id;  // please repleace this with userid of session
                $input->CreatedOn = date('Y-m-d');;
                $input->save();
               
                
               
                
                DB::table('users')
                            ->where('id','=',Auth::user()->id)
                            ->update(['IsSeller' => 1,'SellerMembershipExpiryDate'=>date('Y-m-d', strtotime(' + 1 year'))]);
                            
                $sellerid = $input->SellerID;
                //seller payment table
                $payment = new SellerPaymentTransaction ;
          
                $payment->PaymentSellerID = $sellerid;
                $payment->PaymentFinalAmount = '1';
                $payment->PaymentVendorName = "razorpay";// change it later dynamically
                $payment->PaymentVendorTransactionID = $paymentobj->transactionid;
                $payment->PaymentVendorTransactionStatus = $paymentobj->transactionstatus;   //success orfailure
                $payment->PaymentType = "payment"; //
                $payment->PaymentUserID = Auth::user()->id;   // $request->get('UserID');
                $payment->PaymentDate = Date('Y-m-d');
                $payment->PaymentMethod = $paymentobj->paymentmethod;  //netbanking /card/googlepay
                $payment->save();
                 
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return response()->json(array("success"=>true));

            
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('SellerController:Store:  Exception while adding seller ',(array)$exception);
                return redirect()->route('sellers.index')->with('error',Lang::get('home.fail_msg'));
            }
        
        }
        catch(Exception $e) {
             //throw new Exception;
             Log::info('SellerController:Store:  Exception while adding seller ',(array)$e);
             return redirect()->route('sellers.index')->with('error',Lang::get('home.fail_msg'));
        }
    }


   /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show($sellerID)
    {
          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }

           $seller= Seller::find($sellerID);
          

           return view('sellers.show',compact('seller'));
    }

   
   /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit($sellerID)
    {
          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }
           $seller= Seller::find($sellerID);
        return view('sellers.edit',compact('seller'));
    }

  

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }

        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {
                 
             $seller = Seller::find($request->SellerID);     
             
             $seller->Name = $request->Name;
             $seller->CompanyName = $request->get('CompanyName');
             $seller->Description = $request->get('Description');
             $seller->Location = $request->get('Location');
             
             $seller->Status =1;
             $seller->Updateby = Auth::user()->id;  // please repleace this with userid of session
             $seller->UpdateOn = date('Y-m-d');
            
             $seller->update();

            
             
       

        }); //end of transaction

        if(is_null($exception)) {
            DB::commit();
            return redirect()->route('community')
            ->with('success',Lang::get('home.updated_success'));
        
        } else {
            DB::rollback();
            //throw new Exception;
            Log::info('SellerController:update:  Exception while updating seller ',(array)$exception);
            return redirect()->route('community')
            ->with('error',Lang::get('home.updated_fail'));
        }
    
    }
    catch(Exception $e) {
        //throw new Exception;
        Log::info('SellerController:update:  Exception while updating seller ',(array)$e);
        return redirect()->route('community')
        ->with('error',Lang::get('home.updated_fail'));
        }
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($sellerID)
    {
          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
          }

       //we are doing soft Delete only
       $varproduct = Seller::find($sellerID);
       //echo $varproduct;
       if (isset($varproduct)){
             // $varproduct->delete(); //mark the product Status as 0 to do soft delete
             $varproduct->Status = 0;
             $varproduct->save();
             return redirect()->route('sellers.index')->with('success',Lang::get('home.deletion_success'));
       }
       else{
             return redirect()->route('sellers.index')->with('failure',Lang::get('home.deletion_fail'));
       }

    }

    
}












