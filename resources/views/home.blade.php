@extends('layouts.app1')
@section('content')

<!--{{-- /**
// classname - Home.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This blade represents the Home page after login
// created date - Nov 2019
**/ --}} -->

<style>
    .viewall{
        margin-top:-63px;
    }
    .allcards{
         margin-top:50px !important;
    }
    a .btn{
        font-size:14px!important;
    }
    button{
        font-size:14px!important;
    }
    .btn{
        font-size:14px!important;
    }
</style>
<link rel="stylesheet" href="{{ asset('css/home.css') }}" />

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
        
      <!--WELCOME CSS in app1.blade.php -->
    <div class="container homeprofile-page">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class=" homeprofile-header">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-12">
                        
                                        <h4 class="text-left" style="font-family: 'Sen', sans-serif;"> @lang('home.welcome_head') <b style="font-family: 'Sen', sans-serif;">{{  auth()->user()->name }}!</b>
                                         <span class="pull-right home_icons"  style="font-family: 'Sen', sans-serif;font-size: 12px;"> 
                                                @if(Auth::user()->IsElder == 1)
                                                <img src="/images/frontend_images/icons/glasses-solid.svg" alt="You are Elder" title="You are Elder" style="width:20px;height:20px;"/>
                                                @endif
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                @if(Auth::user()->IsSeller == 1)
                                                <img src="/images/frontend_images/icons/cart-plus-solid.svg" alt="You are Seller" title="You are Seller" style="width:20px;height:20px;"/>
                                                @endif
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                @if(Auth::user()->IsSangamMember == 1)
                                                <img src="/images/frontend_images/icons/landmark-solid.svg" alt="You are Sangam Member" title="You are Sangam Member" style="width:20px;height:20px;"/>
                                                @endif
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                @if(Auth::user()->IsTempleMember == 1)
                                                 <img src="/images/frontend_images/icons/gopuram-solid.svg" alt="You are Temple Member" title="You are Temple Member" style="width:20px;height:20px;"/>
                                                @endif
                                            </span> </b> 
                                       </h4>
                                </div><br/><!--end inner row-->
                                <br/>
                            </div><!-- end col-lg-12--> 
                        </div><!-- end first row-->
                    </div>                    
                </div>
            </div>
    </div>
</div><br/>   <!--END WELCOME CSS in app1.blade.php -->
    



        <main>
        <!-- DIV START SEARCH CONTAINER  -->
        <div class="container home_searchcard">
                <div class="row"> <!--justify-content-center    -->
                                <div class="col-md-12 col-sm-12 col-xl-12">
                                    <form class="card  home_searchcard card-sm" class="form-horizontal" method="GET" action="{{route('search')}}" enctype="multipart/form-data">
                                        <div class="card-body row no-gutters align-items-center">
                                           
                                            <!--end of col-->
                                            <div class="col-md-10 col-sm-10 col-xl-10">
                                                <input class="form-control" type="search" id="key" name="key" placeholder="@lang('home.search_placeholder')">
                                               
                                            </div>
                                            <!--end of col-->
                                            <div class="col-md-2 col-sm-2 col-xl-2">
                                                <button class="btn btn-lg" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:50px;border-top-left-radius:50px;" type="submit"> @lang('home.search_button')</button>
                                            </div>
                                            <!--end of col-->
                                        </div>
                                        <!--Aruna added csrf_token()  is necessary to pass data between HTML and PHP -->
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        
                                    </form>
                                    </div>
                                <!--end of col-->
                            </div>
            </div><!--DIV End SEARCH Container  -->

            <!--MDB Cards-->
            <div class="container home_templecard">
         
                                     <div class="text-center darken-grey-text"> 
                                            <h1 class="font-bold text-center text-uppercase home_temptitle" >@lang('home.head_temple_functions')  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                            </h1>
                                     </div>   
                        
                            <div class="ml-auto d-flex justify-content-end viewall">
                                <a href="{{ route('templefunctions.index') }}" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"><i class="fa fa-eye fa-1x"></i>@lang('home.temple_functions_view_btn')</a>
                            </div>

                        <!--START  Temple functions Grid row -->
                         <div class="row homecard">
                                <!-- Aruna added - the different Table values fetched by the controller is 
                                    accessed in php foreach loop as $var 
                                    If Controller send array of objects or records then foreach loop is needed
                                    If Controller sends single object directly use the object as $var 
                                    Each field in a record/oject is accessed using ->
                                    $object->fieldname eg: $templefunction->TempleFunctionID
                                    Controller sends only top 3 values which we show in this view


                                -->
                                

                                @if (isset($templefunctions) && count($templefunctions) >0)
                                            @foreach ($templefunctions as $templefunction)
                                                <!-- Grid column -->
                                                <div class="col-lg-4 col-md-12 mb-4 home_mrgbetweencardmob" >                                              
                                                <a href="{{ route('templefunctions.show',$templefunction->TempleFunctionID) }}">

                                                    <!--Card-->
                                                    <div class="card allcards">
                
                                                        <!--Card image-->

                                                        <div class="view overlay hm-white-slight  card-home-header-image">
                                                            <!-- Aruna added - giving route in href helps to navigate using web.php routes 
                                                            All php code should be enclosed in double brackets{} in HTML-->
                                                            @if($templefunction->Photo != '')
                                                                <img src="{{ $templefunction->Photo }}" alt="photo">
                                                            @elseif($templefunction->Video != '')
                                                                <video width="340" height="215" controls>
                                                                    <source src="{{ $templefunction->Video }}" type="video/mp4">
                                                                </video>
                                                            @else
                                                               <img src="/images/No-image2.png" alt="photo">
                                                            @endif
                                                            
                                                        </div>
                                                   
                
                                                        <!--Card content-->
                                                        <div class="card-body mytable">
                                                            <!--Title-->
                                                            <h4 class="card-title indigo-text">{{ $templefunction->Title }}</h4>
                                                            <!--Text-->
                                                            <p class="card-text" style="font-family: 'Sen', sans-serif;color:#009688 !important;">{{ $templefunction->Function_Content }}</p>
                                                                <!--Aruna added-  calling a function in PHP controller class from HTML is using the route 
                                                                    tag which in turn refers the web.php to know which controller and which method to call
                                                                    You can pass parameters to PHP controller method too 
                                                                    eg: route('templefunctions.show',$templefunction->TempleFunctionID) 
                                                                    Templefunctions.show is the route name which maps to 
                                                                    Temple Controller class and show method in it. TempleFunctionID is the parameter passed-->
                                                                <a href="{{ route('templefunctions.show',$templefunction->TempleFunctionID) }}" class="btn waves-effect ml-0" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> @lang('home.temple_functions_readmore_btn')</a>
                                                            </p>
                                                        </div>
                
                                                    </div>   <!--/.Card-->
                                             </a>
                                
                                        </div>  
                                        <!-- Grid column -->
                                        @endforeach
                                @else
                                         @if(Auth::user()->IsTempleMember == 1)
                                         
                                                <!-- Grid column -->
                                                <br/>
                                                <div class="row">
                                                        <div class="col-lg-9 col-md-9 " style="margin-top:10px;" >
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 " style="margin-top:10px;">
                                                            <a href="{{url('/templefunctions/create') }}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> Share Temple Function Details </a>
                                                        </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 mb-4" style="margin-top:10px;">
                                                    <h6 class="card-title indigo-text"  style="text-align:center"> @lang('home.error_temple_functions') </h6>
                                                </div>
                                         @else
                                                <!-- Grid column -->
                                                <br/>
                                                <div class="col-lg-12 col-md-12 mb-4" style="margin-top:10px;">
                                                    <h6 class="card-title indigo-text"  style="text-align:center"> @lang('home.error_temple_functions') </h6>
                                                </div>
                                         @endif
                                @endif
               
                    </div>   
                    </br>
                    </br>
                    <!--END temple functions Grid Events row -->
                    <div class="text-center darken-grey-text home_annoucard"> 
                            <h1 class="font-bold text-center text-uppercase home_temptitle" >@lang('home.head_announcements')  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <!--<a href="{{url('/announcements') }}" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> View All   
                            </a> -->
                            </h1>
                    </div> 

                <div class="ml-auto d-flex justify-content-end viewall">
                    <a href="{{url('/announcements') }}" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> @lang('home.temple_functions_view_btn')   
                            </a>
                </div>

                    <!--START  announcements row style="margin-top:-100px;" -->
                    <div class="row homecard">   
                            @if (isset($announcements) && count($announcements) >0 )
                                    @foreach ($announcements as $announcement)
                                        <!-- Grid column -->
                                        <div class="col-lg-4 col-md-12 mb-4 home_mrgbetweencardmob">
                                            <a href="{{ route('announcements.show',$announcement->AnnouncementsID) }}">
                                                <!--Card-->
                                                <div class="card allcards">

                                                    <!--Card image-->
                                                    <div class="view overlay hm-white-slight  card-home-header-image">
                                                        <!-- Aruna added - giving route in href helps to navigate using web.php routes 
                                                        All php code should be enclosed in double brackets{} in HTML-->
                                                        @if(($announcement->Photo != '') || ($announcement->Photo != null))
                                                            <img src="{{$announcement->Photo}}" alt="photo">
                                                        @elseif($announcement->Video != '')
                                                             <video width="340" height="215" controls>
                                                                <source src="{{ $announcement->Video }}" type="video/mp4">
                                                            </video>
                                                        @else
                                                           <img src="/images/No-image2.png" alt="photo">
                                                        @endif
                                                    </div>

                                                    <!--Card content-->
                                                    <div class="card-body mytable">
                                                        <!--Title-->
                                                        <h4 class="card-title indigo-text">{{ $announcement->Title }}</h4>
                                                        <!--Text-->
                                                        <p class="card-text" style="font-family: 'Sen', sans-serif;">{{ $announcement->Function_Content }}</p>
                                                        <!-- Aruna added - giving route in href helps to navigate using web.php routes 
                                                        All php code should be enclosed in double brackets{} in HTML-->
                                                        <a href="{{ route('announcements.show',$announcement->AnnouncementsID) }}" class="btn waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> @lang('home.temple_functions_readmore_btn') </a>
                                                        <!-- <a href="{{url('/announcements') }}" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> View All   
                                                         </a> -->
                                                    </div>

                                                </div>
                                                <!--/.Card-->
                                            </a>
                                        </div>
                                        <!-- Grid column -->
                                        @endforeach
                                @else
                                         <!-- Grid column -->
                                         <br/>
                                         <div class="row">
                                                <div class="col-lg-9 col-md-9 " style="margin-top:10px;" >
                                                </div>
                                                <div class="col-lg-3 col-md-3 " style="margin-top:10px;">
                                                     <a href="{{url('/announcements/create') }}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> Make an announcement </a>
                                                </div>
                                        </div>
                                         <div class="col-lg-12 col-md-12 mb-4" style="margin-top:10px;">
                                               <h6 class="card-title indigo-text"  style="text-align:center"> @lang('home.error_announcements') </h6>
                                         </div>
                                @endif
            
                    </div>
                    </br>
                    </br>
                    <!--END Announcements row -->
                    <div class="text-center darken-grey-text home_meetingcard"> 
                            <h1 class="font-bold text-center text-uppercase home_temptitle" >@lang('home.head_sangam_meetings') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            
                            <!--<a href="{{url('/sangammeetings') }}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> View All  </a> -->
                            </h1>
                    </div>
                    <div class="ml-auto d-flex justify-content-end viewall">
                        <a href="{{url('/sangammeetings') }}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> @lang('home.temple_functions_view_btn')  </a>
                    </div>
                    <!--START  Sangam Meetings row style="margin-top:-100px;" -->
                    <div class="row homecard">
                            @if (isset($sangammeetings) && count($sangammeetings) >0 )
                                    @foreach ($sangammeetings as $sangammeeting)
                                        <!-- Grid column -->
                                        <div class="col-lg-4 col-md-12 mb-4 home_mrgbetweencardmob">
                                            
                                            <!--Card-->
                                            <a href="{{ route('sangammeetings.show',$sangammeeting->SangamMeetingID) }}">
                                                <div class="card allcards">

                                                        <!--Card image-->
                                                        <div class="view overlay hm-white-slight  card-home-header-image">                                  
                                                                @if(($sangammeeting->Photo != '') || ($sangammeeting->Photo != null))
                                                                    <img src="{{$sangammeeting->Photo}}" alt="photo">
                                                                @elseif($sangammeeting->Video != '')
                                                                     <video width="340" height="215" controls>
                                                                        <source src="{{ $sangammeeting->Video }}" type="video/mp4">
                                                                    </video>
                                                                @else
                                                                   <img src="/images/No-image2.png" alt="photo">
                                                                @endif
                                                        </div>

                                                        <!--Card content-->
                                                        <div class="card-body mytable">
                                                            <!--Title-->
                                                            <h4 class="card-title indigo-text">{{ $sangammeeting->Title }}</h4>
                                                            <!--Text-->
                                                            <p class="card-text" style="font-family: 'Sen', sans-serif;">{{ $sangammeeting->Meeting_Content }}</p>
                                                            <a href="{{ route('sangammeetings.show',$sangammeeting->SangamMeetingID) }}" class="btn waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> @lang('home.temple_functions_readmore_btn')</a>
                                                           <!-- <a href="{{url('/sangammeetings') }}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> View All  </a> -->
                                                        </div>

                                            </div>
                                            <!--/.Card-->
                                            </a>
                    
                                        </div>
                                        <!-- Grid column -->
                                        @endforeach
                             @else
                                        @if(Auth::user()->IsSangamMember == 1)
                                                <!-- Grid column -->
                                                <br/>
                                                <div class="row">
                                                        <div class="col-lg-9 col-md-9 " style="margin-top:10px;" >
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 " style="margin-top:10px;">
                                                            <a href="{{url('/sangammeetings/create') }}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> Publish Sangam Meetings </a>
                                                        </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 mb-4" style="margin-top:10px;">
                                                    <h6 class="card-title indigo-text"  style="text-align:center"> @lang('home.error_sangam_meetings') </h6>
                                                </div>
                                         @else
                                                <!-- Grid column -->
                                                <br/>
                                                <div class="col-lg-12 col-md-12 mb-4" style="margin-top:10px;">
                                                    <h6 class="card-title indigo-text"  style="text-align:center"> @lang('home.error_sangam_meetings')</h6>
                                                </div>
                                         @endif
                                @endif
              
            
                    </div>
                    <!--END Sangam Meetings row -->
                    </br>
                    </br>

                    <div class="text-center darken-grey-text home_personalcard"> 
                            <h1 class="font-bold text-center text-uppercase home_temptitle">@lang('home.head_personal_functions') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!--<a href="{{url('/personalfunctions')}}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> View All
                            </a> -->
                            </h1>
                    </div> 
                    <div class="ml-auto d-flex justify-content-end viewall">
                        <a href="{{url('/personalfunctions')}}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> @lang('home.temple_functions_view_btn')
                            </a>
                    </div>
                       <!--START  Personal Functions row style="margin-top:-100px;"-->
                   
                            <div class="row homecard" style="font-family: 'Sen', sans-serif;">
                            @if (isset($personalfunctions) && count($personalfunctions) >0 )
                                    @foreach ($personalfunctions as $personalfunction)
                                        <!-- Grid column -->
                                        <div class="col-lg-4 col-md-12 mb-4 home_mrgbetweencardmob">
                                            
                                            <!--Card-->
                                        <a href="{{ route('personalfunctions.show',$personalfunction->PersonalFunctionID) }}">
                                            <div class="card allcards">

                                                <!--Card image-->
                                                <div class="view overlay hm-white-slight  card-home-header-image">
                                                
                                                    @if(($personalfunction->Photo != '') || ($personalfunction->Photo != null))
                                                        <img src="{{$personalfunction->Photo}}" alt="photo">
                                                    @elseif($personalfunction->Video != '')
                                                         <video width="340" height="215" controls>
                                                            <source src="{{ $personalfunction->Video }}" type="video/mp4">
                                                        </video>
                                                    @else
                                                       <img src="/images/No-image2.png" alt="photo">
                                                    @endif
                                                </div>

                                                <!--Card content-->
                                                <div class="card-body mytable">
                                                    <!--Title-->
                                                    <h4 class="card-title indigo-text">{{ $personalfunction->Title }}</h4>
                                                    <!--Text-->
                                                    <p class="card-text" style="font-family: 'Sen', sans-serif;">{{ $personalfunction->Function_Content }}</p>
                                                    <a href="{{ route('personalfunctions.show',$personalfunction->PersonalFunctionID) }}" class="btn waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> @lang('home.temple_functions_readmore_btn')</a>
                                                    <!-- <a href="{{url('/personalfunctions')}}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> View All
                                                      </a> -->
                                                    
                                                    </div>

                                            </div>
                                            <!--/.Card-->
                                         </a>
                                    
                                        </div>
                                        <!-- Grid column -->
                                        @endforeach
                                @else
                                        <!-- Grid column -->
                                        <br/>
                                        <div class="row">
                                                <div class="col-lg-9 col-md-9 " style="margin-top:10px;" >
                                                </div>
                                                <div class="col-lg-3 col-md-3 " style="margin-top:10px;">
                                                     <a href="{{url('/personalfunctions/create') }}"  class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> <i class="fa fa-eye fa-1x"></i> Upload your functions </a>
                                                </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4" style="margin-top:10px;">
                                               <h6 class="card-title indigo-text"  style="text-align:center">@lang('home.error_personal_functions') </h6>
                                        </div>

                                @endif
                               
                    </div>   
                    <!--END Personal Functions row -->
                    </br>
                    </br>
                    @if (isset($newmembers) && count($newmembers) >0)
                    <div class="text-center darken-grey-text home_newmembercard"> 
                            <h1 class="font-bold text-center text-uppercase home_temptitle" >@lang('home.head_newmem')  </h1>
                    </div> 
                    @endif
                            <!--START  New User row style="margin-top:-100px;"-->
                            <div class="row homecard" >
                                @if (isset($newmembers) && count($newmembers) > 0)
                                    @foreach ($newmembers as $newmember)
                                        <!-- Grid column -->
                                        <div class="col-lg-4 col-md-12 mb-4 home_mrgbetweencardmob">
                                             <a href="{{ route('profile.index',$newmember->id) }}">
                                                        <!--Card-->
                                                        <div class="card allcards">
                                                            
                                                                    <!--Card image-->
                                                                    <div class="view overlay hm-white-slight  card-home-header-image">
                                                                            @if($newmember->User_photo)
                                                                                <img class="img-thumbnail" src="{{ $newmember->User_photo }}" >
                                                                            @else 
                                                                                <img class="img-thumbnail" src="/images/frontend_images/avatar.png" >
                                                                            @endif
                                                                    </div>
                                                        </div>

                                                        <!--Card content-->
                                                        <div class="card-body mytable">
                                                            <!--Title-->
                                                            <h4 class="card-title indigo-text">{{ $newmember->name }} </h4>
                                                            <!--Text-->
                                                            <p class="card-text" style="font-family: 'Sen', sans-serif;"> {{ $newmember->User_Native}}    ,     {{ $newmember->SubCaste_Name }}</p> 
                                                        </div>  
                                                </a>
                                            <!--/.Card-->
                                        </div>
                                        <!-- Grid column -->
                                        @endforeach
                           
                            @else
                              <!--- Dont add empty panel -->
                            @endif
            
                    </div>
                    <!--END New User row -->
                    </br>
                    </br>
                    <div class="text-center darken-grey-text home_jewelleryard"> 
                            <h1 class="font-bold text-center text-uppercase home_temptitle">@lang('home.viewallitems_menu')   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                               <!-- <a href="{{url('/products') }}"  class="btn  waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"><i class="fa fa-eye fa-1x"></i> View All </a> -->
                           </h1>
                        </div>
                    <div class="ml-auto d-flex justify-content-end viewall">
                        <a href="{{url('/products') }}"  class="btn  waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"><i class="fa fa-eye fa-1x"></i> @lang('home.temple_functions_view_btn') </a>
                    </div>

                    <!--START  Jewellery Grid row style="margin-top:-100px;"-->
                    <div class="row homecard" >  
                        @if (isset($products) && count($products) >0)
                          
                                @foreach ($products as $product)
                                        <!-- Grid column -->
                                        <div class="col-lg-4 col-md-12 mb-4 home_mrgbetweencardmob">
                                            
                                            <!--Card-->
                                            <a href="{{ route('products.show',$product->ProductID) }}">
                                            <div class="card allcards">

                                                <!--Card image-->
                                                <div class="view overlay hm-white-slight  card-home-header-image">
                                                    @if($product->Photo)
                                                    <img class="img-thumbnail" src="{{ $product->Photo }}">
                                                    @else 
                                                    <img class="img-thumbnail" src="/images/frontend_images/product-default.png">
                                                    @endif
                                                    
                                                </div>

                                                <!--Card content-->
                                                <div class="card-body mytable">
                                                    <!--Title-->
                                                    <h4 class="card-title indigo-text">{{ $product->ProductName}}</h4>
                                                    <!--Text-->
                                                    <p class="card-text" style="font-family: 'Sen', sans-serif;"><i class="fa fa-inr" aria-hidden="true"></i> {{ $product->Price }}</p>
                                                    <a href="{{ route('products.show',$product->ProductID) }}" class="btn  waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> @lang('home.temple_functions_readmore_btn')</a>
                                                    <!-- <a href="{{url('/products') }}"  class="btn  waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"><i class="fa fa-eye fa-1x"></i> View All </a> -->
                                                    
                                                    </div>

                                            </div>
                                            <!--/.Card-->
                                            </a>
                                    
                                        </div>
                                        <!-- Grid column -->
                                        @endforeach
                                        @else
                                            <!-- Grid column -->
                                            <br/>
                                            <div class="col-lg-12 col-md-12 mb-4" style="margin-top:10px;">
                                                <h6 class="card-title indigo-text"  style="text-align:center"> @lang('home.error_jewellerys')</h6>
                                            </div>
                                        @endif
        
                    </div>
                    <!--END Jewellry Events row -->

         </div>
         <!--MDB Cards-->
            
       </main>
        <!-- 2nd Design End -->
<script>
    
   
</script>
    


    </div>   <!-- Main wrapper -->

@endsection
