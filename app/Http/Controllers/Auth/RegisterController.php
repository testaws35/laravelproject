<?php

namespace App\Http\Controllers\Auth;



use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//use Illuminate\Contracts\Validation\Rule;

use App\Http\Controllers\Controller;

use App\Invite;
use App\User;

use DB;
use Auth;
use Validator;
use Alert;
use Rule;
use Lang;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    // classname - ElderDetailsController.php
    // author - Raveendra 
    // release version - 1.0
    // Description-  This Controller manages the FAQ feature
    // created date - Nov 2019


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

   
     
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
        return view('auth.register',compact( 'castemasters'));
    }

    
   /**
     * Check Invitation ID 
     * 
     * @return \Illuminate\Http\Response
     */
    public function validateInvID(Request $request)
    {

        $invitation = DB::table("invites")
                 ->select('id')
                 ->where('invitationid',$request->UserInvitationID)
                 ->first();

        $invites = DB::table("invites")
                 ->select('id')
                 ->where('invitationid',$request->UserInvitationID)
                 ->where('Mobile_Number',$request->Userphone)
                 ->first();
    
        $alreadyUsed  = DB::table("users")
                ->select('id')
                ->where('User_InvitationID',$request->UserInvitationID)
                ->first();
      

        // if invite is already used 
        if (isset($alreadyUsed ) && (count($alreadyUsed) >0 )   )
        {
                $invites=Lang::get('home.invitation_used');
        }
        // both phone number and invitation matches with an invite
        else if (isset($invites ) && isset($invitation) && (count($invites) >0 ) && (count($invitation) >0)  )
        {
                 $invites=Lang::get('home.correct_match');
        }
        //only invitation id matches but not phone number
        else if ( isset($invitation) && !isset($invites )  && (count($invites) <=0 ) && (count($invitation) >0)  )
        {
         
            $invites = Lang::get('home.phonewrong');
        }
        else
        {
            $invites = Lang::get('home.phoneinv_wrong');
        }
        
         return  response()->json(array("msg"=>$invites) );
       
    }




     /**
     * Check Unique Username 
     * 
     * @return \Illuminate\Http\Response
     */
    public function checkUniqueUser(Request $request)
    {
     
        $usrname = DB::table("users")
                 ->select('username','id')
                 ->where('username',$request->Username)
                 ->first();
       
        // both phone number and invitation matches with an invite
        if (isset($usrname ) && (count($usrname) >0 )  )
        {
          
                 $usrname="Sorry";
                 // return json_encode($usrname );
                  return  response()->json($usrname);
        }
        // if username doesnt exists
        else{
            $usrname = "Yes";
            //return json_encode($usrname);
            return  response()->json($usrname);
        }
       
    }

    /**
     * Check Unique Email-ID 
     * 
     * @return \Illuminate\Http\Response
     */
    




   /**
     * Get State List for given country
     * 
     * @return \Illuminate\Http\Response
     */
    public function getStateList(Request $request)
    {
        $states = DB::table("states")
                    ->where("country_id",$request->country_id)
                    ->pluck("name","id");

        return response()->json($states);
    }


    /**
     * Get City List for given State
     * 
     * @return \Illuminate\Http\Response
     */
    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
                    ->where("state_id",$request->state_id)
                    ->pluck("name","id");
        return response()->json($cities);
    }

   
   /**
     * Get subcaste List 
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSubcasteList(Request $request)
    {
        $subcastes = DB::table("subcaste_master")
                        ->where("CasteID",$request->CasteID)
                        ->pluck("SubCaste_Name","SubCasteID");
        return response()->json($subcastes);
    } 





    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*protected function validator(array $data)
    {
        
      return Validator::make($data, [
            'name' => ['required', 'string', 'min:4', 'max:20'],
            'username' => 'required|string|max:20|unique:users',
            'User_InvitationID' => ['required', 'unique:invites', '!exists:users,User_InvitationID'],
            'User_Caste' => ['required', 'string', 'max:200'],
            'User_Subcaste' => ['required', 'string', 'max:200'],
            'User_Phone' => ['required', 'numeric', 'digits_between:0,10, unique:invites'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            ]); 
    }*/


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return 
     */
    public function store(Request $data)
    {
        // try...catch
         try {
            // Transaction
                $exception = DB::transaction(function() use ($data) {
                     $emailid = DB::table("invites")
                                 ->select('email')
                                 ->where('invitationid',$data->User_InvitationID)
                                 ->first();
                                 
                          
                    $user = new User;
                    $user->User_Phone =  $data->User_Phone;
                    $user->User_InvitationID = $data->User_InvitationID;
                    $user->email = $emailid->email;
                    $user->name =  $data->name;
                    $user->username  = $data->username;
                    $user->password = Hash::make($data->password);
                  
                    $user->User_Caste = $data->User_Caste;
                    $user->User_Subcaste = $data->User_Subcaste;
                    $user->UserroleID=1;
                    $user->IsActive=1;
                   
                    $user->save(); 
                   
                }); //end of transaction

                if(is_null($exception)) {
                        DB::commit();
                          return redirect()->route('welcome')->with('success',Lang::get('home.reg_success'));
                 } else {
                        DB::rollback();
                        //throw new Exception;
                        Log::info('RegisterController:Store:  Exception while adding User ',(array)$exception);
                        return back()->with('error',Lang::get('home.reg_error'));
                }
                
            }
            catch(Exception $e) {
                //throw new Exception;
                Log::info('RegisterController:Store:  Exception while adding User ',(array)$e);
                return back()->route('/register')
                             ->with('error',Lang::get('home.reg_error'));
            }
    }
  

}
