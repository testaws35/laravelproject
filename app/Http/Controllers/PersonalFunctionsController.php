<?php

// classname - PersonalFunctionsController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the Personal Functions feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\PersonalFunctions;
use App\PersonalFunctionPhotos;
use App\PersonalFunctionVideos;

use DB;
use Image;
use Auth;
use Exception;
use Log;
use Lang;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class PersonalFunctionsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }



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
            if (isset($personalfunctions)  && count($personalfunctions) > 0 ){
                return view('personalfunctions.index',compact('personalfunctions','Failed','currentMonthName','currentYear', 'cat'))
                         ->with('i', (request()->input('page', 1) - 1) * 5);
            }
            else {
     
                 if (  isset($cat) ) {
                        $personalfunctions = null;
                        // we have to use . for concatenating Variable and + for concatenating a String constant
                        $Failed= Lang::get('home.personal_function_nodata') .$cat .Lang::get('category');
                 }
                 else{
                        $personalfunctions = null;
                        // we have to use . for concatenating Variable and + for concatenating a String constant
                        $Failed = Lang::get('home.personal_function_nodata').$currentMonthName. '  , ' .$currentYear;
                 }
                 return view('personalfunctions.index',compact('personalfunctions', 'Failed','currentMonthName','currentYear','cat'));
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
        return view('personalfunctions.create');
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

                // Storing the Meeting Details
				
                $input =  new PersonalFunctions;
                $input->Title = $request->get('Title');
                $input->Function_Content = $request->get('Function_Content');
                $input->FunctionDate = $request->get('FunctionDate');
                $input->UserID  = Auth::user()->id;
                $input->Status =1;
                $input->Post_Status = 1;
                $input->Category = $request->get('Category');
                $input->Createdby = Auth::user()->id;  
                $input->CreatedOn = date('Y-m-d');
                
                $input->save();
                
                //Storing the Photos
                if ($request->Photo  != null)
                {
    
                        //Aruna: The below single line gets th ID of the saved record 
                        $lastid =   $input->PersonalFunctionID;  

                        //Storing the Photos
                        $input =  new PersonalFunctionPhotos;
                        // we have to add the meetingid created in the above step
                        $input->PersonalFunctionID = $lastid;

                
                           /*  This was the original code
                        $input['Photo'] = time().'.'.$request->Photo->getClientOriginalExtension();
                        $request->Photo->move(public_path('images/personalfunctions'), $input['Photo']); */

                        // changed by Aruna
                        // To accomodate Mobile App requiement of having the whole path stored in DB and retrieved 
                        // the following changes are done
                        $uri = '/images/personalfunctions/';
                        $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                        $input['Photo'] = $uri.$name;
                        $request->Photo->move(public_path('images/personalfunctions'), $name);


                        $input->Createdby = Auth::user()->id;  
                        $input->CreatedOn = date('Y-m-d');
                            
                        $input->save();
                }

                //Storing the Videos
                 if ($request->Video  != null)
                 {
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
                    $input->Createdby = Auth::user()->id; 
                    $input->CreatedOn = date('Y-m-d');
                    $input->save();
                 }

                }); //end of transaction

                if(is_null($exception)) {
                    DB::commit();
                    //Aruna- there is a difference between returning view and calling back the index method
                    // Here we are calling back the index method of Controller so that it fetches data and returns view with content
                    return redirect()->route('personalfunctions.index')
                            ->with('success',Lang::get('home.personal_functions_create_success'));
                  
                } else {
                    DB::rollback();
                    //throw new Exception;
                     //Log 
                    Log::info('PersonalFunctionsController:Store:  Exception while adding function ',(array)$exception);
                    return redirect()->route('personalfunctions.index')
                                   ->with('warning',Lang::get('home.personal_functions_create_error'));
                }
            
            }
            catch(Exception $e) {
                //throw new Exception;
                DB::rollback();
                //Log 
                Log::info('PersonalFunctionsController:Store:  Exception while adding function ',(array)$e);
                return redirect()->route('personalfunctions.index')
                                  ->with('warning',Lang::get('home.personal_functions_create_error'));
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

    public function show($PersonalFunctionID)
    {
       
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
        }


       /* This is  needed for the Recent functions in Right side */
        $personalfunctions = DB::table('personal_functions')
                                ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
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
                    return view('personalfunctions.show',compact('personalfunction', 'personalfunctions'));
                }
                else{
                    $personalfunction = null;
                    return view('personalfunctions.show',compact('personalfunction', 'personalfunctions'))
                                 ->with('warning',Lang::get('home.personal_functions_missingfun'));
                }

        }
        else{
            $personalfunction = null;
            return view('personalfunctions.show',compact('personalfunction', 'personalfunctions'))
                         ->with('warning',Lang::get('home.personal_functions_missingfun')  );
        }

        
    }



   
    //added by Aruna
     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalFunction  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($PersonalFunctionID)
    {
         //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
          }

        //Aruna added - Since PersonalFunctions can have photos and videos we are doing left join
        // so that even if vidoes and photos are not there too, PersonalFunctions must be provided
        $personalFunction = DB::table('personal_functions')
                                        ->leftjoin('personal_function_photos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_photos.PersonalFunctionID')
                                        ->leftjoin('personal_function_videos', 'personal_functions.PersonalFunctionID', '=', 'personal_function_videos.PersonalFunctionID')
                                        ->select('personal_functions.PersonalFunctionID','personal_functions.Title','personal_functions.Function_Content','personal_functions.Category','personal_functions.FunctionDate', 'personal_functions.Createdby','personal_function_photos.PersonalFunction_PhotosID', 'personal_function_photos.Photo','personal_function_videos.Video' )
                                        ->where('personal_functions.PersonalFunctionID',$PersonalFunctionID )
                                        ->first(); 
  
         return view('personalfunctions.edit',compact('personalFunction'));
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
                      return redirect()->route('personalfunctions.index')
                             ->with('error',Lang::get('home.personal_functions_missingfunc'));
                }
                //Storing the Photos
                if( $request->Photo != null)
                {
                    $phinput =  PersonalFunctionPhotos::where(PersonalFunctionID,$request->PersonalFunctionID)
                                     ->first();
                
                    
                    //Aruna - most important-   save() method can be applied on a variable which is pointing to Model objects only
                    //  Initially we have written raw query using DB::table.  That time Photo->save was not working
                    // After changing to Eloquent syntax of representing model photo save is working
                    if (isset($phinput)){

                        // changed by Aruna
                        // To accomodate Mobile App requiement of having the whole path stored in DB and retrieved 
                        // the following changes are done
                        $uri = '/images/personalfunctions/';
                        $namewithextension = $request->Photo->getClientOriginalName(); //Name with extension 'filename.jpg'
                        $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                        $name = $name.'_'.time().'.'.$request->Photo->getClientOriginalExtension();
                        $phinput['Photo'] = $uri.$name;
                        $request->Photo->move(public_path('images/personalfunctions'), $name);


                        $phinput->Createdby = Auth::user()->id;  
                        $phinput->CreatedOn = date('Y-m-d');
                            
                        // we have to add the meetingid created in the above step
                        $phinput->save();
                    }
                }

                //Storing the Videos
                 if ($request->Video != null)
                 {

                    $vidinput =  PersonalFunctionVideos::where(PersonalFunctionID,$request->PersonalFunctionID) ->first(); 
                    $uri = '/images/personalfunctions/video/';
                    $namewithextension = $request->Video->getClientOriginalName(); //Name with extension 'filename.jpg'
                    $name = explode('.', $namewithextension)[0]; // Filename 'filename'
                    $name = $name.'_'.time().'.'.$request->Video->getClientOriginalExtension();
                    $vidinput['Video'] = $uri.$name;
                    $request->Video->move(public_path('images/personalfunctions/video/'), $name);
                    $vidinput->save();

                 }
            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return redirect()->route('personalfunctions.index')
                             ->with('success',Lang::get('home.personal_functions_update_success'));
               
            } else {
                DB::rollback();
                //throw new Exception;
                Log::info('PersonalFunctionsController:update:  Exception while updating personal functions ',(array)$exception);
                return redirect()->route('personalfunctions.index')
                           ->with('warning',Lang::get('home.personal_functions_update_error'));
            }
        
        }
        catch(Exception $e) {
            // throw new Exception;
            DB::rollback();
            Log::info('PersonalFunctionsController:update:  Exception while updating personal functions ',(array)$e);
            return redirect()->route('personalfunctions.index')
                         ->with('warning',Lang::get('home.personal_functions_update_error'));
        }
   }




    //added by Aruna
     /**
     * Delete the specified resource.
     *
     * @param  \App\PersonalFunctions\  $personalfuncton
     * @return \Illuminate\Http\Response
     */
    public function destroy($PersonalFunctionID)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
        return view('auth.SessionTimeout');
        }
        
        // try...catch
        try {
            // Transaction
             $exception = DB::transaction(function()use ($PersonalFunctionID) {
           
                            
                $personalfunctionVideo = PersonalFunctionVideos::where('PersonalFunctionID',$PersonalFunctionID);
                $personalfunction= PersonalFunctions::where('PersonalFunctionID','=',$PersonalFunctionID);
                $personalfunctionPhoto = PersonalFunctionPhotos::where('PersonalFunctionID',$PersonalFunctionID);

                if (isset($personalfunctionPhoto))
                {

                        if(isset($personalfunction))
                        {
                            $personalfunction = PersonalFunctions::where('PersonalFunctionID','=',$PersonalFunctionID)->update(['Status'=>0]);
                           
                            
                            
                           /* if (isset($personalfunctionPhoto))
                            {
                                $personalfunctionPhoto = PersonalFunctionPhotos::where('PersonalFunctionID',$PersonalFunctionID)->update(['Status'=>0]);
                                   
                            }
                           if (isset($personalfunctionVideo))
                            {
                                   $personalfunctionVideo->Status =0;
                                   $personalfunctionVideo->save();
                            }*/
                        }
                        else
                        {
                            return redirect()->route('personalfunctions.index')
                            ->with('warning',Lang::get('home.personal_functions_missingfunc'));
                        }
                
                }
                else
                {
                    return redirect()->route('personalfunctions.index')
                    ->with('warning',Lang::get('home.personal_functions_delphoto_error'));
                }

            }); //end of transaction

            if(is_null($exception)) {
                DB::commit();
                return redirect()->route('personalfunctions.index')
                             ->with('success',Lang::get('home.personal_functions_delphoto_success') );
               
            } else {
                DB::rollback();
                //throw new Exception($exception->getMessage(), $exception->getCode(), $exception) ;
                Log::info('PersonalFunctuonsController:update:  Exception while updating personal functions ',(array)$exception);
                return redirect()->route('personalfunctions.index')
                           ->with('warning',Lang::get('home.personal_functions_delphoto_dberror'));
            }
        
        }
        catch(Exception $e) {
            //Aruna - exception handling is pending
            //throw new Exception($e->getMessage(), $e->getCode(), $e);
            
            Log::info('PersonalFunctuonsController:update:  Exception while updating personal functions ',(array)$e);
            return redirect()->route('personalfunctions.index')
                         ->with('warning',Lang::get('home.personal_functions_delphoto_dberror'));
        }
   }

}
