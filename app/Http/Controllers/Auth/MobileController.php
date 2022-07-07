<?php

// classname - MobileController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages all the Mobile API methods
// created date - Nov 2019

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Invite;
use App\Mail\InviteCreated;
use App\User;

//Announcement function
use App\Announcements;
use App\AnnouncementsPhotos;
use App\AnnouncementsVideos;


//jwellery/product function 
use App\Product;

// temple function modals
use App\TempleFunctions;
use App\TempleFunctionPhotos;
use App\TempleFunctionVideos;

//community function
use App\SangamMaster;
use App\TempleMaster;
use App\Seller;

//sangam meetings
use App\SangamMeetings;
use App\SangamMeetingPhotos;
use App\SangamMeetingVideos;
use App\SangamMembers;
//personal functions
use App\PersonalFunctions;
use App\PersonalFunctionPhotos;
use App\PersonalFunctionVideos;

//askhelppost functions
use App\HelpPost;
use App\HelpComment;


//seekelders
use App\ElderDetails;
use App\Comment;
use App\Post;

//razorpay api
use Razorpay\Api\Api;

//seller
use App\SellerPaymentTransaction;
//matrimony
use App\Matrimony;
use App\Payment;
use App\Subcaste;
use App\SubcasteGroupMap;
//contact
use App\ContactUS;
use Mail;
use App;
use DB;
use Auth;
use Hash;
use Exception;
use Image;
use Lang;
use Session;

class MobileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest');
    }


/*************************************Login API ***********start****************************************************/
  public function userdetails(Request $request)
  {
      $usr = DB::table('users')
                ->select('id','name','username','User_Phone','UserroleID','IsActive','IsSangamMember', 'IsElder', 'IsSeller', 'SellerMembershipExpiryDate', 'IsTempleMember', 'IsReginMatrimony', 'MatrimonyMembershipExpiry', 'User_MatrimonyMembershipType','User_photo')
                ->where('id','=',$request->UserID)
                ->get();
    
                return response()->json(array('usr'=>$usr));
  }

  public function login(Request $request){
      
        //first check the User table for the Username
        $chkuser = DB::table('users')
                   ->select('id','username','User_Phone','UserroleID','IsActive','IsSangamMember', 'IsElder', 'IsSeller', 'SellerMembershipExpiryDate', 'IsTempleMember', 'IsReginMatrimony', 'MatrimonyMembershipExpiry', 'User_MatrimonyMembershipType')
                   ->where ('username',Input::get('username'))
                   ->get();
                   
     

        if (Auth::attempt(['username' => $request->username,'password'=>$request->password])) {
        //returning user object to mobile app
              return  response()->json($chkuser);
        }
        else
        {

           if (isset($chkuser)  && (count($chkuser) >0) ){
               return  response()->json("wrong_pass",406);
           }
           else{
                return  response()->json("user_noexits",406);
           }
          
        }
    } 
    
    public function changePassword(Request $request)
    {


        if (!(Hash::check($request->current-password, $request->username )  ) ) {
            // The passwords doensnt matches
           return response()->json('chng_pass_err');
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return response()->json('chng_pass_err1');
        }
  
        //Change Password
        $user = DB::table('users')::where('username','=',$request->username )->first();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        //Aruna- there is a difference between returning view and calling back the index method
        // Here we are calling back the index method of Controller so that it fetches data and returns view with content
        //return redirect()->back()->with("success","Password changed successfully !");
       /* $res = 'Password changed successfully !';*/
        return response()->json('password_changesuccess') ;
    }
/************************************Login API *************end **************************************************/

/************************************Home page  API *************start **************************************************/

/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home_index()
    {
                       
         //show the latest Temple function by sorting the result by latest Date 
         $templefunctions = DB::table('temple_functions')
                                ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                                ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                                ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo', 'temple_function_videos.Video')
                                ->where('temple_functions.Status', '1')
                                ->orderby('temple_functions.FunctionDate','DESC')
                                ->take(6)
                                ->get();
    
                
         //show the latest Product uploaded by sorting the result by latest Date 
         $jwellery = DB::table('products')
                                ->select('products.ProductID','products.ProductName', 'products.Description', 'products.Photo', 'products.Weight', 'products.Price')
                                ->where('Status', '1')
                                ->orderby('products.CreatedOn','DESC')
                                ->take(6)
                                ->get();
    
    
       
         //show the latest Sangam Meetings by sorting the result by latest Date 
         $sangammeetings = DB::table('sangam_meetings')
                                ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                                ->leftjoin('sangammeeting_videos', 'sangam_meetings.SangamMeetingID', '=', 'sangammeeting_videos.SangamMeetingID')
                                ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo', 'sangammeeting_videos.Video')
                                ->where('sangam_meetings.Status', '1')
                                ->orderby('sangam_meetings.MeetingDate','DESC')
                                ->take(6)
                                ->get();
    
    
         //show the recently joined Users by sorting the result by latest Date 
     
         $newmembers = DB::table('users')
                                ->leftjoin('subcaste_master', 'users.User_Subcaste', '=', 'subcaste_master.SubCasteID')
                                ->select('users.id','users.name as name', 'users.User_photo as User_photo', 'users.User_Native as User_Native', 'subcaste_master.SubCaste_Name' )
                                ->where('IsActive', '1')
                                ->orderby('users.created_at','DESC')
                                ->take(6)
                                ->get();
    
    
         //show the recent Announcements by sorting the result by latest Date   
         $announcements = DB::table('announcements')
                                ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                                ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                                ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements_photos.Photo','announcements_videos.Video')
                                ->where('announcements.Status', '1')
                                ->orderby('announcements.FunctionDate','DESC')
                                ->take(6)
                                ->get();
    
        //show the latest personal functions by sorting the result by latest Date 
        $personalfunctions = DB::table('personal_functions')
                                ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                ->leftjoin('personal_function_videos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_videos.PersonalFunctionID')
                                ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content','personal_functions.FunctionDate','personal_function_photos.Photo', 'personal_function_videos.Video')
                                ->where('personal_functions.Status', '1')
                                ->orderby('personal_functions.FunctionDate','DESC')
                                ->take(6)
                                ->get();                       

          //return view('home',compact('templefunctions', 'products', 'sangammeetings', 'newmembers', 'personalfunctions', 'announcements'));
        return response()->json(array('temple_functions'=> $templefunctions,'Events'=>$announcements,'sangam_meetings'=>$sangammeetings,'personal_functions'=>$personalfunctions,'new_members'=>$newmembers,'products'=> $jwellery));
    }
    
    
    
    
    public function searchApplication(Request $request)
    {
         
        $searchResult = null;
        $Failure = null;
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
                       // return view('search',compact('searchResult','Failure'));
                        return response()->json(array('searchResult'=> $searchResult,'Failure'=> $Failure) );
                    }
                    else{
                    
                        $Failure = ('search_err');
                        //return view('search',compact('searchResult', 'Failure'));
                        return response()->json(array('searchResult'=> $searchResult,'Failure'=> $Failure) );
                    }
                
                }
            }
            else
            {
                $searchResult = null;
                $Failure =('search_empty');
                //return view('search',compact('searchResult', 'Failure'));
                return response()->json(array('searchResult'=> $searchResult,'Failure'=> $Failure) );
            }
            
    }   
    
    
    /************************************Home page API *************end ************************************************************/
    
    /************************************Profile page API ************* Start ******************************************************/
    public function showaccountpage(Request $request)
    {
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

        $user =array($userprofile);
        return  response()->json(array('user'=>$user ));
    }
    
    public function countries_list()
    {
        $countries = DB::table("countries")->pluck("name","id");
        return response()->json($countries);
    }
    
    public function city_list(Request $request)
    {
        $cities = DB::table("cities")->where("state_id",$request->state_id)->pluck("name","id");
        return response()->json($cities);
    }
    
    public function state_list(Request $request)
    {
        $states = DB::table("states")->where("country_id",$request->country_id)->pluck("name","id");
        return response()->json($states);
    }
    
    public function mob_updateProfile(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
       

        // Form validation
       /*  $request->validate([
            'name'              =>  'required',
            'User_photo'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]); */

        // Get current user
       
        $user = User::Find($request->id);
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


       if ( $request->file('User_photo') )
        {
                $Photo = $request->file('User_photo');
                $uri = '/dist/img/userprofile/';
                $namewithextension = str_replace(' ', '_', $Photo->getClientOriginalName() ); //Name with extension 'filename.jpg'
                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                $user->User_photo =$uri.$name;
                $Photo->move(public_path('/dist/img/userprofile/'), $name);
        }

        //$request->session()->put("name");
      
        // Persist user record to database
        $user->save();

       
        // Return user back and show a flash message
        return response()->json(array(['status' =>('updated_success')]));
    }
    
   
    
    
    
    
    /************************************Profile page API ************* END ******************************************************/

    
    /************************************Registration page API *************Start **************************************************/
    
    /**
     * Check Invitation ID 
     * 
     * @return \Illuminate\Http\Response
     */
    public function mob_regvalidateInvID(Request $request)
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
               
                return  response()->json('invitation_used',406);
        }
        // both phone number and invitation matches with an invite
        else if (isset($invites ) && isset($invitation) && (count($invites) >0 ) && (count($invitation) >0)  )
        {
                 
                  return  response()->json('correct_match');
        }
        //only invitation id matches but not phone number
        else if ( isset($invitation) && !isset($invites )  && (count($invites) <=0 ) && (count($invitation) >0)  )
        {
         
           
             return  response()->json('phonewrong',406);
        }
        else
        {
        
           
             return  response()->json('phoneinv_wrong',406);
        }
        
         //return  response()->json(array("msg"=>$invites) );
       
    }
    
     public function mob_checkUniqueUser(Request $request)
    {
     
        $usrname = DB::table("users")
                 ->select('username','id')
                 ->where('username',$request->Username)
                 ->first();
       
        // both phone number and invitation matches with an invite
        if (isset($usrname ) && (count($usrname) >0 )  )
        {
           return  response()->json('Sorry',406);
        }
        // if username doesnt exists
        else
        {
            //$usrname = "Yes";
            //return json_encode($usrname);
            return  response()->json('Yes');
        }
       
    }
    public function get_castelist()
    {
        $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
        return response()->json($castemasters);
    }
    
    public function register(Request $data)
    {
      

        // try...catch
         try {
            // Transaction
                $exception = DB::transaction(function() use ($data) 
                {
                        $emailid = DB::table("invites")
                                     ->select('email')
                                     ->where('invitationid',$request->UserInvitationID)
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
                       // print_r("data".$user);
                       // exit();     
                        $user->save(); 
                      
                    
                    
                }); //end of transaction
                if(is_null($exception)) {
                        DB::commit();
                        return response()->json(array('success'=>true,'message'=>'reg_success'));
                 } 
                 else 
                 {
                        DB::rollback();
                        //throw new Exception;
                        Log::info('RegisterController:Store:  Exception while adding User ',(array)$exception);
                        return response()->json(array('error'=>true,'message'=>'reg_error'));
                          
                }
                
                
            }
            catch(Exception $e) 
            {
                //throw new Exception;
                Log::info('RegisterController:Store:  Exception while adding User ',(array)$e);
                return response()->json(array('error'=>true,'message'=>'reg_error'));
                
            }
    }
    
    
    
    
    /************************************Registration page API *************end **************************************************/
    
    /************************************Jwellery/Product page API ************* Start **************************************************/
    /*
        The below function is used for getting all products/jwellery ,
        subcategories, sorting , filtering
    */
    public function jwellery_index(Request $request)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        /*if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }*/

        // set default values 
        $sortBy = 'ProductName';
        $orderBy = 'asc';
        $perPage = 20;
        $q = null;
        
        if (isset($request->sortKey))
        {
            if (strcmp($request->sortKey,"default") ==0 ) {
                    $sortBy = "ProductName";
                    $orderBy="Asc";
            }
            else if (strcmp($request->sortKey,"new") ==0){
                    $sortBy = "products.CreatedOn";
                    $orderBy="Desc";
            }
            else if (strcmp($request->sortKey,"low") ==0) {
                    $sortBy = "products.Price";
                    $orderBy="Asc";
            }
            else if (strcmp($request->sortKey,"high") ==0){
                    $sortBy = "products.Price";
                    $orderBy="Desc";
            }
            else{
                    $sortBy = "ProductName";
                    $orderBy="Asc";
                }

        }
        
        if (isset($request->q))
        {
            $q = $request->q;
        }
        
        if (Input::get('href') != null)
        {
            $filter = Input::get('href');
        }
  
        //get all products that are active and from all active sellers in the beginning
        $query = DB::table('products')
                ->join('demo_subcategory', 'demo_subcategory.SubCategoryID', '=', 'products.SubCategoryID')
                ->join('seller', 'seller.SellerID', '=', 'products.SellerID')
                ->where('products.Status',1)
                ->where('seller.Status',1)
                ->orderBy($sortBy,$orderBy);

        // This is for the Search panel in the top in Jewellery/product page
        if(isset($q)) {
            // This will only execute if you received any keyword
            $query = $query->where('ProductName','LIKE','%'.$q.'%')
                            ->orWhere ( 'products.Description', 'LIKE', '%' . $q . '%' )
                            ->orWhere ( 'Weight', 'LIKE', '%' . $q . '%' )
                            ->orWhere ( 'Price', 'LIKE', '%' . $q . '%' )
                            ->orWhere ( 'seller.Name', 'LIKE', '%' . $q . '%' ) 
                            ->orWhere ( 'SubCategoryName', 'LIKE', '%' . $q . '%' ) ;
        } 

        // This is for the LHS panel subcategories like Anklets, Chains etc.. selection
        if(isset($request->SubCategoryID))  {
            // This will only execute if you received any SubcategoryID
            $query = $query->where( 'products.SubCategoryID',$request->SubCategoryID ); 
        }  

        // This is for the LHS panel price panel selection
        if(isset($request->min_price) && isset($request->max_price)){
            // This will only execute if you received any price
            // Make you you validated the min and max price properly
            $query = $query->where('Price','>=',$request->min_price)
                           ->where('Price','<=',$request->max_price);
        }

        // This is for the LHS  Seller panel selection
        if(isset($request->sellerID)) {
            // This will only execute if you received any Seller selection
            $query = $query->where('products.SellerID','=',$request->sellerID);
        }
        
        $products = $query->get();
      
        //this is for knowing selected CategoryID 
        $CatID =$request->SubCategoryID? $request->SubCategoryID : 0;
         return response()->json(array('products'=>$products, 'orderBy'=>$orderBy,'sortBy'=>$sortBy,'perPage'=>$perPage,'CatID'=>$CatID));
       
    }// function end
    
    /*
        The below function is used for getting subcategory list
        * @param  \App\Product  $product
        * @return \Illuminate\Http\Response
    */
    public function subcategorylist()
    {
         $subcategorys = DB::table("demo_subcategory")
                   ->pluck('SubCategoryName','SubCategoryID');
                  return response()->json($subcategorys);
    }
    /*
        The below function is used for getting selller list
        * @param  \App\Product  $product
        * @return \Illuminate\Http\Response
    */
    public function sellerlist()
    {
        $sellers = DB::table('seller')
                ->pluck('seller.Name','seller.SellerID');
                
        return response()->json($sellers);
    }
   

    /*
        The below function is used for viewing the particular product
        * @param  \App\Product  $product
        * @return \Illuminate\Http\Response
    */
    
    public function product_show($ProductID)
    {
           //Check for Session time out and redirect to Login page on Session time out 
           /*if ( ! Auth::check()){
            return view('auth.SessionTimeout');
            }*/
   
        
          if(isset($ProductID))
          {
              
                $product = Product::find($ProductID);
               
                if (isset($product)) {

                    $seller = DB::table('seller')
                    ->select('seller.SellerID','seller.Name', 'seller.CompanyName', 'seller.seller_Mobile', 'seller.Location', 'seller.UserID')
                    ->where('seller.SellerID','=',$product->SellerID)
                    ->orderby('seller.Name','DESC')
                    ->first();   
                       
                    if (! isset($seller)){
                        $seller=null;
                        $sellersProducts = null;
                        //return view('products.show',compact('product', 'seller', 'sellersProducts'));
                        return response()->json(array('product'=>$product, 'seller'=>$seller,'sellersProducts'=>$sellersProducts));

                    }
                    else{
                            $sellersProducts = DB::table('products')
                                        ->where ('products.SellerID', $seller->SellerID)
                                        ->orderby('products.ProductName','ASC')
                                        ->get(); 
                            //return view('products.show',compact('product', 'seller', 'sellersProducts'));
                            return response()->json(array('product'=>$product, 'seller'=>$seller,'sellersProducts'=>$sellersProducts));
                        }
                }//product check if
                else{
                    $product = null;
                    $seller = null;
                    $sellersProducts = null;
                    
                    return response()->json(array("error"=>true, "message"=> "product_err"));
                }
        }
        else
        {
           
            $product = null;
            $seller = null;
            $sellersProducts = null;
            
            return response()->json(array("error"=>true, "message"=> "product_empty"));
        }
    }

    /*
        The below function is used for viewing the particular product
        * @param  \App\Product  $product
        * @return \Illuminate\Http\Response
    */
    public function mob_product_store(Request $request)
    {
           //Check for Session time out and redirect to Login page on Session time out 
          
      
        try 
        {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

                    

            // Storing the Product Details
                            
            $input =  new Product;
            $input->ProductName = $request->get('ProductName');
            $input->Description = $request->get('Description');
            $input->Weight = $request->get('Weight');
            $input->Price = $request->get('Price');
            $input->Carats = $request->get('Carats');
            $input->SubCategoryID = $request->get('SubCategoryID');
         
            
              //name-> full name 123.jpg  , type => mime type  , url => local file path
              //   $input->Photo = $request->file('Photo')->store('products');
            if($request->file('Photo'))
            {
                $Photo = $request->file('Photo');
                $uri = '/images/products/';
                $namewithextension = str_replace(' ', '_', $Photo->getClientOriginalName() ); //Name with extension 'filename.jpg'
                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                $input->Photo =$uri.$name;
       
                $Photo->move(public_path('/images/products/'), $name);
            }
           
            
            
            $seller = DB::table('seller')
                    ->select('seller.SellerID', 'seller.UserID')
                    ->where('seller.UserID','=',$request->UserID)
                    ->first();  
            
            $input->SellerID =$seller->SellerID;
            $input->Status =1;
            $input->Createdby = $request->UserID; 
            $input->CreatedOn = date('Y-m-d');
            $input->Modifiedby = $request->UserID; 
            $input->ModifiedOn = date('Y-m-d');
            $input->save();
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return response()->json(array("success"=>true, "message"=> "success_msg"));
            } 
            else
            {
                DB::rollback();
               // throw new Exception;
               return response()->json(array("error"=>true, "message"=> "fail_msg"));
             }
        }
        catch(Exception $e) 
        {
           // throw new Exception;
            DB::rollback();
            return response()->json(array("error"=>true, "message"=>"fail_msg"));
        }

     

    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function mob_pro_update(Request $request)
    {
           
           

        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

        

             $input = Product::find($request->ProductID);
            
            
             if (isset($input))
                {
                    $input->ProductName = $request->ProductName;
                    $input->Description = $request->Description;
                    $input->Weight = $request->Weight;
                    $input->Price = $request->Price;
                    $input->Carats = $request->Carats;

                    
                    
                    if($request->file('Photo'))
                    {
                        $Photo = $request->file('Photo');
                        $uri = '/images/products/';
                        $namewithextension = str_replace(' ', '_', $Photo->getClientOriginalName() ); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $input->Photo =$uri.$name;
               
                        $Photo->move(public_path('/images/products/'), $name);
                    }
           

                    $input->Modifiedby = $request->UserID;  // please repleace this with userid of session
                    $input->ModifiedOn = date('Y-m-d'); 
 
                    $input->save();
           
                }
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                
                return response()->json(array("success"=>true, "message"=> "updated_success"));
            } else {
                DB::rollback();
                //throw new Exception;
                //return redirect()->route('products.index')
                
                return response()->json(array("error"=>true, "message"=> "updated_fail"));
            }

        }
        catch(Exception $e) {
           // throw new Exception;
            DB::rollback();
            return response()->json(array("error"=>true, "message"=> "updated_fail"));
        }



    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function mob_product_destroy($ProductID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        
        
        //we are doing soft Delete only
       $varproduct = Product::find($ProductID);
       if (isset($varproduct)){
             $varproduct->Status = 0;
             $varproduct->save();
             return response()->json(array("Success"=>true, "message"=> "deletion_success"));
       }
       else{
             return response()->json(array('error'=>true,'message'=>'deletion_fail'));
       }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function mob_product_edit($ProductID)
    {
           //Check for Session time out and redirect to Login page on Session time out 
           

            if(isset($ProductID)){
                    $product = Product::find($ProductID);
                    return response()->json(array('product'=>$product));
            }
            else{

                return response()->json('fetch_error',406);
            }
    }
    /************************************Jwellery page API ************* end **************************************************/

    /************************************Announcement page API *************start **************************************************/
    public function announcement_index(Request $request)
    {
         // in this feature both category wise listing and month wise listing of index page  are handled in same index method
         //Check for Session time out and redirect to Login page on Session time out 
       

        if(isset($request->mon)){

            switch($request->mon){
            case '0':
                     $curMonth =  date('Y-m-d', strtotime("now") );
                     break;
            case '1':
                     $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                     break;
            case '2':
                     $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                     break;
            case '3':
                     $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                     break;
            case '4':
                     $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                     break;
            case '5':
                     $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                     break;
            case '6':
                     $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                     break;
            default:
                     $curMonth= Date('Y-m-d');
            }
        }
        else{
                     $curMonth= Date('Y-m-d');
        }

        $currentYear =  date("Y",strtotime($curMonth) );
        $currentMonth = date("m",strtotime($curMonth) );
        $currentMonthName=  date("M",strtotime($curMonth) );
        $cat = null;
        $Failed=null;

        if (isset($request->cat)) 
        {

            $cat = $request->cat;
 
            $announcements = DB::table('announcements')
                                // we have used left join so that whether photo is available or not Announcements will be got
                                //for index show only photos
                                ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                                // in index page we are not going to show Videos and hence we can remove it 
                                ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                                ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements.Announcement_Category','announcements_photos.Photo','announcements_videos.Video')
                                ->where('announcements.Status', '1')
                                ->where('announcements.Announcement_Category','=', $request->cat)
                                ->orderby('announcements.FunctionDate','DESC')
                                ->get();
        }
         else 
        {
            $announcements = DB::table('announcements')
                                // we have used left join so that whether photo is available or not Announcements will be got
                                ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                                // in index page we are not going to show Videos and hence we can remove it 
                                ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                                ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements.Announcement_Category','announcements_photos.Photo','announcements_videos.Video')
                                ->where('announcements.Status', '1')
                                ->whereYear('announcements.CreatedOn','=',$currentYear)
                                ->whereMonth('announcements.CreatedOn','=',$currentMonth)
                                ->orderby('announcements.FunctionDate','DESC')
                                ->get();
        }  

        if (isset($announcements)  && count($announcements) > 0 ){
                    return response()->json(array('announcements'=>$announcements, 'Failed'=>$Failed));
                          //->with('i', (request()->input('page', 1) - 1) * 5);
        }
        else 
        {

             if (  isset($cat) ) 
             {
                    $announcements = null;
                    // we have to use . for concatenating Variable and + for concatenating a String constant
                    $Failed = error;
                    return response()->json(array('announcements'=>$announcements, 'Failed'=>$Failed));
             }
             else
             {
                    $announcements = null;
                    // we have to use . for concatenating Variable and + for concatenating a String constant
                    $Failed = error;
                    return response()->json(array('announcements'=>$announcements, 'Failed'=>$Failed));
             }
             
             return response()->json(array('announcements'=>$announcements, 'Failed'=>$Failed));
                   
       }
      

    }// end of index
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Announcement_store(Request $request)
    {
       
      
        //Check for Session time out and redirect to Login page on Session time out 
        /*if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }*/

        // try...catch
        try {
           // Transaction
            $exception = DB::transaction(function() use ($request) {

           

                // First , save Announcement details in Announcements table
	            $input =  new Announcements;
                $input->Title = $request->get('Title');
                $input->Function_Content = $request->get('Function_Content');
                $input->FunctionDate = $request->get('FunctionDate');
                $input->Createdby = $request->UserID;  
                $input->CreatedOn = date('Y-m-d');
                $input->Status = 1;
                $input->Post_Status = 1;
                $input->Announcement_Category = $request->get('Category');
                                      
                $input->save();
                //get the ID of the announcement saved
                $lastid = $input->AnnouncementsID;

                //Storing the Photos
                if ($request->file('Photo'))
                {
                   
                         // Changed by Aruna
                         //Data that is being stored in table is chnaged from 1506032020.png to /images/announcements_aruna_1506032020.png
                         // This means initially we were forming filename to be stored in DB as  Time.ext 1503062020.png
                         //now to benefit mobile app we are storing full path in DB 

                        $phinput =  new AnnouncementsPhotos;
                        // Set the announcemnt ID created in the previous step as Foreign key in announcements_photos
                        $phinput->AnnouncementsID = $lastid;

                       
                        $Photo = $request->file('Photo');
                        $uri = '/images/announcements/';
                        $namewithextension =  $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'. $Photo->getClientOriginalExtension();
                        $phinput['Photo'] = $uri.$name;
                        $request->Photo->move(public_path('images/announcements'), $name);
                        $phinput->Createdby =$request->UserID;  
                        $phinput->CreatedOn = date('Y-m-d');
                        $phinput->save();
                }

                    //Storing the Vidoes
                if ($request->file(Video)  != null)
                {
                    $vidinput =  new AnnouncementsVideos;
                    // Set the announcemnt ID created in the previous step as Foreign key in announcements_videos
                    $vidinput->AnnouncementsID = $lastid;
                    //$vidinput->Video = $request->get('Video');
                    $video = $request->file(Video);
                    $uri = '/images/announcements/video/';
                    $namewithextension = $video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$video->getClientOriginalExtension();
                    $vidinput['Video'] = $uri.$name;
                    $video->move(public_path('images/announcements/video/'), $name);
                    
                    
                    $vidinput->Createdby = $request->UserID; 
                    $vidinput->CreatedOn = date('Y-m-d');
                    $vidinput->save();
                    
                 }

                }); //end of transaction

                if(is_null($exception)) {
                        DB::commit();
                         //Aruna- there is a difference between returning view and calling back the index method
                         // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                        // return redirect()->route('announcements.index')
                          //         ->with('success','Announcement created successfully.');
                     return response()->json(array('success'=>'success_msg'));

                } 
                else {
                    DB::rollback();
                    //throw new Exception;
                    //Log::info('AnnouncementsController:Store:  Exception while adding announcement ',(array)$exception);
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                     return response()->json(array('warning'=>'fail_msg'),406);
                            

                }
            
            }
            catch(Exception $e) {
                DB::rollback();
                //throw new Exception;
                Log::info('AnnouncementsController:Store:  Exception while adding announcement ',(array)$e);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return response()->json(array('warning'=>'fail_msg'),406);
            }
   }
   
      /**
     * Display the specified resource.
     *
     * @param  \App\Announcements  $announcement
     * @return \Illuminate\Http\Response
     * Announcements is the Model Name
     * 
     */
    public function Announcements_show($AnnouncementsID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        /*if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }*/


        //THIS IS sent for the Recent Announcements panel in RHS
        $announcements = DB::table('announcements')
                            ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                            ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                            ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements.Announcement_Category','announcements_photos.Photo','announcements_videos.Video')
                            ->where('announcements.Status', '1')
                            ->orderby('announcements.FunctionDate','DESC')
                            ->take(5)
                            ->get();

        if (isset($AnnouncementsID) ){
                //sending the specific announcement for the given id
       
                $announcement = DB::table('announcements')
                                        ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                                        ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                                        ->leftjoin('users', 'announcements.Createdby', '=', 'users.id')
                                        ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements.Createdby','announcements.Announcement_Category','announcements_photos.Photo','announcements_videos.Video', 'users.name as name' )
                                        ->where('announcements.AnnouncementsID',$AnnouncementsID)
                                        ->first();

                if(  isset($announcement) &&  (count($announcement) >0)  ) {
                        //return view('announcements.show',compact('announcement', 'announcements'));
                        return response()->json(array('announcement'=>$announcement,'announcements'=>$announcements));
                }
                else{

                         $announcement = null;
                         return response()->json(array('announcement'=>$announcement, 'announcements'=>$announcements,"error"=>true, "message"=> "Unable to add to Cart!" ));
                                        
                }
        }
        else
        {
            $announcement = null;
            //return view('announcements.show',compact('announcement', 'announcements')
            //->with('warning','Given Announcement ID is null'));
            return response()->json(array('announcement'=>$announcement, 'announcements'=>$announcements,'warning'=>'announce_warning_null' ));
        }
       
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcements
     * @return \Illuminate\Http\Response
     */
     
    public function announcements_edit($announcementsID)
    {

        //Aruna added - Since announcements can have photos and videos we are doing left join
        // so that even if vidoes and photos are not there too, announcments must be provided
        $announcement = DB::table('announcements')
                            ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                            ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                            ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements.Announcement_Category','announcements_photos.Photo','announcements_photos.Announcements_PhotosID', 'announcements_videos.Video','announcements_videos.Announcements_VideosID' )
                            ->where('announcements.Status', '1')
                            ->where('announcements.AnnouncementsID',$announcementsID)
                            ->first();

        return response()->json(array('announcement'=>$announcement));
    }



    //added by Aruna
     /**
     * update the specified resource.
     *
     * @param  \App\PersonalFunction  $product
     * @return \Illuminate\Http\Response
     */
    public function announcement_update(Request $request)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        
        // try...catch
        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {
           
                $input = Announcements::find($request->AnnouncementsID);
                $input->Title = $request->Title;
                $input->Function_Content = $request->Description;
                $input->FunctionDate = $request->FunctionDate;
                $input->Status =1;
                $input->Post_Status = 1;
                $input->Announcement_Category = $request->Category;
             
                $input->save();
                        
               //Storing the Photos
               if( $request->file('Photo'))
               {
                    //Aruna - most important-   save() method can be applied on a variable which is pointing to Model objects only
                    //  Initially we have written raw query using DB::table.  That time Photo->save was not working
                    // After changing to Eloquent syntax of representing model photo save is working
                    
                    $phinput = AnnouncementsPhotos::where(AnnouncementsID, $request->AnnouncementsID)->first(); 
                    
                    if( isset($phinput)  )
                    {
                        $Photo = $request->file('Photo');
                        $uri = '/images/announcements/';
                        $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $phinput['Photo'] = $uri.$name;
                        $Photo->move(public_path('images/announcements'), $name);
                        $phinput->Createdby = $request->UserID;  
                        $phinput->CreatedOn = date('Y-m-d'); 
                        //AnnouncementsID is already set. No need to again do it This is update only.
                        $phinput->save();
                    }
                    else
                    {
                        $phinput1 = new AnnouncementsPhotos;
                        $phinput1->AnnouncementsID = $request->AnnouncementsID;
                        $Photo = $request->file('Photo');
                        $uri = '/images/announcements/';
                        $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $phinput1['Photo'] = $uri.$name;
                        $Photo->move(public_path('images/announcements'), $name);
                        $phinput1->Createdby = $request->UserID;  
                        $phinput1->CreatedOn = date('Y-m-d'); 
                        //AnnouncementsID is already set. No need to again do it This is update only.
                        $phinput1->save();
                        
                    }
                }

                //Storing the Videos
                 if ($request->file('Video') != null)
                 {
                    $vidinput =  AnnouncementsVideos::where(AnnouncementsID,$request->AnnouncementsID)->first(); 
                    if(isset($vidinput))
                    {
                        $video = $request->file('Video');
                        $uri = '/images/announcements/video/';
                        $namewithextension = $video->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$video->getClientOriginalExtension();
                        $vidinput['Video'] = $uri.$name;
                        $video->move(public_path('images/announcements/video/'), $name);
                        $vidinput->Createdby = $request->UserID;  
                        $vidinput->CreatedOn = date('Y-m-d'); 
                        $vidinput->save();
                    }
                    else
                    {
                        $videonew = new  AnnouncementsVideos;
                        $videonew->AnnouncementsID = $request->AnnouncementsID;
                        $video = $request->file('Video');
                        $uri = '/images/announcements/video/';
                        $namewithextension = $video->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$video->getClientOriginalExtension();
                        $videonew['Video'] = $uri.$name;
                        $video->move(public_path('images/announcements/video/'), $name);
                        $videonew->Createdby = $request->UserID;
                        $videonew->CreatedOn = date('Y-m-d'); 
                        $videonew->save();
                    }
                    
                 }
 
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return response()->json(array('success'=>true,'msg'=>'announce_update_success'));
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('AnnouncementsController:update:  Exception while updating announcement ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return response()->json('announce_update_error',406);
            }
        
        }
        catch(Exception $e) {
            //dd($e);
            //throw new Exception;
            // add code to Log exception and not throw Exception
            DB::rollback();
            
            return response()->json('announce_update_exp',406);
        }
   
    }

   
    //added by Aruna
     /**
     * Delete the specified resource.
     *
     * @param  \App\Announcments\  $announcement
     * @return \Illuminate\Http\Response
     */
    public function announcement_destroy($AnnouncementsID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
       

        try 
        {
                // Transaction
             $exception = DB::transaction(function() use ($request,$AnnouncementsID) {

               
                $announcementPhoto = DB::table('announcements_photos')->where('AnnouncementsID','=',$AnnouncementsID)->first();
                if(isset($announcementPhoto->Photo))
                {
                    $announcementPhoto1 = DB::table('announcements_photos')->where('AnnouncementsID','=',$AnnouncementsID)->update(['Status'=>0]);
                }
                
                $announcementVideo = DB::table('announcements_videos')->where('AnnouncementsID','=',$AnnouncementsID)->first();
             
                if(isset($announcementVideo->Video))
                {
                    $announcementVideo = DB::table('announcements_videos')->where('AnnouncementsID','=',$AnnouncementsID)->update(['Status'=>0]);
                }
                
                $announcement      = DB::table('announcements')->where('AnnouncementsID','=',$AnnouncementsID)->update(['Status'=>0]);
                
                 //print_r($announcement);exit();

                
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return response()->json(array('success'=>true,'msg'=>'announce_del_success'));
              } 
              else 
              {
                DB::rollback();
                //throw new Exception;
                Log::info('AnnouncementsController:Delete:  Exception while deleting announcement ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return response()->json('announce_del_error',406);
              }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            // add code to Log exception and not throw Exception
            DB::rollback();
            Log::info('AnnouncementsController:Delete:  Exception while updating announcement ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return response()->json('announce_del_exp',406);
           
       }

    }
    
/***************************************Announcement page API  *************end *************************************************
&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&*/   
/***********************************Temple Functions page API  ************* Start ***********************************************/
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function templefunctn_index(Request $request)
    {

           // in this feature both category wise listing and month wise listing of index page  are handled in same index method
          
    
            if(isset($request->mon)){

                switch($request->mon){
                case '1':
                         $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                         break;
                case '2':
                         $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                         break;
                case '3':
                         $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                         break;
                case '4':
                         $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                         break;
                case '5':
                         $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                         break;
                case '6':
                         $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                         break;
                default:
                         $curMonth= Date('Y-m-d');
                }
            }
            else{
                         $curMonth= Date('Y-m-d');
            }
     
            $currentYear =  date("Y",strtotime($curMonth) );
            $currentMonth = date("m",strtotime($curMonth) );
            $currentMonthName=  date("M",strtotime($curMonth) );
            $Failed=null;
    
          
             if (!isset($request->templeid) ){
   
                $templefunctions = DB::table('temple_functions')
                        ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                            // Aruna- we have used left join so that whether photo is available or not Announcements will be got
                            //for index show only photos
                        ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                         // Aruna : Let us get only photos for the index pages
                        ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo','temple_functions.Createdby', 'temple_function_videos.Video')
                        ->where('temple_functions.Status', '1')
                        ->whereYear('temple_functions.CreatedOn','=',$currentYear)
                        ->whereMonth('temple_functions.CreatedOn','=',$currentMonth)
                        ->orderby('temple_functions.FunctionDate','DESC')
                        ->get();
                        //->paginate(6);
                      
                         
                if ( isset($templefunctions) && (count($templefunctions) >0)  ){
                        $Failed=null;
                }
                else{
                            $templefunctions = null;
                            $Failed='templefunc_index_error'.$currentMonthName. ' , '.$currentYear;
                }
             }
             else{

                $templefunctions = DB::table('temple_functions')
                        ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                        // Aruna : Let us get only photos for the index pages
                        
                        ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                        ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo','temple_function_videos.Video')
                        ->where('temple_functions.Status', '1')
                        ->where('TempleID',$request->templeid)
                        ->orderby('temple_functions.FunctionDate','DESC')
                        ->get();
                        //->paginate(6);
                        
                $templeUP = DB::table('temple_member_master')
                                ->select('TempleID')
                                ->where('temple_member_master.UserID',$request->UserID)
                                ->where('TempleID','=',$request->templeid)
                                ->first();
                                
                if ( isset($templefunctions) && (count($templefunctions) >0)  ){
                    $Failed= null;
                }
                else
                {
                    //$templefunctions =null;
                    $temple = DB::table('temple_master')
                             ->select('temple_master.TempleID','temple_master.Temple_Name')
                             ->where('TempleID', $request->templeid)
                             ->first();
                    $Failed='templefunc_index_error'.$temple->Temple_Name;
                }
             }

             return response()->json(array('templefunctions'=>$templefunctions,'Failed'=>$Failed,'templeUP'=>$templeUP));

   }

   public function templeslist()
   {
       
            $temples = DB::table("temple_master")
                        ->where('Temple_Status', '1')
                        ->orderby('temple_master.Temple_Name','ASC')
                        ->pluck("Temple_Name","TempleID");
                        
            return response()->json($temples);
                            
   }
                
                
    public function templefun_store(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        

        $temple = DB::table('temple_member_master')
                        ->where('temple_member_master.UserID',$request->UserID)
                        ->first();

        if (isset($temple) ){
  
        // try...catch
        try {
           // Transaction
            $exception = DB::transaction(function() use ($request, $temple) {

              
               
        
                // Storing the Meeting Details
                $input =  new TempleFunctions;
                $input->Title = $request->Title;
                $input->Function_Content = $request->Function_Content;
                $input->FunctionDate = $request->FunctionDate;
                //Aruna added
                $input->TempleID = $temple->TempleID;
                $input->Status =1;
                $input->Post_Status = 1;
                $input->Createdby = $request->UserID;  // please repleace this with userid of session
                $input->CreatedOn = date('Y-m-d');
                $input->save();

                //Aruna: The below single line gets th ID of the saved record
                $lastid= $input->TempleFunctionID;

                //Storing the Photos
                if ($request->file('Photo'))
                {
                    $phinput =  new TempleFunctionPhotos;
                    // we have to add the meetingid created in the above step
                    $phinput->TempleFunctionID = $lastid;
                    
                    /*changed by Aruna - Due to mobile app issue - get filepath full
                    $phinput['Photo'] = time().'.'.$request->Photo->getClientOriginalExtension();
                    $request->Photo->move(public_path('images/templefunctions'), $phinput['Photo']);*/
                    $Photo = $request->file('Photo');
                    $uri = '/images/templefunctions/';
                    $namewithextension = str_replace(' ', '_', $Photo->getClientOriginalName() ); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                    $phinput['Photo'] = $uri.$name;
                    $Photo->move(public_path('images/templefunctions'), $name);
                    
                    
                    
                   

                    $phinput->Createdby = $request->UserID;  
                    $phinput->CreatedOn = date('Y-m-d');
                   
                    $phinput->save();
                }

                    
               //Storing the Vidoes
                if ($request->file(Video))
                {
                    $vidinput =  new TempleFunctionVideos;
                      // we have to add the meetingid created in the above step
                    $vidinput->TempleFunctionID = $lastid;
                    $video = $request->file(Video);
                    $uri = '/images/templefunctions/video/';
                    $namewithextension = $video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$video->getClientOriginalExtension();
                    $vidinput['Video'] = $uri.$name;
                    $video->move(public_path('images/templefunctions/video/'), $name);
                    $vidinput->Createdby =  $request->UserID;  
                    $vidinput->CreatedOn = date('Y-m-d');
                    $vidinput->save();
                }


                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //Aruna . There is difference between calling a view and controller method
                    // To call view -> we use return view  and send objects using "compact" and variable using "with"
                    // To call a controller method we use redirect()-> route () and with to send additioanl message
                    return response()->json(array('success'=>true,'message'=>'success_msg'));
                    
                    
                  
                } else {
                    DB::rollback();
                   // throw new Exception;
                    Log::info('TempleFunctionsController:Create:  Exception while creating Temple Function ',(array)$exception);
                    return response()->json('fail_msg',406);
                }
            
            }
            catch(Exception $e) {
                //throw new Exception;
                
                DB::rollback();
                //Log::info('TempleFunctionsController:Create:  Exception while creating Temple Function',(array)$e);
                return response()->json('fail_msg',406);
            }
        }
        else{
            //throw new Exception;
            DB::rollback();
            Log::info('TempleFunctionsController:Create:  Exception while creating Temple Function . Owned Temple ID is null',(array)$e);
            return response()->json('fail_msg',406);
        }
    }

    
    
     /**
     * Display the specified resource.
     *
     * @param  \App\TempleFunctions  $templefunction
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function templefunc_show($TempleFunctionID)
    {
        
        //Check for Session time out and redirect to Login page on Session time out 
        
        //this is retruned for the Recent functions panel in Right side
        $templefunctions = DB::table('temple_functions')
                                    ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                                    ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                                    ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo','temple_function_videos.Video')                                    ->where('temple_functions.Status', '1')
                                    ->orderby('temple_functions.FunctionDate','DESC')
                                    ->get();
        
        if (isset ($TempleFunctionID)  ) 
        {
                //first get the Post of the given ID
                $templefunction = DB::table('temple_functions')
                                    ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                                    ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                                    ->leftjoin('temple_member_master','temple_member_master.TempleID','=','temple_functions.TempleID' )
                                    ->leftjoin('temple_master','temple_master.TempleID','=','temple_functions.TempleID')
                                    ->leftjoin('users','users.id','=','temple_functions.Createdby' )
                                    ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate',
                                             'temple_functions.Createdby','temple_function_photos.Photo as Photo','temple_function_videos.Video  as Video', 'users.name as name',
                                             'temple_master.Temple_Name')
                                    ->where('temple_functions.Status', '1')
                                    ->where('temple_functions.TempleFunctionID',$TempleFunctionID )
                                    ->first(); 
                //print_r($templefunction);exit();
                
                if(isset($templefunction)  &&  (count($templefunction) >0)) 
                {
                    return response()->json(array('templefunction'=>$templefunction,'templefunctions'=>$templefunctions));
                }
                else
                {
                    $templefunction = null;
                    return response()->json(array('templefunction'=>$templefunction,'templefunctions'=>$templefunctions,'templefunc_warning'));
                }

        }
        else
        {
            $templefunction = null;
            return response()->json(array('templefunction'=>$templefunction,'templefunctions'=>$templefunctions,'templefunc_idnull_warning'));
                       
        }
    }

    //added by Aruna
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalFunction  $product
     * @return \Illuminate\Http\Response
     */
    public function templefunc_edit($TempleFunctionID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        
          //Aruna added - Since Temple Functions can have photos and videos we are doing left join
        // so that even if vidoes and photos are not there too, Temple functions must be provided
        $templefunction = DB::table('temple_functions')
                            ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                            ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                            ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo','temple_function_videos.Video')
                            ->where('temple_functions.TempleFunctionID', $TempleFunctionID)
                            ->first();

        return response()->json(array('templefunction'=>$templefunction));
    }




  /**
     * Display the specified resource.
     *
     * @param  \App\TempleFunctions  $templefunction
     * @return \Illuminate\Http\Response
     * TempleFunctions Model Name
     * variable name templefunction used in create,index and show pages
     */

    public function templefunctn_update(Request $request)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        // try...catch
        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {
    
                $input = TempleFunctions::find($request->TempleFunctionID);
                $input->Title = $request->Title;
                $input->Function_Content = $request->Function_Content;
                $input->FunctionDate = $request->FunctionDate;
                $input->Status =1;
                // we are not updating Temple id
                $input->Post_Status = 1;
                $input->Createdby = $request->UserID;  
                $input->CreatedOn = date('y-m-d');

                $input->save();

                //Storing the Photos
                if( $request->file('Photo'))
                {
                    $phinput = TempleFunctionPhotos::where(TempleFunctionID,$request->TempleFunctionID)->first();
                                          
                    if (isset($phinput))
                    {

                          /*   changed by Aruna - due to mobileapp issue
                            $phinput['Photo']  = time().'.'.$request->Photo->getClientOriginalExtension();
                            $request->Photo->move(public_path('images/templefunctions'), $phinput['Photo'] ); */
                            
                            $Photo = $request->file('Photo');
                            $uri = '/images/templefunctions/';
                            $namewithextension = str_replace(' ', '_', $Photo->getClientOriginalName() ); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                            $phinput['Photo'] = $uri.$name;
                            $Photo->move(public_path('images/templefunctions'), $name);
                            $phinput->Createdby = $request->UserID;  
                            $phinput->CreatedOn = date('Y-m-d');
                            $phinput->save();
                    }
                    else
                    {
                            $phinput1 = new TempleFunctionPhotos;
                        
                            $New_Photo = $request->file('Photo');
                            $uri = '/images/templefunctions/';
                            $namewithextension = str_replace(' ', '_', $New_Photo->getClientOriginalName() ); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$New_Photo->getClientOriginalExtension();
                            $phinput1['Photo'] = $uri.$name;
                            $New_Photo->move(public_path('images/templefunctions'), $name);
                            $phinput1->Createdby = $request->UserID;  
                            $phinput1->CreatedOn = date('Y-m-d');
                            $phinput1->save();
                    }
                }
                
                //Storing the Vidoes
                if ($request->file(Video))
                {
                    $phinput = TempleFunctionVideos::where(TempleFunctionID,$request->TempleFunctionID)->first();
                   
                    if(isset($phinput))
                    {
                        //$vidinput =  new TempleFunctionVideos;
                        // we have to add the meetingid created in the above step
                        //$vidinput->TempleFunctionID = $lastid;
                        $video = $request->file(Video);
                        $uri = '/images/templefunctions/video/';
                        $namewithextension = $video->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$video->getClientOriginalExtension();
                        $phinput['Video'] = $uri.$name;
                        $video->move(public_path('images/templefunctions/video/'), $name);
                        $phinput->Createdby =  $request->UserID;  
                        $phinput->CreatedOn = date('Y-m-d');
                        $phinput->save();
                    }
                    else
                    {
                        $vidinput =  new TempleFunctionVideos;
                        // we have to add the meetingid created in the above step
                        $vidinput->TempleFunctionID = $request->TempleFunctionID;
                        $video = $request->file(Video);
                        $uri = '/images/templefunctions/video/';
                        $namewithextension = $video->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$video->getClientOriginalExtension();
                        $vidinput['Video'] = $uri.$name;
                        $video->move(public_path('images/templefunctions/video/'), $name);
                        $vidinput->Createdby =  $request->UserID;  
                        $vidinput->CreatedOn = date('Y-m-d');
                        $vidinput->save();
                    }
                    
                    
                }
                    
                

            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                 //Aruna . There is difference between calling a view and controller method
                // To call view -> we use return view  and send objects using "compact" and variable using "with"
                // To call a controller method we use redirect()-> route () and with to send additioanl message
                return response()->json(array('success'=>true,'msg'=>'updated_success'));
               
            } else {
                DB::rollback();
                //throw new Exception;
                //Log::info('TempleFunctionsController:update:  Exception while updating Temple functions ',(array)$exception);
                return response()->json('updated_fail',406);
            }
        
        }
        catch(Exception $e) {
            //dd($e);
            //throw new Exception;
            DB::rollback();
            //Log::info('TempleFunctionsController:update:  Exception while updating Temple functions ',(array)$e);
            return response()->json('updated_fail',406);
        }

    }   
    
     //added by Aruna
     /**
     * Delete the specified resource.
     *
     * @param  \App\TempleFunctions\  $TempleFunctionID
     * @return \Illuminate\Http\Response
     */
    public function templefunctn_destroy($TempleFunctionID)
    {

        // try...catch
        try 
        {
                // Transaction
             $exception = DB::transaction(function() use ($request,$TempleFunctionID) {

               
                $templefunctionPhoto = DB::table('temple_function_photos')->where('TempleFunctionID','=',$TempleFunctionID)->first();
                if(isset($templefunctionPhoto->Photo))
                {
                    $templefunctionPhoto1 = DB::table('temple_function_photos')->where('TempleFunctionID','=',$TempleFunctionID)->update(['Status'=>0]);
                }

                $templefunctionVideo = DB::table('temple_function_videos')->where('TempleFunctionID','=',$TempleFunctionID)->first();
             
                if(isset($templefunctionVideo->Video))
                {
                    $templefunctionVideo1 = DB::table('temple_function_videos')->where('TempleFunctionID','=',$TempleFunctionID)->update(['Status'=>0]);
                }
               
                $templefunction      = DB::table('temple_functions')->where('TempleFunctionID','=',$TempleFunctionID)->update(['Status'=>0]);

            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return response()->json(array('success'=>true,'msg'=>'deletion_success'));
                    
              } 
              else {
                DB::rollback();
                //throw new Exception;
               // Log::info('TempleFunctionsController:Delete:  Exception while deleting Temple Function  ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return response()->json('deletion_fail',406);
                                     
              }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            // add code to Log exception and not throw Exception
            DB::rollback();
            //Log::info('TempleFunctionsController:Delete:  Exception while updating Temple Function  ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return response()->json('deletion_fail',406);
                    
       }

    }

/***********************************Temple Functions page API  ************* End ******************************************************
&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
***********************************Community Functions page API  ************* Start *************************************************/
    /*
    
        This function is used for getting the members list and 
        sangam's list for community page
    
    */
    public function mob_community_sangam(Request $request)
    {
        $SangamID = $request->SangamID;
      
        $sangams = SangamMaster::get();
        
        if(isset($SangamID))
        {
            
          
            $members = DB::table('sangam_member_master')
                  ->leftjoin('sangam_master', 'sangam_master.SangamID', '=', 'sangam_member_master.SangamID')
                  ->leftjoin('users','users.id', '=', 'sangam_member_master.UserID')
    
                  ->select('sangam_member_master.SangamMemberID','sangam_master.Sangam_Name','users.name','users.id as id' ,'users.User_photo', 'sangam_member_master.Position','sangam_member_master.MembersFromWhen','sangam_member_master.MembershipType')
                  ->where('Status', '1')
                  ->where('sangam_member_master.SangamID',$SangamID)
                  ->orderby('users.name','ASC')
                  ->get();
                  
         /*   $sangams = SangamMaster::find($SangamID); */
             $sangams = DB::table('sangam_master')
                        ->leftjoin('users','users.id', '=','sangam_master.Createdby')
                        ->select('SangamID','Sangam_Name', 'Sangam_Location', 'Sangam_Description', 'Sangam_StartedOn', 'Sangam_Status', 'Sangam_Photo', 'Num_of_members','Sangam_Activities', 'Createdby', 'CreatedOn','users.name')
                        ->where('SangamID','=',$SangamID)
                        ->first();
            
            $sangam_recent = DB::table('sangam_master')
                                ->select('sangam_master.Sangam_Name','sangam_master.SangamID','sangam_master.Sangam_Photo')->take(5)->get();
                                
           
            if(isset($members)  &&  (count($members) >0)) 
            {
                return response()->json(array('sangams'=>$sangams,'members'=>$members,'sangam_recent'=>$sangam_recent));
            }
            else
            {
                 $sangams = [];
                 $members = [];
                 $sangam_recent = [];
                 return response()->json(array('sangams'=>$sangams,'members'=>$members,'sangam_recent'=>$sangam_recent));
            }
        }
        else
        {
           
            return response()->json(array('sangams'=>$sangams));
        }
          

    } 
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function mob_community_sangamstore(Request $request)
    {
       
        try {
               $exception = DB::transaction(function() use ($request) 
               {
                    // Storing the Sangam Details
				
                    $input =  new SangamMaster;
                    $input->Sangam_Name = $request->get('Sangam_Name');
                    $input->Sangam_Location = $request->get('Sangam_Location');
                    $input->Sangam_Description = $request->get('Sangam_Description');
                    $input->Sangam_StartedOn = $request->get('Sangam_StartedOn');

                    if($request->file('Sangam_Photo'))
                    {
                        $Photo = $request->file('Sangam_Photo');
                        $uri = '/images/sangamphotos/';
                        $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $input['Sangam_Photo'] = $uri.$name;
                        $Photo->move(public_path('images/sangamphotos'), $name);
                    }
                    
                    $input->Num_of_members = $request->get('Num_of_members');
                    $input->Sangam_Activities = $request->get('Sangam_Activities');
                    $input->Sangam_Status =1;
                    $input->Createdby = $request->UserID;  // please repleace this with userid of session
                    $input->CreatedOn = date('Y-m-d');
                    $input->save();
                    
                    
                    $members = new SangamMembers;
                    $members->SangamID = $input->SangamID;
                    $members->UserID = $request->UserID;
                    $members->Position = "admin";
                    $members->MembersFromWhen = date('Y-m-d');
                    $members->MembershipType = "Permanent";
                    $members->Status = 1;
                    $members->Createdby = $request->UserID;  // please repleace this with userid of session
                    $members->CreatedOn = date('Y-m-d');
                    $members->created_at = date('Y-m-d');
                    $members->save();
               
                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    return response()->json(array('success'=>true,'msg'=>'success_msg'));
                }
                else 
                {
                    DB::rollback();
                    //throw new Exception;
                    //Log::info('SangamMasterController:Create:  Exception while creating Sangam',(array)$exception);
                    return response()->json(array('error'=>true,'msg'=>'fail_msg'),406);
                }
            
            }
            catch(Exception $e) {
               DB::rollback();
               // throw new Exception;
               //Log::info('SangamMasterController:Create:  Exception while creating Sangam',(array)$exception);
               return response()->json(array('error'=>true,'msg'=>'fail_msg'),406);
            }
    }
    
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
     
   public function mob_community_temples(Request $request)
   {
        $TempleID = $request->TempleID;
        $temples = TempleMaster::orderBy('CreatedOn', 'asc')->get();
        //usha -> this below temple query is for viewing the particular temple on click of readmore
        if(isset($TempleID))
        {
           /* $temples = TempleMaster::find($TempleID);*/
            $temples =  DB::table('temple_master')
                        ->leftjoin('users','users.id', '=','temple_master.Createdby')
                        ->select('TempleID', 'Temple_Name', 'Temple_Head', 'Temple_OwnedBy_Subsect', 'Temple_SharedWith_Anyone', 'Temple_Location', 'Temple_Description', 'Temple_StartedOn', 'Temple_Status', 'Temple_Photo', 'Temple_Address', 'Temple_BusRoute', 'Temple_Nearby_City', 'CreatedOn', 'Createdby','users.name')
                        ->where('TempleID','=',$TempleID)
                        ->first();
            $temple_recent = TempleMaster::select('Temple_Name','TempleID','Temple_Photo')->take(5)->get();
            return response()->json(array('temples'=>$temples,'temple_recent'=>$temple_recent));
        }
        else
        {
            if(isset($temples) && (count($temples)>0))
            {
                return response()->json(array('temples'=>$temples));
            }
            else
            {
                $temples = [];
                return response()->json(array('temples'=>$temples));
            }
        }

   }
   
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mob_community_templestore(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        

        // try...catch
        try {
           // Transaction
            $exception = DB::transaction(function() use ($request) {

               
              
                // Storing the Sangam Details
				
                $input =  new TempleMaster;
                $input->Temple_Name = $request->get('Temple_Name');
                $input->Temple_Description = $request->get('Temple_Description');
                $input->Temple_StartedOn = $request->get('Temple_StartedOn');
                $input->Temple_Head = $request->get('Temple_Head');
                $input->Temple_Address = $request->get('Temple_Address');
                $input->Temple_Nearby_City = $request->get('Temple_NearbyCity');
                $input->Temple_BusRoute = $request->get('Temple_Route');

                $input->Temple_OwnedBy_Subsect = $request->get('Temple_OwnedBy_Subsect');
                $input->Temple_SharedWith_Anyone = $request->get('Temple_SharedWith_Anyone');
                $input->Temple_Location = $request->get('Temple_Location');
            
              
               /*  $input['Temple_Photo'] = time().'.'.$request->Temple_Photo->getClientOriginalExtension();
                $request->Temple_Photo->move(public_path('images/templephotos'), $input['Temple_Photo']); */
                if($request->file('Temple_Photo'))
                {
                    $Photo = $request->file('Temple_Photo');
                    $uri = '/images/templephotos/';
                    $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                    $input['Temple_Photo'] = $uri.$name;
                    $Photo->move(public_path('images/templephotos'), $name);
                }

                $input->Temple_Status =1;  
              
             
                $input->Createdby =$request->UserID;  
                $input->CreatedOn = date('Y-m-d');
               
                $input->save();
             }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    return response()->json(array('success'=>true,'msg'=>'success_msg'));
                } else {
                    DB::rollback();
                    //Log::info('TempleMasterController:update:  Exception while updating Temple details ',(array)$exception);
                    return response()->json(array('warning'=>true,'msg'=>'fail_msg'),406);
                }
            
            }
            catch(Exception $e) {
                //throw new Exception;
                DB::rollback();
                //Log::info('TempleMasterController:update:  Exception while updating Temple details ',(array)$exception);
                return response()->json(array('warning'=>true,'msg'=>'fail_msg'));
            }
       
	       

    }
    
   public function mob_community_sellers(Request $request)
   {
      $sellerID = $request->sellerID;
      $sellers = DB::table('seller')
                    ->where('Status','=',1)
                    ->get();
      if(isset($sellerID))
      {
          $seller= Seller::find($sellerID);
          return response()->json(array($seller));
      }
      else
      {
          return response()->json(array($sellers));
      }
      
   }
   
   public function mob_comm_sellerdatefilter(Request $request)
   {
       if(isset($request->mon))
        {

            switch($request->mon){
            case '0':
                     $curMonth =  date('Y-m-d', strtotime("now") );
                     break;
            case '1':
                     $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                     break;
            case '2':
                     $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                     break;
            case '3':
                     $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                     break;
            case '4':
                     $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                     break;
            case '5':
                     $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                     break;
            case '6':
                     $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                     break;
            default:
                     $curMonth= Date('Y-m-d');
            }
        }
        else
        {
           $curMonth= Date('Y-m-d');
        }

        $currentYear =  date("Y",strtotime($curMonth) );
        $currentMonth = date("m",strtotime($curMonth) );
        $currentMonthName=  date("M",strtotime($curMonth) );
        
        
        $sellers = DB::table('seller')
                        ->where('Status','=',1)
                        ->whereYear('seller.CreatedOn','=',$currentYear)
                        ->whereMonth('seller.CreatedOn','=',$currentMonth)
                        ->orderBy('Name', 'Asc')
                        ->get();
                        
        if (isset($sellers)  && count($sellers) > 0 ){
                   return response()->json(array('sellers'=>$sellers)); 
        }
        else 
        {

                    $sellers=null;
                    $Failed = 'seller_failed'.$currentMonthName. '  , ' .$currentYear;
             
                    return response()->json(array('Failed'=>$Failed));
       }                   
                           
   }
   
   /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function mob_comm_selleredit($sellerID)
    {
        $seller= Seller::find($sellerID);
        return response()->json(array('seller'=>$seller));
    }
   
   
   
   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function mob_comm_sellerupdate(Request $request)
    {
         

        try 
        {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

     

             $seller = Seller::find($request->SellerID);     
             
             $seller->Name = $request->Name;
             $seller->CompanyName = $request->get('CompanyName');
             $seller->Description = $request->get('Description');
             $seller->Location = $request->get('Location');
             
             $seller->Status =1;
             $seller->Updateby = $request->UserID;  // please repleace this with userid of session
             $seller->UpdateOn = date('Y-m-d');
            
             $seller->update();

       

            }); //end of transaction

            if(is_null($exception)) 
            {
                DB::commit();
                return response()->json(array('success'=>'updated_success'));
            
            }
            else 
            {
                DB::rollback();
                //throw new Exception;
                Log::info('SellerController:update:  Exception while updating seller ',(array)$exception);
                return response()->json(array('error'=>'updated_fail',406));
            }
    
        }
        catch(Exception $e) 
        {
            //throw new Exception;
            Log::info('SellerController:update:  Exception while updating seller ',(array)$e);
            return response()->json(array('error'=>'updated_fail',406));
        }
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function mob_comm_sellerdestroy($sellerID)
    {
         

       //we are doing soft Delete only
       $varproduct = Seller::find($sellerID);
       //echo $varproduct;
       if (isset($varproduct)){
             // $varproduct->delete(); //mark the product Status as 0 to do soft delete
             $varproduct->Status = 0;
             $varproduct->save();
             return response()->json(array('success'=>'deletion_success'));
       }
       else{
             return response()->json(array('failure'=>'deletion_fail',406));
       }

    }
    /***********************************Community Functions page API  ************* End **********************************************/
    
    /***********************************Sangam meetings Functions page API  ************* Start ************************************/
    /**
     * Display a listing of the resource.
     * sangammeetings folder name and variablename
     * @return \Illuminate\Http\Response
     */

    public function mobsangam_index(Request $request)
    {
        // in this feature both category wise listing and month wise listing of index page  are handled in same index method
        //Check for Session time out and redirect to Login page on Session time out 
        

        if(isset($request->mon)){
            switch($request->mon){
            case '1':
                     $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                     break;
            case '2':
                     $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                     break;
            case '3':
                     $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                     break;
            case '4':
                     $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                     break;
            case '5':
                     $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                     break;
            case '6':
                     $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                     break;
            default:
                     $curMonth= Date('Y-m-d');
              }
          }//if end
          else{
                    $curMonth= Date('Y-m-d');
          }

            $currentYear =  date("Y",strtotime($curMonth) );
            $currentMonth = date("m",strtotime($curMonth) );
            $currentMonthName=  date("M",strtotime($curMonth) );
            $Failed=null;
            $sangams = SangamMaster::where('Sangam_Status', '1')->orderby('sangam_master.Sangam_Name','ASC')->pluck('sangam_master.Sangam_Name','sangam_master.SangamID');
                        
                        //->where('Sangam_Status', '1');
                        //->orderby('sangam_master.Sangam_Name','ASC');
                        //->get();
            
            if (!isset($request->sangamid))
            {
                        $sangammeetings = DB::table('sangam_meetings')
                                            // Aruna- we have used left join so that whether photo is available or not Announcements will be got
                                            //for index show only photos
                                            ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                                            ->leftjoin('sangammeeting_videos', 'sangam_meetings.SangamMeetingID', '=', 'sangammeeting_videos.SangamMeetingID')
                                            ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo','sangammeeting_videos.Video')
                                            ->where('Status', '1')
                                            ->whereYear('sangam_meetings.CreatedOn','=',$currentYear)
                                            ->whereMonth('sangam_meetings.CreatedOn','=',$currentMonth)
                                            ->orderby('sangam_meetings.MeetingDate','DESC')
                                            ->get();
  
                        if ( isset($sangammeetings) && (count($sangammeetings) >0)  )
                        {
                            $Failed=null;
                        }
                        else
                        {
                                $sangammeetings = null;
                                $Failed = 'sangam_failed'.$currentMonthName. ' , '.$currentYear;
                        }
             }
             else
             {
                
                $sangammeetings = DB::table('sangam_meetings')
                                 // Aruna- we have used left join so that whether photo is available or not Announcements will be got
                                 //for index show only photos
                                ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                                ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo')
                                ->where('Status', '1')
                                ->where('sangam_meetings.SangamID',$request->sangamid)
                                ->orderby('sangam_meetings.MeetingDate','DESC')
                                ->get();
                
                        if ( isset($sangammeetings) && (count($sangammeetings) >0)  ){
                             $Failed= null;
                        }
                        else{
                            $sangammeetings =null;
                            $sangamname = DB::table('sangam_master')
                                    ->select('sangam_master.Sangam_Name')
                                    ->where('SangamID', $request->sangamid)
                                    ->orderby('sangam_master.Sangam_Name','ASC')
                                    ->first();
                            $Failed='sangam_failed'.$sangamname->Sangam_Name;
                        }
               }
 
       return response()->json(array('sangammeetings'=>$sangammeetings,'Failed'=>$Failed,'sangams'=>$sangams));
       

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function mobsangam_store(Request $request)
    {
        // try...catch
        try {
           // Transaction
            
            $exception = DB::transaction(function() use ($request) 
            {
                //checking whether the user is an sangam member
                $sangam = DB::table('sangam_member_master')
                            ->join('sangam_master','sangam_master.SangamID','=','sangam_member_master.SangamID')
                            ->select('sangam_member_master.SangamID','sangam_master.Sangam_Name')
                            ->where('sangam_member_master.UserID',$request->UserID)
                            ->first();
             
                // Storing the Meeting Details
                
                if( isset($sangam) && (count($sangam)>0)   && ($sangam->SangamID >0))
                {
                    
				           
                            $input =  new SangamMeetings;
                            $input->Title = $request->Title;
                            $input->Meeting_Content = $request->Meeting_Content;
                            $input->MeetingDate = $request->MeetingDate;
                            $input->SangamID  = $sangam->SangamID;//Aruna - storing the Sangam id in which Session user is a member- expecting user to be member of one sangam only
                            $input->Status ='1';
                            $input->Post_Status = ' 1';
                            $input->Createdby = $request->UserID;  // please repleace this with userid of session
                            $input->CreatedOn = date('Y-m-d');
                            
                            $input->save();
                            
                         
                            //Aruna: The below single line gets th ID of the saved record
                            $lastid =   $input-> SangamMeetingID;  
                            // echo 'lastid'.$lastid;
            
                            //Storing the Photos
                            if($request->file(Photo))
                            {
                                $phinput =  new SangamMeetingPhotos;
                                $phinput->SangamMeetingID = $lastid;
                                $Photo = $request->file(Photo);
                                $uri = '/images/sangammeetings/';
                                $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                                $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                                $phinput['Photo'] = $uri.$name;
                                $Photo->move(public_path('images/sangammeetings'), $name);
            
                                $phinput->Createdby = $request->UserID;  // please repleace this with userid of session
                                $phinput->CreatedOn = date('Y-m-d');
                                // we have to add the meetingid created in the above step
                                $phinput->save();
                            }
                           
                                //Storing the Vidoes
                             if ($request->Video  != null)
                            {
                                $vidinput =  new SangamMeetingVideos;
                                  // we have to add the meetingid created in the above step
                                $vidinput->SangamMeetingID = $lastid;
                                $uri = '/images/sangammeetings/video/';
                                $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                                $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                                $vidinput['Video'] = $uri.$name;
                                $request->Video->move(public_path('images/sangammeetings/video/'), $name);
            
                                $vidinput->Createdby =  $request->UserID;   
                                $vidinput->CreatedOn = date('Y-m-d');
                                $vidinput->save();
                            }
                    
                    
                }
                else
                {
                   
                     return response()->json('sangam_add_mem_error',406);
                }

                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                     //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return response()->json(array('success'=>true,'msg'=>'success_msg'));
                   
                } 
                else 
                {
                    DB::rollback();
                   // throw new Exception;
                    //Log 
                    //Log::info('SangamMeetingsController:Store:  Exception while adding meeting ',(array)$exception);
                    return response()->json('fail_msg',406);
                }
            
            }
            catch(Exception $e) {
               // throw new Exception;
                //Log 
                //Log::info('SangamMeetingsController:Store:  Exception while adding meeting ',(array)$e);
                return response()->json('fail_msg',406);
                
            }
    }

    
    
     /**
     * Display the specified resource.
     *
     * @param  \App\SangamMeetingPhotos  $sangammeeting
     * @return \Illuminate\Http\Response
     * SangamMeetingPhotos Model Name
     * variable name sangammeeting used in create,index and show pages
     */
  
    public function mobsangam_show($SangamMeetingID)
    {
        

        //this is for the Recent meetings panel in RHS
        $sangammeetings = DB::table('sangam_meetings')
                            ->join('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                            ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo')
                            ->where('Status', '1')
                            ->orderby('sangam_meetings.MeetingDate','DESC')
                            ->take(5)
                            ->get();
       
        

        if (isset ($SangamMeetingID)  ) 
        {
            //first get the Post of the given ID
            $sangammeeting = DB::table('sangam_meetings')
                            ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                            ->leftjoin('sangammeeting_videos', 'sangam_meetings.SangamMeetingID', '=', 'sangammeeting_videos.SangamMeetingID')
                            ->leftjoin('users', 'users.id', '=', 'sangam_meetings.Createdby')
                            ->leftjoin('sangam_master','sangam_master.SangamID','=','sangam_meetings.SangamID')
                            ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate',
                              'sangam_meetings.Createdby','sangam_meeting_photos.Photo','sangammeeting_videos.Video', 'users.name as name','sangam_master.Sangam_Name')
                            ->where('sangam_meetings.Status', '1')
                            ->where('sangam_meetings.SangamMeetingID',$SangamMeetingID)
                            ->first(); 
           

            if(isset($sangammeeting) )// &&  (count($sangammeeting) >0)) 
            {
                return response()->json(array('sangammeeting'=>$sangammeeting, 'sangammeetings'=>$sangammeetings));
            }
            else
            {
                $sangammeeting = null;
                $Failed = 'sangam_meeting_warning';
                return response()->json(array('sangammeeting'=>$sangammeeting, 'sangammeetings'=>$sangammeetings,'Failed'=>$Failed));
                            
            }

        }
        else
        {
            $sangammeeting = null;
            $Failed = 'sangam_meetingid_null';
            return response()->json(array('sangammeeting'=>$sangammeeting, 'sangammeetings'=>$sangammeetings,'Failed'=>$Failed));

        }

    }
   


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SangamMeetingPhotos  $sangammeeting
     * @return \Illuminate\Http\Response
     */

    public function mobsangam_edit($SangamMeetingID)
    {
        //Check for Session time out and redirect to Login page on Session time out 
       
        
       $sangammeeting = DB::table('sangam_meetings')
                            ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                            ->leftjoin('sangammeeting_videos', 'sangam_meetings.SangamMeetingID', '=', 'sangammeeting_videos.SangamMeetingID')
                            ->leftjoin('users', 'users.id', '=', 'sangam_meetings.Createdby')
                            ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate',
                              'sangam_meetings.Createdby','sangam_meeting_photos.Photo','sangammeeting_videos.Video', 'users.name as name')
                            ->where('sangam_meetings.Status', '1')
                            ->where('sangam_meetings.SangamMeetingID',$SangamMeetingID)
                            ->first(); 
       
        return response()->json(array('sangammeeting'=>$sangammeeting));
    }



   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SangamMeetingPhotos  $sangammeeting
     * @return \Illuminate\Http\Response
     */
    public function mobsangam_update(Request $request)
    {
        // try...catch
        try 
        {
            // Transaction
            $exception = DB::transaction(function() use ($request) 
            {
                $input = SangamMeetings::find($request->SangamMeetingID);

                $input->Title = $request->Title;
                $input->Meeting_Content = $request->Description;
                $input->MeetingDate = $request->MeetingDate;
                $input->save();
               

                //Storing the Photos

                if( $request->file('Photo'))
                {
                    $phinput =  SangamMeetingPhotos::where(SangamMeetingID,$request->SangamMeetingID)
                                ->first();
                                
                    $Photo = $request->file('Photo');
                    $uri = '/images/sangammeetings/';
                    $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                    $phinput['Photo'] = $uri.$name;
                    $Photo->move(public_path('images/sangammeetings'), $phinput['Photo']); 
                    $phinput->Createdby = $request->UserID;  
                    $phinput->CreatedOn = date('Y-m-d');
                     // we are not updating  the meetingid 
                    $phinput->save();
                }

                    //Storing the Vidoes
                    if ($request->Video  != null)
                    {
                        $vidinput = SangamMeetingVideos::where(SangamMeetingID,$request->SangamMeetingID)->first();
                        //print_r($vidinput);exit();
                        if($vidinput != null)
                        {
                            // we have to add the meetingid created in the above step
                            //$vidinput->SangamMeetingID = $lastid;
                            $uri = '/images/sangammeetings/video/';
                            $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                            $vidinput['Video'] = $uri.$name;
                            $request->Video->move(public_path('images/sangammeetings/video/'), $name);
        
                            $vidinput->Createdby =  $request->UserID;   
                            $vidinput->CreatedOn = date('Y-m-d');
                            $vidinput->save();
                        }
                        else
                        {
                            
                            $vidinput = new SangamMeetingVideos;
                            $vidinput->SangamMeetingID = $request->SangamMeetingID;
                            $uri = '/images/sangammeetings/video/';
                            $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                            $vidinput['Video'] = $uri.$name;
                            $request->Video->move(public_path('images/sangammeetings/video/'), $name);
                            $vidinput->Createdby =  $request->UserID;   
                            $vidinput->CreatedOn = date('Y-m-d');
                            $vidinput->save();
                        }
                          
                    }
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                   //Aruna . There is difference between calling a view and controller method
                    // To call view -> we use return view  and send objects using "compact" and variable using "with"
                    // To call a controller method we use redirect()-> route () and with to send additioanl message
                    return response()->json(array('success'=>true,'msg'=>'success_msg'));
            
            } 
            else 
            {
                DB::rollback();
                //throw new Exception;
                //Log::info('SangamMeetingsController:update:  Exception while updating meeting ',(array)$exception);
                return response()->json('fail_msg',406);
            }

        }
        catch(Exception $e) {
            //dd($e);
            //Log::info('SangamMeetingsController:update:  Exception while updating meeting ',(array)$e);
            return response()->json('fail_msg',406);
            
        }
    }
  



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SangamMeetingPhotos  $sangammeeting
     * @return \Illuminate\Http\Response
     */
    public function mobsangam_destroy($SangamMeetingID)
    {

       
        //we are doing Soft delete only
        $sangammeeting = SangamMeetings::find($SangamMeetingID);
        if (isset($sangammeeting) )
        {
                $sangammeeting->Status='0';
                $sangammeeting->save();


                return response()->json(array('success'=>true,'msg'=>'deletion_success'));
        }
        else{
                return response()->json('deletion_fail',406);
        }
    }
    
    /***********************************Sangam meetings Functions page API  ************* End **************************************/
    /***********************************Personal Functions page API  ************* Start **************************************/
    public function mobpersonalfun_index(Request $request)

    {
        // in this feature both category wise listing and month wise listing of index page  are handled in same index method

        if(isset($request->mon)){

            switch($request->mon){
            case '1':
                     $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                     break;
            case '2':
                     $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                     break;
            case '3':
                     $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                     break;
            case '4':
                     $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                     break;
            case '5':
                     $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                     break;
            case '6':
                     $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                     break;
            default:
                     $curMonth= Date('Y-m-d');
                }
            }
            else{
                        $curMonth= Date('Y-m-d');
            }

            $currentYear =  date("Y",strtotime($curMonth) );
            $currentMonth = date("m",strtotime($curMonth) );
            $currentMonthName=  date("M",strtotime($curMonth) );
            $cat = null;
            $Failed=null;
    
             if (isset($request->cat)) {
    
                $cat = $request->cat;

                $personalfunctions = DB::table('personal_functions')
                                        // we have used left join so that whether photo is available or not PersonalFunctions will be got
                                        //for index show only photos
                                        ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                        ->leftjoin('personal_function_videos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_videos.PersonalFunctionID')
                                        ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content','personal_functions.FunctionDate','personal_function_photos.Photo','personal_function_videos.Video')
                                        ->where('personal_functions.Status', '1')
                                        ->where('personal_functions.Category',$request->cat)
                                        ->orderby('personal_functions.FunctionDate','DESC')
                                        ->get();


            }
            else {
                //by month
                $personalfunctions = DB::table('personal_functions')
                                        ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                        ->leftjoin('personal_function_videos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_videos.PersonalFunctionID')
                                        ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content','personal_functions.FunctionDate','personal_function_photos.Photo','personal_function_videos.Video')
                                        ->where('personal_functions.Status', '1')
                                        ->whereYear('personal_functions.CreatedOn','=',$currentYear)
                                        ->whereMonth('personal_functions.CreatedOn','=',$currentMonth)
                                        ->orderby('personal_functions.FunctionDate','DESC')
                                        ->get();
            }
      
            if (isset($personalfunctions)  && count($personalfunctions) > 0 )
            {
                return response()->json(array('personalfunctions'=>$personalfunctions,'Failed'=>$Failed));
                         
            }
            else {
     
                 if (  isset($cat) ) 
                 {
                        $personalfunctions = null;
                        // we have to use . for concatenating Variable and + for concatenating a String constant
                        $Failed= 'personal_function_nodata'.$cat .'category';
                 }
                 else
                 {
                        $personalfunctions = null;
                        // we have to use . for concatenating Variable and + for concatenating a String constant
                        $Failed = 'personal_function_nodata'.$currentMonthName. '  , ' .$currentYear;
                 }
                return response()->json(array('personalfunctions'=>$personalfunctions,'Failed'=>$Failed));
            }
    }


   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function mobpersonalfunc_store(Request $request)
    {
        
     
          // try...catch
        try {
           // Transaction
            $exception = DB::transaction(function() use ($request) {

               
              

                // Storing the Meeting Details
				
                $input =  new PersonalFunctions;
                $input->Title = $request->get('Title');
                $input->Function_Content = $request->get('Function_Content');
                $input->FunctionDate = $request->get('FunctionDate');
                $input->UserID  =$request->UserID;
                $input->Status =1;
                $input->Post_Status = 1;
                $input->Category = $request->get('Category');
                $input->Createdby = $request->UserID;  
                $input->CreatedOn = date('Y-m-d');
                
                $input->save();
                
                //Storing the Photos
                if ($request->file('Photo'))
                {
    
                        //Aruna: The below single line gets th ID of the saved record 
                        $lastid =   $input->PersonalFunctionID;  
                       
                        //Storing the Photos
                        $input =  new PersonalFunctionPhotos;
                        // we have to add the meetingid created in the above step
                        $input->PersonalFunctionID = $lastid;

                
                       /* $Photo = $request->file('Photo');
                        $uri = '/images/personalfunctions/';
                        $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $input['Photo'] = $uri.$name;
                        $Photo->move(public_path('images/personalfunctions'), $name);
*/

                        $Photo = $request->file('Photo');
                        $uri = '/images/personalfunctions/';
                        $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $input['Photo'] = $uri.$name;
                        $Photo->move(public_path('images/personalfunctions'), $name);
                        $input->Createdby =$request->UserID;  
                        $input->CreatedOn = date('Y-m-d');
                            
                        $input->save();
                }

                       
                //Storing the Videos
                 if ($request->Video  != null)
                 {
                     $lastid =   $input->PersonalFunctionID;
                    $input =  new PersonalFunctionVideos;
                      // we have to add the meetingid created in the above step
                    $input->PersonalFunctionID = $lastid;
                    $uri = '/images/personalfunctions/video/';
                    $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                    $input['Video'] = $uri.$name;
                    $request->Video->move(public_path('images/personalfunctions/video/'), $name);
                    
                    
                    
                    //$input->Video = $request->get('Video');
                    $input->Createdby = $request->UserID;  
                    $input->CreatedOn = date('Y-m-d');
                    $input->save();
                 }

                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    
                    return response()->json(array('success'=>true,'msg'=>'personal_functions_create_success'));
                  
                } else 
                {
                    DB::rollback();
                    //throw new Exception;
                     //Log 
                    //Log::info('PersonalFunctionsController:Store:  Exception while adding function ',(array)$exception);
                    return response()->json('personal_functions_create_error',405);

                    
                }
            
            }
            catch(Exception $e) 
            {
                //throw new Exception;
                DB::rollback();
                //Log 
                //Log::info('PersonalFunctionsController:Store:  Exception while adding function ',(array)$e);
                
                return response()->json('personal_functions_create_error',406);

                
            }
   
    }

    
    
     /**
     * Display the specified resource.
     *
     * @param  \App\PersonalFunctions  $personalfunction
     * @return \Illuminate\Http\Response
     * PersonalFunctions Model Name
     * sends the PersonalFunction for the given ID
     */

    public function mobpersonalfunc_show($PersonalFunctionID)
    {
       


       /* This is  needed for the Recent functions in Right side */
        $personalfunctions = DB::table('personal_functions')
                                ->join('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content',
                                         'personal_functions.FunctionDate','personal_function_photos.Photo  as Photo' )
                                ->where('personal_functions.Status', '1')
                                ->orderby('personal_functions.FunctionDate','DESC')
                                //in show blade take(5) given
                                ->get(); 
        

        if (isset ($PersonalFunctionID)  ) {
                //first get the Post of the given ID
                $personalfunction = DB::table('personal_functions')
                                        ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                        ->leftjoin('personal_function_videos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_videos.PersonalFunctionID')
                                        ->leftjoin('users', 'users.id', '=', 'personal_functions.Createdby')
                                        ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content',
                                            'personal_functions.FunctionDate', 'personal_functions.Createdby','personal_function_photos.Photo  as Photo',
                                            'personal_function_videos.Video', 'users.name as name' )
                                        ->where('personal_functions.PersonalFunctionID',$PersonalFunctionID )
                                        ->first();  

                if(isset($personalfunction)  &&  (count($personalfunction) >0)) 
                {
                    return response()->json(array('personalfunction'=>$personalfunction, 'personalfunctions'=>$personalfunctions));
                }
                else
                {
                    $personalfunction = null;
                    $Failed = 'personal_functions_missingfunc';
                    return response()->json(array('personalfunction'=>$personalfunction, 'personalfunctions'=>$personalfunctions,'Failed'=>$Failed));
                                 
                }

        }
        else
        {
            $personalfunction = null;
            $Failed = 'personal_functions_missingfunc';
            
            return response()->json(array('personalfunction'=>$personalfunction, 'personalfunctions'=>$personalfunctions,'Failed'=>$Failed));
             
        }

        
    }



   
    //added by Aruna
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalFunction  $product
     * @return \Illuminate\Http\Response
     */
    public function mobpersonalfunc_edit($PersonalFunctionID)
    {
        

        //Aruna added - Since PersonalFunctions can have photos and videos we are doing left join
        // so that even if vidoes and photos are not there too, PersonalFunctions must be provided
        $personalFunction = DB::table('personal_functions')
                                        ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                        ->leftjoin('personal_function_videos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_videos.PersonalFunctionID')
                                        ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content','personal_functions.Category','personal_functions.FunctionDate', 'personal_functions.Createdby','personal_function_photos.PersonalFunction_PhotosID', 'personal_function_photos.Photo','personal_function_videos.Video' )
                                        ->where('personal_functions.PersonalFunctionID',$PersonalFunctionID )
                                        ->first(); 
  
         return response()->json(array('personalFunction'=>$personalFunction));
    }

    


    //added by Aruna
     /**
     * update the specified resource.
     *
     * @param  \App\PersonalFunction  $product
     * @return \Illuminate\Http\Response
     */
    public function mobpersonalfunc_update(Request $request)
    {

        // try...catch
        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) 
             {
                $input = PersonalFunctions::find($request->PersonalFunctionID);
                if(isset($input))
                {
                    $input->Title = $request->Title;
                    $input->Function_Content = $request->Description;
                    $input->FunctionDate = $request->FunctionDate;
                    $input->Status =1;
                    $input->Post_Status = 1;
                    $input->Category = $request->Category;
                    $input->save();
                
                }
                else
                {
                   return response()->json('personal_functions_missingfunc',406);
                }
                
                
            
                //Storing the Photos
                if( $request->file('Photo'))
                {
                    $phinput =  PersonalFunctionPhotos::where(PersonalFunctionID,$request->PersonalFunctionID)
                                     ->first();
                
                    
                    //Aruna - most important-   save() method can be applied on a variable which is pointing to Model objects only
                    //  Initially we have written raw query using DB::table.  That time Photo->save was not working
                    // After changing to Eloquent syntax of representing model photo save is working
                    if (isset($phinput))
                    {

                        $Photo = $request->file('Photo');
                        $uri = '/images/personalfunctions/';
                        $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $phinput['Photo'] = $uri.$name;
                        $Photo->move(public_path('images/personalfunctions'), $name);


                        $phinput->Createdby = $request->UserID;  
                        $phinput->CreatedOn = date('Y-m-d');
                            
                        // we have to add the meetingid created in the above step
                        $phinput->save();
                    }
                    else
                    {
                        $phinputnew = new PersonalFunctionPhotos;
                        $phinputnew->PersonalFunctionID = $request->PersonalFunctionID;
                        $Photo = $request->file('Photo');
                        $uri = '/images/personalfunctions/';
                        $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                        $phinputnew['Photo'] = $uri.$name;
                        $Photo->move(public_path('images/personalfunctions'), $name);


                        $phinputnew->Createdby = $request->UserID;  
                        $phinputnew->CreatedOn = date('Y-m-d');
                            
                        // we have to add the meetingid created in the above step
                        $phinputnew->save();
                    }
                    
                }

                //Storing the Videos
                 if ($request->Video  != null)
                 {
                    $videoinput =  PersonalFunctionVideos::where(PersonalFunctionID,$request->PersonalFunctionID)
                                     ->first();
                    if(isset($videoinput))
                    {
                        //$input->PersonalFunctionID = $lastid;
                        $uri = '/images/personalfunctions/video/';
                        $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                        $videoinput['Video'] = $uri.$name;
                        $request->Video->move(public_path('images/personalfunctions/video/'), $name);
                        //$input->Video = $request->get('Video');
                        $videoinput->Createdby = $request->UserID;  
                        $videoinput->CreatedOn = date('Y-m-d');
                        $videoinput->save();
                    }
                    else
                    {
                        $input =  new PersonalFunctionVideos;
                        $input->PersonalFunctionID = $request->PersonalFunctionID;
                        $uri = '/images/personalfunctions/video/';
                        $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                        $input['Video'] = $uri.$name;
                        $request->Video->move(public_path('images/personalfunctions/video/'), $name);
                        //$input->Video = $request->get('Video');
                        $input->Createdby = $request->UserID;  
                        $input->CreatedOn = date('Y-m-d');
                        $input->save();
                    }
                    
                      // we have to add the meetingid created in the above step
                   
                 }
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return response()->json(array('success'=>true,'msg'=>'personal_functions_update_success'));
               
            } else {
                DB::rollback();
                //throw new Exception;
                //Log::info('PersonalFunctionsController:update:  Exception while updating personal functions ',(array)$exception);
                return response()->json('personal_functions_update_error',406);
                
            }
        
        }
        catch(Exception $e) {
            // throw new Exception;
            DB::rollback();
           /* dd($e);*/
            //Log::info('PersonalFunctionsController:update:  Exception while updating personal functions ',(array)$e);
            return response()->json('personal_functions_update_error',406);
            
        }
   }




    //added by Aruna
     /**
     * Delete the specified resource.
     *
     * @param  \App\PersonalFunctions\  $personalfuncton
     * @return \Illuminate\Http\Response
     */
    public function mobpersonalfunc_destroy($PersonalFunctionID)
    {
       
      
       $personalfunction= PersonalFunctions::find($PersonalFunctionID);
        if (isset($personalfunction) )
        {
                $personalfunction->Status='0';
                $personalfunction->save();


                return response()->json(array('success'=>true,'msg'=>'personal_functions_delphoto_success'));
        }
        else{
                return response()->json('personal_functions_missingfunc',406);
        }
       
        
   }
    /***********************************Personal Functions page API  ************* End **************************************/
    /***********************************Ask Help page API  ************* start **********************************************/
     /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function helppost_index(Request $request)
    {

        // this index method was written at the intiial stage and hence Monthwise listing and category wise listing of Index page is handled 
        //seperately. Index method handles only Month wise listing and getCat method handles category wise listing and fills the content and
        //redirects to the index page

        //In other controllers , all index page listings are handled only in Index method of controller

         
         //check for requested Period
         switch($request->mon){
            case '1':
                     $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                     break;
            case '2':
                     $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                     break;
            case '3':
                     $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                     break;
            case '4':
                     $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                     break;
            case '5':
                     $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                     break;
            case '6':
                     $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                     break;
            default:
                     $curMonth= Date('Y-m-d');
            }
        
        $currentYear =  date("Y",strtotime($curMonth) );
        $currentMonth = date("m",strtotime($curMonth) );
        $currentMonthName=  date("M",strtotime($curMonth) );

        $helpposts = DB::table('help_post')
                        ->leftjoin('users','users.id', '=', 'help_post.user_id')
                        ->select('help_post.HelpID','help_post.Description','help_post.Type','help_post.Photo as Photo', 'help_post.user_id', 'users.name','users.User_Photo as User_Photo','help_post.CreatedOn')
                        ->where('Status', '1')
                        ->whereYear('help_post.updated_at','=',$currentYear)
                        ->whereMonth('help_post.updated_at','=',$currentMonth)
                        ->orderby('help_post.CreatedOn','DESC')
                        ->get();

        $helppostsCat = null;
        $catName= null;
       
        if (isset($helpposts) && (count($helpposts)>0)){
            
             return response()->json(array('helpposts'=>$helpposts,'currentMonthName'=>$currentMonthName,'currentYear'=>$currentYear));
             
        }
        else
        {
            
            $Failed = 'help_post_unavailable';
            return response()->json(array('helpposts'=>$helpposts,'currentMonthName'=>$currentMonthName,'currentYear'=>$currentYear,'Failed'=>$Failed));
           
        }
    }
    
    /**
     * Store a resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function helppost_store(Request $request)
    {

        // try...catch
        try {
           // Transaction
            $exception = DB::transaction(function() use ($request) {

              
              

                // Storing the helppost Details
				
                $input =  new HelpPost;
                $input->Type = $request->get('HType');
                $input->Description = $request->get('Description');
                $input->Status =1;
                $input->NumReplies = 0;
                $input->ClosedOn = Date('Y-m-d');
                $input->user_id = $request->UserID;
                
                /*
                $input['Photo'] = time().'.'.$request->Photo->getClientOriginalExtension();
                $request->Photo->move(public_path('images/helppost'), $input['Photo']);*/
                if($request->file('Photo'))
                {
                    $Photo = $request->file('Photo');
                    $uri = '/images/helppost/';
                    $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                    $input['Photo'] = $uri.$name;
                    $Photo->move(public_path('images/helppost'), $name);
                }
               
                
                $input->CreatedBy = $request->UserID; 
                $input->CreatedOn = date('Y-m-d');
       
                $input->save();
                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return response()->json(array('success'=>true,'msg'=>'help_post_success'));
                   
                } 
                else {
                    DB::rollback();
                    // throw new Exception;
                    //Log 
                    Log::info('HelpPostController:Store:  Exception while adding Post ',(array)$exception);
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return response()->json('help_post_error',406);
                }
            
            }
            catch(Exception $e) {
                throw new Exception;
                //Log 
                Log::info('HelpPostController:Store:  Exception while adding Post ',(array)$e);
                return response()->json('help_post_error',406);
            }
            
    }
   

    /**
     * Display all resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function helppost_show($HelpID)
    {

        

        //get all the posts to be shown in RHS as recent Posts
        $helpposts = DB::table('help_post')
                            ->leftjoin('users','users.id', '=', 'help_post.user_id')
                            ->select('help_post.HelpID','help_post.Description','help_post.Type','help_post.Photo as Photo', 'help_post.user_id', 'users.name','users.User_Photo as User_Photo')
                            ->where('Status', '1')
                            ->orderby('help_post.CreatedOn','DESC')
                            ->take(5)
                            ->get();

        if (isset ($HelpID)  ) {
            //first get the Post of the given ID

             //get the Post for the given ID
             $helppost = DB::table('help_post')
                        ->leftjoin('users','users.id', '=', 'help_post.user_id')
                        ->select('help_post.HelpID','help_post.Description','help_post.Type','help_post.created_at','help_post.Photo as Photo', 'help_post.user_id', 'users.name','users.User_Photo as User_Photo')
                        ->where('Status', '1')
                        ->where('help_post.HelpID',$HelpID)
                        ->first();
    
            if(isset($helppost)  &&  (count($helppost) >0)) 
            {
                //then find comments of the given post
                $comments = DB::table('help_comments')
                            ->join('users','users.id','=','help_comments.user_id')
                            ->select('help_comments.HelpCommentsID','help_comments.Description','help_comments.created_at','users.name as name','users.User_Photo as photo','users.id as userid')
                            ->where('parent_id', $HelpID)
                            //->where('Status','1')
                            ->get();

                //if comments are there , then send it
                if(isset($comments)  &&  (count($comments) >0)   )
                {
                    return response()->json(array('helppost'=>$helppost,'comments'=>$comments, 'helpposts'=>$helpposts));
                }
                else
                {
                    $comments = [];
                    return response()->json(array('helppost'=>$helppost,'comments'=>$comments, 'helpposts'=>$helpposts));
                }
            
            }
            else
            {
                $Failed = 'help_post_missing';
               
                return response()->json(array('helpposts'=>$helpposts,'Failed'=>$Failed));
                      
            }
        }
        else{
                    
                    $Failed = 'help_post_missing';
                    return response()->json(array('helpposts'=>$helpposts,'Failed'=>$Failed));
                    
            }
        
  }


    /**
     * to redirect to Edit view.
     * 
     * @return \Illuminate\Http\Response
     */
    public function helppost_edit($HelpID) 
    {

        if (isset($HelpID))
        {
            $helppost = HelpPost::find($HelpID);
            If (isset($helppost))
            {
                return response()->json(array('helppost'=>$helppost));
            }
            else
            {
                return response()->json('help_post_missing',406);

            }

        }
        else
        {
            return response()->json('help_post_missing',406);
            
        }
     }


    /**
     * Updates a resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function helppost_update(Request $request)
    {



         // try...catch
         try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

                $helppost = HelpPost::findOrFail($request->HelpID);
                $helppost->Description = $request->get('Description');
                $helppost->Status =1;
                
                $helppost->user_id = $request->UserID;
                
                /*
                $input['Photo'] = time().'.'.$request->Photo->getClientOriginalExtension();
                $request->Photo->move(public_path('images/helppost'), $input['Photo']);*/
                if($request->file('Photo'))
                {
                    $Photo = $request->file('Photo');
                    $uri = '/images/helppost/';
                    $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                    $helppost['Photo'] = $uri.$name;
                    $Photo->move(public_path('images/helppost'), $name);
                }
                
                $helppost->Updateby = $request->UserID; 
                $helppost->UpdateOn = date('Y-m-d');
       
                $helppost->update();

            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return response()->json(array('success'=>true,'msg'=>'help_post_updatesuccess'));
               
            } else {
                DB::rollback();
                //throw new Exception;
                //Log 
                Log::info('HelpPostController:Update:  Exception while updating Post ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return response()->json('help_post_error',406);
            }
        
        }
        catch(Exception $e) {
            throw new Exception;
            //Log 
            Log::info('HelpPostController:Store:  Exception while adding Post ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return response()->json('help_post_error',406);
        }
  
        
    }



   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $HelpID
     * @return \Illuminate\Http\Response
     */
    public function helppost_destroy($HelpID)
    {
        
        $helpost = HelpPost::find($HelpID);
        if (isset($helpost) )
        {
            
                  DB::table('help_post')->where('HelpID','=',$HelpID)->update(['Status'=>0]);


                return response()->json(array('success'=>true,'msg'=>'help_post_deletesuccess'));
        }
        else{
                return response()->json('help_post_deleteerror',406);
        }
        
    }


     /**
     * Get Index page based on Help Category.
     *
     * @param  int  $cat
     * @return \Illuminate\Http\Response
     */
    public function helppost_getCat($cat)
    {
       
         
         $helpposts = null;
         $catName=null;

        if( isset($cat) ){
                //check for requested Period
                switch($cat){
                    case 'Health':
                            $catName="Health";
                            break;
                    case 'Finance':
                            $catName="Finance";
                            break;
                    case 'Job':
                            $catName="Job";
                            break;
                    case 'Education':
                            $catName="Education";
                            break;
                    default:
                            $catName="Others";
                    }
                $helppostsCat = DB::table('help_post')
                                ->leftjoin('users','users.id', '=', 'help_post.user_id')
                                ->select('help_post.HelpID','help_post.Description','help_post.Type','help_post.Photo as Photo', 'help_post.user_id', 'users.name','users.User_Photo as User_Photo')
                                ->where('Status', '1')
                                ->where('Type',$catName)
                                ->orderby('help_post.CreatedOn','DESC')
                                ->get();

 
                if (isset($helppostsCat))
                {
                    return response()->json(array('helpposts'=>$helppostsCat,'catName'=>$catName));
                
                }
                else
                {
                    $Failed = 'help_post_unavailable';
                    return response()->json(array('helpposts'=>$helppostsCat,'catName'=>$catName,'Failed'=>$Failed));
               
                }
        }
        else
        {
            $Failed = 'help_post_unavailable';
            return response()->json(array('helpposts'=>$helppostsCat,'catName'=>$catName,'Failed'=>$Failed));
        }
      
    }

    /***********************************Ask Help page API  *******************************  End  ************************************************/

    /***********************************Seller Add and Razorpay details API  ************* Start ************************************************/
    
    /**
      * Show the form for creating a new resource.
      * @return \Illuminate\Http\Response
    */
    public function getrazorpay_user_details(Request $request)
    {
          $razorPayKey = env("RAZOR_PAY_KEY"); 
          $razorSecretkey = env("RAZOR_PAY_SECRET"); 
          $user = User::where("id","=",$request->UserID)->select('name','email','User_Phone')->first();
          return response()->json(array('razorPayKey'=>$razorPayKey,'razorSecretkey'=>$razorSecretkey,'user'=>$user));
    }
    
    
    public function mobseller_store(Request $request)
    {
        $paymentId = $request->paymentId;
       	$curl = curl_init();
    	$url = env('RAZORPAY_URL')."/payments/".$paymentId;
     	curl_setopt_array($curl, array(
    	  CURLOPT_URL => $url,
    	  CURLOPT_RETURNTRANSFER => true,
    	  CURLOPT_ENCODING => "",
    	  CURLOPT_MAXREDIRS => 10,
    	  CURLOPT_TIMEOUT => 0,
    	  CURLOPT_FOLLOWLOCATION => true,
    	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	  CURLOPT_CUSTOMREQUEST => "GET",
    	  CURLOPT_HTTPHEADER => array(
    		"Authorization: Basic ".env("RAZORPAY_KEY_COMBINATION")
    	  ),
    	));
    	$response = curl_exec($curl);
    	
    	$resp = json_decode($response);
    	
        if( isset($resp) && (isset($resp->error )))
        {
             return response()->json($resp->error->description, 201);
        }
    
        $resStr= $resp->status;
    
    
        $amount = $resp->amount;
           
           
       //usha - second step for capturing the payment in razorpay dashbaord  
       $curl1 = curl_init();
       
       $url1 = env('RAZORPAY_URL')."/payments/".$paymentId."/capture";
       
        curl_setopt_array($curl1, array(
           
           CURLOPT_URL => $url1,
           
           CURLOPT_RETURNTRANSFER => true,
           
           CURLOPT_ENCODING => "",
           
           CURLOPT_MAXREDIRS => 10,
           
           CURLOPT_TIMEOUT => 0,
           
           CURLOPT_FOLLOWLOCATION => true,
           
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           
           CURLOPT_CUSTOMREQUEST => "POST",
           
           CURLOPT_POSTFIELDS =>'{"amount":"'.$amount.'"}',
           
           CURLOPT_HTTPHEADER => array(
           
           "Authorization: Basic ".env("RAZORPAY_KEY_COMBINATION"),
           
           "Content-Type: application/json"
           
           ),
           
           ));
           $response1 = curl_exec($curl1);
           curl_close($curl1);

        try 
        {
            
            // Transaction
             $exception = DB::transaction(function() use ($request,$resp) 
             {
                $paymentobj      = [];
                $paymentObj = (object)($resp);
                $sellerobj        = (object) ($request->seller);
                
                
                
                // Storing the Seller Details
                                
                $input =  new Seller;
              
                $input->Name = $sellerobj->Name;
                $input->CompanyName = $sellerobj->CompanyName;
                $input->Description = $sellerobj->Description;
                $input->Location = $sellerobj->Location;
                $input->seller_Mobile = $sellerobj->Phone;
                $input->SellerMembershipExpiryDate = date('Y-m-d', strtotime(' + 1 year'));
                $input->UserID =$request->UserID;
                
                $input->Status =1;
                $input->Createdby = $request->UserID;  
                $input->CreatedOn = date('Y-m-d');
                
                $input->save();

                DB::table('users')
                            ->where('id','=',$request->UserID)
                            ->update(['IsSeller' => 1,'SellerMembershipExpiryDate'=>date('Y-m-d', strtotime(' + 1 year'))]);
                
                
                $sellerid = $input->SellerID;
                
               
                //seller payment table
                $payment = new SellerPaymentTransaction ;
          
                $payment->PaymentSellerID = $sellerid;
                $payment->PaymentFinalAmount = '1';
                $payment->PaymentVendorName = "razorpay";// change it later dynamically
                $payment->PaymentVendorTransactionID = $paymentObj->id;
                $payment->PaymentVendorTransactionStatus = $paymentObj->status;   //success orfailure
                $payment->PaymentType = "payment"; //
                $payment->PaymentUserID = $request->UserID;   // $request->get('UserID');
                $payment->PaymentDate = Date('Y-m-d');
                $payment->PaymentMethod = $paymentObj->method;  //netbanking /card/googlepay
              
                $payment->save();
                
               
                 
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return response()->json(array("success"=>true,"msg"=>"seller_create"));

            
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('MobileController:mobseller_store:  Exception while adding seller ',(array)$exception);
                return response()->json('fail_msg',406);
            }
        
        }
        catch(Exception $e) {
             //throw new Exception;
             Log::info('MobileController:mobseller_store:  Exception while adding seller ',(array)$e);
             return response()->json('fail_msg',406);

        }
    }
     
    
    
    /***********************************Seller Add and Razorpay details API  ************* END ************************************************/
/**
     * Display a listing of the resource.
     * elders folder name and variablename
     * @return \Illuminate\Http\Response
     */
    public function elders_index(Request $request)
    {

       if(isset($request->mon)){

            switch($request->mon){
            case '1':
                     $curMonth =  date('Y-m-d', strtotime( '-1  months') );
                     break;
            case '2':
                     $curMonth =  date('Y-m-d', strtotime( '-2  months') );
                     break;
            case '3':
                     $curMonth =  date('Y-m-d', strtotime( '-3  months') );
                     break;
            case '4':
                     $curMonth =  date('Y-m-d', strtotime( '-4  months') );
                     break;
            case '5':
                     $curMonth =  date('Y-m-d', strtotime( '-5  months') );
                     break;
            case '6':
                     $curMonth =  date('Y-m-d', strtotime( '-6  months') );
                     break;
            default:
                     $curMonth= Date('Y-m-d');
            }
        }
        else{
                     $curMonth= Date('Y-m-d');
        }

        $currentYear =  date("Y",strtotime($curMonth) );
        $currentMonth = date("m",strtotime($curMonth) );
        $currentMonthName=  date("M",strtotime($curMonth) );

        // If user is already an Elder then show the FAQ posts of him and other people
        if ($request->IsElder ==1)
        {
            
           
            //sometimes this Auth::user()->isElder check is not working in view and hence using this flag
            $flag=1;

            //FAQ raised by others
            $Othersfaqs= DB::table('faq_posts')
                    ->join('users','users.id','=','faq_posts.FAQ_UserID')
                    ->select('faq_posts.FAQ_PostID','faq_posts.FAQ_Title','faq_posts.FAQ_Body','faq_posts.FAQ_Photo', 'faq_posts.FAQ_CreatedDate','faq_posts.FAQ_UserID','users.name', 'users.User_photo','users.User_City')
                    ->where('faq_posts.FAQ_IsActive', '=', '1')
                    // note this-   not created by user condition being checked
                    ->where('faq_posts.FAQ_UserID','!=',$request->UserID)

                    ->whereYear('faq_posts.updated_at','=',$currentYear)
                    ->whereMonth('faq_posts.updated_at','=',$currentMonth)
                    ->orderby('faq_posts.FAQ_CreatedDate','DESC')
                    ->get();

            //FAQ raised by him
            $Hisfaqs= DB::table('faq_posts')
                    ->join('users','users.id','=','faq_posts.FAQ_UserID')
                    ->select('faq_posts.FAQ_PostID','faq_posts.FAQ_Title','faq_posts.FAQ_Body', 'faq_posts.FAQ_Photo','faq_posts.FAQ_CreatedDate','faq_posts.FAQ_UserID','users.name', 'users.User_photo','users.User_City')
                    ->where('faq_posts.FAQ_IsActive', '=', '1')
                    ->where('faq_posts.FAQ_UserID',$request->UserID)
                    ->whereYear('faq_posts.updated_at','=',$currentYear)
                    ->whereMonth('faq_posts.updated_at','=',$currentMonth)
                    ->orderby('faq_posts.FAQ_CreatedDate','DESC')
                    ->get();

            //List of Elders
            $elders = DB::table('elder_details')
                        ->join('users', 'elder_details.UserID', '=', 'users.id')
                        ->select('elder_details.UserID as UserID','users.name as name','users.User_photo as User_Photo','users.User_City','elder_details.Num_Queries_Answered')
                        ->where('elder_details.Status', '=', '1')
                        ->orderby('users.name','ASC')
                        ->get();
                        
            return response()->json(array('elders'=>$elders,'Hisfaqs'=>$Hisfaqs,'Othersfaqs'=>$Othersfaqs,'flag'=>$flag,'currentMonthName'=>$currentMonthName,'currentYear'=>$currentYear));   
            
        }
        //if User is not an Elder
        else
        {
            $flag=0;
            $Othersfaqs = null;
            //List of Elders
            $elders = DB::table('elder_details')
                        ->join('users', 'elder_details.UserID', '=', 'users.id')
                        ->select('elder_details.UserID as UserID','users.name as name','users.User_photo','users.User_City','elder_details.Num_Queries_Answered')
                        ->where('elder_details.Status', '=', '1')
                        ->orderby('users.name','ASC')
                        ->get();

            //FAQ raised by him
            $Hisfaqs= DB::table('faq_posts')
                    ->join('users','users.id','=','faq_posts.FAQ_UserID')
                    ->select('faq_posts.FAQ_PostID','faq_posts.FAQ_Title','faq_posts.FAQ_Body', 'faq_posts.FAQ_Photo', 'faq_posts.FAQ_CreatedDate','faq_posts.FAQ_UserID','users.name', 'users.User_photo','users.User_City')
                    ->where('faq_posts.FAQ_IsActive', '=', '1')
                    ->where('faq_posts.FAQ_UserID',$request->UserID)
                    ->whereYear('faq_posts.updated_at','=',$currentYear)
                    ->whereMonth('faq_posts.updated_at','=',$currentMonth)
                    ->orderby('faq_posts.FAQ_CreatedDate','DESC')
                    ->get();
            
            return response()->json(array('elders'=>$elders,'Hisfaqs'=>$Hisfaqs,'Othersfaqs'=>$Othersfaqs,'flag'=>$flag,'currentMonthName'=>$currentMonthName,'currentYear'=>$currentYear));   
                  
            
       }
    
    }


    


   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function elderstore(Request $request)
    {

       // try...catch
        try {
           // Transaction
            $exception = DB::transaction(function() use ($request) {

                

               // Storing the elder Details

                $faqcomment = new Post;
                $faqcomment->FAQ_Title= $request->Title;
                $faqcomment->FAQ_Body = $request->Description;
                $faqcomment->FAQ_UserID= $request->UserID;
                $faqcomment->FAQ_CreatedDate= date('Y-m-d');
                $faqcomment->updated_at= date('Y-m-d');
                $faqcomment->FAQ_IsActive=1;
                if($request->file('Photo') )
                {
                    $Photo = $request->file('Photo');
                    $uri = '/images/faqpost/';
                    $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                    $faqcomment['FAQ_Photo'] = $uri.$name;
                    $Photo->move(public_path('images/faqpost'), $name);
                }

                $faqcomment->save();
               
                
              }); //end of transaction
              if(is_null($exception)) {
                    DB::commit();
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return response()->json(array('success'=>true,'msg'=>'faq_create_success'));
                  
              } else {
                    DB::rollback();
                    //throw new Exception;
                    Log::info('ElderDetailsController:Store:  Exception while adding FAQ ',(array)$exception);
                     //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return response()->json('faq_create_error',406);
                }
            
            }
            catch(Exception $e) {
                //throw new Exception;
                DB::rollback();
                Log::info('ElderDetailsController:Store:  Exception while adding FAQ ',(array)$e);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
               return response()->json('faq_create_error',406);
            }


    }
    
    public function eldercomment_store(Request $request)
    {
      
        if (isset($request->post_id) ){
            
                $faqcomment = new Comment;
                $faqcomment->Comment_Body = $request->comment_body;
                $faqcomment->user_id= $request->UserID;
                $faqcomment->parent_id=$request->post_id;
                $faqcomment->Status=1;
                $faqcomment->created_at= Date('Y-m-d');
                $faqcomment->save();

                $faq = Post::find($request->post_id);
                if (isset($faq))
                {
                        $faq->updated_at = Date('Y-m-d');
                        $faq->save();
                }
                // After a comment is added , it returns to the same Individual FAQ page to display the comment
                return response()->json("success");
        }
        else
        {
            return response()->json("faq_error_empty",406);
        } 
   
    }

   /**
     * Show  resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function eldersshow($FAQ_PostID)
    {

       

        //for the RHS panel
        $allfaq =DB::table('faq_posts')
                            ->leftjoin('users','users.id','=','faq_posts.FAQ_UserID')
                            ->select('faq_posts.FAQ_PostID','faq_posts.FAQ_IsActive', 'faq_posts.FAQ_Photo','faq_posts.FAQ_Title','faq_posts.FAQ_Body','faq_posts.FAQ_CreatedDate','users.name as name','users.User_Photo as User_Photo','users.id as ID')
                            ->where('faq_posts.FAQ_IsActive','1')
                            ->take(5)
                            ->get();

        if (isset ($FAQ_PostID)  ) {
                //first get the Post of the given ID
                $faqs = DB::table('faq_posts')
                                ->leftjoin('users','users.id','=','faq_posts.FAQ_UserID')
                                ->select('faq_posts.FAQ_PostID','faq_posts.FAQ_IsActive','faq_posts.FAQ_Title','faq_posts.FAQ_Body','faq_posts.FAQ_Photo','faq_posts.FAQ_CreatedDate','users.name as name','users.User_Photo as User_Photo','users.id as ID')
                                ->where('faq_posts.FAQ_IsActive','1')
                                ->where('faq_posts.FAQ_PostID', $FAQ_PostID)
                                ->first();

                if(isset($faqs)   &&  (count($faqs) >0)) 
                {
                    //then find comments of the given post
                    $comments = DB::table('comments')
                                ->join('users','users.id','=','comments.user_id')
                                ->select('comments.id','Comment_Body','comments.created_at','users.name','users.User_Photo','users.id')
                                ->where('parent_id', $FAQ_PostID)
                                ->where('Status','1')
                                ->get();

                    //if comments are there , then send it
                    if(isset($comments)  &&  (count($comments) >0))
                    {
                        return response()->json(array('faqs'=>$faqs,'comments'=>$comments,'allfaq'=>$allfaq));
                    }
                    else{
                        $comments = null;
                        return response()->json(array('faqs'=>$faqs,'comments'=>$comments,'allfaq'=>$allfaq));
                    }
                
                }
                else
                {
                    $faq = null;
                    $comments = null;
                    $Failed = 'faq_error_missingid';
                    return response()->json(array('faqs'=>$faqs,'comments'=>$comments,'allfaq'=>$allfaq,'Failed'=>$Failed));
                    
                }
        }
       else{
                $faq = null;
                $comments = null;
                $Failed = 'faq_error_empty';
                    return response()->json(array('faqs'=>$faqs,'comments'=>$comments,'allfaq'=>$allfaq,'Failed'=>$Failed));
                    
              
       }

    }
   




    public function Elder_IVolunteer(Request $request)
    {
        // try...catch
        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

                //validation is not needed here as we are taking session user id
 
                 // Storing the elder Details

                 $input =  new ElderDetails;
                 $input->UserID  = $request->UserID;
                 $input->Status =1;
                 $input->CreatedOn = date('Y-m-d');
                 $input->Createdby = $request->UserID;  
                 $input->Num_Queries_Answered =0;
                 //print_r($input);exit();
                 $input->save();

                 $eldrid = $input->ElderID ;

                 DB::table('users')->where('id','=',$request->UserID)->update(['IsElder'=>1]);

                 //$request->UserID->update(['IsElder' => 1,]);
                 
 
               }); //end of transaction
               if(is_null($exception)) {
                     DB::commit();
                     return response()->json(array('success'=>true,'msg'=>'elder_reg_success'));
                 } else {
                     DB::rollback();
                     //throw new Exception;
                     Log::info('ElderDetailsController:IVolunteer:  Exception while adding Elder ',(array)$exception);
                     return response()->json('elder_reg_error',406);
                 }
             }
             catch(Exception $e) {
                 //throw new Exception;
                 Log::info('ElderDetailsController:IVolunteer:  Exception while adding Elder ',(array)$e);
                 return response()->json('elder_reg_error',406);

            }

    }
    
    //after login 
    /** * Show the application dashboard. * * @return \Illuminate\Http\Response */
    public function mobcontactUSPost(Request $request) 
    {

        
       
 
        $contact = new ContactUS;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        
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
   
        return response()->json(array('success'=>true,"msg"=>"success_contact")); 
    }


    
    public function commentstore(Request $request)
    {
       
         //Check for Session time out and redirect to Login page on Session time out 
       
        if (isset($request->post_id) ){
              $comment = new HelpComment;
              $comment->Description = $request->comment_body;
              $comment->user_id= $request->UserID;
              $comment->parent_id=$request->post_id;
              $comment->created_at= Date('Y-m-d');
             
              $comment->save();

              $post = HelpPost::find($request->post_id);
              
              if (isset($post) )
              {
                     $post->updated_at = Date('Y-m-d');
                     $post->save();
              }
              
              // After a comment is added , it returns to the same Individual FAQ page to display the comment
              return response()->json(array('success'=>'success_msg'));
    
        }
        else
        {
            return response()->json("postid_error",406);
        } 
    }
        
    /*****************************************************************************************************************************************/
    /***********************************************************Matrimony api starts ***********************************************************/
    /*****************************************************************************************************************************************/
    /**
     * After payment we set membership and membership expiry
     * in 2 tables User and Matrimony_registration table
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mob_setMatrimonyExpiry(Request $request)
    {
        
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
        //get payment details
        
        $paymentId = $request->paymentId;
    	
       	$curl = curl_init();
    	$url = env('RAZORPAY_URL')."/payments/".$paymentId;
     	curl_setopt_array($curl, array(
    	  CURLOPT_URL => $url,
    	  CURLOPT_RETURNTRANSFER => true,
    	  CURLOPT_ENCODING => "",
    	  CURLOPT_MAXREDIRS => 10,
    	  CURLOPT_TIMEOUT => 0,
    	  CURLOPT_FOLLOWLOCATION => true,
    	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	  CURLOPT_CUSTOMREQUEST => "GET",
    	  CURLOPT_HTTPHEADER => array(
    		"Authorization: Basic ".env("RAZORPAY_KEY_COMBINATION")
    	  ),
    	));
    	$response = curl_exec($curl);
    	
    	$resp = json_decode($response);
        if( isset($resp) && (isset($resp->error )))
        {
             return response()->json($resp->error->description, 406);
        }
    
          $resStr= $resp->status;
    
    
           $amount = $resp->amount;
           
           
           //usha - second step for capturing the payment in razorpay dashbaord  
           $curl1 = curl_init();
           
           $url1 = env('RAZORPAY_URL')."/payments/".$paymentId."/capture";
           
           curl_setopt_array($curl1, array(
               
               CURLOPT_URL => $url1,
               
               CURLOPT_RETURNTRANSFER => true,
               
               CURLOPT_ENCODING => "",
               
               CURLOPT_MAXREDIRS => 10,
               
               CURLOPT_TIMEOUT => 0,
               
               CURLOPT_FOLLOWLOCATION => true,
               
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               
               CURLOPT_CUSTOMREQUEST => "POST",
               
               CURLOPT_POSTFIELDS =>'{"amount":"'.$amount.'"}',
               
               CURLOPT_HTTPHEADER => array(
               
               "Authorization: Basic ".env("RAZORPAY_KEY_COMBINATION"),
               
               "Content-Type: application/json"
               
               ),
               
               ));
               $response1 = curl_exec($curl1);
               $resp1 = json_decode($response1);
               curl_close($curl1);
    
    
            curl_close($curl);		
         

        //active profile
        $profileuser = Matrimony::where('Createdby', $request->UserID)
                        ->where('Status','1')
                        //first helps you get only one row and avoid a list as a result
                        ->first();
     
        try {
            // Transaction
                $exception = DB::transaction(function() use ($request,$resp) {

                //echo" in SetMatrimony Expiry - within try";
                $paymentObj      = [];
                $paymentobj = (object)($resp);
                $flags = (object) ($request->flag); 
              
              
               $user = User::find($request->UserID);
                //monthly plan
               if ($flags->flag == "month")
                {
                    

                    $user->update([
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
                    $user->update([
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
                   
                    $user->update([
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
      
                $payment->UserID = $request->UserID;
                $payment->Vendor_PaymentID = $paymentobj->id;
                $payment->TransactionDate = Date('Y-m-d');
               
                $payment->TransactionAmount =$paymentobj->amount;
                $payment->TransactionType = "razorpay";// change it later dynamically
                $payment->TransactionStatus = $paymentobj->status;   //success orfailure
                $payment->PaymentMethod = $paymentobj->method;  //netbanking /card/googlepay
                $payment->created_at = Date('Y-m-d');
                $payment->save();
                
                
                
                
                
            }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //write code to return view
                   return response()->json('pay_success',200);
                
                } else {
                    DB::rollback();
                    //Log::info('MatrimonyController:SetMatrimonyExpiry: Matrimony registration cannot be done due to',$exception);
                        //write code to return view with failure
                        return response()->json('pay_fail',406);
                   /* return redirect('/matrimonys')->back()
                        ->with('failure','Matrimony registration cannot be done due to Database error');*/
                }

            }
            catch(Exception $e) {
                // throw new Exception;
                //Aruna added- Have to log exception 
                //Log::info('MatrimonyController:SetMatrimonyExpiry: Matrimony subscription cannot be renewed due to',$e);
                 return response()->json(array('pay_fail',406));
                /*return redirect('/matrimonys')->back()
                     ->with('failure','Matrimony subscription cannot be renewed due to Exception');*/
            }
    }
    
    
    public function matrimony_index(Request $request)
    {  
        
       //Check for Session time out and redirect to Login page on Session time out 
       
      
       $matrimonys=null;
       $caste=null;

      
       //scenario 1:  if Session user has not registered in Matrimony then
        if ($request->IsReginMatrimony == 0){

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
                    
                        return response()->json(array('code'=>1,'msg'=>'matri_reg'));
                    }
        }
        else
        {
                //scenario 2 : Membership expired
               
                if ( ($request->IsReginMatrimony ==1 )&&($request->MatrimonyMembershipExpiry) < date('Y-m-d')  ) 
                //membership expity date is less than today
                        
                {
                    
                        $matrimonys=null;
                        //Aruna added - objects to be passed in compact with view 
                        // and messages to be passed using with clause
                        //return response()->json(array(2,'Your membership had expired. Kindly renew'));
                        return response()->json(array('code'=>2,'msg'=>'mem_renew'));
                         
                }
       
                $profileuser = Matrimony::where('Createdby', $request->UserID)
                                        ->where('Status','1')
                                        ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                        //first helps you get only one row and avoid a list as a result
                                        ->first();
                
               
                //scenario 3: If session user has registered , no expiry but not created any profile 
                if (!isset($profileuser) && ($request->MatrimonyMembershipExpiry) > date('Y-m-d') )  
                {
                    $matrimonys=null;
                    //Aruna added - objects to be passed in compact with view 
                    // and messages to be passed using with clause
                    //return response()->json(array(3,'You dont have active profile in Matrimony section'));
                    return response()->json(array('code'=>3,'msg'=>'matri_noactive'));
                    
                }     
                
                
                //scenario 4: If session user has registered previously and deleted the profile irrespective of expiry date
                if (isset($profileuser) &&  $profileuser->RegistrationID ==0  )  
                {
                    $matrimonys=null;
                    //Aruna added - objects to be passed in compact with view 
                    // and messages to be passed using with clause
                    return response()->json(array('code'=>4,'msg'=>'matri_prodelete'));
                    
                }    

                // get profile user subcaste ID

                //in case Profile User has given Subcaste as 'Don't know' or 'Not Applicable' 
                //then only gender to be checked
                
                //scenario 5:  whether User wants to fetch mathcing profiles based on his registered caste 
                //  or based on what caste he chose in Index page now
                //
                //First option is Preferred Caste selected in UI, then  Preferred Caste  given in profile and then profile caste
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
                        return response()->json(array('code'=>5,'msg'=>'no_profiles'));
                        
                    }
                    else
                    {
                        
                           
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp($request->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                $matrimonys = DB::table('matrimony_registration') 
                                                ->where('Status','=','1')
                                                ->where('ProfileUser_Gender','!=', $profileuser->ProfileUser_Gender)    
                                                ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                                ->orderby('ProfileUser_Name', 'ASC')
                                                ->get();
                                
                                            //->paginate(6); 
                            }
                            //Half yearly plan - only 150 profiles shown                    
                            elseif (strcmp($request->User_MatrimonyMembershipType,"Halfyearly") == 0)
                            {
                                $matrimonys = DB::table('matrimony_registration') 
                                                ->where('Status','=','1')
                                                ->where('ProfileUser_Gender','!=', $profileuser->ProfileUser_Gender)    
                                                ->where('ProfileUser_MatrimonyMembershipExpiryDate','>=',date('Y-m-d') )
                                                ->orderby('ProfileUser_Name', 'ASC')
                                                ->get();
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
                            return response()->json(array('matrimonys'=>$matrimonys, 'profileuser'=>$profileuser,'castemasters'=>$castemasters, 'caste'=>$caste));
                                              
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
                        $Failed = 'no_profiles';
                        return response()->json(array('matrimonys'=>$matrimonys, 'profileuser'=>$profileuser,'castemasters'=>$castemasters, 'caste'=>$caste,'code'=>5,'msg'=>$Failed));
                                
                    }    
                    else
                    {           
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp($request->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                $matrimonys =$matrimonys->take(50);
                                           // ->paginate(6); 
                            }
                            //Halfyearly plan - only 150 profiles shown                    
                            elseif (strcmp($request->User_MatrimonyMembershipType,"Halfyearly") == 0)
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
                            return response()->json(array('matrimonys'=>$matrimonys, 'profileuser'=>$profileuser,'castemasters'=>$castemasters, 'caste'=>$caste, 'Failed'=>$Failed));
                                    
                    }
                } 
                
                //scenario 8: If user registered caste or selected caste in index page is Telugu Viswakarma
                // and Subcaste is Not Applicable or Dont Know 
                //then we show all opposite Gender of Telugu Viswakarma
                if (  ( strcmp( trim($caste) , "Telugu Viswakarma") ==0)   &&( strcmp( trim($profileuser->ProfileUser_Category) , "Tamil Viswakarma") ==0)  )
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
                        
                        $Failed = 'no_profiles';
                        return response()->json(array('matrimonys'=>$matrimonys, 'profileuser'=>$profileuser,'castemasters'=>$castemasters, 'caste'=>$caste,'code'=>6,'msg'=>$Failed));
                                  
                    }
                    else
                    {
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp($request->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                $matrimonys =$matrimonys ->take(50);
                                           // ->paginate(6); 
                            }
                            //Halfyearly plan - only 150 profiles shown                    
                            elseif (strcmp($request->User_MatrimonyMembershipType,"Halfyearly") == 0)
                            {
                                $matrimonys =$matrimonys ->take(150);
                                            //->paginate(6); 
                            }
                            //Yearly plan
                            else{
                                $matrimonys =$matrimonys ->get();
                                            //->paginate(6); 
                            }     
                            
                            
                                    
                           

                            $Failed = null;
                            return response()->json(array('matrimonys'=>$matrimonys, 'profileuser'=>$profileuser,'castemasters'=>$castemasters, 'caste'=>$caste, 'Failed'=>$Failed));
                         
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
                        
                        $Failed = 'no_profiles';
                        return response()->json(array('matrimonys'=>$matrimonys, 'profileuser'=>$profileuser,'castemasters'=>$castemasters, 'caste'=>$caste,'code'=>7,'msg'=>$Failed));
                         
                    }
                    else
                    {
                            //Based on Membership type the number of Profiles shown will vary
                            //Monthly plan - only 50 profiles shown                    
                            if (strcmp($request->User_MatrimonyMembershipType,"Monthly") == 0)
                            {
                                   //now find Bride or Groom of matching subcaste
                                   $matrimonys =$matrimonys->take(50);
                            }
                            //Hlf yearly Membership - only 150 profiles shown
                            else if ( strcmp ($request->User_MatrimonyMembershipType,"Halfyearly") ==0 )
                            {
                                   $matrimonys =$matrimonys->take(150);
                            }
                            //yearly membership - no limits
                            else 
                            {
                                   $matrimonys =$matrimonys->all();
                            }
                            
                            $Failed =null;

                            return response()->json(array('matrimonys'=>$matrimonys, 'profileuser'=>$profileuser,'castemasters'=>$castemasters, 'caste'=>$caste, 'Failed'=>$Failed));
                                        
                    }//end of else
                }//end of inner else

        }//end of outer else

    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function matrimony_store(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
          

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
            $input->ProfileUser_PreferredCaste =$request->get('ProfileUser_PreferredCaste');
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
            
            if($request->file('ProfileUser_Photo')  )
            {
                $Photo = $request->file('ProfileUser_Photo');
                $uri = '/images/matrimonys/userphotos/';
                $namewithextension = $Photo->getClientOriginalName(); 
                /*Name with extension 'filename.jpg'*/
                $name = explode('.', $namewithextension)[0]; 
                /* Filename 'filename'*/
                $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                $input['ProfileUser_Photo'] = $uri.$name;
                $Photo->move(public_path('images/matrimonys/userphotos/'), $name);
                            
            }
            if($request->file('ProfileUser_Horoscope'))
            {
                        $HPhoto = $request->file('ProfileUser_Horoscope');
                        $uri = '/images/matrimonys/horoscopephotos/';
                        $namewithextension = $HPhoto->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$HPhoto->getClientOriginalExtension();
                        $input['ProfileUser_Horoscope'] = $uri.$name;
                        $HPhoto->move(public_path('images/matrimonys/horoscopephotos/'), $name);
                     
            }
                    
           
            //payment details and subscription expiry details will be updated later during payment
            $input->Status = 1;
            $input->ProfileUser_MatrimonyMembershipExpiryDate= $request->MatrimonyMembershipExpiry;
            $input->Createdby = $request->UserID;  
            $input->CreatedOn = date('Y-m-d') ;
            
            //RegistrationID should be autoincrement in DB as it is the primary key
            
            //echo " I am about to save";
            $input->save();


            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return response()->json(array('success'=>true,'msg'=>'matri_add'));
                
            } else if($exception instanceof QueryException){
                DB::rollback();
                //throw new Exception;
                //Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$exception);
                return response()->json('matri_add_error',406);
            }
            else {
                DB::rollback();
                //throw new Exception;
                //Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$exception);
                /*return view('matrimonys.create')
                ->with('error','Please rectify errors in the input');*/
                return response()->json('matri_add_error',406);
            }
        
        }
        catch(QueryException $e) {
            //throw new Exception;
            //Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$e);
            // add code to Log exception and not throw Exception
            return response()->json('matri_add_error',406);
        }
        catch(Exception $e) 
        {
            //throw new Exception;
            //Log::info('MatrimonyController:Store:  Exception while adding profile ',(array)$e);
            // add code to Log exception and not throw Exception
            //dd($e);
            return response()->json('matri_add_error',406);
        }

    }




   /**
     * Display the specified resource.
     *
     * @param  \App\Matrimony  $RegistrationID
     * @return \Illuminate\Http\Response
     * shows the detailed matrimony profile for the given Registration ID
     */
    public function matrimony_show($RegistrationID)
    {
            
            $matrimony = Matrimony::find($RegistrationID);
            return response()->json(array('matrimony'=>$matrimony));
    }
   

    public function matrimony_edit($RegistrationID)
    {
        
        $matrimony = Matrimony::find($RegistrationID);
        $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
      
        return response()->json(array('matrimony'=>$matrimony,'castemasters'=>$castemasters));
    }



   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function matrimony_update(Request $request)
    {
           //Check for Session time out and redirect to Login page on Session time out 
           

            try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

                $input = Matrimony::find($request->RegistrationID);
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
            if( $request->get('ProfileUser_email')!== null)
            {
            $input->ProfileUser_email = $request->get('ProfileUser_email');
            }
            if( $request->get('ProfileUser_PlaceofBirth')!== null)
            {
            $input->ProfileUser_PlaceofBirth = $request->get('ProfileUser_PlaceofBirth');
            }
            if( $request->get('ProfileUser_Address')!== null)
            {
                $input->ProfileUser_Address = $request->get('ProfileUser_Address');
            }
            if( $request->get('ProfileUser_LocationID')!== null)
            {
            $input->ProfileUser_LocationID = $request->get('ProfileUser_LocationID');
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
            $input->ProfileUser_Category = $request->get('ProfileUser_Category');
            }
            if(  $request->get('ProfileUser_Subcaste')!== null)
            {
            $input->ProfileUser_Subcaste = $request->get('ProfileUser_Subcaste');
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
              $input->ProfileUser_PreferredCaste =$request->get('ProfileUser_PreferredCaste');
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
            
            if($request->get('ProfileUser_EmplSinceWhen') !== null)
            {
                 $input->ProfileUser_EmplSinceWhen = $request->ProfileUser_EmplSinceWhen;
                
            }
            // else
            // {
            //      $input->ProfileUser_EmplSinceWhen = "else";
            // }
            
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
            
            if($request->file('ProfileUser_Photo'))
            {
                            $Photo  = $request->file('ProfileUser_Photo');
                            $uri = '/images/matrimonys/userphotos/';
                            $namewithextension = $Photo->getClientOriginalName(); 
                            /*Name with extension 'filename.jpg'*/
                            $name = explode('.', $namewithextension)[0]; 
                            /* Filename 'filename'*/
                            $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                            $input['ProfileUser_Photo'] = $uri.$name;
                            $Photo->move(public_path('images/matrimonys/userphotos/'), $name);
                            
   
                         
            }
            if( $request->file('ProfileUser_Horoscope'))
            {
                $HPhoto  = $request->file('ProfileUser_Horoscope');
                $uri = '/images/matrimonys/horoscopephotos/';
                $namewithextension = $HPhoto->getClientOriginalName(); //Name with extension 'filename.jpg'
                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                $name = $name.'_'.time().'.'.$HPhoto->getClientOriginalExtension();
                $input['ProfileUser_Horoscope'] = $uri.$name;
                $HPhoto->move(public_path('images/matrimonys/horoscopephotos/'), $name);
                         
            }
                    
           
            $input->save();
            
            
            
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                $castemasters = DB::table("caste_master")->pluck("CasteName","CasteID");
                $matrimony = Matrimony::find($request->RegistrationID);
                return response()->json(array('matrimony'=>$matrimony,'castemasters'=>$castemasters));
            
            } else {
                DB::rollback();
                //throw new Exception;
                //Log::info('MatrimonyController:Update:  Exception while updating profile ',(array)$exception);
                
               // return redirect('/matrimonys')->back()->with('Failure', 'Unable to update your Matrimony Profile');
                return response()->json('matri_update_error',406);
            }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            //Log::info('MatrimonyController:Update:  Exception while updating profile ',(array)$e);
            return response()->json('matri_update_error',406);
        }
      
    }



   /**
     * get Subcastelist to be shown in index page
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mobgetSubcasteList(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        

        $subcastes = DB::table("subcaste_master")
                        ->join('caste_master','caste_master.CasteID','=','subcaste_master.CasteID')
                        ->where("caste_master.CasteName",$request->CasteName)
                        ->pluck("SubCaste_Name","SubCasteID");

        return response()->json($subcastes);
    } 


    // process the form submission and send the invite by email
    public function mob_sendingInvite(Request $request)
    {
       
        //Check for Session time out and redirect to Login page on Session time out 
        
       
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
            'Invitedby' => $request->Sendername,
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
            	$message = "You have been invited to join Viswakarma Community Website by". $request->Sendername.". Your invitation id is ".$invitationid;
      
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
        //alert()->success('Your invitation is sent to the Invitee');
        return response()->json(array('success'=>true,"msg"=>'invite_success_alert'));
    } 

    /**
     * Delete profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function matrimony_delete($RegistrationID,$UserID)
    {
        

        try {
            // Transaction
             $exception = DB::transaction(function() use ($RegistrationID,$UserID) {

                    $matrimony = Matrimony::find($RegistrationID);
                    If (isset($matrimony))
                    {
                        $matrimony->Status=0;
                        $matrimony->ProfileUser_MatrimonyMembershipExpiryDate = date('Y-m-d', strtotime(' - 1 day'));
                        $matrimony->save();

                        /*$user = User::find($UserID);
                        if (isset($user)) 
                        {
                            $user->IsReginMatrimony=0;
                            $user->User_MatrimonyMembershipType = "";
                            $user->MatrimonyMembershipExpiry = date('Y-m-d', strtotime(' - 1 day'));
                            $user->save(); 
                        }
                        else
                        {
 
                        }*/
                    }
                    else{
                        
                    }
                }); //end of transaction

                if(is_null($exception)) 
                {
                    DB::commit();
                    return response()->json(array('success'=>true,'msg'=>'matri_unlinked'));
                 } 
                 else 
                 {
                    DB::rollback();
                   // throw new Exception;
                   //Aruna added - add log code
                   return response()->json('matri_unlinked_error',406);
                }
        }
        catch(Exception $e) {
           // throw new Exception;
          return response()->json('matri_unlinked_error',406);
        }
    }

    public function getlang_library(Request $request)
    {
        /* $locale = $localeinput;
        Session::put('locale',$locale);
        app()->setLocale($request->user()->getLocale());*/
         
        $locale = $request->lang; 
        App::setLocale(Session::get('locale',$locale));
        $array = Lang::get('home');
        return $array;
    }


}//end class