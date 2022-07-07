<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SangamMaster;
use App\SangamMembers;
use DB;
use Auth;
use Lang;

// classname - SangamMasterController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Sangams for Admin User
// created date - Nov 2019



class SangamMasterController extends Controller
{
      
   /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
         }
       
        $sangams = SangamMaster::paginate(3);
        return view('pages.community',compact('sangams'));

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

        return view('sangams.create');
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

                //checking whether the user is an sangam member
                $sangam = DB::table('sangam_member_master')
                            ->join('sangam_master','sangam_master.SangamID','=','sangam_member_master.SangamID')
                            ->select('sangam_member_master.SangamID','sangam_master.Sangam_Name')
                            ->where('sangam_member_master.UserID',Auth::user()->id)
                            ->first();
             
                // Storing the Meeting Details
                
                if( isset($sangam) && (count($sangam)>0)   && ($sangam->SangamID >0))
                {

                            // Storing the Sangam Details
            				
                            $input =  new SangamMaster;
                            $input->Sangam_Name = $request->get('Sangam_Name');
                            $input->Sangam_Location = $request->get('Sangam_Location');
                            $input->Sangam_Description = $request->get('Sangam_Description');
                            $input->Sangam_StartedOn = $request->get('Sangam_StartedOn');
            
                            if($request->Sangam_Photo!= null){
            
                                $uri = '/images/sangamphotos/';
                                $namewithextension = $request->Sangam_Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                                $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                                $name = $name.'_'.time().'.'.$request->Sangam_Photo->getClientOriginalExtension();
                                $input['Sangam_Photo'] = $uri.$name;
                                $request->Sangam_Photo->move(public_path('images/sangamphotos'), $name);
            
            
                               
                            }
                            $input->Num_of_members = $request->get('Num_of_members');
                            $input->Sangam_Activities = $request->get('Sangam_Activities');
                            $input->Sangam_Status =1;
                            $input->Createdby = Auth::user()->id;  // please repleace this with userid of session
                            $input->CreatedOn = date('Y-m-d');
                            $input->save();
                            
                            $members = new SangamMembers;
                            $members->SangamID = $input->SangamID;
                            $members->UserID = Auth::user()->id;
                            $members->Position = "admin";
                            $members->MembersFromWhen = date('Y-m-d');
                            $members->MembershipType = "Permanent";
                            $members->Status = 1;
                            $members->Createdby = Auth::user()->id;  // please repleace this with userid of session
                            $members->CreatedOn = date('Y-m-d');
                            $members->created_at = date('Y-m-d');
                            $members->save();
                }
                else
                {
                     $msg = Lang::get('home.sangam.create_error');
                     return redirect()->route('sangams.index')
                          ->with('error',$msg);
                }            
                                
                    
                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                   
                }
                else {
                    DB::rollback();
                    //throw new Exception;
                    Log::info('SangamMasterController:Create:  Exception while creating Sangam',(array)$exception);
                    $msg = Lang::get('home.sangam.create_dberror');
	                return redirect()->route('sangams.index')
                       ->with('error',$msg);
                }
            
            }
            catch(Exception $e) {
               DB::rollback();
               // throw new Exception;
               Log::info('SangamMasterController:Create:  Exception while creating Sangam',(array)$exception);
               $msg = Lang::get('home.sangam.create_dberror');
	            return redirect()->route('sangams.index')
                       ->with('error',$msg);
            }
            $msg = Lang::get('validation.sangam.create_success');
	        return redirect()->route('sangams.index')
                       ->with('success',$msg);

    }

  /**
     * Display the specified resource.
     *
     * @param  \App\SangamMaster  $sangam
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function show($SangamID)
    {

          //Check for Session time out and redirect to Login page on Session time out 
          if ( ! Auth::check()){
            return view('auth.SessionTimeout');
          }
          $sangams = SangamMaster::get();

          $members = DB::table('sangam_member_master')
                  ->leftjoin('sangam_master', 'sangam_master.SangamID', '=', 'sangam_member_master.SangamID')
                  ->leftjoin('users','users.id', '=', 'sangam_member_master.UserID')
                    
                  ->select('sangam_member_master.SangamMemberID','sangam_master.Sangam_Name','users.name','users.id as id' ,'users.User_photo', 'sangam_member_master.Position','sangam_member_master.MembersFromWhen','sangam_member_master.MembershipType')
                  ->where('Status', '1')
                  ->where('sangam_member_master.SangamID',$SangamID)
                  ->orderby('users.name','ASC')
                  ->get();

          $sangam = DB::table('sangam_master')
                        ->leftjoin('users','users.id', '=','sangam_master.Createdby')
                        ->select('SangamID','Sangam_Name', 'Sangam_Location', 'Sangam_Description', 'Sangam_StartedOn', 'Sangam_Status', 'Sangam_Photo', 'Num_of_members','Sangam_Activities', 'Createdby', 'CreatedOn','users.name')
                        ->where('SangamID','=',$SangamID)
                        ->first();
                        
                       
          return view('sangams.show',compact('sangam', 'sangams','members'));

    }
   
}
