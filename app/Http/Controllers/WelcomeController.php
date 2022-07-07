<?php


// classname - WelcomeController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the first page before Login
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\TempleFunctions;
use App\TempleFunctionPhotos;
use App\TempleFunctionVideos;
use App\Product;
use App\ContactUsLand;
use App\ContactUS;

use Auth;
use DB;
use Mail;
use Validator;
use Lang;

class WelcomeController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
          
                
            // Aruna -- as we have a panel to show Activities in the welcome page, the data
            // for that panel come from here 
            // since it is only gallery show, we need only photos of the functions
            $templefunctions = DB::table('temple_functions')
                                ->join('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                                ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo')
                                ->where('temple_functions.Status', '1')
                                ->orderby('temple_functions.FunctionDate','DESC')
                                ->take(3)
                                ->get();
                    
            
            $sangammeetings = DB::table('sangam_meetings')
                                ->join('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                                ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo')
                                ->where('sangam_meetings.Status', '1')
                                ->orderby('sangam_meetings.MeetingDate','DESC')
                                ->take(3)
                                ->get();

            $advertisements = DB::table('advertisements')
                                ->select('advertisements.AdvtID','advertisements.Advt_Title','advertisements.Advt_Description','advertisements.Advt_Photo','advertisements.Start_Date','advertisements.End_Date')
                                ->where('Status', '1')
                                ->orderby('advertisements.created_at','DESC')
                                ->take(3)
                                ->get();    
        
        if(  isset($request->Json)  ){
            return response()->json_encode('templefunctions', 'sangammeetings', 'advertisements');
        }
        else{
            return view('welcome',compact('templefunctions', 'sangammeetings', 'advertisements'));
          
        }
           
    }

   /**
     * Sending mail from Contact us panel in Welcome page
     * 
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function contactUSLandPost(Request $request) 
   {

        ContactUS::create($request->all()); 
        
        //This is an example of sending a simple mail without Model and Email view
    
        Mail::send('email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message'),
            ), function($message)
        {
            //$request parameters are not recognized by Mail facade // so use Input facade
            $message->from('info@telunguviswakarma-tn.in');
            $message->to('info@telunguviswakarma-tn.in');
           
            $message->subject('Mail from '.Input::get('name')  );
        });
   
        Mail::send('email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message'),
            ), function($message)
        {
            //$request parameters are not recognized by Mail facade // so use Input facade
            $message->from('info@telunguviswakarma-tn.in');
             $message->to(Input::get('email'));
           
            $message->subject('Dear  '.Input::get('name').",Your message has been received, We'll get back to you shortly");
        });
   
   
        return back()->with('success',Lang::get('home.success_contact')); 
    }




    public function education()
    {
            return view('education');

    }
}
