<?php

// classname - MatrimonyController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Matrimony feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;

use Razorpay\Api;

use Session;
use Redirect;
use DB;
use Log;
use Auth;
use Lang;

// DECLARE ALL the models used
use App\User;
use App\Subcaste;
use App\SubcasteGroupMap;
use App\Matrimony;
use App\Payment;
use Alert;
use Validator;
use App\Http\Controllers\Exception;


class MatrimonyController extends Controller
{
   /**
     * Display a listing of the matching matrimony profiles.
     *
     */

    public function index(Request $request)
    {  
       //Check for Session time out and redirect to Login page on Session time out 
       if ( ! Auth::check()){
       return view('auth.SessionTimeout');
       }

       $matrimonys=null;
       $caste=null;
          $razorPayKey = env("RAZOR_PAY_KEY"); 
          $user = DB::table("users")
        							->where("id","=",Auth::user()->id)
        							->first();
      

       //scenario 1:  if Session user has not registered in Matrimony then
        if (Auth::user()->IsReginMatrimony == 0){

                    /********************
                     * Free membership code - Begin
                     *
                    $toDay = Date('Y-m-d');
                    $checkdate  =strtotime('2021-05-30');

                    if($toDay <= $checkdate){

                    echo" in Matrimony- index - Free scheme";
                    $Message =4;
                    //Aruna added - for Free Matrimony
                    
                        return view('matrimonys.index',compact('matrimonys', 'Message') )
                            ->with('Free','Free Service');
                    }

                    /********************
                     * Free membership code - End
                     */
                    //else
                    {
        
                        $matrimonys=null;

                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                    
                        return view('matrimonys.index',compact('matrimonys','razorPayKey','user') )
                            ->with('Failed',Lang::get('home.matri_reg'));
                    }
        }
        else
        {
                //scenario 2 : Membership expired
               

                if ( (Auth::user()->IsReginMatrimony ==1 )&&(Auth::user()->MatrimonyMembershipExpiry) < date('Y-m-d')  ) 
                //membership expity date is less than today
                        
                {
                    
                        $matrimonys=null;
                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                         return view('matrimonys.index',compact('matrimonys','razorPayKey','user') )
                             ->with('Failed',Lang::get('home.mem_renew'));
                }
       
                $profileuser = Matrimony::where('Createdby', Auth::user()->id)
                                        ->where('Status','1')
                                        ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                        //first helps you get only one row and avoid a list as a result
                                        ->first();

                //scenario 3: If session user has registered , no expiry but not created any profile 
                if (!isset($profileuser) && (Auth::user()->MatrimonyMembershipExpiry) > date('Y-m-d') )  
                {
                    $matrimonys=null;
                    //Aruna added - objects to be passed in compact with view 
                    // and messages to be passed using with clause
                    return view('matrimonys.index',compact('matrimonys') )
                     ->with('Failed',Lang::get('home.matri_noactive'));
                }     
                

                //scenario 4: If session user has registered previously and deleted the profile irrespective of expiry date
                if (isset($profileuser) &&  $profileuser->RegistrationID ==0  )  
                {
                    $matrimonys=null;
                    //Aruna added - objects to be passed in compact with view 
                    // and messages to be passed using with clause
                    return view('matrimonys.index',compact('matrimonys','razorPayKey','user') )
                     ->with('Failed',Lang::get('home.matri_prodelete'));
                }    

                // get profile user subcaste ID

                //in case Profile User has given Subcaste as 'Don't know' or 'Not Applicable' 
                //then only gender to be checked
                
                //scenario 5:  whether User wants to fetch mathcing profiles based on his registered caste 
                //  or based on what caste he chose in Index page now
                //
                $caste = null;


                //First option is Preferred Caste selected in UI, then  Preferred Caste  given in profile and then profile caste
                if (isset($request->User_Caste) )
                {
                    $caste = $request->User_Caste;
                    
                }
                else if (isset($profileuser->ProfileUser_PreferredCaste) )
                {
                    $caste = $profileuser->ProfileUser_PreferredCaste;
                    
                }
                else{
                    $caste = $profileuser->ProfileUser_Category;
                    
                }

             
                $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");

                //scenario 6 If user registered caste or selected caste in index page is All
                //then we show all opposite Gender of Tamil and Telugu Viswakarma
                if (( strcmp( trim($caste) , "All") ==0))
                {

                    //now find Bride or Groom of matching subcaste
                    $matrimonys = DB::table('matrimony_registration') 
                                    ->where('Status','=','1')
                                    ->where('ProfileUser_Gender','!=', $profileuser->ProfileUser_Gender)    
                                    ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                    ->orderby('ProfileUser_Name', 'ASC')
                                    ->get();
                    
                    
                    if ( !isset($matrimonys) || ( count($matrimonys) == 0)  )
                    {
                        $matrimonys=null;
                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                        
                        return view('matrimonys.index',compact('matrimonys','profileuser','castemasters', 'caste', 'Failed') )
                                ->with('Failed',Lang::get('home.no_profiles'));
                    }
                    else
                    {
                   
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp(Auth::user()->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                $matrimonys =$matrimonys ->take(50);
                                            //->paginate(6); 
                            }
                            //Half yearly plan - only 150 profiles shown                    
                            elseif (strcmp(Auth::user()->User_MatrimonyMembershipType,"Halfyearly") == 0)
                            {
                                $matrimonys =$matrimonys->take(150);
                                            //->paginate(6); 
                            }
                            //yearly plan
                            else
                            {
                                $matrimonys = DB::table('matrimony_registration') 
                                    ->where('Status','=','1')
                                    ->where('ProfileUser_Gender','!=', $profileuser->ProfileUser_Gender)    
                                    ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                    ->orderby('ProfileUser_Name', 'ASC')
                                    ->get();
                                            //->paginate(6); 
                            }
                           
                            $Failed =null;
                            return view('matrimonys.index',compact('matrimonys', 'profileuser','castemasters', 'caste', 'Failed','castemasters_matri') )
                                              ->with('i', (request()->input('page', 1) - 1) * 5);
                    }
                } 

                //scenario 7 If user registered caste or selected caste in index page is Tamil Viswakarma
                //then we show all opposite Gender of Tamil Viswakarma

                if (( strcmp( trim($caste) , "Tamil Viswakarma") ==0))
                {
                    
                  
                    //now find Bride or Groom of matching subcaste
                    $matrimonys = DB::table('matrimony_registration') 
                                    ->where('Status','=','1')
                                    ->where('ProfileUser_Gender','!=', $profileuser->ProfileUser_Gender)    
                                    ->where('ProfileUser_Category', $caste)   
                                    ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                    ->orderby('ProfileUser_Name', 'ASC') 
                                    ->get() ;                               
                                                    
                    if ( ! isset($matrimonys)|| ( count($matrimonys) == 0) ) 
                    {
                        $matrimonys=null;
                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                        
                        return view('matrimonys.index',compact('matrimonys', 'profileuser','castemasters', 'caste', 'Failed') )
                                ->with('Failed',Lang::get('home.no_profiles'));
                    }    
                    else
                    {           
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp(Auth::user()->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                $matrimonys =$matrimonys->take(50);
                                           // ->paginate(6); 
                            }
                            //Halfyearly plan - only 150 profiles shown                    
                            elseif (strcmp(Auth::user()->User_MatrimonyMembershipType,"Halfyearly") == 0)
                            {
                                $matrimonys =$matrimonys->take(150);
                                           // ->paginate(6); 
                            }
                            //yearly plan
                            else{
                                $matrimonys =$matrimonys->take(50);
                                            //->paginate(6); 
                            }

                            $Failed =null;
                            return view('matrimonys.index',compact('matrimonys', 'profileuser','castemasters', 'caste', 'Failed') )
                                    ->with('i', (request()->input('page', 1) - 1) * 5);
                    }
                } 
                

                //scenario 8: If user registered caste or selected caste in index page is Telugu Viswakarma
                // and Subcaste is Not Applicable or Dont Know 
                //then we show all opposite Gender of Telugu Viswakarma
                if (  ( strcmp( trim($caste) , "Telugu Viswakarma") ==0)   &&( strcmp( trim($profileuser->ProfileUser_Category) , "Tamil Viswakarma") ==0)  )
                {
                    
                   
                    //now find Bride or Groom of all subcaste in Telugu
                    $matrimonys = DB::table('matrimony_registration') 
                                        ->where('Status','=','1')
                                        ->where('ProfileUser_Gender','!=', $profileuser->ProfileUser_Gender) 
                                        ->where('ProfileUser_Category','=',$caste)   
                                        ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                        ->orderby('ProfileUser_Name', 'ASC') 
                                        ->get() ;  
                                     
                    if ( ! isset($matrimonys)|| ( count($matrimonys) == 0) )
                    {
                        $matrimonys=null;
                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                        return view('matrimonys.index',compact('matrimonys', 'profileuser','castemasters', 'caste', 'Failed') )
                                 ->with('Failed',Lang::get('home.no_profiles'));
                    }
                    else
                    {
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp(Auth::user()->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                $matrimonys =$matrimonys ->take(50);
                                           // ->paginate(6); 
                            }
                            //Halfyearly plan - only 150 profiles shown                    
                            elseif (strcmp(Auth::user()->User_MatrimonyMembershipType,"Halfyearly") == 0)
                            {
                                $matrimonys =$matrimonys ->take(150);
                                            //->paginate(6); 
                            }
                            //Yearly plan
                            else{
                                $matrimonys =$matrimonys ->get();
                                            //->paginate(6); 
                            }     
                            
                            
                                    
                            $Failed =null;

                            return view('matrimonys.index',compact('matrimonys', 'profileuser','castemasters','caste', 'Failed') )
                                    ->with('i', (request()->input('page', 1) - 1) * 5);
                        }
                }   
                
               
                //scenario 9: If user registered caste or selected caste in index page is Telugu Viswakarma
                // and Subcaste is given
                //then we show all opposite Gender of opposite Subsect group in Telugu Viswakarma
                else
                {    

                    //Logic here is critical
                    // we have to get the profie user's  (not Session user) Gender and subcaste group and
                    // retrieve other Matrimonies which are of opposite Gender and opposite subcaste group
                    // how to do this?

                    // Get Profile user gender  eg: male
                    // get profile user subcaste eg: 1 - Tamil Subcaste
                    // get profile user subcaste group   eg: 1 
                    // get subcaste groups other than profile user subcaste group   eg: 2,3,4 etc..  
                    // get all subcastes in the opposite group   eg: telugu subcaste  <etc class=""></etc>

                    // now  query matrimony table where gender is opposite and subcaste is in the opposite group

                    // we were wondering why $subcaste_ProfileUser was not working earlier when we had DB facade.
                    // we can reuse the result set of one query in another only when we have a model to represent 
                    // the table. So we created model for the subcaste_master table. After that , we were able to use
                    // the variable $subcaste_ProfileUser in subsequent queries


                    $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");

                    $subcaste_ProfileUser = Subcaste::where('SubCaste_Name',$profileuser->ProfileUser_Subcaste)
                                                    ->first();

                    //get profile user subcaste group id
                    //Again we created a model class for subcastegroup_subcastemaptable  so that this variable 
                    //can be used further. Again first() is used instead of get() to get single row
                    $subcastegroupid = SubcasteGroupMap::join('subcaste_master','subcaste_master.SubCasteID','=','subcastegroup_subcastemaptable.SubcasteID' )
                                                ->select ('subcastegroup_subcastemaptable.SubcasteGroupID As GrpID')
                                                ->where('subcaste_master.SubCaste_Name',$profileuser->ProfileUser_Subcaste)
                                                ->first();

                    // get the list of opposite groups id
                    $oppGroupID = SubcasteGroupMap::select ('subcastegroup_subcastemaptable.SubcasteGroupID As GroupID')
                                                ->where('subcastegroup_subcastemaptable.SubcasteGroupID','<>',$subcastegroupid->GrpID)
                                                ->first(); 
 
                    //get matching subcaste list from opposite groups
                    $matchingsubcastelists = SubcasteGroupMap::join ('subcaste_master','subcaste_master.SubCasteID','=','subcastegroup_subcastemaptable.SubcasteID')
                                                ->select('subcaste_master.SubCaste_Name As SubcasteName ')
                                                ->where('subcastegroup_subcastemaptable.SubcasteGroupID',$oppGroupID->GroupID)
                                                ->get();
                                                
                                                

                    $matrimonys = DB::table('matrimony_registration') 
                                                ->where('Status','=','1')
                                                ->where('ProfileUser_Gender','!=', $profileuser->ProfileUser_Gender)                                                           
                                                ->WhereIn('Profileuser_Subcaste',$matchingsubcastelists)
                                                ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                                ->orderby('ProfileUser_Name', 'ASC')
                                                ->get();

                   
                    //Aruna added-  Null check for a DB result was very tough because all functions
                    //like is_null, empty, isset returns as the list is having value
                    //finally we found count() function is the best to check for 
                    //null result from DB
                    if ( empty($matrimonys) || ( count($matrimonys) == 0)  )
                    {
                        $matrimonys=null;
 
                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                        return view('matrimonys.index',compact('matrimonys','profileuser','castemasters','caste'))
                                   ->with('Failed',Lang::get('home.no_profiles'));
                    }
                    else
                    {
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp(Auth::user()->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                   //now find Bride or Groom of matching subcaste
                                   $matrimonys =$matrimonys->take(50);
                            }
                            //Hlf yearly Membership - only 150 profiles shown
                            else if ( strcmp (Auth::user()->User_MatrimonyMembershipType,"Halfyearly") ==0 )
                            {
                                   $matrimonys =$matrimonys->take(150);
                            }
                            //yearly membership - no limits
                            else 
                            {
                                   $matrimonys =$matrimonys->all();
                            }
                            
                            $Failed =null;

                                return view('matrimonys.index',compact('matrimonys','profileuser', 'castemasters','caste','Failed'))
                                         ->with('i', (request()->input('page', 1) - 1) * 5);
                    }//end of else
                }//end of inner else

        }//end of outer else

    }



    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()

    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
            return view('matrimonys.create', compact('castemasters'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
            if ( ! Auth::check()){
                return view('auth.SessionTimeout');
            }

        // try...catch
        try {
           // Transaction
            $exception = DB::transaction(function() use ($request) {

               

            // Storing the Matrimony Details
            
            $input =  new Matrimony;
            $input->ProfileUser_Name = $request->get('ProfileUser_Name');
            $input->ProfileUser_Gender = $request->get('ProfileUser_Gender');
            $input->ProfileUser_Age = $request->get('ProfileUser_Age');
            $input->ProfileUser_MaritalStatus = $request->get('ProfileUser_MaritalStatus');

            $input->ProfileUser_email = $request->get('ProfileUser_email');
            $input->ProfileUser_PlaceofBirth = $request->get('ProfileUser_PlaceofBirth');
            $input->ProfileUser_Address = $request->get('ProfileUser_Address');
            $input->ProfileUser_LocationID = $request->get('ProfileUser_LocationID');
            $input->ProfileUser_DOB = $request->get('ProfileUser_DOB');

            $input->ProfileUser_AnyDisability = $request->get('ProfileUser_AnyDisability');
            $input->ProfileUser_Category = $request->get('ProfileUser_Category');
            $input->ProfileUser_Subcaste = $request->get('User_Subcaste');
            $input->ProfileUser_Mobile = $request->get('ProfileUser_Mobile');
            $input->ProfileUser_TOB = $request->get('ProfileUser_TOB');


            //personal details
            $input->ProfileUser_FatherName = $request->get('ProfileUser_FatherName');
            $input->ProfileUser_MotherName = $request->get('ProfileUser_MotherName');
            $input->ProfileUser_Father_Caste = $request->get('ProfileUser_Father_Caste');
            $input->ProfileUser_Mother_Caste = $request->get('ProfileUser_Mother_Caste');
            $input->ProfileUser_Father_Occupation = $request->get('ProfileUser_Father_Occupation');
            $input->ProfileUser_Mother_Occupation= $request->get('ProfileUser_Mother_Occupation');
            $input->ProfileUser_Sisters_Num = $request->get('ProfileUser_Sisters_Num');
            $input->ProfileUser_MarriedSis_Num = $request->get('ProfileUser_MarriedSis_Num');
            $input->ProfileUser_Brothers_Num = $request->get('ProfileUser_Brothers_Num');
            $input->ProfileUser_MarriedBro_Num = $request->get('ProfileUser_MarriedBro_Num');

            //astrological details

            $input->ProfileUser_Rashi = $request->get('ProfileUser_Rashi');
            $input->ProfileUser_Natchithram = $request->get('ProfileUser_Natchithram');
            $input->ProfileUser_AnyDosam = $request->get('ProfileUser_AnyDosam');
            $input->ProfileUser_PreferredCaste = $request->get('ProfileUser_PreferredCaste');
            $input->ProfileUser_PreferredStar = $request->get('ProfileUser_PreferredStar');
            $input->ProfileUser_Description_Expectation = $request->get('ProfileUser_Description_Expectation');
            
            //education & occupational details
            $input->ProfileUser_Degree = $request->get('ProfileUser_Degree');
            $input->ProfileUser_Deg_FinishingYear = $request->get('ProfileUser_Deg_FinishingYear');
            $input->ProfileUser_CurrentCompany = $request->get('ProfileUser_CurrentCompany');
            $input->ProfileUser_CurrentDesignation = $request->get('ProfileUser_CurrentDesignation');
            $input->ProfileUser_EmplSinceWhen = $request->get('ProfileUser_EmplSinceWhen');
            $input->ProfileUser_Salary = $request->get('ProfileUser_Salary');

            // physical attributes
            $input->ProfileUser_Height = $request->get('ProfileUser_Height');
            $input->ProfileUser_Weight = $request->get('ProfileUser_Weight');
            $input->ProfileUser_BodyType = $request->get('ProfileUser_BodyType');
            $input->ProfileUser_BloodGroup = $request->get('ProfileUser_BloodGroup');
            $input->ProfileUser_PhysicalStatus = $request->get('ProfileUser_PhysicalStatus');
            $input->ProfileUser_PhysicallyChallengedDetails = $request->get('ProfileUser_PhysicallyChallengedDetails');
            
            //photos
            // adding relative path for Mobile app sake 
            
            if( isset($request->ProfileUser_Photo)  ){
                            $uri = '/images/matrimonys/userphotos/';
                            $namewithextension = $request->ProfileUser_Photo->getClientOriginalName(); 
                            /*Name with extension 'filename.jpg'*/
                            $name = explode('.', $namewithextension)[0]; 
                            /* Filename 'filename'*/
                            $name = $name.'_'.time().'.'.$request->ProfileUser_Photo->getClientOriginalExtension();
                            $input['ProfileUser_Photo'] = $uri.$name;
                            $request->ProfileUser_Photo->move(public_path('images/matrimonys/userphotos/'), $name);
                            
   
                         
                    }
                if( isset($request->ProfileUser_Horoscope)  ){
                            $uri = '/images/matrimonys/horoscopephotos/';
                            $namewithextension = $request->ProfileUser_Horoscope->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->ProfileUser_Horoscope->getClientOriginalExtension();
                            $input['ProfileUser_Horoscope'] = $uri.$name;
                            $request->ProfileUser_Horoscope->move(public_path('images/matrimonys/horoscopephotos/'), $name);
                         
                    }
                    
           
            //payment details and subscription expiry details will be updated later during payment
            $input->Status = 1;
            $input->ProfileUser_MatrimonyMembershipExpiryDate= Auth::user()->MatrimonyMembershipExpiry;
            $input->Createdby = Auth::user()->id;  
            $input->CreatedOn = date('Y-m-d') ;
            
            //RegistrationID should be autoincrement in DB as it is the primary key
            
            //echo " I am about to save";
            $input->save();


            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return redirect()->route('matrimonys.index')
                ->with('success',Lang::get('home.matri_add'));
                
            } else if($exception instanceof QueryException){
                DB::rollback();
                //throw new Exception;
                Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$exception);
                return redirect()->route('matrimonys.index')
                ->with('error',Lang::get('home.matri_add_error'));
            }
            else {
                DB::rollback();
                //throw new Exception;
                Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$exception);
                return view('matrimonys.create')
                ->with('error',Lang::get('home.matri_add_error'));
            }
        
        }
        catch(QueryException $e) {
            //throw new Exception;
            Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$e);
            // add code to Log exception and not throw Exception
           return view('matrimonys.create')
                ->with('error',Lang::get('home.matri_add_error'));
        }
        catch(Exception $e) {
            //throw new Exception;
            Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$e);
            // add code to Log exception and not throw Exception
           return view('matrimonys.create')
                ->with('error',Lang::get('home.matri_add_error'));
        }

    }




   /**
     * Display the specified resource.
     *
     * @param  \App\Matrimony  $RegistrationID
     * @return \Illuminate\Http\Response
     * shows the detailed matrimony profile for the given Registration ID
     */
    public function show($RegistrationID)
    {
            //Check for Session time out and redirect to Login page on Session time out 
            if ( ! Auth::check()){
                return view('auth.SessionTimeout');
            }

            $matrimony = Matrimony::find($RegistrationID);
            return view('matrimonys.show',compact('matrimony'));
    }
   

    public function edit($RegistrationID)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
        return view('auth.SessionTimeout');
        }

        $matrimony = Matrimony::find($RegistrationID);
        $castemasters_matri = DB::table("caste_master")->select("CasteName")->where('CasteID','=',$matrimony->ProfileUser_Category)->first();
        $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
       
        return view('matrimonys.edit',compact('matrimony','castemasters','castemasters_matri'));
    }



   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

                $input = Matrimony::findOrFail($request->RegistrationID);
            
            //instead of using update all. we are updating individually
            // $matrimony->update($request->all());
            if( $request->get('ProfileUser_Name')!== null)
            {
                 $input->ProfileUser_Name = $request->get('ProfileUser_Name');
            }
            if( $request->get('ProfileUser_Gender')!== null)
            {
            $input->ProfileUser_Gender = $request->get('ProfileUser_Gender');
            }
            if( $request->get('ProfileUser_Age')!== null)
            {
            $input->ProfileUser_Age = $request->get('ProfileUser_Age');
            }
            if(  $request->get('ProfileUser_MaritalStatus')!== null)
            {
            $input->ProfileUser_MaritalStatus = $request->get('ProfileUser_MaritalStatus');
            }
            if( $request->get('ProfileUser_Name')!== null)
            {
            $input->ProfileUser_email = $request->get('ProfileUser_email');
            }
            if( $request->get('ProfileUser_PlaceofBirth')!== null)
            {
            $input->ProfileUser_PlaceofBirth = $request->get('ProfileUser_PlaceofBirth');
            }
            if( $request->get('ProfileUser_Name')!== null)
            {
            $input->ProfileUser_Address = $request->get('ProfileUser_Address');
            }
            if( $request->get('ProfileUser_Location')!== null)

            {
            $input->ProfileUser_LocationID = $request->get('ProfileUser_Location');
            }
            if( $request->get('ProfileUser_DOB')!== null)
            {
            $input->ProfileUser_DOB = $request->get('ProfileUser_DOB');
            }
            if(  $request->get('ProfileUser_AnyDisability')!== null)
            {
            $input->ProfileUser_AnyDisability = $request->get('ProfileUser_AnyDisability');
            }
            if(  $request->get('ProfileUser_Category')!== null)
            {
               $input->ProfileUser_Category = $request->get('User_Category');
            }
            if(  $request->get('User_Subcaste')!== null)
            {
              $input->ProfileUser_Subcaste = $request->get('User_Subcaste');
            }
            if( $request->get('ProfileUser_Mobile')!== null)
            {
            $input->ProfileUser_Mobile = $request->get('ProfileUser_Mobile');
            }
            if(  $request->get('ProfileUser_TOB')!== null)
            {
            $input->ProfileUser_TOB = $request->get('ProfileUser_TOB');
            }

            if($request->get('ProfileUser_FatherName')!== null)
            {
            //personal details
            $input->ProfileUser_FatherName = $request->get('ProfileUser_FatherName');
            }
            if(  $request->get('ProfileUser_MotherName')!== null)
            {
            $input->ProfileUser_MotherName = $request->get('ProfileUser_MotherName');
            }
            if( $request->get('ProfileUser_Father_Caste')!== null)
            {
                 
                $input->ProfileUser_Father_Caste = $request->get('ProfileUser_Father_Caste');
                
            }
            if( $request->get('ProfileUser_Mother_Caste')!== null)
            {
            $input->ProfileUser_Mother_Caste = $request->get('ProfileUser_Mother_Caste');
            }
            if( $request->get('ProfileUser_Father_Occupation')!== null)
            {
            $input->ProfileUser_Father_Occupation = $request->get('ProfileUser_Father_Occupation');
            }
            if( $request->get('ProfileUser_Mother_Occupation')!== null)
            {
            $input->ProfileUser_Mother_Occupation= $request->get('ProfileUser_Mother_Occupation');
            }
            if( $request->get('ProfileUser_Sisters_Num')!== null)
            {
            $input->ProfileUser_Sisters_Num = $request->get('ProfileUser_Sisters_Num');
            }
            if(  $request->get('ProfileUser_MarriedSis_Num')!== null)
            {
            $input->ProfileUser_MarriedSis_Num = $request->get('ProfileUser_MarriedSis_Num');
            }
            if(  $request->get('ProfileUser_Brothers_Num')!== null)
            {
            $input->ProfileUser_Brothers_Num = $request->get('ProfileUser_Brothers_Num');
            }
            if( $request->get('ProfileUser_MarriedBro_Num')!== null)
            {
            $input->ProfileUser_MarriedBro_Num = $request->get('ProfileUser_MarriedBro_Num');
            }

            //astrological details
            if( $request->get('ProfileUser_Rashi')!== null)
            {
            $input->ProfileUser_Rashi = $request->get('ProfileUser_Rashi');
            }
            if(  $request->get('ProfileUser_Natchithram')!== null)
            {
            $input->ProfileUser_Natchithram = $request->get('ProfileUser_Natchithram');
            }
            if( $request->get('ProfileUser_AnyDosam')!== null)
            {
            $input->ProfileUser_AnyDosam = $request->get('ProfileUser_AnyDosam');
            }
            
            if($request->get("ProfileUser_PreferredCaste")!== null)
            {
                $input->ProfileUser_PreferredCaste = $request->get('ProfileUser_PreferredCaste');;
            }
            if( $request->get('ProfileUser_PreferredStar')!== null)
            {
            $input->ProfileUser_PreferredStar = $request->get('ProfileUser_PreferredStar');
            }
            if( $request->get('ProfileUser_Description_Expectation')!== null)
            {
            $input->ProfileUser_Description_Expectation = $request->get('ProfileUser_Description_Expectation');
            }
            
            //education & occupational details
            if($request->get('ProfileUser_Degree')!== null)
            {
            $input->ProfileUser_Degree = $request->get('ProfileUser_Degree');
            }
            if($request->get('ProfileUser_Deg_FinishingYear')!== null)
            {
            $input->ProfileUser_Deg_FinishingYear = $request->get('ProfileUser_Deg_FinishingYear');
            }
            if($request->get('ProfileUser_CurrentCompany')!== null)
            {
            $input->ProfileUser_CurrentCompany = $request->get('ProfileUser_CurrentCompany');
            }
            if($request->get('ProfileUser_CurrentDesignation')!== null)
            {
            $input->ProfileUser_CurrentDesignation = $request->get('ProfileUser_CurrentDesignation');
            }
            if($request->get('ProfileUser_EmplSinceWhen')!== null)
            {
            $input->ProfileUser_EmplSinceWhen = $request->get('ProfileUser_EmplSinceWhen');
            }
            if($request->get('ProfileUser_Salary')!== null)
            {
            $input->ProfileUser_Salary = $request->get('ProfileUser_Salary');
            }

            // physical attributes
            if( $request->get('ProfileUser_Height')!== null)
            {
            $input->ProfileUser_Height = $request->get('ProfileUser_Height');
            }
            if($request->get('ProfileUser_Weight')!== null)
            {
            $input->ProfileUser_Weight = $request->get('ProfileUser_Weight');
            }
            if( $request->get('ProfileUser_BodyType')!== null)
            {
            $input->ProfileUser_BodyType = $request->get('ProfileUser_BodyType');
            }
            if($request->get('ProfileUser_BloodGroup')!== null)
            {
            $input->ProfileUser_BloodGroup = $request->get('ProfileUser_BloodGroup');
            }
            if( $request->get('ProfileUser_PhysicalStatus')!== null)
            {
            $input->ProfileUser_PhysicalStatus = $request->get('ProfileUser_PhysicalStatus');
            }
            if( $request->get('ProfileUser_PhysicallyChallengedDetails')!== null)
            {
            $input->ProfileUser_PhysicallyChallengedDetails = $request->get('ProfileUser_PhysicallyChallengedDetails');
            }
            
            //photos
            // adding relative path for Mobile app sake 
            
            if( isset($request->ProfileUser_Photo)  ){
                            $uri = '/images/matrimonys/userphotos/';
                            $namewithextension = $request->ProfileUser_Photo->getClientOriginalName(); 
                            /*Name with extension 'filename.jpg'*/
                            $name = explode('.', $namewithextension)[0]; 
                            /* Filename 'filename'*/
                            $name = $name.'_'.time().'.'.$request->ProfileUser_Photo->getClientOriginalExtension();
                            $input['ProfileUser_Photo'] = $uri.$name;
                            $request->ProfileUser_Photo->move(public_path('images/matrimonys/userphotos/'), $name);
                            
   
                         
                    }
                    if( isset($request->ProfileUser_Horoscope)  ){
                            $uri = '/images/matrimonys/horoscopephotos/';
                            $namewithextension = $request->ProfileUser_Horoscope->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->ProfileUser_Horoscope->getClientOriginalExtension();
                            $input['ProfileUser_Horoscope'] = $uri.$name;
                            $request->ProfileUser_Horoscope->move(public_path('images/matrimonys/horoscopephotos/'), $name);
                         
                    }
                    
                     
                
                    $input->save();
           
          
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
                $matrimony = Matrimony::find($request->RegistrationID);
                $castemasters_matri = DB::table("caste_master")->select("CasteName")->where('CasteID','=',$request->ProfileUser_Category)->first();

                return view('matrimonys.edit',compact('matrimony','castemasters','castemasters_matri'));
            
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('MatrimonyController:Update:  Exception while updating profile ',(array)$exception);
                return redirect('/matrimonys')->back()->with('Failure',Lang::get('home.matri_update_error'));
            }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            Log::info('MatrimonyController:Update:  Exception while updating profile ',(array)$e);
            return redirect('/matrimonys')->back()->with('Failure',Lang::get('home.matri_update_error'));
        }
      
    }



   /**
     * get Subcastelist to be shown in index page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubcasteList(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        $subcastes = DB::table("subcaste_master")
                        ->join('caste_master','caste_master.CasteID','=','subcaste_master.CasteID')
                        ->where("caste_master.CasteName",$request->CasteName)
                        ->pluck("SubCaste_Name","SubCasteID");

        return response()->json($subcastes);
    } 




    /**
     * After payment we set membership and membership expiry
     * in 2 tables User and Matrimony_registration table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setMatrimonyExpiry(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
        //echo" in SetMatrimony Expiry";

        // there are multiple sceanrios of expiry
        // 1. after the membership expires 
        //          This case is automatic as after deadline date , no field will be changed  
        //          (user->matrimonymembershipexpiry  , profileuser->status, profileuser->matrimonymembership) but
        //          profile will not appear in any search and index page will be shown with error as 
        //          Membership Expired and please renew
        // 2. user can unpublish their profile 
        //         This case is done by user , Fields (user->matrimonymembershipexpiry  , profileuser->matrimonymembership) 
        //          will be unchanged but profileuser->status will be set to 0
        //          profile will not appear in any search and index page will be shown with error as 
        //          No profile crated .Create profile
        // 3. user can renew membership and look for their profile
        //          This case is done by user. After payment expirydates will be rest in User and profiles
        //          profileuser status will be unchnaged  
        //          profile will re-appear if User has not unpublished 
        //          profile will start appearing in any search and 
        //          index page will be shown with matching profiles
        //         
        // 4.  when membership exists, user unpublished profile, then what happens.
        //          index page appears with No profile created . create another profile
        //


        //active profile
        $profileuser = Matrimony::where('Createdby', Auth::user()->id)
                        ->where('Status','1')
                        //first helps you get only one row and avoid a list as a result
                        ->first();

        try {
            // Transaction
                $exception = DB::transaction(function() use ($request) {

                    //echo" in SetMatrimony Expiry - within try";
                $paymentobj      = (object) ($request->payment);
                $flags           = (object) ($request->flag); 
               
              

                //monthly plan
               if ($flags->flag == "month")
                {
                    

                    Auth::user()->update([
                        'User_MatrimonyMembershipType' => "Monthly",
                        'MatrimonyMembershipExpiry' => date('Y-m-d', strtotime(' + 30 days')),
                        'IsReginMatrimony' => 1,
                    ]);
   
                    if(isset($profileuser) )
                    {
                        $profileuser->ProfileUser_MatrimonyMembershipExpiryDate =$user->MatrimonyMembershipExpiry;
                    }
                    else 
                    {
         
                    }
                }
                // Half yearly plan
                else if ($flags->flag == "half")
                {
                    Auth::user()->update([
                        'User_MatrimonyMembershipType' => "Halfyearly",
                        'MatrimonyMembershipExpiry' => date('Y-m-d', strtotime(' + 182 days')),
                        'IsReginMatrimony' => 1,
                    ]);


                    if(isset($profileuser) )
                    {
                        $profileuser->ProfileUser_MatrimonyMembershipExpiryDate =$user->MatrimonyMembershipExpiry;
                    }
                    else {
       
                    }
                }
                //annual plan
                else if ($flags->flag == "year")
                {
                    Auth::user()->update([
                        'User_MatrimonyMembershipType' => "Yearly",
                        'MatrimonyMembershipExpiry' => date('Y-m-d', strtotime(' + 365 days')),
                        'IsReginMatrimony' => 1,
                    ]);

                    if(isset($profileuser) )
                    {
                        $profileuser->ProfileUser_MatrimonyMembershipExpiryDate =$user->MatrimonyMembershipExpiry;
                    }
                }
                else
                {
                    
                }
                if(isset($profileuser) )
                {
                    $profileuser->save();
                }
                $payment = new Payment ;
      
                $payment->UserID = Auth::user()->id;
                $payment->Vendor_PaymentID = $paymentobj->transactionid;
                $payment->TransactionDate = Date('Y-m-d');
               
                $payment->TransactionAmount =$paymentobj->finalamount;
                $payment->TransactionType = "razorpay";// change it later dynamically
                $payment->TransactionStatus = $paymentobj->transactionstatus;   //success orfailure
                $payment->PaymentMethod = $paymentobj->paymentmethod;  //netbanking /card/googlepay
                $payment->created_at = Date('Y-m-d');
                $payment->save();
                
                
                
                
                
            }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //write code to return view
                   return response()->json(array("success"=>true));
                
                } else {
                    DB::rollback();
                    Log::info('MatrimonyController:SetMatrimonyExpiry: Matrimony registration cannot be done due to',$exception);
                        //write code to return view with failure
                        return response()->json(array("failure"=>true));
                  
                }

            }
            catch(Exception $e) {
                // throw new Exception;
                //Aruna added- Have to log exception 
                Log::info('MatrimonyController:SetMatrimonyExpiry: Matrimony subscription cannot be renewed due to',$e);
                 return response()->json(array("failure"=>true));
                
            }
    }


    /**
     * Delete profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($RegistrationID)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
        return view('auth.SessionTimeout');
        }

        try {
            // Transaction
             $exception = DB::transaction(function() use ($RegistrationID) {

                    $matrimony = Matrimony::find($RegistrationID);
                    If (isset($matrimony))
                    {
                        $matrimony->Status=0;
                        //commenting below to implement new logic.  When Users delete profile, we should not expire membership but allow them to update another profile
                        //$matrimony->ProfileUser_MatrimonyMembershipExpiryDate = date('Y-m-d', strtotime(' - 1 day'));
                        $matrimony->save();

                       
                    }
                    else
                    {
                        return redirect()->back();
                    }
                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    return redirect()->back()->with('success',Lang::get('home.matri_unlinked'));
                 } else {
                    DB::rollback();
                   // throw new Exception;
                   //Aruna added - add log code
                   return redirect()->back();
                }
        }
        catch(Exception $e) {
           // throw new Exception;
           return redirect()->route('matrimonys.index')
                   ->with('failure',Lang::get('home.matri_unlinked_error'));
        }
    }


   /* public function onlinePay(Request $request){
  
           //Check for Session time out and redirect to Login page on Session time out 
           if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }
           return view('matrimonys.onlinePay')->with('Message',$request->typ);
    }*/


} //end
