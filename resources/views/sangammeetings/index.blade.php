@extends('layouts.app1')
@section('content')


<!DOCTYPE html>
<html>
<head>

    <title>Sangam Meetings Gallery </title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
            .card-row{
                margin-top:10px;
            }

            /* END Limiting column data */
    </style>

</head>

<body>

    
        @if ($message = Session::get('Message'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
        @endif

    
<!-- Start Shop Page -->
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
                                           <?php if(isset($sangams) ) {  ?>
                                             <aside class="wedget__categories poroduct--cat">
                                                       <h3 class="wedget__title indexmeeting_mrgtop"><b>@lang('home.sangammeetings_index_leftside_sangamwise')</b></h3>
        
                                                       <form id="prodindex" >
                                                            <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                                                          or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
    
                                                                     <ul class="properties-filter">
                                                                         @foreach ($sangams as $sangam)
                                                                         <li  class="selected" name="{{$sangam->SangamID}}" id="sangamid" >
                                                                         <a href="?sangamid={{$sangam->SangamID}}" data-filter="{{$sangam->SangamID}}" class="click">{{ Illuminate\Support\Str::limit(ucwords($sangam->Sangam_Name), 20, $end='...') }} </a>
                                                                         </li> 
                                                                         @endforeach
                                                                     </ul>
                                                        </form>
                                           </aside>
                                          <?php } ?>
                                     </div>
                             </div>
        
                            <!--- ********** second row in 1st column Area***********************************
                            ********************************************************-->
                             
                               <div class="row">
                                   <aside class="wedget__categories poroduct--cat">
                                       <h3 class="wedget__title indexmeetingcurrent_mrgtop"><b>@lang('home.announcements_index_leftside_current')</b></h3>
                                             <ul>
                                                 <li><a href="{{ url('/sangammeetings/') }}">Current Month </li>
                                             </ul>
                                       </h3>
                                   </aside>
                               </div>
                               <!-- Start search_widget Widget -->
                                <!-- <div class="row">
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
                                       <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
        
                                            <!-- Start Single Widget -->
                                            <aside class="wedget__categories poroduct--cat">
                                                <h3 class="wedget__title indexmeetingarc_mrgtop"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
                                                <ul>
                                                    
                                                    <li><a href="{{ url('/sangammeetings/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/sangammeetings/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/sangammeetings/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/sangammeetings/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/sangammeetings/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/sangammeetings/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                                    
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
                              @if(isset($sangamname))
                                <h1 class="font-bold text1-center text-uppercase sanmeeting_heading">{{$sangamname->Sangam_Name}} @lang('home.head_sangam_meetings')&nbsp;&nbsp;&nbsp;&nbsp;
                              @else
                                <h1 class="font-bold text1-center text-uppercase sanmeeting_heading"> @lang('home.head_sangam_meetings') of {{$currentMonthName}}, {{$currentYear}} &nbsp;&nbsp;&nbsp;&nbsp;
                              @endif
                              @if(\Auth::user()->IsSangamMember==1 && (isset($sangam_mem)))
                                    <a class="btn  fa-3x" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;margin-top: 16px;" href="{{ route('sangammeetings.create') }}"><b style="font-size:10px;font-family: 'Sen', sans-serif;">@lang('home.sangammeetings_index_upbtn')</b></a>  
                              @endif
                        </h1>   
                          
                        </div>
                    </div>  <!--row end -->
             
                    <!-- Row  -->
                    <div class="row card-row">
        
                        <!--- ********** Elders List Area***********************************
                           ********************************************************-->
                       <?php if (isset($sangammeetings)   && (count($sangammeetings) >0 )  )  { ?>   
                         
                        @foreach ($sangammeetings as $sangammeeting)
                                <div class="col-md-4">
                                        <div class="card card-profile ">
                                                <div class="card-header card-header-image">
                                                    <a href="{{ route('sangammeetings.show',$sangammeeting->SangamMeetingID) }}">
                                                        @if(($sangammeeting->Photo != '') || ($sangammeeting->Photo != null))
                                                            <img src="{{$sangammeeting->Photo}}" alt="photo">
                                                        @elseif($sangammeeting->Video != '')
                                                             <video width="225" height="215" controls>
                                                                <source src="{{ $sangammeeting->Video }}" type="video/mp4">
                                                            </video>
                                                        @else
                                                           <img src="/images/No-image2.png" alt="photo">
                                                        @endif
                                                        
                                                    </a>
                                                    @if($sangammeeting->Photo == "")
                                                    <div class="colored-shadow" style="background-image: url('/images/announcements/Announcement_default.jpg');opacity: 1;">
                                                    </div>
                                                    @else
                                                    <div class="colored-shadow" style="background-image: url('{{ $sangammeeting->Photo }}');opacity: 1;">
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                            
                                                <div class="card-body mytable">
                                                    <h4 class="card-title">{{ $sangammeeting->Title }} <!--&nbsp;&nbsp;&nbsp;  <span> {{ $sangammeeting->MeetingDate }} </span>--></h4>
                                                    <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                            {{ $sangammeeting->Meeting_Content }}
                                                    </p>
                                                    <a href="{{ route('sangammeetings.show',$sangammeeting->SangamMeetingID) }}" class="btn waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;font-size:14px;">@lang('home.temple_functions_readmore_btn')</a> 
                                                </div>
                                                <br/> 
                                                
                                     </div>
                                </div>
                                @endforeach
                            <?php } else{ ?>
                                            <br>  <br>
                                            <p ><h4 class="alert alert-info" style="font-family: 'Sen', sans-serif;margin-left:90px;"> {{$Failed}} </h4> <p>
                            <?php }   ?>
        
                        </div><!-- Row END -->
        
                        {{-- <div class="float-right">   {{ $sangammeetings->links() }} </div> --}}
                     
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
