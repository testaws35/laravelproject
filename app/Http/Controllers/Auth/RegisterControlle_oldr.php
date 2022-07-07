<?php

namespace App\Http\Controllers\Auth;



use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Invite;
use App\User;

use DB;
use Auth;
use Validator;
use Alert;

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
                $invites='Invitation is already used. Kindly try with a new Invitation';
               // alert()->error('Failure', 'Invitation is already used. Kindly try with a new Invitation');
                //return json_encode($invites );
                
               //return back()->withErrors(['User_InvitationID' =>'Invitation is already used. Kindly try with a new Invitation']);
        }
        // both phone number and invitation matches with an invite
        else if (isset($invites ) && isset($invitation) && (count($invites) >0 ) && (count($invitation) >0)  )
        {
                 $invites='Invitation and Phone number matches.  Please proceed';
               //  alert()->success('success', 'Invitation and Phone number matches.  Please proceed');
               //  return json_encode($invites );
                //return back()->with('success', 'Invitation and Phone number matches.  Please proceed');
        }
        //only invitation id matches but not phone number
        else if ( isset($invitation) && !isset($invites )  && (count($invites) <=0 ) && (count($invitation) >0)  )
        {
         
            $invites = 'Given Phone number is wrong. It doesnot match with this Invitation ID';
           // alert()->error('Failure', 'Given Phone number is wrong. It doesnot match with this Invitation ID');
            //return json_encode($invites);
           // return back()->withErrors(['User_Phone' =>'Given Phone number is wrong. It doesnot match with this Invitation ID']);
        }
        else{
            $invites = 'Given Phone number and Invitation ID is wrong. It doesnot match with any Invitation';
            //alert()->error('Failure', 'Given Phone number  and Invitation ID is wrong. It doesnot match with any Invitation');
             // return back()->withErrors(['User_Phone' =>'Given Phone number and Invitation ID is wrong. It doesnot match with any Invitation']);
             // return json_encode($invites);
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
                 ->where('username',$request->username)
                 ->first();


        // both phone number and invitation matches with an invite
        if (isset($usrname ) && (count($usrname) >0 )  )
        {
                 $usrname="Sorry";
                 alert()->error('Sorry Username exists!');
                  return json_encode($usrname );
        }
        // if username doesnt exists
        else{
            $usrname = "Yes";
            return json_encode($usrname);
        }
       
    }





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
    protected function validator(array $data)
    {
        
     /*   return Validator::make($data, [
            'name' => ['required', 'string', 'min:4', 'max:20'],
            'username' => 'required|string|max:20|unique:users',
            'User_InvitationID' => ['required', 'unique:invites', '!exists:users,User_InvitationID'],
            'User_Caste' => ['required', 'string', 'max:200'],
            'User_Subcaste' => ['required', 'string', 'max:200'],
            'User_Phone' => ['required', 'numeric', 'digits_between:0,10, unique:invites'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            ]); */
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return 
     */
    public function store(Request $data)
    {
        echo "I am in register store";

      /*   $this->validate($data, [
            'name' => ['required'],
            'username' => 'required|unique:users',
            'User_InvitationID' => ['required'],
            'User_Caste' => ['required'],
            'User_Subcaste' => ['required'],
            'User_Phone' => ['required'],
        ]);  */

        $validator = Validator::make($data->all(), [
            'name' => ['required', 'string', 'min:4', 'max:100'],
            'username' => 'required|string|max:20|unique:users',
            'User_InvitationID' => ['required'],
            'User_Caste' => ['required', 'string', 'max:200'],
            'User_Subcaste' => ['required', 'string', 'max:200'],
            'User_Phone' => ['required', 'numeric', 'digits_between:0,10, unique:invites'],
            'password' => ['required', ]
            //'string', 'min:6', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
           
        ],
        [
            'name.required' => 'Name must be filled',
            'name.min' => 'Minimum 4 characters needed in Name field',
            'name.max' => 'Name must not exceed 100 characters',
            'username.required' => 'Username must be filled',
            'username.string' => 'Username must be a string',
            'username.max' => 'Username must not exceed 20 characters',
            'username.unique' => 'Given Username already exists',
            'User_InvitationID.required' => 'Invitation ID to be filled',
            //'User_InvitationID.unique' => 'Invitation ID is not matching for this Mobile',
            //'User_InvitationID.exists' => 'Invitation ID already taken',
            'User_Phone.required' => 'Mobile number must be filled',
            'User_Phone.unique' => 'Already invitation issued for this mobile number',
            'User_Phone.numeric' => 'Mobile number must be numeric',
            'User_Caste.required' => 'Caste must be filled',
            'User_Subcaste.required' => 'Sub Caste must be filled',
            'password.required' => 'Password must be filled',
            'password.min' => 'Password field must be minimum 6 characters',
            //'password.regex' => 'Password field must have atleast one capital letter and one number',
        ]
    
    );

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }




        // try...catch
         try {
            // Transaction
                $exception = DB::transaction(function() use ($data) {
                    echo "I am in register store  try catch";
     
                    $user = new User;
            
                    $user->User_Phone =  $data->User_Phone;
                    $user->User_InvitationID = $data->User_InvitationID;

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
                        echo  "Your registration is successful. Please login now...";
                          return redirect()->route('login')
                             ->with('success','Your registration is successful. Please login now..');
                 } else {
                        DB::rollback();
                        //throw new Exception;
                        Log::info('RegisterController:Store:  Exception while adding User ',(array)$exception);
                        echo "I am in register store exception";
                          return redirect()->route('/register')
                             ->with('error','Sorry unable to add User due to error');
                }
                
            }
            catch(Exception $e) {
                //throw new Exception;
                Log::info('RegisterController:Store:  Exception while adding User ',(array)$e);
                echo "I am in register store error";
                   return redirect()->route('/register')
                             ->with('error','Sorry unable to add User due to DB exception');
            }
    }
  

}
