<?php

// classname - HelpPostController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Help feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HelpPost;
use App\HelpComment;

use DB;
use Auth;
use Log;

class HelpPostController extends Controller
{

    /**
     * construtor function
     * 
     * @return Auth - session user details
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // this index method was written at the intiial stage and hence Monthwise listing and category wise listing of Index page is handled 
        //seperately. Index method handles only Month wise listing and getCat method handles category wise listing and fills the content and
        //redirects to the index page

        //In other controllers , all index page listings are handled only in Index method of controller

         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
         }

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
        if (isset($helpposts)){
             return view('helpposts.index',compact('helpposts','currentMonthName','currentYear'));
             /*->with('i', (request()->input('page', 1) - 1) * 5);*/
        }
        else{
            return view('helpposts.index',compact('helpposts','currentMonthName','currentYear'))
            ->with('Failed', 'No Posts available now');
        }
    }

   /**
     * Redirects to  the Create view page.
     * 
     * 
     */
    public function create()
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
        return view('helpposts.create');
    }



    
    /**
     * Store a resource.
     * 
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

               /*$request->validate([

                          'Type' => 'required|max:200',
                          'Description' => 'required|max:3000',
               
               ],
               [
                'Type.required' => 'Please fill the Title',
                'Description.required' => 'Please fill Function details',
             
                
               ]);*/
              

                // Storing the helppost Details
				
                $input =  new HelpPost;
                $input->Type = $request->get('Type');
                $input->Description = $request->get('Description');
                $input->Status =1;
                $input->NumReplies = 0;
                $input->ClosedOn = Date('Y-m-d');
                $input->user_id = Auth::user()->id;
                
                /*
                $input['Photo'] = time().'.'.$request->Photo->getClientOriginalExtension();
                $request->Photo->move(public_path('images/helppost'), $input['Photo']);*/
                
                $uri = '/images/helppost/';
                $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                $input['Photo'] = $uri.$name;
                $request->Photo->move(public_path('images/helppost'), $name);
                
                $input->CreatedBy = Auth::user()->id; 
                $input->CreatedOn = date('Y-m-d');
       
                $input->save();
                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return redirect()->route('helpposts.index')
                                  ->with('success','Help Post added successfully.');
                   
                } 
                else {
                    DB::rollback();
                    // throw new Exception;
                    //Log 
                    Log::info('HelpPostController:Store:  Exception while adding Post ',(array)$exception);
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return redirect()->route('helpposts.index')
                                   ->with('message','Unable to add Post');
                }
            
            }
            catch(Exception $e) {
                throw new Exception;
                //Log 
                Log::info('HelpPostController:Store:  Exception while adding Post ',(array)$e);
                return redirect()->route('helpposts.index')
                             ->with('message','Unable to add Post');
            }
            
    }
   

    /**
     * Display a l resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($HelpID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        //get all the posts to be shown in RHS as recent Posts
        $helpposts = DB::table('help_post')
                            ->leftjoin('users','users.id', '=', 'help_post.user_id')
                            ->select('help_post.HelpID','help_post.Description','help_post.Type','help_post.Photo as Photo', 'help_post.user_id', 'users.name','users.User_Photo as User_Photo','help_post.CreatedBy')
                            ->where('Status', '1')
                            ->orderby('help_post.CreatedOn','DESC')
                            ->take(5)
                            ->get();

        if (isset ($HelpID)  ) {
            //first get the Post of the given ID

             //get the Post for the given ID
             $helppost = DB::table('help_post')
                        ->leftjoin('users','users.id', '=', 'help_post.user_id')
                        ->select('help_post.HelpID','help_post.Description','help_post.Type','help_post.created_at','help_post.Photo as Photo', 'help_post.user_id', 'users.name','users.User_Photo as User_Photo','help_post.CreatedBy')
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
                    return view('helpposts.show', compact('helppost','comments', 'helpposts'));
                }
                else{
                    $comments = null;
                    return view('helpposts.show', compact('helppost','comments', 'helpposts'));
                }
            
            }
            else
            {
                $helppost = null;
                $comments = null;
                return view('helpposts.show', compact('helppost','comments','helpposts'))
                        ->with('Failed','Cant find this Post');
            }
            }
        else{
                    $helppost = null;
                    $comments = null;
                    return view('helpposts.show', compact('helppost','comments','helpposts'))
                    ->with('Failed','Post id empty');
            }
        
  }


    /**
     * to redirect to Edit view.
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($HelpID) {

          //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }


        if (isset($HelpID))
        {
            $helppost = HelpPost::find($HelpID);
            If (isset($helppost)){
                return view('helpposts.edit', compact('helppost'));
            }
            else{
                $helppost = null;
                Log::info('HelpPostController:Edit:  Helppost null');
                return view('helpposts.edit', compact('helppost'))
                          ->with('Failed','Cannot find the Post');

            }

        }
        else{
            $helppost = null;
            Log::info('HelpPostController:Edit:  Helppost ID null');
            return view('helpposts.edit', compact('helppost') )
             ->with('Failed','Id is null');
        }
     }


    /**
     * Updates a resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }


         // try...catch
         try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {

                $helppost = HelpPost::find($request->HelpID);
                //$input =  new HelpPost;
                
                $helppost->Description = $request->get('Description');
                $helppost->Status =1;
                
                $helppost->user_id = Auth::user()->id;
                
                /*
                $input['Photo'] = time().'.'.$request->Photo->getClientOriginalExtension();
                $request->Photo->move(public_path('images/helppost'), $input['Photo']);*/
                if($request->Photo != null)
                {
                    print_r("im inisde if");
                    $Photo = $request->Photo;
                    $uri = '/images/helppost/';
                    $namewithextension = $Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$Photo->getClientOriginalExtension();
                    $helppost['Photo'] = $uri.$name;
                    $Photo->move(public_path('images/helppost'), $name);
                }
                else
                {
                    
                }
                $helppost->Updateby = Auth::user()->id; 
                $helppost->UpdateOn = date('Y-m-d');
                $helppost->update();

            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('helpposts.index')
                    ->with('success','Help Post updated successfully.');
               
            } else {
                DB::rollback();
                //throw new Exception;
                //Log 
                Log::info('HelpPostController:Update:  Exception while updating Post ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('helpposts.index')
                   ->with('Failed','Unable to add Post');
            }
        
        }
        catch(Exception $e) {
            throw new Exception;
            //Log 
            Log::info('HelpPostController:Store:  Exception while adding Post ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return redirect()->route('helpposts.index')
            ->with('Failed','Unable to add Post');
        }
  
        
    }



   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $HelpID
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
 
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

       // try...catch
       try {
       // Transaction
        $exception = DB::transaction(function() use ($request) 
        {
                DB::table('help_post')->where('HelpID','=',$request->HelpID)->update(['Status'=>0]);

                return redirect('/helpposts')->with('success', 'Help Post is successfully deleted');
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('helpposts.index')
                    ->with('success','Help Post deleted successfully.');
               
            } else {
                DB::rollback();
               // throw new Exception;
                //Log 
                Log::info('HelpPostController:Delete:  Exception while deleting Post ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('helpposts.index')
                   ->with('Failed','Unable to delete Post');
            }
        
        }
        catch(Exception $e) {
           // throw new Exception;
            //Log 
            Log::info('HelpPostController:Delete:  Exception while deleting Post ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return redirect()->route('helpposts.index')
            ->with('Failed','Unable to delete Post');
        }
    }


     /**
     * Get Index page based on Help Category.
     *
     * @param  int  $cat
     * @return \Illuminate\Http\Response
     */
    public function getCat($cat)
    {

         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
         }
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

 
                if (isset($helppostsCat)){
                return view('helpposts.index',compact('helppostsCat', 'catName'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
                }
                else{
                return view('helpposts.index',compact('helppostsCat', 'catName'))
                ->with('Failed', 'No Posts available now');
                }
        }
        else{
            return view('helpposts.index',compact('helppostsCat', 'catName'))
                                     ->with('Failed', 'No Posts available now');
        }
      
    }

}
