<?php

// classname - ElderDetailsController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the FAQ feature
// created date - Nov 2019

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Auth;
use DB;

use App\ElderDetails;
use App\Comment;
use App\Post;
use App\User;

class ElderDetailsController extends Controller
{


    public function __construct()
    {
        return $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     * elders folder name and variablename
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

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
        if (Auth::user()->IsElder ==1){
            //sometimes this Auth::user()->isElder check is not working in view and hence using this flag
            $flag=1;

            //FAQ raised by others
            $Othersfaqs= DB::table('faq_posts')
                    ->join('users','users.id','=','faq_posts.FAQ_UserID')
                    ->select('faq_posts.FAQ_PostID','faq_posts.FAQ_Title','faq_posts.FAQ_Body','faq_posts.FAQ_Photo', 'faq_posts.FAQ_CreatedDate','faq_posts.FAQ_UserID','users.name', 'users.User_photo','users.User_City')
                    ->where('faq_posts.FAQ_IsActive', '=', '1')
                    // note this-   not created by user condition being checked
                    ->where('faq_posts.FAQ_UserID','<>',Auth::user()->id)

                    ->whereYear('faq_posts.updated_at','=',$currentYear)
                    ->whereMonth('faq_posts.updated_at','=',$currentMonth)
                    ->orderby('faq_posts.FAQ_CreatedDate','DESC')
                    ->get();

            //FAQ raised by him
            $Hisfaqs= DB::table('faq_posts')
                    ->join('users','users.id','=','faq_posts.FAQ_UserID')
                    ->select('faq_posts.FAQ_PostID','faq_posts.FAQ_Title','faq_posts.FAQ_Body', 'faq_posts.FAQ_Photo','faq_posts.FAQ_CreatedDate','faq_posts.FAQ_UserID','users.name', 'users.User_photo','users.User_City')
                    ->where('faq_posts.FAQ_IsActive', '=', '1')
                    ->where('faq_posts.FAQ_UserID',Auth::user()->id)
                    ->whereYear('faq_posts.updated_at','=',$currentYear)
                    ->whereMonth('faq_posts.updated_at','=',$currentMonth)
                    ->orderby('faq_posts.FAQ_CreatedDate','DESC')
                    ->get();

            //List of Elders
            $elders = DB::table('elder_details')
                        ->join('users', 'elder_details.UserID', '=', 'users.id')
                        ->select('elder_details.UserID as UserID','users.name as name','users.User_photo','users.User_City','elder_details.Num_Queries_Answered')
                        ->where('elder_details.Status', '=', '1')
                        ->orderby('users.name','ASC')
                        ->get();
               
            return view('elders.index',compact('elders','Hisfaqs','Othersfaqs','flag','currentMonthName','currentYear'))
                      ->with('i', (request()->input('page', 1) - 1) * 5);
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
                    ->where('faq_posts.FAQ_UserID',Auth::user()->id)
                    ->whereYear('faq_posts.updated_at','=',$currentYear)
                    ->whereMonth('faq_posts.updated_at','=',$currentMonth)
                    ->orderby('faq_posts.FAQ_CreatedDate','DESC')
                    ->get();

                  
            return view('elders.index',compact('elders','Hisfaqs','flag','Othersfaqs', 'currentMonthName','currentYear'))
                             ->with('i', (request()->input('page', 1) - 1) * 5);
       }
    
    }


   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
        return view('elders.create');
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

                $request->validate([

                    'Title' => 'required|max:200',
                    'Description' => 'required|max:3000',
                    //'Photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ],
                [
                    'Title.required' => 'Please fill the Title',
                    'Description.required' => 'Please fill Function details',
                   // 'Photo.required'  => 'Photo is missing. Please upload Photo',
                ]  );

               // Storing the elder Details

                $faqcomment = new Post;
                $faqcomment->FAQ_Title= $request->Title;
                $faqcomment->FAQ_Body = $request->Description;
                $faqcomment->FAQ_UserID= Auth::user()->id;
                $faqcomment->FAQ_CreatedDate= date('Y-m-d');
                $faqcomment->updated_at= date('Y-m-d');
                $faqcomment->FAQ_IsActive=1;
                if($request->Photo != null ){
                    $uri = '/images/faqpost/';
                    $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                    $faqcomment['FAQ_Photo'] = $uri.$name;
                    $request->Photo->move(public_path('images/faqpost'), $name);
                }

                $faqcomment->save();
               
                
              }); //end of transaction
              if(is_null($exception)) {
                    DB::commit();
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return redirect()->route('elders.index')
                            ->with('success','FAQ created successfully.');
                  
              } else {
                    DB::rollback();
                    //throw new Exception;
                    Log::info('ElderDetailsController:Store:  Exception while adding FAQ ',(array)$exception);
                     //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return redirect()->route('elders.index')
                              ->with('message','Unable to created FAQ');
                }
            
            }
            catch(Exception $e) {
                //throw new Exception;
                DB::rollback();
                Log::info('ElderDetailsController:Store:  Exception while adding FAQ ',(array)$e);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('elders.index')
                                 ->with('message','Unable to create FAQ');
            }


    }


   /**
     * Show  resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($FAQ_PostID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

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
                        return view('elders.show', compact('faqs','comments','allfaq'));
                    }
                    else{
                        $comments = null;
                        return view('elders.show', compact('faqs','comments','allfaq'));
                    }
                
                }
                else
                {
                    $faq = null;
                    $comments = null;
                    return view('elders.show', compact('faqs','comments','allfaq'))
                            ->with('Failed','Cant find Post for this id');
                }
        }
       else{
                $faq = null;
                $comments = null;
                return view('elders.show', compact('faqs','comments','allfaq'))
                           ->with('Failed','Post Id is empty');
       }

    }
   




    public function IVolunteer()
    {
         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }


        // try...catch
        try {
            // Transaction
             $exception = DB::transaction(function() {

                //validation is not needed here as we are taking session user id
 
                 // Storing the elder Details

                 $input =  new ElderDetails;
                 $input->UserID  = Auth::user()->id;
                 $input->Status =1;
                 $input->CreatedOn = date('Y-m-d');
                 $input->Createdby = Auth::user()->id;  
                 $input->Num_Queries_Answered =0;
                 $input->save();

                 $eldrid = $input->ElderID ;

                 Auth::user()->update([
                     'IsElder' => 1,
                 ]);
 
               }); //end of transaction
               if(is_null($exception)) {
                     DB::commit();
                     return back() 
                        -> with('message','Success.. You have been registered as Elder');
                 } else {
                     DB::rollback();
                     //throw new Exception;
                     Log::info('ElderDetailsController:IVolunteer:  Exception while adding Elder ',(array)$exception);
                     return back()
                          -> with('message','Sorry.. Unable to register you as Elder');
                 }
             }
             catch(Exception $e) {
                 //throw new Exception;
                 Log::info('ElderDetailsController:IVolunteer:  Exception while adding Elder ',(array)$e);
                 return back()
                      -> with('message','Sorry.. Unable to register you as Elder');
            }

    }


}
