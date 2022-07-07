<?php

// classname - TempleFunctionsController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the TempleFunctions  feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\TempleFunctions;
use App\TempleFunctionPhotos;
use App\TempleFunctionVideos;

use DB;
use Image;
use Auth;
use Exception;
use Log;
use Lang;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class TempleFunctionsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

           // in this feature both category wise listing and month wise listing of index page  are handled in same index method
           //Check for Session time out and redirect to Login page on Session time out 
             if ( ! Auth::check()){
                return view('auth.SessionTimeout');
            }
  
            $temple = null;
            $templeUP= null;
            
            //check whether Month is given
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
            
            
           
             //determine whether Temple is sent or Month is sent 
             if (!isset($request->templeid) )
             {

                $templefunctions = DB::table('temple_functions')
                        ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                        ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                            // Aruna- we have used left join so that whether photo is available or not Announcements will be got
                            //for index show only photos
                            
                        ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo','temple_function_videos.Video')
                        ->where('temple_functions.Status', '1')
                        ->whereYear('temple_functions.CreatedOn','=',$currentYear)
                        ->whereMonth('temple_functions.CreatedOn','=',$currentMonth)
                        ->orderby('temple_functions.FunctionDate','DESC')
                        //->get();
                        ->paginate(6);
                     
                         
                if ( isset($templefunctions) && (count($templefunctions) >0)  ){
                        $Failed=null;
                }
                else{
                            $templefunctions = null;
                            $Failed=Lang::get('home.templefunc_index_error').$currentMonthName. ' , '.$currentYear;
                }
                $temple = null;
             }
             else
            {

                $templefunctions = DB::table('temple_functions')
                        ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                        ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                        // Aruna : Let us get only photos for the index pages
                        ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo','temple_functions.Createdby', 'temple_function_videos.Video')
                        ->where('temple_functions.Status', '1')
                        ->where('TempleID',$request->templeid)
                        ->orderby('temple_functions.FunctionDate','DESC')
                        ->paginate(6);
                        

                        
                $temple1 = DB::table('temple_master')
                             ->select('temple_master.TempleID','temple_master.Temple_Name')
                             ->where('TempleID', $request->templeid)
                             ->first();        
                        
                if ( isset($templefunctions) && (count($templefunctions) >0)  ){
                    $Failed= null;
                }
                else{
                    $templefunctions =null;
  
                    $Failed=Lang::get('home.templefunc_index_error')."   ".$temple1->Temple_Name;
                }
             }

                $templeUP = DB::table('temple_member_master')
                                ->select('TempleID')
                                ->where('temple_member_master.UserID',Auth::user()->id)
                                ->where('TempleID','=',$request->templeid)
                                ->first();
                                
                $temples = DB::table('temple_master')
                                ->select('temple_master.TempleID','temple_master.Temple_Name')
                                ->where('Temple_Status', '1')
                                ->orderby('temple_master.Temple_Name','ASC')
                                ->get();

             return view('templefunctions.index',compact('templefunctions', 'temples', 'Failed','currentMonthName' , 'currentYear','templeUP','temple1'));   
    
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
        return view('templefunctions.create');
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

        $temple = DB::table('temple_member_master')
                        ->where('temple_member_master.UserID',Auth::user()->id)
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
                $input->Createdby = Auth::user()->id;  // please repleace this with userid of session
                $input->CreatedOn = date('Y-m-d');
                $input->save();

                //Aruna: The below single line gets th ID of the saved record
                $lastid= $input->TempleFunctionID;

                //Storing the Photos
                if ($request->Photo  != null)
                {
                    $phinput =  new TempleFunctionPhotos;
                     // we have to add the meetingid created in the above step
                    $phinput->TempleFunctionID = $lastid;

              /*    changed by Aruna - Due to mobile app issue - get filepath full
                    $phinput['Photo'] = time().'.'.$request->Photo->getClientOriginalExtension();
                    $request->Photo->move(public_path('images/templefunctions'), $phinput['Photo']); */

                    $uri = '/images/templefunctions/';
                    $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                    $phinput['Photo'] = $uri.$name;
                    $request->Photo->move(public_path('images/templefunctions'), $name);

                    $phinput->Createdby = Auth::user()->id;  
                    $phinput->CreatedOn = date('Y-m-d');
                   
                    $phinput->save();
                }

                //Storing the Vidoes
                if ($request->Video  != null)
                {
                    $vidinput =  new TempleFunctionVideos;
                      // we have to add the meetingid created in the above step
                    $vidinput->TempleFunctionID = $lastid;
                    $uri = '/images/templefunctions/video/';
                    $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                    $vidinput['Video'] = $uri.$name;
                    $request->Video->move(public_path('images/templefunctions/video/'), $name);

                    $vidinput->Createdby =  Auth::user()->id;;  
                    $vidinput->CreatedOn = date('Y-m-d');
                    $vidinput->save();
                }

                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //Aruna . There is difference between calling a view and controller method
                    // To call view -> we use return view  and send objects using "compact" and variable using "with"
                    // To call a controller method we use redirect()-> route () and with to send additioanl message
                    return redirect()->route('templefunctions.index')
                    ->with('success',Lang::get('home.success_msg'));
                  
                } else {
                    DB::rollback();
                   // throw new Exception;
                    Log::info('TempleFunctionsController:Create:  Exception while creating Temple Function ',(array)$exception);
                    return redirect()->route('templefunctions.index')
                          ->with('warning',Lang::get('home.fail_msg'));
                }
            
            }
            catch(Exception $e) {
                //throw new Exception;
                DB::rollback();
                Log::info('TempleFunctionsController:Create:  Exception while creating Temple Function',(array)$e);
                return redirect()->route('templefunctions.index')
                         ->with('warning',Lang::get('home.fail_msg'));
            }
        }
        else{
            //throw new Exception;
            DB::rollback();
            Log::info('TempleFunctionsController:Create:  Exception while creating Temple Function . Owned Temple ID is null',(array)$e);
            return redirect()->route('templefunctions.index')
                     ->with('message',Lang::get('home.templefunc_create_error'));
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
    public function show($TempleFunctionID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
        //this is retruned for the Recent functions panel in Right side
        $templefunctions = DB::table('temple_functions')
                                    ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                                    ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo')
                                    ->where('temple_functions.Status', '1')
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

                if(isset($templefunction)  &&  (count($templefunction) >0)) 
                {
                    return view('templefunctions.show',compact('templefunction','templefunctions'));
                }
                else
                {
                    $templefunction = null;
                    return view('templefunctions.show',compact('templefunction','templefunctions'))
                                ->with('warning',Lang::get('home.templefunc_warning'));
                }

        }
        else{
            $templefunction = null;
            return view('templefunctions.show',compact('templefunction','templefunctions'))
                        ->with('warning',Lang::get('home.templefunc_idnull_warning'));
        }
    }

    //added by Aruna
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalFunction  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($TempleFunctionID)
    {

         //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }
          //Aruna added - Since Temple Functions can have photos and videos we are doing left join
        // so that even if vidoes and photos are not there too, Temple functions must be provided
        $templefunction = DB::table('temple_functions')
                            ->leftjoin('temple_function_photos', 'temple_functions.TempleFunctionID', '=', 'temple_function_photos.TempleFunctionID')
                            ->leftjoin('temple_function_videos', 'temple_functions.TempleFunctionID', '=', 'temple_function_videos.TempleFunctionID')
                            ->select('temple_functions.TempleFunctionID','temple_functions.Title','temple_functions.Function_Content','temple_functions.FunctionDate','temple_function_photos.Photo','temple_function_videos.Video')
                            ->where('temple_functions.TempleFunctionID', $TempleFunctionID)
                            ->first();

        return view('templefunctions.edit',compact('templefunction'));
    }




  /**
     * Display the specified resource.
     *
     * @param  \App\TempleFunctions  $templefunction
     * @return \Illuminate\Http\Response
     * TempleFunctions Model Name
     * variable name templefunction used in create,index and show pages
     */

    public function update(Request $request, $TempleFunctionID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        // try...catch
        try {
            // Transaction
             $exception = DB::transaction(function() use ($request) {
    
                $input = TempleFunctions::find($request->TempleFunctionID);
                $input->Title = $request->Title;
                $input->Function_Content = $request->Description;
                $input->FunctionDate = $request->FunctionDate;
                $input->Status =1;
                // we are not updating Temple id
                $input->Post_Status = 1;
                $input->Createdby = Auth::user()->id;  
                $input->CreatedOn = date('y-m-d');

                $input->save();

                //Storing the Photos
                if( $request->Photo != null)
                {
                    $phinput = TempleFunctionPhotos::where(TempleFunctionID,$request->TempleFunctionID)
                                         ->first(); 
                    if (isset($phinput)){

                            $uri = '/images/templefunctions/';
                            $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                            $phinput['Photo'] = $uri.$name;
                            $request->Photo->move(public_path('images/templefunctions'), $name);
                            $phinput->save();
                    }
                }

                 //Storing the Vidoes
                if ($request->Video  != null)
                {
                    $vidinput =   TempleFunctionVideos::where(TempleFunctionID,$request->TempleFunctionID)->first();
                    $uri = '/images/templefunctions/video/';
                    $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                    $vidinput->Video = $uri.$name;
                    
                    $request->Video->move(public_path('images/templefunctions/video/'), $name);

                    //$vidinput->save();  Save is not working as where and first is breaking the Eloquent style. Hence using below update
                    $vidinput->update(['Video'=>$uri.$name] );
                }
             
             
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                 //Aruna . There is difference between calling a view and controller method
                // To call view -> we use return view  and send objects using "compact" and variable using "with"
                // To call a controller method we use redirect()-> route () and with to send additioanl message
                return redirect()->route('templefunctions.index')
                            ->with('success',Lang::get('home.updated_success'));
               
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('TempleFunctionsController:update:  Exception while updating Temple functions ',(array)$exception);
                return redirect()->route('templefunctions.index')
                            ->with('warning',Lang::get('home.updated_fail'));
            }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            DB::rollback();
            Log::info('TempleFunctionsController:update:  Exception while updating Temple functions ',(array)$e);
            return redirect()->route('templefunctions.index')
                         ->with('warning',Lang::get('home.updated_fail'));
        }

    }
    
    
     //added by Aruna
     /**
     * Delete the specified resource.
     *
     * @param  \App\TempleFunctions\  $TempleFunctionID
     * @return \Illuminate\Http\Response
     */
    public function destroy($TempleFunctionID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

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
                    return redirect()->route('templefunctions.index')
                    ->with('success',Lang::get('home.deletion_success'));
                    
              } 
              else {
                DB::rollback();
                //throw new Exception;
                Log::info('TempleFunctionsController:Delete:  Exception while deleting Temple Function  ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('templefunctions.index')
                                     ->with('message',Lang::get('home.deletion_fail'));
                                     
              }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            // add code to Log exception and not throw Exception
            DB::rollback();
            Log::info('TempleFunctionsController:Delete:  Exception while updating Temple Function  ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return redirect()->route('templefunctions.index')
                    ->with('message',Lang::get('home.deletion_fail'));
                    
       }

    }


}
