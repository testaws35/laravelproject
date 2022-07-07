<?php


// classname - UserController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the User Authentication and creation
// created date - Nov 2019

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\User;

use AuthenticatesUsers;
use DB;
use Alert;
use Lang;
//Aruna -  Please check User.php to understand how authentication happens in this application
class UserController extends Controller
{
   /**
     * This function does the Authentication
     *
     */
    public function login(Request $request){
      
        //first check the User table for the Username
        $chkuser = DB::table('users')
                   ->where ('username',Input::get('username'))
                   ->get();
                   
        $user = array(
       
            //Aruna commented this
            //'password' => Hash::make(Input::get('password'))

            // Aruna - we should not use Hash because the attempt feature of Auth will convert the
            // password to Hash encypted.
            // Hence if we put Hash here the password will be encrypted 2 times

            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($user)) {
            //Aruna commented the below way of calling attempt. Instead of array parameter , we change to using Object
           
            // if(Auth::attempt(['username' => request('username'), 'password' => Hash::make(request('password') ) ])  ){
            //return view('home');
           
            // Aruna - when we use "Redirect" service, the logic as how redirect happens is 
            // mentioned in class xxx (will fill the name later) is used 
            // Please observe User.php , EventServiceProvider.php, HomeController.php, VerificationController.php
            // Authenticate.php, RedirectIfAuthenticated.php  verify_email.blade.php, AuthenticationException.php
            // EnsureEmailsVerified.php, AuthenticatesUsers.php, Validator 
            return Redirect::to('home');
        }
        else{

           if (isset($chkuser)  && (count($chkuser) >0) ){
                 return view('auth.login')
                         ->with ('Failed',Lang::get('home.wrong_pass'));
           }
           else{
                return view('auth.login')
                        ->with ('Failed',Lang::get('home.user_noexits'));
           }
          
        }
    } 


   /* added by raveendra on 31-12-19 logout and redirect to login page */
   public function logout(Request $request) 
   {
      Auth::logout();
      //Aruna - changed from route to view
      //return redirect()->route('/login');
      return view("auth.login");
   }



   
   /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
}//end
