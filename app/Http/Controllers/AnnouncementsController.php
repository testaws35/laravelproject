<?php

// classname - AnnouncementsController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Announcements feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


use App\Announcements;
use App\AnnouncementsPhotos;
use App\AnnouncementsVideos;

use DB;
use Image;
use Auth;
use Exception;
use Log;
use Lang;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class AnnouncementsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }



    /**
     * Display a listing of the Announcements.
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
                                ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                                // in index page we are not going to show Videos and hence we can remove it 
                                ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements.Announcement_Category','announcements_photos.Photo','announcements_videos.Video')
                                ->where('announcements.Status','=',1)
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
                                ->where('announcements.Status','=',1)
                                ->whereYear('announcements.CreatedOn','=',$currentYear)
                                ->whereMonth('announcements.CreatedOn','=',$currentMonth)
                                ->orderby('announcements.FunctionDate','DESC')
                                ->get();
            
                                
        }  
       
      
        if (isset($announcements)  && count($announcements) > 0 ){
                    return view('announcements.index',compact('announcements', 'Failed','currentMonthName','currentYear', 'cat'))
                          ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        else {

             if (  isset($cat) ) {
                    $announcements = null;
                    // we have to use . for concatenating Variable and + for concatenating a String constant
                    /*$Failed= 'No Announcements available for ' .$cat .'  Category';*/
                    $Failed = Lang::get('home.error');
             }
             else
             {
                    $announcements = null;
                    // we have to use . for concatenating Variable and + for concatenating a String constant
                   /* $Failed = 'No Announcements available for '.$currentMonthName. '  , ' .$currentYear;*/
                   $Failed = Lang::get('home.error');
                   
                   
             }
                    return view('announcements.index',compact('announcements', 'Failed','currentMonthName','currentYear','cat'));
       }
      

    }// end of index



 
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

        return view('announcements.create');
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

                // First , save Announcement details in Announcements table
	            $input =  new Announcements;
                $input->Title = $request->get('Title');
                $input->Function_Content = $request->get('Function_Content');
                $input->FunctionDate = $request->get('FunctionDate');
                $input->Createdby = Auth::user()->id;  
                $input->CreatedOn = date('Y-m-d');
                $input->Status = 1;
                $input->Post_Status = 1;
                $input->Announcement_Category = $request->get('Category');
                                           
                $input->save();
                //get the ID of the announcement saved
                $lastid = $input->AnnouncementsID;

                //Storing the Photos
                if ($request->Photo  != null)
                {
                         // Changed by Aruna
                         //Data that is being stored in table is chnaged from 1506032020.png to /images/announcements_aruna_1506032020.png
                         // This means initially we were forming filename to be stored in DB as  Time.ext 1503062020.png
                         //now to benefit mobile app we are storing full path in DB 

                        $phinput =  new AnnouncementsPhotos;
                        // Set the announcemnt ID created in the previous step as Foreign key in announcements_photos
                        $phinput->AnnouncementsID = $lastid;

                        $uri = '/images/announcements/';
                        $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                        $phinput['Photo'] = $uri.$name;
                        $request->Photo->move(public_path('images/announcements'), $name);
                        $phinput->Createdby = Auth::user()->id;  
                        $phinput->CreatedOn = date('Y-m-d');
                        $phinput->save();
                }
 
                    //Storing the Vidoes
                 if ($request->Video  != null)
                 {
                    $vidinput =  new AnnouncementsVideos;
                    // Set the announcemnt ID created in the previous step as Foreign key in announcements_videos
                    $vidinput->AnnouncementsID = $lastid;
                    //$vidinput->Video = $request->get('Video');
                    
                    $uri = '/images/announcements/video/';
                    $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                    $vidinput['Video'] = $uri.$name;
                    $request->Video->move(public_path('images/announcements/video/'), $name);
                    
                    
                    $vidinput->Createdby = Auth::user()->id; 
                    $vidinput->CreatedOn = date('Y-m-d');
                    $vidinput->save();
                    
                 }
                
                }); //end of transaction

                if(is_null($exception)) {
                        DB::commit();
                         //Aruna- there is a difference between returning view and calling back the index method
                         // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                         return redirect()->route('announcements.index')
                                     ->with('success',Lang::get('home.announce_success'));
                                  // ->with('success','Announcement created successfully.');
                  
                } 
                else {
                    DB::rollback();
                    //throw new Exception;
                    Log::info('AnnouncementsController:Store:  Exception while adding announcement ',(array)$exception);
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return redirect()->route('announcements.index')
                            ->with('warning',Lang::get('home.announce_warning'));
                            //->with('warning','Unable to add the Announcement');

                }
            
            }
            catch(Exception $e) {
                DB::rollback();
                //throw new Exception;
                Log::info('AnnouncementsController:Store:  Exception while adding announcement ',(array)$e);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('announcements.index')
                                ->with('warning',Lang::get('home.announce_warning'));
                            //->with('warning','Unable to add the Announcement');
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
    public function show($AnnouncementsID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

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
                        return view('announcements.show',compact('announcement', 'announcements'));
                }
                else{

                         $announcement = null;
                         return view('announcements.show',compact('announcement', 'announcements')
                                 ->with('warning',Lang::get('home.announce_warning_missing')));
                                      //  ->with('warning','Cant find the given Announcement'));
                }
        }
        else{
            $announcement = null;
            return view('announcements.show',compact('announcement', 'announcements')
                ->with('warning',Lang::get('home.announce_warning_null')));
                  //->with('warning','Given Announcement ID is null'));
        }
       
    }





     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcements
     * @return \Illuminate\Http\Response
     */
    public function edit($announcementsID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

      
        //Aruna added - Since announcements can have photos and videos we are doing left join
        // so that even if vidoes and photos are not there too, announcments must be provided
        $announcement = DB::table('announcements')
                            ->leftjoin('announcements_photos', 'announcements.AnnouncementsID', '=', 'announcements_photos.AnnouncementsID')
                            ->leftjoin('announcements_videos', 'announcements.AnnouncementsID', '=', 'announcements_videos.AnnouncementsID')
                            ->select('announcements.AnnouncementsID','announcements.Title','announcements.Function_Content','announcements.FunctionDate','announcements.Announcement_Category','announcements_photos.Photo','announcements_photos.Announcements_PhotosID', 'announcements_videos.Video','announcements_videos.Announcements_VideosID' )
                            ->where('announcements.Status', '1')
                            ->where('announcements.AnnouncementsID',$announcementsID)
                            ->first();

        return view('announcements.edit',compact('announcement'));
    }



    //added by Aruna
     /**
     * update the specified resource.
     *
     * @param  \App\PersonalFunction  $product
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
           
                $input = Announcements::find($request->AnnouncementsID);
                $input->Title = $request->Title;
                $input->Function_Content = $request->Description;
                $input->FunctionDate = $request->FunctionDate;
                $input->Status =1;
                $input->Post_Status = 1;
                $input->Announcement_Category = $request->Category;
             
                $input->save();
                        
               //Storing the Photos
               if( $request->Photo != null)
               {
                    //Aruna - most important-   save() method can be applied on a variable which is pointing to Model objects only
                    //  Initially we have written raw query using DB::table.  That time Photo->save was not working
                    // After changing to Eloquent syntax of representing model photo save is working
                    $phinput = AnnouncementsPhotos::where(AnnouncementsID, $request->AnnouncementsID)
                                                    ->first(); 
                    if( isset($phinput)  ){
                            $uri = '/images/announcements/';
                            $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                            $phinput['Photo'] = $uri.$name;
                            $request->Photo->move(public_path('images/announcements'), $name);
                            $phinput->Createdby = Auth::user()->id;  
                            $phinput->CreatedOn = date('Y-m-d'); 
                            
                            //AnnouncementsID is already set. No need to again do it This is update only.
                            $phinput->save();
                    }
                }

                //Storing the Videos
                 if ($request->get('Video') != null)
                 {
                    $vidinput =  AnnouncementsVideos::where(AnnouncementsID,$request->AnnouncementsID)->first(); 
                    $uri = '/images/announcements/video/';
                    $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                    $vidinput['Video'] = $uri.$name;
                    $request->Video->move(public_path('images/announcements/video/'), $name);
                    
                    $vidinput->save();
                 }
 
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('announcements.index')
                             ->with('success',Lang::get('home.announce_update_success'));
                        //->with('success','Announcement updated successfully.');
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('AnnouncementsController:update:  Exception while updating announcement ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('announcements.index')
                                    ->with('message',Lang::get('home.announce_update_error'));
                                        //   ->with('message','Unable to update Announcement due to error');
            }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            // add code to Log exception and not throw Exception
            DB::rollback();
            Log::info('AnnouncementsController:update:  Exception while updating announcement ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return redirect()->route('announcements.index')
            ->with('message',Lang::get('home.announce_update_exp'));
                    //->with('message','Unable to update Announcement due to Exception');
        }
   
    }

   
    //added by Aruna
     /**
     * Delete the specified resource.
     *
     * @param  \App\Announcments\  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($AnnouncementsID)
    {

        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        // try...catch
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
                    return redirect()->route('announcements.index')
                     ->with('success',Lang::get('home.announce_del_success'));
                    //->with('success','Announcement deleted successfully.');
              } 
              else {
                DB::rollback();
                //throw new Exception;
                Log::info('AnnouncementsController:Delete:  Exception while deleting announcement ',(array)$exception);
                //Aruna- there is a difference between returning view and calling back the index method
                // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                return redirect()->route('announcements.index')
                                        ->with('message',Lang::get('home.announce_del_error'));
                                    // ->with('message','Unable to delete Announcement due to error');
              }
        
        }
        catch(Exception $e) {
            //throw new Exception;
            // add code to Log exception and not throw Exception
            DB::rollback();
            Log::info('AnnouncementsController:Delete:  Exception while updating announcement ',(array)$e);
            //Aruna- there is a difference between returning view and calling back the index method
            // Here we are calling back the index method of Controller so that it fetches data and returns view with content
            return redirect()->route('announcements.index')
                     ->with('message',Lang::get('home.announce_del_exp'));
                   // ->with('message','Unable to delete Announcement due to Exception');
       }

    }
}
