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

// DECLARE ALL the models used
use App\User;
use App\Subcaste;
use App\SubcasteGroupMap;
use App\Matrimony;
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

      
       //scenario 1:  if Session user has not registered in Matrimony then
        if (Auth::user()->IsReginMatrimony == 0){

                    /********************
                     * Free membership code - Begin
                     */
                    $toDay = Date('Y-m-d');
                    $checkdate  =strtotime('2021-12-30');

                    if($toDay <= $checkdate){

                    echo" in Matrimony- index - Free scheme";
                    $Message =4;
                    //Aruna added - for Free Matrimony
                    
                        return view('matrimonys.index',compact('matrimonys', 'Message') )
                            ->with('Failed','Free Service');
                    }

                    /********************
                     * Free membership code - End
                     */
                    else{
        
                        $matrimonys=null;

                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                    
                        return view('matrimonys.index',compact('matrimonys') )
                            ->with('Failed','Please do register in Matrimony section');
                    }
        }
        else
        {
                //scenario 2 : Membership expired
                if ( (Auth::user()->IsReginMatrimony ==1 )&&
                //membership expity date is less than today
                     (Auth::user()->MatrimonyMembershipExpiry) < date('Y-m-d')  )    
                {
                        $matrimonys=null;
                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                         return view('matrimonys.index',compact('matrimonys') )
                             ->with('Failed','Your membership had expired. Kindly renew');
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
                     ->with('Failed','You dont have active profile in Matrimony section');
                }     
                
                
                //scenario 4: If session user has registered previously and deleted the profile irrespective of expiry date
                if (isset($profileuser) &&  $profileuser->RegistrationID ==0  )  
                {
                    $matrimonys=null;
                    //Aruna added - objects to be passed in compact with view 
                    // and messages to be passed using with clause
                    return view('matrimonys.index',compact('matrimonys') )
                     ->with('Failed','You have deleted profile in Matrimony section');
                }    

                // get profile user subcaste ID

                //in case Profile User has given Subcaste as 'Don't know' or 'Not Applicable' 
                //then only gender to be checked
                
                //scenario 5:  whether User wants to fetch mathcing profiles based on his registered caste 
                //  or based on what caste he chose in Index page now
                //
                $caste = null;
                if (isset($request->User_Caste) )
                {
                    $caste = $request->User_Caste;
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
                                ->with('Failed','Sorry no matching profiles');
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
                                $matrimonys =$matrimonys ->take(150);
                                            //->paginate(6); 
                            }
                            //yearly plan
                            else{
                                $matrimonys =$matrimonys ->get();
                                            //->paginate(6); 
                            }

                            $Failed =null;
                            return view('matrimonys.index',compact('matrimonys', 'profileuser','castemasters', 'caste', 'Failed') )
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
                                ->with('Failed','Sorry no matching profiles');
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
                if (( strcmp( trim($caste) , "Telugu Viswakarma") ==0) &&( strcmp( trim($profileuser->ProfileUser_Subcaste) , "Donot Know") ==0) or ((strcmp($profileuser->ProfileUser_Subcaste,"Not Applicable")==0))   )
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
                                 ->with('Failed','Sorry no matching profiles');
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
                                   ->with('Failed','Sorry no matching profiles');
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

               $validator = Validator::make($request->all(), [

                          'ProfileUser_Name' => 'required|max:100',
                          'ProfileUser_Gender' => 'required',
                          'ProfileUser_Age' => 'required|numeric',
                          'ProfileUser_MaritalStatus'   => 'required',
                          'ProfileUser_Mobile' => 'required|max:10',
                          'ProfileUser_email'   => 'required',

                          'ProfileUser_AnyDisability'   => 'required',
                          'ProfileUser_PlaceofBirth' => 'required',
                          'ProfileUser_LocationID'   => 'required',
                          'ProfileUser_Address'   => 'required',
                          'ProfileUser_DOB' => 'required',
                          /*'ProfileUser_Photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                          'ProfileUser_Horoscope' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',*/
                          'ProfileUser_Degree'   => 'required',

                          'ProfileUser_Deg_FinishingYear'   => 'required|max:4',
                          'ProfileUser_CurrentDesignation' => 'nullable',
                          'ProfileUser_CurrentCompany'   => 'nullable',
                          'ProfileUser_EmplSinceWhen'   => 'nullable',
                          'ProfileUser_FatherName' => 'required',
                          'ProfileUser_MotherName'   => 'required',

                          'ProfileUser_Sisters_Num'   => 'required|numeric',
                          'ProfileUser_MarriedSis_Num' => 'required|numeric',
                          'ProfileUser_Brothers_Num'   => 'required|numeric',
                          'ProfileUser_MarriedBro_Num'   => 'required|numeric',
                          'ProfileUser_Rashi' => 'required',
                          'ProfileUser_Natchithram'   => 'required',

                          'ProfileUser_AnyDosam'   => 'required',
                          'ProfileUser_PreferredCaste' => 'nullable',
                          'ProfileUser_PreferredStar'   => 'nullable',
                          'ProfileUser_Description_Expectation'   => 'required',
                          'ProfileUser_Category' => 'required',

                          'ProfileUser_TOB'   => 'required',
                          'ProfileUser_Height' => 'required',
                          'ProfileUser_Weight'   => 'required',
                          'ProfileUser_BodyType'   => 'required',
                          'ProfileUser_BloodGroup' => 'required',
                          'ProfileUser_PhysicalStatus'   => 'required',
                          'ProfileUser_PhysicallyChallengedDetails' => 'nullable',
              
                ],
            [
                'ProfileUser_Name.required' => 'Name must be filled',
                'ProfileUser_Name.max' => 'Maximum 100 characters allowed',
                'ProfileUser_Gender.required' => 'Gender must be filled',
                'ProfileUser_Age.required' => 'Age must be filled',
                'ProfileUser_MaritalStatus.required' => 'Marital Status must be filled',
                'ProfileUser_Mobile.required' => 'Mobile number must be filled',
                'ProfileUser_Mobile.max' => 'Mobile number must have 10 digits exactly',
                'ProfileUser_email.required' => 'Email must be filled',
                'ProfileUser_AnyDisability.required' => 'Disability Status must be filled',
                'ProfileUser_PlaceofBirth.required' => 'Place of Birth must be filled',
                'ProfileUser_LocationID.required' => 'Location must be filled',
                'ProfileUser_Address.required' => 'Address must be filled',
                'ProfileUser_DOB.required' => 'DOB must be filled',
                'ProfileUser_Deg_FinishingYear.required' => 'Year of degree must be filled',
                'ProfileUser_FatherName.required' => 'Fathers name must be filled',
                'ProfileUser_MotherName.required' => 'Mothers name must be filled',
                'ProfileUser_Sisters_Num.required' => 'Number of Sisters must be filled',
                'ProfileUser_MarriedSis_Num.required' => 'Number of Married Sisters must be filled',
                'ProfileUser_Brothers_Num.required' => 'Number of Brothers must be filled',
                'ProfileUser_MarriedBro_Num.required' => 'Number of Married Brothers must be filled',
                'ProfileUser_Rashi.required' => 'Rashi must be filled',
                'ProfileUser_Natchithram.required' => 'Natchithram must be filled',
                'ProfileUser_AnyDosam.required' => 'Dosam detailsmust be filled',
                'ProfileUser_Description_Expectation.required' => 'Expectation details must be filled',
                'ProfileUser_Category.required' => 'Caste must be filled',
                'ProfileUser_TOB.required' => 'TOB must be filled',
                'ProfileUser_Height.required' => 'Height must be filled',
                'ProfileUser_Weight.required' => 'Weight must be filled',
                'ProfileUser_BodyType.required' => 'Body Type must be filled',
                'ProfileUser_BloodGroup.required' => 'Blood Group must be filled',
                'ProfileUser_PhysicalStatus.required' => 'Physical Status detailsmust be filled',
                'ProfileUser_PhysicallyChallengedDetails.required' => 'Physical Challenge details must be filled',
            ]); 
              
                   
            if ($validator->fails()) {
                return back()->with('error', $validator->messages()->all()[0])->withInput();
            }  

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
            $input->ProfileUser_PreferredCaste ="";
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
            
            echo " I am about to save";
            $input->save();


            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return redirect()->route('matrimonys.index')
                ->with('success','Matrimony added successfully.');
                
            } else if($exception instanceof QueryException){
                DB::rollback();
                //throw new Exception;
                Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$exception);
                return redirect()->route('matrimonys.index')
                ->with('error','Please check the Year of degree field');
            }
            else {
                DB::rollback();
                //throw new Exception;
                Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$exception);
                return view('matrimonys.create')
                ->with('error','Please rectify errors in the input');
            }
        
        }
        catch(QueryException $e) {
            //throw new Exception;
            Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$e);
            // add code to Log exception and not throw Exception
           return view('matrimonys.create')
                ->with('error','Please rectify errors in the input');
        }
        catch(Exception $e) {
            //throw new Exception;
            Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$e);
            // add code to Log exception and not throw Exception
           return view('matrimonys.create')
                ->with('error','Please rectify errors in the input');
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
        $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
            return view('matrimonys.edit',compact('matrimony','castemasters'));
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
            $input->ProfileUser_PreferredCaste ="";
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
            
             //for Free Membership
            if(date('Y-m-d')  < strtotime('2021-12-31'))
            {
                $input->Status = 1;
                $input->ProfileUser_MatrimonyMembershipExpiryDate= strtotime('2021-12-31');
                $input->Createdby = Auth::user()->id;  
                $input->CreatedOn = date('Y-m-d') ;
            }
            
            //RegistrationID should be autoincrement in DB as it is the primary key
            
           // echo " I am about to update";
           // $input->update();
            $input->save();
            
            //for Free Membership
            if(date('Y-m-d')  < strtotime('2021-12-31'))
            {
                 Auth::user()->update([
                            'User_MatrimonyMembershipType' => "Free",
                           // 'MatrimonyMembershipExpiry' => date('Y-m-d', strtotime(' + 30 days')),
                            'MatrimonyMembershipExpiry' => strtotime('2021-12-31'),
                            'IsReginMatrimony' => 1,
                        ]);
            }
            
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
                $matrimony = Matrimony::find($request->RegistrationID);
                return view('matrimonys.edit',compact('matrimony','castemasters'));
            
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('MatrimonyController:Update:  Exception while updating profile ',(array)$exception);
                return redirect('/matrimonys')->back()->with('Failure', 'Unable to update your Matrimony Profile');
            }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            Log::info('MatrimonyController:Update:  Exception while updating profile ',(array)$e);
            return redirect('/matrimonys')->back()->with('Failure', 'Unable to update your Matrimony Profile');
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
        echo" in SetMatrimony Expiry";

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

                    echo" in SetMatrimony Expiry - within try";


                //monthly plan
               if ($request->Message ==1)
                {
                    echo" in SetMatrimony Expiry - scheme 1";

                    Auth::user()->update([
                        'User_MatrimonyMembershipType' => "Monthly",
                        'MatrimonyMembershipExpiry' => date('Y-m-d', strtotime(' + 30 days')),
                        'IsReginMatrimony' => 1,
                    ]);
   
                    if(isset($profileuser) )
                    {
                        $profileuser->ProfileUser_MatrimonyMembershipExpiryDate =$user->MatrimonyMembershipExpiry;
                    }
                    else {
         
                    }
                }
                // Half yearly plan
                else if ($request->Message ==2)
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
                else if ($request->Message ==3)
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
                //Free plan

                 /********************
                 * Free membership code - Begin
                 */
                else if ($request->Message ==4)
                {
                    echo" in SetMatrimony Expiry - scheme 4";
                    Auth::user()->update([
                        'User_MatrimonyMembershipType' => "Free",
                        'MatrimonyMembershipExpiry' => date('2021-12-31'),
                        'IsReginMatrimony' => 1,
                    ]);

                }


                /********************
                 * Free membership code - Begin
                 */
                else{
                        
                    Auth::user()->update([
                        'User_MatrimonyMembershipType' => "",
                        'MatrimonyMembershipExpiry' => "",
                        'IsReginMatrimony' => 0,
                    ]);

                    if(isset($profileuser) )
                    {
                        $profileuser->ProfileUser_MatrimonyMembershipExpiryDate =$user->MatrimonyMembershipExpiry;
                    }
                }
                if(isset($profileuser) )
                {
                    $profileuser->save();
                }
                
            }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //write code to return view
                    return redirect()->route('matrimonys.index')
                        ->with('success','Congrats!  You have now registered with our Matrimony services');
                
                } else {
                    DB::rollback();
                    Log::info('MatrimonyController:SetMatrimonyExpiry: Matrimony registration cannot be done due to',$exception);
                        //write code to return view with failure
                    return redirect('/matrimonys')->back()
                        ->with('failure','Matrimony registration cannot be done due to Database error');
                }

            }
            catch(Exception $e) {
                // throw new Exception;
                //Aruna added- Have to log exception 
                Log::info('MatrimonyController:SetMatrimonyExpiry: Matrimony subscription cannot be renewed due to',$e);
                return redirect('/matrimonys')->back()
                     ->with('failure','Matrimony subscription cannot be renewed due to Exception');
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
                        $matrimony->ProfileUser_MatrimonyMembershipExpiryDate = date('Y-m-d', strtotime(' - 1 day'));
                        $matrimony->save();

                        $user = Auth::user();
                        if (isset($user)) {
                                $user->IsReginMatrimony=0;
                                $user->User_MatrimonyMembershipType = "";
                                $user->MatrimonyMembershipExpiry = date('Y-m-d', strtotime(' - 1 day'));
                                $user->save(); 
                        }
                        else{
 
                        }
                    }
                    else{
                        return redirect()->back();
                    }
                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    return redirect()->back();
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
                   ->with('failure','Unpublish failed');
        }
    }


    public function onlinePay(Request $request){
  
           //Check for Session time out and redirect to Login page on Session time out 
           if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }
           return view('matrimonys.onlinePay')->with('Message',$request->typ);
    }


} //end
