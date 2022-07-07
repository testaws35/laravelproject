@extends('layouts.app1')
@section('content')


<!--  /**
// classname - Announcements/Index.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used showing all Announcements
// created date - Nov 2019
**/  -->

<!-- The flow a php workflow is 
            1. Every top menu of the Application, is connected to the  Index method of the Controller which is provided in web.php
            2. The index method in Controller invokes the  index blade which shows all the list of a resource
            3. On click of a specific resource in list, show method of Controller is called
            4. The show method in Controller, in turn , sends the Show view 
            5. Show view has Edit and Delete button so that that resource can be edited or deleted
            6. On click of Edit button, the Edite method in Controller is called
            7. this in turn sends the Edit view
            8. In the Edit view user can edit the values and Submit
            9. Click of Submit calls Update method in Controller
            10. After updating in DB, it sends the index view back
            11. On click on create button in Index view , the create method is called in controller
            12. This sends the Create view.
            13. After filling the form when it is submitted , the store method in controller is called
            14. After inserting data in DB, the controller returns the Index view-->



<!DOCTYPE html>
<html>
<head>

    <title>Announcements Gallery </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <style type="text/css">
        
            /* Limiting column data */
            .mytable p{
            max-width:900px; /* Customise it accordingly */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            }
            .mytable h4{
            max-width:280px; /* Customise it accordingly */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            }
        /* END Limiting column data */
   </style>
</head>
<body>

        <!-- Start  Page -->
        <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" style="margin-top:-100px;">
                <!-- Container -->
                    <div class="container">
                        <!--- ********** Outer row Area***********************************
                            ********************************************************-->
     
                            <div class="row">  <!-- outer row -->
                            
                            <!--- ********** 1st column Area***********************************
                            ********************************************************-->
                
                                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                
                                    <div class="row"> <!-- begin  1 col row -->
                                            <div class="shop__sidebar">
                                                    <aside class="wedget__categories poroduct--cat">
                                                            <h3 class="wedget__title anno_catewise"><b>@lang('home.announcements_index_leftside_catewise') </b></h3>
                
                                                            <form id="prodindex"  >
                                                                        <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                                                                        or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
                                                                                        {!! csrf_field() !!}
                                                                        <ul class="properties-filter">
                                                                            <li  class="selected" name="General" id="General"><a href="{{ url('/announcements/?cat=General') }}" class="click">@lang('home.announcements_index_leftside_general')</a>
                                                                            </li> 
                                                                            <li  class="selected" name="Temple" id="Temple"><a href="{{ url('/announcements/?cat=Temple') }}" class="click">@lang('home.announcements_index_leftside_temple')</a>
                                                                            </li> 
                                                                            <li  class="selected" name="Sangam" id="Sangam"><a href="{{ url('/announcements/?cat=Sangam') }}" class="click">@lang('home.announcements_index_leftside_sangam')</a>
                                                                            </li> 
                                                                            <li  class="selected" name="Promotion" id="Promotion"><a href="{{ url('/announcements/?cat=Promotion') }}" class="click">@lang('home.announcements_index_leftside_pro')</a>
                                                                            </li> 
                                                                            <li  class="selected" name="Invitation" id="Invitation"><a href="{{ url('/announcements/?cat=Invitation') }}" class="click">@lang('home.announcements_index_leftside_invitation')</a>
                                                                            </li>  
                                                                            <li  class="selected" name="Death" id="Death"><a href="{{ url('/announcements/?cat=Death') }}" class="click">@lang('home.announcements_index_leftside_death')</a>
                                                                            </li>  
                                                                            <li  class="selected" name="Funeral" id="Funeral"><a href="{{ url('/announcements/?cat=Funeral') }}" class="click">@lang('home.announcements_index_leftside_funeral')</a>
                                                                            </li>  
                                                                        </ul>
                                                            </form>
                                                </aside>
                                            </div>
                                    </div>
                
                                    <!--- ********** second row in 1st column Area***********************************
                                    ********************************************************-->
                                    
                                    
                          
                                    
                                    
                                    <div class="row">
                                        <aside class="wedget__categories poroduct--cat">
                                            <h3 class="wedget__title anno_current"><b>@lang('home.announcements_index_leftside_current')  </b></h3>
                                                    <ul>
                                                        <li><a href="{{ url('/announcements/?mon=0') }}">@lang('home.templefunc_index_lhscumonth')</li>
                                                    </ul>
                                            </h3>
                                        </aside>
                                    </div>

                                    <!-- Start search_widget Widget -->
                                          <!--  <div class="row">
                                            <aside class="widget search_widget">
                                                    <h3 class="wedget-title"><b>Search </b></h3>
                                                    <form action="#">
                                                        <div class="form-input">
                                                            <input type="text" placeholder="Search...">
                                                            <button><i class="fa fa-search"></i></button>
                                                        </div>
                                                    </form>
                                                </aside> 
                                            </div> -->
                                        <!-- End search_widget Widget -->

                                    <div class="row">
                                            <!--Prints the Month and year ,  (strtotime converts whatever the parameetre given into time stamp and then - 1 month)-->
                                            <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
                
                                            <!-- Start Single Widget -->
                                            <aside class="wedget__categories poroduct--cat">
                                                <h3 class="wedget__title anno_arc"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
                                                <ul>
                                                    
                                                    <li><a href="{{ url('/announcements/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/announcements/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/announcements/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/announcements/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/announcements/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/announcements/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                                    
                                                </ul>
                                            </aside>
                                            <!-- End Single Widget -->
                                            <?php ?>
                                    </div>
                
                    </div> <!-- end  1 col row -->
                    <!--- ********** 2nd column Area***********************************
                    ********************************************************-->
                
                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                        <div class="tab__container">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                
                            <!-- Row  -->
                            <div class="row">
                                <div class="title">
                                    @if($cat)
                                        <h1 class="font-bold text-center text-uppercase"> {{ $cat}} @lang('home.head_announcements') &nbsp;&nbsp;&nbsp;&nbsp;</br>
                                    @else
                                        <h1 class="font-bold text-center text-uppercase">@lang('home.head_announcements') of {{$currentMonthName}}, {{$currentYear}}&nbsp;&nbsp;&nbsp;&nbsp;</br>
                                    @endif
                                                <a class="btn fa-3x" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;margin-left:550px;" href="{{ route('announcements.create') }}"><b style="font-size:12px;font-family: 'Sen', sans-serif;">@lang('home.announcements_index_upbtn')</b></a>  
                                        </h1>  
                            </div>
                                  <!--- ********** Elders List Area***********************************
                                ********************************************************-->
                                <?php if (  isset($announcements)   &&  (count($announcements) >0)  ) { ?>
                                    @if(isset($announcements)  )
                                                @foreach ($announcements as $announcement)
                                                    <div class="col-md-4" >
                                                            <div class="card card-profile" >
                                                                <div class="card-header card-header-image">
                                                                    <a href="/announcements/show/{{$announcement->AnnouncementsID}}">
                                                                    
                                                                        
                                                                        @if(($announcement->Photo != '') || ($announcement->Photo != null))
                                                                            <img src="{{$announcement->Photo}}" alt="photo">
                                                                        @elseif($announcement->Video != '')
                                                                             <video width="225" height="215" controls>
                                                                                <source src="{{ $announcement->Video }}" type="video/mp4">
                                                                            </video>
                                                                        @else
                                                                           <img src="/images/No-image2.png" alt="photo">
                                                                        @endif
                                                                       
                                                                       
                                                                    </a>
                                                           </div>
                                                            
                                                            <div class="card-body mytable">
                                                                    <h4 class="card-title">{{ $announcement->Title }}</h4>
                                                                    <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                                            {{ $announcement->Function_Content }}  
                                                                    </p>
                                                                    <a href="/announcements/show/{{$announcement->AnnouncementsID}}" class="btn  waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;font-size:14px;">@lang('home.temple_functions_readmore_btn')</a> 
                                                            </div>
                                                            <br/> 
                                                    </div> 
                                                </div>
                                                @endforeach
                                    @endif
                                <?php } else {   ?>
                                
                                    <p> <h4 class="alert alert-info anno_failedmsg" >  {{$Failed}} </h4> </p>
                                    
                                <?php } ?>
                
                                </div><!-- Row END -->
                                         
                             </div>  <!-- end of inner row-->
                          </div>
                         </div>
                      </div>  <!-- end second column-->
                
                                
                
                        <!--- ********** End Outer row ***********************************
                        ********************************************************-->
                        </div><!-- END Outer  ROW -->
                    </div><!-- Container END -->
                </div>    <!-- End Shop Page -->
</body>
</html>

@include('sweetalert::alert')    

@endsection
