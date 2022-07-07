<?php

 /* 
 classname - InviteController.php
 Author - Raveendra 
 release version - 1.0
 Description-  This Controller is used for sending Invitation mails to Users
 Created date - Nov 2019 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Invite;
use App\Mail\InviteCreated;
use App\User;

use DB;
use Auth;

class InviteController extends Controller
{


    public function invite()
    {
            //Check for Session time out and redirect to Login page on Session time out 
          /*  if ( ! Auth::check()){
                return view('auth.SessionTimeout');
            }*/
           // show the user a form with an email field to invite a new user
            return view('invite')
            ->with('success',Lang::get('home.invite_success'));
               // ->with('success', 'We have sent an email with a Invitation ID link to your email address.');
    
    }

    public function checkUniqueUserEmail(Request $request)
    {
     
        $usrmail = DB::table("users")
                 ->select('email','id')
                 ->where('email',$request->email)
                 ->first();
       
        // both phone number and invitation matches with an invite
        if (isset($usrmail ) && (count($usrmail) >0 )  )
        {
          
                 $usrmail="Sorry";
                 // return json_encode($usrname );
                  return  response()->json($usrmail);
        }
        // if username doesnt exists
        else
        {
            $usrmail = "Yes";
            //return json_encode($usrname);
            return  response()->json($usrmail);
        }
       
    }
    // process the form submission and send the invite by email
    public function sendingInvite(Request $request)
    {
       
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
       
        // validate the incoming request data
    
        //do while loop
        do {
            //generate a random string using Laravel's str_random helper
            $invitationid = str_random();
        }
        //check if the token already exists and if it does, try again
        while (Invite::where('invitationid', $invitationid)->first());
    
        //create a new invite record
        $invite = Invite::create([
            'email' => $request->get('email'),
            'Mobile_Number' => $request->get('Mobile_Number'),
            'Invitee_Name' => $request->get('Invitee_Name'),
            'Invitedby' => Auth::user()->name,
           'invitationid' => $invitationid
    
        ]);

        // send the email
        Mail::to($request->get('email'))->send(new InviteCreated($invite));
        
       /* $message = "You have been invited to join Viswakarma Community Website by"+ Auth::user()->name+". Your invitation id is "+$invitationid;
        $mobile = $request->get('Mobile_Number');
        
         $apiKey = urlencode(env("SMS_GATEWAY_KEY"));

                // Message details
                $numbers = 1;
                $sender = urlencode('TXTLCL');
        
                $numbers = implode(',', $numbers);   
                                                  

                // Prepare data for POST request
                 $data = array('apikey' => $apiKey, 'numbers' => '$numbers', "sender" => $sender, "message" => $message);
                
              
                // Send the POST request with cURL
               // $ch = curl_init('https://api.textlocal.in/send/');
              //  $ch = curl_init(static::SMS_GATEWAY_URL);
           
                $ch = curl_init(env('SMS_GATEWAY_URL'));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);*/
                

                
                // Account details
            	$apiKey = urlencode("xf7xHFIFIl8-1UbuDpvl7aHSueMpwtcVNVME8BoswM");
            	$sender = urlencode('Viswakarma community');
            	$message = "You have been invited to join Viswakarma Community Website by". Auth::user()->name.". Your invitation id is ".$invitationid;
      
            	// Message details
            	$m = "91".$request->get('Mobile_Number');
            	
               	$numbers = $m;
            	$message = rawurlencode($message);
    
            	//$numbers = implode(',', $numbers);
             
            	// Prepare data for POST request
            	$data = array('apikey' => $apiKey, 'username'=>"aruna@tecpleglobal.com" , 'password'=>"Tecple@2019" , 'numbers' => "919448958088", "sender" => $sender, "message" => $message);
             
       
             
            	// Send the POST request with cURL
            	$ch = curl_init('https://api.txtlocal.com/send/');
            	curl_setopt($ch, CURLOPT_POST, true);
            	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            	$response = curl_exec($ch);
     
            	curl_close($ch);
                

        // redirect back where we came from
        alert()->success(Lang::get('home.invite_success_alert'));
        //alert()->success('Your invitation is sent to the Invitee');
        return redirect() ->back();
    } 


    
    protected function show()
    {
         $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
         return view('auth.register',compact( 'castemasters'));
    } 

}
