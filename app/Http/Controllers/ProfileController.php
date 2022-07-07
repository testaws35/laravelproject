<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Session;
use DB;
use Auth;
use Lang;

use App\User;
use App\Traits\UploadTrait;

// classname - ProfileController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the User profile
// created date - Nov 2019

class ProfileController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

   /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        if (isset ($request->id ) )
        {
            $userprofile = DB::table('users')
                                ->leftjoin('countries', 'users.User_Country', '=', 'countries.id')
                                ->leftjoin('caste_master', 'users.User_Caste', '=', 'caste_master.CasteID')
                                ->leftjoin('subcaste_master', 'users.User_Subcaste', '=', 'subcaste_master.SubCasteID')
                                ->leftjoin('states', 'users.User_State', '=', 'states.id') 
                                ->leftjoin('cities', 'users.User_City', '=', 'cities.id')
                                ->select('users.id','users.name as name', 'users.username','users.email','users.User_Caste','caste_master.CasteName',
                                'users.User_Subcaste','subcaste_master.SubCaste_Name', 'users.User_Phone', 'users.User_Gender',
                                'users.User_MaritalStatus', 'users.User_Country', 'countries.name as Countryname', 'users.User_State',
                                'states.name as statename','users.User_City','cities.name as cityname','users.User_Address','users.User_photo',
                                'users.User_Father_Name','users.User_Mother_Name','users.User_Brother_Num',
                                'users.User_Sister_Num','users.User_Native','users.User_Occupation', 'users.IsElder',
                                'users.IsSeller' )
                                ->where('users.id', $request->id)
                                ->first();
        }
        else{
            $userprofile = DB::table('users')
                                ->leftjoin('countries', 'users.User_Country', '=', 'countries.id')
                                ->leftjoin('caste_master', 'users.User_Caste', '=', 'caste_master.CasteID')
                                ->leftjoin('subcaste_master', 'users.User_Subcaste', '=', 'subcaste_master.SubCasteID')
                                ->leftjoin('states', 'users.User_State', '=', 'states.id') 
                                ->leftjoin('cities', 'users.User_City', '=', 'cities.id')
                                ->select('users.id','users.name as name', 'users.email','users.User_Caste','caste_master.CasteName',
                                'users.User_Subcaste','subcaste_master.SubCaste_Name', 'users.User_Phone', 'users.User_Gender',
                                'users.User_MaritalStatus', 'users.User_Country', 'countries.name as Countryname', 'users.User_State',
                                'states.name as statename','users.User_City','cities.name as cityname','users.User_Address','users.User_photo',
                                'users.User_Father_Name','users.User_Mother_Name','users.User_Brother_Num',
                                'users.User_Sister_Num','users.User_Native','users.User_Occupation', 'users.IsElder',
                                'users.IsSeller' )
                                ->where('users.id', Auth::user()->id)
                                ->first();
        }

        $countries = DB::table("countries")->pluck("name","id");
        $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");

        return view('auth.profile',compact('countries', 'castemasters', 'userprofile'));
    }


    


    public function updateProfile(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        // Form validation
       /*  $request->validate([
            'name'              =>  'required',
            'User_photo'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]); */

        // Get current user
        //$user = User::Find(auth()->user()->id);
        $user = Auth::user();
        // Set user name
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->User_Address = $request->input('User_Address');
        $user->User_Gender = $request->input('User_Gender');
        $user->User_MaritalStatus = $request->input('User_MaritalStatus');

        $user->User_Occupation = $request->input('User_Occupation');
        $user->User_Country = $request->input('User_Country');
        $user->User_State = $request->input('User_State');
        $user->User_City = $request->input('User_City');

        //Family Details
        $user->User_Father_Name = $request->input('User_Father_Name');
        $user->User_Mother_Name = $request->input('User_Mother_Name');  
        $user->User_Brother_Num = $request->input('User_Brother_Num');
        $user->User_Sister_Num = $request->input('User_Sister_Num');  
        $user->User_Native = $request->input('User_Native');


        // Check if a profile image has been uploaded
        if ($request->has('User_photo')) {
            /* // Get image file
            $image = $request->file('User_photo');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/profilephotos/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            //Aruna the below public was causing issue in production site. Image was getting stored under projectfolder/public/ folder
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->User_photo = $filePath; */

            $uri = '/uploads/images/profilephotos/';
            $namewithextension = $request->User_photo->getClientOriginalName(); //Name with extension 'filename.jpg'
            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
            $name = $name.'_'.time().'.'.$request->User_photo->getClientOriginalExtension();
            $user->User_photo = $uri.$name;
            $request->User_photo->move(public_path('/uploads/images/profilephotos/'), $name);

        }

        $request->session()->put("name");
      
        // Persist user record to database
        $user->save();

        //syntax to save value in Session
        $request->session()->save();
        // Return user back and show a flash message
        return redirect()->back()->with(['status' =>Lang::get('home.updated_success')]);
    }


   /**
     * Get State List for given country
     * 
     * @return \Illuminate\Http\Response
     */
    public function getStateList(Request $request)
    {
         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
          }

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
         //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        $cities = DB::table("cities")
                    ->where("state_id",$request->state_id)
                    ->pluck("name","id");
        return response()->json($cities);
    }

   
    public function updateAuthUserPassword(Request $request)
    {
         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

       
       // $user = User::find(Auth::id());
       $user = Auth::user();

        if (!Hash::check($request->current, $user->password)) {
            return response()->json(['errors' => ['current'=>Lang::get('home.pass_err')]], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return view('auth.changepassword')->with("success",Lang::get('home.pass_chng_success'));
    }
       
}//end
