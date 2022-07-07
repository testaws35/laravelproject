<?php


// classname - TempleMasterController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the first page before Login
// created date - Nov 2019


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TempleMaster;
use DB;
use Auth;
use Lang;

class TempleMasterController extends Controller
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
       $temples = TempleMaster::orderBy('CreatedOn', 'desc')->paginate(3);
       return view('pages.community',compact('temples')); 
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

        return view('temples.create');
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

                          'Temple_Name' => 'required',
                          'Temple_Head' => 'required',
                          'Temple_OwnedBy_Subsect' => 'required',
                          'Temple_SharedWith_Anyone' => 'required',
                          'Temple_Location'   => 'required',
                          'Temple_Description' => 'required',
                          'Temple_StartedOn'   => 'required',
                          'Temple_Address'   => 'required',
   
                      ]);
              
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
                if(isset($request->Temple_Photo)){

                    $uri = '/images/templephotos/';
                    $namewithextension = $request->Temple_Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Temple_Photo->getClientOriginalExtension();
                    $input['Temple_Photo'] = $uri.$name;
                    $request->Temple_Photo->move(public_path('images/templephotos'), $name);
                }

                $input->Temple_Status =1;  
                $input->Createdby =Auth::user()->id;  
                $input->CreatedOn = date('Y-m-d');
               
                $input->save();
             }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    return redirect()->route('temples.index')
                                ->with('success',Lang::get('home.success_msg'));
                }
                else {
                    DB::rollback();
                    Log::info('TempleMasterController:update:  Exception while updating Temple details ',(array)$exception);
                    return redirect()->route('temples.index')
                                ->with('warning',Lang::get('home.fail_msg'));
                }
            
            }
            catch(Exception $e) {
                //throw new Exception;
                DB::rollback();
                Log::info('TempleMasterController:update:  Exception while updating Temple details ',(array)$exception);
                return redirect()->route('temples.index')
                            ->with('warning',Lang::get('home.fail_msg'));
            }
       
	     

    }


   /**
     * Display the specified resource.
     *
     * @param  \App\TempleMaster  $sangam
     * @return \Illuminate\Http\Response
     * 
     */

    public function show($TempleID)
    {
         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
          }
          $temples = TempleMaster::orderBy('CreatedOn', 'desc')->paginate(10);
          /*$temple = TempleMaster::find($TempleID);*/
          
          $temple =  DB::table('temple_master')
                        ->leftjoin('users','users.id', '=','temple_master.Createdby')
                        ->select('TempleID', 'Temple_Name', 'Temple_Head', 'Temple_OwnedBy_Subsect', 'Temple_SharedWith_Anyone', 'Temple_Location', 'Temple_Description', 'Temple_StartedOn', 'Temple_Status', 'Temple_Photo', 'Temple_Address', 'Temple_BusRoute', 'Temple_Nearby_City', 'CreatedOn', 'Createdby','users.name')
                        ->where('TempleID','=',$TempleID)
                        ->first();
          return view('temples.show',compact('temple', 'temples'));
    }


}
