<?php

// classname - SangamMeetingsController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages Sangam meetings feature
// created date - Nov 2019

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\SangamMeetings;
use App\SangamMeetingPhotos;
use App\SangamMeetingVideos;

use DB;
use Image;
use Auth;
use Log;
use Lang;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class SangamMeetingsController extends Controller
{

    /**
     * Display a listing of the resource.
     * sangammeetings folder name and variablename
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
            $sangam_mem = DB::table('sangam_member_master')
                            ->join('sangam_master','sangam_master.SangamID','=','sangam_member_master.SangamID')
                            ->select('sangam_member_master.UserID')
                            ->where('sangam_member_master.UserID',Auth::user()->id)
                            ->first();
                        
            $sangams = DB::table('sangam_master')
                        ->select('sangam_master.SangamID','sangam_master.Sangam_Name')
                        ->where('Sangam_Status', '1')
                        ->orderby('sangam_master.Sangam_Name','ASC')
                        ->get();
            
            if (!isset($request->sangamid) )
            {
                        $sangammeetings = DB::table('sangam_meetings')
                                            // Aruna- we have used left join so that whether photo is available or not Announcements will be got
                                            //for index show only photos
                                            ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                                            ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo')
                                            ->where('Status', '1')
                                            ->whereYear('sangam_meetings.CreatedOn','=',$currentYear)
                                            ->whereMonth('sangam_meetings.CreatedOn','=',$currentMonth)
                                            ->orderby('sangam_meetings.MeetingDate','DESC')
                                            ->get();
  
                        if ( isset($sangammeetings) && (count($sangammeetings) >0)  ){
                            $Failed=null;
                        }
                        else{
                                $sangammeetings = null;
                                $Failed=Lang::get('home.sangam_failed').$currentMonthName. ' , '.$currentYear;
                         }
             }
             else{
                
                $sangammeetings = DB::table('sangam_meetings')
                                 // Aruna- we have used left join so that whether photo is available or not Announcements will be got
                                 //for index show only photos
                                ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                                ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo')
                                ->where('Status', '1')
                                ->where('sangam_meetings.SangamID',$request->sangamid)
                                ->orderby('sangam_meetings.MeetingDate','DESC')
                                ->get();
                $sangamname = DB::table('sangam_master')
                                    ->select('sangam_master.Sangam_Name')
                                    ->where('SangamID', $request->sangamid)
                                    ->orderby('sangam_master.Sangam_Name','ASC')
                                    ->first();
                
                if ( isset($sangammeetings) && (count($sangammeetings) >0)  ){
                     $Failed= null;
                }
                else{
                    $sangammeetings =null;
                   
                    $Failed=Lang::get('home.sangam_failed').$sangamname->Sangam_Name;
                }
            }
 
       return view('sangammeetings.index',compact('sangammeetings', 'sangams','sangam_mem','Failed','currentMonthName','currentYear','sangamname'));
      
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
        return view('sangammeetings.create');
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

                $sangam = DB::table('sangam_member_master')
                            ->join('sangam_master','sangam_master.SangamID','=','sangam_member_master.SangamID')
                            ->select('sangam_member_master.SangamID','sangam_master.Sangam_Name')
                            ->where('sangam_member_master.UserID',Auth::user()->id)
                            ->first();
                // Storing the Meeting Details
                
                if( isset($sangam)   && ($sangam->SangamID >0))
                {
				
                            $input =  new SangamMeetings;
                            $input->Title = $request->Title;
                            $input->Meeting_Content = $request->Meeting_Content;
                            $input->MeetingDate = $request->MeetingDate;
                            $input->SangamID  = $sangam->SangamID;//Aruna - storing the Sangam id in which Session user is a member- expecting user to be member of one sangam only
                            $input->Status ='1';
                            $input->Post_Status = ' 1';
                            $input->Createdby = Auth::user()->id;  // please repleace this with userid of session
                            $input->CreatedOn = date('Y-m-d');
            
                            $input->save();
                        
                            //Aruna: The below single line gets th ID of the saved record
                            $lastid =   $input-> SangamMeetingID;  
                            // echo 'lastid'.$lastid;
            
                            //Storing the Photos
                            if($request->Photo !=null)
                            {
                                $phinput =  new SangamMeetingPhotos;
                                $phinput->SangamMeetingID = $lastid;
                                
                                $uri = '/images/sangammeetings/';
                                $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                                $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                                $phinput['Photo'] = $uri.$name;
                                $request->Photo->move(public_path('images/sangammeetings'), $name);
            
                                $phinput->Createdby = Auth::user()->id; 
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
            
                                $vidinput->Createdby =  Auth::user()->id;;  
                                $vidinput->CreatedOn = date('Y-m-d');
                                $vidinput->save();
                            }
                    
                    
                }
                else
                {
                     return redirect()->route('sangammeetings.index')
                    ->with('message',Lang::get('home.sangam_add_mem_error'));
                }

                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                     //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return redirect()->route('sangammeetings.index')
                        ->with('success',Lang::get('home.success_msg'));
                   
                } else {
                    DB::rollback();
                   // throw new Exception;
                    //Log 
                    Log::info('SangamMeetingsController:Store:  Exception while adding meeting ',(array)$exception);
                    return redirect()->route('sangammeetings.index')
                        ->with('message',Lang::get('home.fail_msg'));
                }
            
            }
            catch(Exception $e) {
               // throw new Exception;
                //Log 
                Log::info('SangamMeetingsController:Store:  Exception while adding meeting ',(array)$e);
                return redirect()->route('sangammeetings.index')
                        ->with('message',Lang::get('home.fail_msg'));
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
  
    public function show($SangamMeetingID)
    {

         //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

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
                return view('sangammeetings.show',compact('sangammeeting', 'sangammeetings'));
            }
            else{
                $sangammeeting = null;
                return view('sangammeetings.show',compact('sangammeeting', 'sangammeetings'))
                             ->with('Failed',Lang::get('home.sangam_meeting_warning'));
            }

    }
    else
    {
        $sangammeeting = null;
        return view('sangammeetings.show',compact('sangammeeting', 'sangammeetings'))
                     ->with('Failed',Lang::get('home.sangam_meetingid_null'));
    }

}
   


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SangamMeetingPhotos  $sangammeeting
     * @return \Illuminate\Http\Response
     */

    public function edit($SangamMeetingID)
    {
         //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }

        /*$sangammeeting = SangamMeetings::find($SangamMeetingID);
        return view('sangammeetings.edit',compact('sangammeeting'));*/

          //Aruna added - SinceSangamMeetings can have photos and videos we are doing left join
        // so that even if vidoes and photos are not there too, SangamMeetings must be provided
        $sangammeeting = DB::table('sangam_meetings')
                            ->leftjoin('sangam_meeting_photos', 'sangam_meetings.SangamMeetingID', '=', 'sangam_meeting_photos.SangamMeetingID')
                            ->leftjoin('sangammeeting_videos', 'sangam_meetings.SangamMeetingID', '=', 'sangammeeting_videos.SangamMeetingID')
                            ->select('sangam_meetings.SangamMeetingID','sangam_meetings.Title','sangam_meetings.Meeting_Content','sangam_meetings.MeetingDate','sangam_meeting_photos.Photo','sangammeeting_videos.Video')
                            ->where('sangam_meetings.SangamMeetingID', $SangamMeetingID)
                            ->first();

        return view('sangammeetings.edit',compact('sangammeeting'));
    }



   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SangamMeetingPhotos  $sangammeeting
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
                $input = SangamMeetings::find($request->SangamMeetingID);

                $input->Title = $request->Title;
                $input->Meeting_Content = $request->Description;
                $input->MeetingDate = $request->MeetingDate;
                $input->save();
               

                //Storing the Photos

                if( $request->Photo != null)
                {
                    $phinput =  SangamMeetingPhotos::where(SangamMeetingID,$request->SangamMeetingID)
                                ->first();
                                
                    if (isset($phinput)){

                            $uri = '/images/sangammeetings/';
                            $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                            $phinput['Photo'] = $uri.$name;
                            $request->Photo->move(public_path('images/sangammeetings'), $name);
                            $phinput->save();
                            
                    }
                }

                //Storing the Videos
                 if( $request->Video  != null)
                 {
                    $vidinput =   SangamMeetingVideos::where(SangamMeetingID,$request->SangamMeetingID)->first();
            
                            $uri ='/images/sangammeetings/video/';
                            $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                            $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                            $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                            $vidinput->Video = $uri.$name;
                            
                            $request->Video->move(public_path('images/sangammeetings/video/'), $name);
        
                            //$vidinput->save(); // Save is not working as where and first is breaking the Eloquent style. Hence using below update
                            DB::table('sangammeeting_videos')->where(SangamMeetingID,$request->SangamMeetingID)->update(['Video'=>$uri.$name] );
                    
                 }
                 
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                   //Aruna . There is difference between calling a view and controller method
                    // To call view -> we use return view  and send objects using "compact" and variable using "with"
                    // To call a controller method we use redirect()-> route () and with to send additioanl message
                    return redirect()->route('sangammeetings.index')
                             ->with('success',Lang::get('home.updated_success'));
            
            } else {
                DB::rollback();
                throw new Exception;
                Log::info('SangamMeetingsController:update:  Exception while updating meeting ',(array)$exception);
                return redirect()->route('sangammeetings.index')
                         ->with('warning',Lang::get('home.updated_fail'));
            }

        }
        catch(Exception $e) {
            throw new Exception;
            Log::info('SangamMeetingsController:update:  Exception while updating meeting ',(array)$e);
            return redirect()->route('sangammeetings.index')
                             ->with('warning',Lang::get('home.updated_fail'));
        }
    }
  



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SangamMeetingPhotos  $sangammeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy($SangamMeetingID)
    {

          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }

        //we are doing Soft delete only
        $sangammeeting = SangamMeetings::find($SangamMeetingID);
        if (isset($sangammeeting) )
        {
                $sangammeeting->Status='0';
                $sangammeeting->save();


                return redirect()->route('sangammeetings.index')
                                ->with('success',Lang::get('home.deletion_success'));
        }
        else{
                return redirect()->route('sangammeetings.index')
                                ->with('warning',Lang::get('home.deletion_fail'));
        }
    }





}
