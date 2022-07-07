<?php

// classname - HomeController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Home page content
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
    
         //show the latest Temple function by sorting the result by latest Date 
         $templefunctions = DB::table('temple_functions')
                                ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                                ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                                ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo', 'temple_function_videos.Video')
                                ->where('temple_functions.Status', '1')
                                ->orderby('temple_functions.FunctionDate','DESC')
                                ->take(3)
                                ->get();
    
                
         //show the latest Product uploaded by sorting the result by latest Date 
         $products = DB::table('products')
                                ->select('products.ProductID','products.ProductName', 'products.Description', 'products.Photo', 'products.Weight', 'products.Price')
                                ->where('Status', '1')
                                ->orderby('products.CreatedOn','DESC')
                                ->take(3)
                                ->get();
    
    
       
         //show the latest Sangam Meetings by sorting the result by latest Date 
         $sangammeetings = DB::table('sangam_meetings')
                                ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                                ->leftjoin('sangammeeting_videos', 'sangam_meetings.SangamMeetingID', '=', 'sangammeeting_videos.SangamMeetingID')
                                ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo', 'sangammeeting_videos.Video')
                                ->where('Status', '1')
                                ->orderby('sangam_meetings.MeetingDate','DESC')
                                ->take(3)
                                ->get();
    
    
         //show the recently joined Users by sorting the result by latest Date 
     
         $newmembers = DB::table('users')
                                ->leftjoin('subcaste_master', 'users.User_Subcaste', '=', 'subcaste_master.SubCasteID')
                                ->select('users.id','users.name as name', 'users.User_photo as User_photo', 'users.User_Native as User_Native', 'subcaste_master.SubCaste_Name' )
                                ->where('IsActive', '1')
                                ->orderby('users.created_at','DESC')
                                ->take(3)
                                ->get();
    
    
         //show the recent Announcements by sorting the result by latest Date   
         $announcements = DB::table('announcements')
                                ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                                ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                                ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements_photos.Photo','announcements_videos.Video')
                                ->where('announcements.Status', '1')
                                ->orderby('announcements.FunctionDate','DESC')
                                ->take(3)
                                ->get();
    
        //show the latest personal functions by sorting the result by latest Date 
        $personalfunctions = DB::table('personal_functions')
                                ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                ->leftjoin('personal_function_videos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_videos.PersonalFunctionID')
                                ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content','personal_functions.FunctionDate','personal_function_photos.Photo', 'personal_function_videos.Video')
                                ->where('Status', '1')
                                ->orderby('personal_functions.FunctionDate','DESC')
                                ->take(3)
                                ->get();
    
         return view('home',compact('templefunctions', 'products', 'sangammeetings', 'newmembers', 'personalfunctions', 'announcements'));
    }

    
  
    /**
     * Show the Change Password page
     *
     *
     */
    public function showChangePasswordForm()
    {
         return view('auth.changepassword');
    }// end showChangePasswordForm



    /**
     * Change Password functionality
     *
     *
     */
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|confirmed',
        ],
        [
            'current-password.required' => 'Please fill the password',
            'new-password.required' => 'Please fill confirm password',
            'new-password.confirmed'  => 'New password and Confirm passord are not matching',
        ]  );

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        //Aruna- there is a difference between returning view and calling back the index method
        // Here we are calling back the index method of Controller so that it fetches data and returns view with content
        return redirect()->back()->with("success","Password changed successfully !");
        
    }//end changePassword()
    
    

   /**
     * Search functionality in Index page
     *
     *
     */
    public function searchApplication(Request $request){
         
         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        $searchResult = null;
        $Failure = null;
        /*print_r($request->key);exit();*/
        //If search keyword not empty
        if(isset($request->key))
        {
                $searchResult = DB::table('users')
                                    ->leftjoin('cities','users.User_City','=','cities.id')
                                    ->select('users.id', 'users.name','users.User_photo','users.email','users.User_Phone', 'cities.name as User_City')
                                    ->where('users.name','LIKE', '%'.$request->key.'%')
                                    ->orwhere('User_Caste','LIKE','%'.$request->key.'%')
                                    ->orwhere('User_Subcaste','LIKE','%'.$request->key.'%')
                                    ->orwhere('cities.name','LIKE','%'.$request->key.'%')
                                    ->orwhere('User_Occupation','LIKE','%'.$request->key.'%')
                                    ->orwhere('User_Father_Name','LIKE','%'.$request->key.'%')
                                    ->orwhere('User_Native','LIKE','%'.$request->key.'%')
                                    ->orderby('users.name','ASC')
                                    ->get();

                if (isset($searchResult) )    {
                    if( count($searchResult)>=1)
                    {
                        $Failure=null;
                        $key = $request->key;
                        return view('search',compact('searchResult','Failure','key'));
                    }
                    else{
                    
                        $Failure = 'Sorry, No matching records';
                        return view('search',compact('searchResult', 'Failure'));
                    }
                
                }
            }
            else
            {
                $searchResult = null;
                $Failure = 'Search phrase is empty';
                return view('search',compact('searchResult', 'Failure'));
            }
            
    }  //end  searchApplication()       




}
