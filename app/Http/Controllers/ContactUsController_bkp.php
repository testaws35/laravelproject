<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUS;
use Mail;
use Alert;
use Validator;
use Auth;
class ContactUSController extends Controller
{
    
 public function contactUS()
 {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
        return view('contactUS');
 } 




/** * Show the application dashboard. * * @return \Illuminate\Http\Response */
public function contactUSPost(Request $request) 
{

         //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
    
        

       
 
        ContactUS::create($request->all()); 
    
        Mail::send('email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
        {
            $message->from('info@telunguviswakarma-tn.in');
            $message->to('info@telunguviswakarma-tn.in', 'Admin')->subject('Contact VC Feedback');
        });
   
        return back()->with('success', "Your message has been received, We'll get back to you shortly"); 
    }


/** * Show the application dashboard. * * @return \Illuminate\Http\Response */
public function contactUSPost_Welcome(Request $request) 
{

        ContactUS::create($request->all()); 
    
        Mail::send('email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message'),
            ), function($message)
        {
            $message->from('info@telunguviswakarma-tn.in');
            $message->to('jsvins1991@gmail.com', 'Admin');
            $message->subject('Mail from User');
        });
   
        return back()->with('success', "Your message has been received, We'll get back to you shortly"); 
    }

    
 }
