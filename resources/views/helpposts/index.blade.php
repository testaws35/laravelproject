@extends('layouts.app1')
@section('content')

{{-- /**
// classname - Helpposts-Indexblade.php
// author - Raveendra 
// release version - 1.0
// Description-  This class represents the FAQ pages
// created date - Nov 2019
**/ --}}

<!DOCTYPE html>

<html>

<head>

    <title>Help Post Index</title>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- References: https://github.com/fancyapps/fancyBox -->

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

    /* HELP Comment and Post */
    .comment-box-wrapper{
    display:flex; 
    flex-direction:column;
    width:100%;
    margin:5px 0px;
    }
    .comment-box{
      display:flex; 
      width:100%;
    }
    .comment-box a{
    color:#000;  /* changed by raveendra on 19-11-19  */
    }
    .commenter-image{
        height:80px;   /* changed by raveendra on 19-11-19  */
        width:80px;    /* changed by raveendra on 19-11-19  */
        border-radius:50%;
    }
    .comment-content{
        display:flex; 
    flex-direction:column;
      background:#f2f3f5;
      margin-left:5px;
      padding:4px 20px;
      border-radius:10px;
      width: 100%; /* Added by raveendra on 19-11-19  */
    }

    .commenter-head{
    display:block;
    }


    .commenter-head .commenter-name{
    font-size:2rem;
    font-weight:600;
    }

    .comment-date{
        font-size:2rem;
    }
    .comment-date i {
      margin:0 5px 0 10px;
    }
    .comment-body{
        padding:0 0 0 5px;
        display:flex;
        font-size:1.8rem;  /* changed by raveendra on 19-11-19  */
        color:#000; /* Added by raveendra on 19-11-19  */
    }
    .comment-footer{
        font-size:0.9rem;
        font-weight:500;
    }

    .comment-footer span{
      margin:0 15px 0 0;
    }



    .comment-footer span.comment-likes  .active .fa-heart{
    color:black;
    font-size:1rem;
    }
    .comment-footer span.comment-likes  .active .fa-heart{
    color:red;
    }

    .nested-comments{
        margin-left:50px;
    }

    /* NEW CARD POST AND COMMENT CSS */

    .profile-widget {
      position: relative;
    }
    .profile-widget .image-container {
      background-size: cover;
      background-position: center;
      padding: 190px 0 10px;
    }
    .profile-widget .image-container .profile-background {
      width: 100%;
      height: auto;
    }
    .profile-widget .image-container .avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin: 0 auto -60px;
      display: block;
    }
    .profile-widget .details {
      padding: 50px 15px 15px;
      text-align: center;
    }
    /* End Component: Profile Widget */
    /********************************************************************
    *********************************************************************
    *********************************************************************/
    /* Component: Mini Profile Widget */
    .mini-profile-widget .image-container .avatar {
      width: 180px;
      height: 180px;
      display: block;
      margin: 0 auto;
      border-radius: 50%;
      background: white;
      padding: 4px;
      border: 1px solid #dddddd;
    }
    .mini-profile-widget .details {
      text-align: center;
    }



    /* Component: Panel */
    .panel {
      border-radius: 0;
      margin-bottom: 30px;
    }
    .panel.solid-color {
      color: white;
    }
    .panel .panel-heading {
      border-radius: 0;
      position: relative;
    }
    .panel .panel-heading > .controls {
      position: absolute;
      right: 10px;
      top: 12px;
    }
    .panel .panel-heading > .controls .nav.nav-pills {
      margin: -8px 0 0 0;
    }
    .panel .panel-heading > .controls .nav.nav-pills li a {
      padding: 5px 8px;
    }
    .panel .panel-heading .clickable {
      margin-top: 0px;
      font-size: 12px;
      cursor: pointer;
    }
    .panel .panel-heading.no-heading-border {
      border-bottom-color: transparent;
    }
    .panel .panel-heading .left {
      float: left;
    }
    .panel .panel-heading .right {
      float: right;
    }
    .panel .panel-title {
      font-size: 16px;
      line-height: 20px;
    }
    .panel .panel-title.panel-title-sm {
      font-size: 18px;
      line-height: 28px;
    }
    .panel .panel-title.panel-title-lg {
      font-size: 24px;
      line-height: 34px;
    }
    .panel .panel-body {
      font-size: 13px;
    }
    .panel .panel-body > .body-section {
      margin: 0px 0px 20px;
    }
    .panel .panel-body > .body-section > .section-heading {
      margin: 0px 0px 5px;
      font-weight: bold;
    }
    .panel .panel-body > .body-section > .section-content {
      margin: 0px 0px 10px;
    }
    .panel-white {
      border: 1px solid #dddddd;
    }
    .panel-white > .panel-heading {
      color: #333;
      background-color: #fff;
      border-color: #ddd;
    }
    .panel-white > .panel-footer {
      background-color: #fff;
      border-color: #ddd;
    }
    .panel-primary {
      border: 1px solid #dddddd;
    }
    .panel-purple {
      border: 1px solid #dddddd;
    }
    .panel-purple > .panel-heading {
      color: #fff;
      background-color: #8e44ad;
      border: none;
    }
    .panel-purple > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-light-purple {
      border: 1px solid #dddddd;
    }
    .panel-light-purple > .panel-heading {
      color: #fff;
      background-color: #9b59b6;
      border: none;
    }
    .panel-light-purple > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-blue,
    .panel-info {
      border: 1px solid #dddddd;
    }
    .panel-blue > .panel-heading,
    .panel-info > .panel-heading {
      color: #fff;
      background-color: #2980b9;
      border: none;
    }
    .panel-blue > .panel-heading .panel-title a:hover,
    .panel-info > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-light-blue {
      border: 1px solid #dddddd;
    }
    .panel-light-blue > .panel-heading {
      color: #fff;
      background-color: #3498db;
      border: none;
    }
    .panel-light-blue > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-green,
    .panel-success {
      border: 1px solid #dddddd;
    }
    .panel-green > .panel-heading,
    .panel-success > .panel-heading {
      color: #fff;
      background-color: #27ae60;
      border: none;
    }
    .panel-green > .panel-heading .panel-title a:hover,
    .panel-success > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-light-green {
      border: 1px solid #dddddd;
    }
    .panel-light-green > .panel-heading {
      color: #fff;
      background-color: #2ecc71;
      border: none;
    }
    .panel-light-green > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-orange,
    .panel-warning {
      border: 1px solid #dddddd;
    }
    .panel-orange > .panel-heading,
    .panel-warning > .panel-heading {
      color: #fff;
      background-color: #e82c0c;
      border: none;
    }
    .panel-orange > .panel-heading .panel-title a:hover,
    .panel-warning > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-light-orange {
      border: 1px solid #dddddd;
    }
    .panel-light-orange > .panel-heading {
      color: #fff;
      background-color: #ff530d;
      border: none;
    }
    .panel-light-orange > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-red,
    .panel-danger {
      border: 1px solid #dddddd;
    }
    .panel-red > .panel-heading,
    .panel-danger > .panel-heading {
      color: #fff;
      background-color: #d40d12;
      border: none;
    }
    .panel-red > .panel-heading .panel-title a:hover,
    .panel-danger > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-light-red {
      border: 1px solid #dddddd;
    }
    .panel-light-red > .panel-heading {
      color: #fff;
      background-color: #ff1d23;
      border: none;
    }
    .panel-light-red > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-pink {
      border: 1px solid #dddddd;
    }
    .panel-pink > .panel-heading {
      color: #fff;
      background-color: #fe31ab;
      border: none;
    }
    .panel-pink > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-light-pink {
      border: 1px solid #dddddd;
    }
    .panel-light-pink > .panel-heading {
      color: #fff;
      background-color: #fd32c0;
      border: none;
    }
    .panel-light-pink > .panel-heading .panel-title a:hover {
      color: #f0f0f0;
    }
    .panel-group .panel {
      border-radius: 0;
    }
    .panel-group .panel + .panel {
      margin-top: 0;
      border-top: 0;
    }

    /* Component: Posts */
    .post .post-heading {
      height: 95px;
      padding: 20px 15px;
    }
    .post .post-heading .avatar {
      width: 60px;
      height: 60px;
      display: block;
      margin-right: 15px;
    }
    .post .post-heading .meta .title {
      margin-bottom: 0;
    }
    .post .post-heading .meta .title a {
      color: black;
    }
    .post .post-heading .meta .title a:hover {
      color: #aaaaaa;
    }
    .post .post-heading .meta .time {
      margin-top: 8px;
      color: #999;
    }
    .post .post-image .image {
      width: 100%;
      height: auto;
    }
    .post .post-description {
      padding: 15px;
    }
    .post .post-description p {
      font-size: 14px;
    }
    .post .post-description .stats {
      margin-top: 20px;
    }
    .post .post-description .stats .stat-item {
      display: inline-block;
      margin-right: 15px;
    }
    .post .post-description .stats .stat-item .icon {
      margin-right: 8px;
    }
    .post .post-footer {
      border-top: 1px solid #ddd;
      padding: 15px;
    }
    .post .post-footer .input-group-addon a {
      color: #454545;
    }
    .post .post-footer .comments-list {
      padding: 0;
      margin-top: 20px;
      list-style-type: none;
    }
    .post .post-footer .comments-list .comment {
      display: block;
      width: 100%;
      margin: 20px 0;
    }
    .post .post-footer .comments-list .comment .avatar {
      width: 35px;
      height: 35px;
    }
    .post .post-footer .comments-list .comment .comment-heading {
      display: block;
      width: 100%;
    }
    .post .post-footer .comments-list .comment .comment-heading .user {
      font-size: 14px;
      font-weight: bold;
      display: inline;
      margin-top: 0;
      margin-right: 10px;
    }
    .post .post-footer .comments-list .comment .comment-heading .time {
      font-size: 12px;
      color: #aaa;
      margin-top: 0;
      display: inline;
    }
    .post .post-footer .comments-list .comment .comment-body {
      margin-left: 50px;
    }
    .post .post-footer .comments-list .comment > .comments-list {
      margin-left: 50px;
    }

    .fluid-width-video-wrapper {
        width: 100%;
        position: relative;
        padding: 0;
    }

    .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

      
    </style>
    

    <script>
    function myFunction(x) {
      x.classList.toggle("fa-thumbs-down");
    } 
    </script>


</head>

<body>


       <!-- Start Shop Page -->
       <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" style="margin-top:-100px;">
          <div class="container">
               <!--- ********** Outer row Area***********************************
                 ********************************************************-->
   
            <div class="row">  <!-- outer row -->
   
              {!! csrf_field() !!}
                <!--- ********** 1st column Area***********************************
                 ********************************************************-->
                 
                       <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
   
                                     <div class="row"> <!-- begin  1 col row -->
                                             <div class="shop__sidebar">
                                                     <aside class="wedget__categories poroduct--cat">
                                                               <h3 class="wedget__title indexhelp_wise"><b>@lang('home.announcements_index_leftside_catewise')</b></h3>
   
                                                               <form id="prodindex"  >
                                                                   <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                                                                 or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
                                                                                 {!! csrf_field() !!}
                                                                 <ul class="properties-filter">
                                                                     <li  class="selected" name="JobHelp" id="JobHelp"><a href="{{ route('helpposts.getCat', 3) }}" class="click">@lang('home.seekhelp_lhs_jobhelp')</a>
                                                                     </li>
                                                                     <li  class="selected" name="EduHelp" id="EduHelp"><a href="{{ route('helpposts.getCat', 4) }}" class="click">@lang('home.seekhelp_lhs_educhelp')</a>
                                                                     </li>
                                                                     <li  class="selected" name="MedicalHelp" id="MedicalHelp"><a href="{{ route('helpposts.getCat', 1) }}" class="click">@lang('home.seekhelp_lhs_realthhelp')</a>
                                                                     </li> 
                                                                     <li  class="selected" name="FinanceHelp" id="FinanceHelp"><a href="{{ route('helpposts.getCat', 2) }}" class="click">@lang('home.seekhelp_lhs_financehelp')</a>
                                                                     </li> 
                                                                     <li  class="selected" name="OtherHelp" id="OtherHelp"><a href="{{ route('helpposts.getCat', 5) }}" class="click">@lang('home.seekhelp_lhs_otherhelp')</a>
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
                                               <h3 class="wedget__title indexhelp_current"><b>@lang('home.seekhelp_lhs_currreq') </b></h3>
                                                     <ul>
                                                         <li><a href="{{ url('/helpposts/') }}">@lang('home.templefunc_index_lhscumonth') </li>
                                                     </ul>
                                               </h3>
                                           </aside>
                                       </div>
                                       <div class="row">
                                               <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
               
                                               <!-- Start Single Widget -->
                                               <aside class="wedget__categories poroduct--cat">
                                                   <h3 class="wedget__title indexhelp_arc"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
                                                   <ul>
                                                       
                                                       <li><a href="{{ url('/helpposts/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                                       <li><a href="{{ url('/helpposts/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                                       <li><a href="{{ url('/helpposts/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                                       <li><a href="{{ url('/helpposts/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                                       <li><a href="{{ url('/helpposts/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                                       <li><a href="{{ url('/helpposts/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                                     
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
   
                             <div class="row">  <!-- Inner row -->
                               <!--- ********** Title Area ***********************************
                                 ********************************************************-->
                                        
                                       <br/><br/><br/>
                                      
               
                                       <!--- ********** Helppost  Area ***********************************
                                           ********************************************************-->
                                      <!-- regular resultset -->
                                     <?php if ( ( !isset($helppostsCat)) 
                                                    && ( isset($helpposts)   && (count($helpposts) >0 )  )  
                                              ) { ?>
                                     
                                       <div  class="infinite-scroll col-md-12">
                                               <div class="title">
                                                    <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;"> @lang('home.seekhelp_head') {{$currentMonthName}},{{$currentYear}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a class="btn  fa-3x indexhelp_btn" href="{{ route('helpposts.create') }}"><b style="font-size:20px; text-align:right;font-family: 'Sen', sans-serif;"  >@lang('home.footer_sub_head_askhelp')</b></a>  
                                                    </h1>   
                                                  <br>
                                                  <br>
                                                </div>

                                                <!--Right side page -->
                                                @foreach ($helpposts as $helppost)
                                                <!--START comment-box-wrapper -->
                                                <a href="{{ route('helpposts.show',$helppost->HelpID) }}"> 
                                                  <div class="comment-box-wrapper">
                                                          <div class="comment-box">
                                                                <!-- give different images based on Type -->
                                                                <?php if ($helppost->Type == "Job" ) { ?>
                                                                        <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                <?php } else if ($helppost->Type == "Education" ) { ?>
                                                                  <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                <?php } else if ($helppost->Type == "Health" ) { ?>
                                                                  <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                <?php } else if ($helppost->Type == "Finance" ) { ?>
                                                                  <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                <?php } else { ?>
                                                                   <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                <?php } ?>
                                                              <div class="comment-content">
                                                                      <div class="commenter-head">
                                                                            <span class="commenter-name" style="font-family: 'Sen', sans-serif;">{{ $helppost->Type }}</span>  
                                                                            <span class="comment-date pull-right" style="font-size: 15px; position: relative;">@lang('home.help_post_by'): {{ $helppost->name }}</span> <br/>
                                                                            <span class="comment-date pull-right" style="font-size: 13px; position: relative; top: -6px;"><!-- <i class="far fa-clock"></i> --> <i class="fa fa-calendar" aria-hidden="true"></i> {{ date('d-m-Y', strtotime($helppost->CreatedOn)) }}</span> 
                                                                      </div>
                                                                      <div class="comment-body">
                                                                          <span class="comment" style="font-family: 'Sen', sans-serif;word-break: break-word;"> {{ Illuminate\Support\Str::limit(ucwords($helppost->Description), 80, $end='...') }}</span>
                                                                      </div>
                                                              </div>
                                                           </div>  
                                                  </div></a><!--END comment-box-wrapper -->
                                                <br> <br>
                                                @endforeach
   
                                        </div> <!-- END infinite-scroll -->
                               
                                        <?php } else if ( ( !isset($helppostsCat) )  && ( ( isset($helpposts)   && (count($helpposts) <=0)  )  ) ) { ?> 
                                            <div class="title">
                                                  <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;"> @lang('home.seekhelp_head')  {{$currentMonthName}},{{$currentYear}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                  <a class="btn fa-3x indexhelp_btn" href="{{ route('helpposts.create') }}"><b style="font-size:20px; font-family: 'Sen', sans-serif;">@lang('home.footer_sub_head_askhelp')</b></a>  
                                                  </h1>   
                                                <br>
                                                <br>
                                             </div>
                                             <div height="500px" width="300px">
                                                  <p> <h3 style="font-family: 'Sen', sans-serif;"> @lang('home.seekhelp_rhs_msg')  {{$currentMonthName}} , {{$currentYear}} 
                                                    <h3> <br> <br>  </p>
                                             </div>  
                                         <?php } else if ( ( isset($helppostsCat)&& (count($helppostsCat) >0) ) &&  ( ! isset($helpposts)     )    
                                                         ) { ?> 
                                                    <div  class="infinite-scroll col-md-12">
                                                        <div class="title">
                                                            <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;"> Help Desk  &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <a class="btn  fa-3x indexhelp_btn" href="{{ route('helpposts.create') }}"><b style="font-size:20px;font-family: 'Sen', sans-serif;">Ask for Help</b></a>  
                                                            </h1>   
                                                          <br>
                                                          <br>
                                                        </div>

                                                        <!--Right side page -->
                                                        @foreach ($helppostsCat as $helppost)
                                                        <!--START comment-box-wrapper -->
                                                        <a href="{{ route('helpposts.show',$helppost->HelpID) }}"> 
                                                          <div class="comment-box-wrapper">
                                                                  <div class="comment-box">
                                                                        <!-- give different images based on Type -->
                                                                        <?php if ($helppost->Type == "Job" ) { ?>
                                                                                <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                        <?php } else if ($helppost->Type == "Finance" ) { ?>
                                                                          <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                        <?php } else if ($helppost->Type == "Health" ) { ?>
                                                                          <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                        <?php } else if ($helppost->Type == "Education" ) { ?>
                                                                          <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                        <?php } else { ?>
                                                                            <img src="{{ $helppost->Photo }}"  class="commenter-image" alt="commenter_image">
                                                                        <?php } ?>
                                                                      <div class="comment-content">
                                                                              <div class="commenter-head">
                                                                                    <span class="commenter-name" style="font-family: 'Sen', sans-serif;">{{ $helppost->Type }}</span> 
                                                                                    <span class="comment-date pull-right" style="font-size: 15px; position: relative; top: 30px;"><!-- <i class="far fa-clock"></i> -->Posted By: {{ $helppost->name }}</span> <br/>
                                                                                    <span class="comment-date pull-right" style="font-size: 13px; position: relative; top: 25px;"><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('d-m-Y', strtotime($helppost->CreatedOn)) }}</span> 
                                                                              </div>
                                                                              <div class="comment-body">
                                                                          <span class="comment" style="font-family: 'Sen', sans-serif;"> {{ Illuminate\Support\Str::limit(ucwords($helppost->Description), 80, $end='...') }}</span>
                                                                      </div>
                                                                      </div>
                                                                    </div>  
                                                          </div></a><!--END comment-box-wrapper -->
                                                        <br> <br>
                                                        @endforeach
            
                                                    </div> <!-- END infinite-scroll -->


                                         <?php }else { ?> 

                                            <div class="title">
                                                  <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;"> Help Desk &nbsp;&nbsp;&nbsp;&nbsp;
                                                  <a class="btn fa-3x indexhelp_btn"  href="{{ route('helpposts.create') }}"><b style="font-size:20px;font-family: 'Sen', sans-serif;" >Ask for Help</b></a>  
                                                  </h1>   
                                                <br>
                                                <br>
                                            </div>
                                            <div height="500px" width="300px">
                                                  <p> <!--<h3 style="font-family: 'Sen', sans-serif;"> There is no help requests available for  {{$catName}} Category
                                                    <h3> -->
                                                    <h4 class="alert alert-info indexhelp_alertcatname" > There is no help requests available for  {{$catName}} Category</h4>
                                                    <br> <br>  </p>
                                            </div> 
                                        
                                         <?php } ?>
                                          
                         </div>  <!-- end of inner row-->
                     </div>
                   </div>
               
                 </div> <!-- end Second column -->
   
                      
             
              <!--- ********** End Outer row ***********************************
              ********************************************************-->
             </div><!-- END ROW -->
       
       </div>
    </div>   <!-- End Shop Page -->
   
   
               <script type="text/javascript">
   
               /* The below line can be made to either show pagination index or hide it. 
               If pagination is needed, then make it as $('ul.pagination').show(); and remove the function below*/
   
                   $('ul.pagination').hide();
                   $(function() {
                       $('.infinite-scroll').jscroll({
                           autoTrigger: true,
                           loadingHtml: '<img class="center-block" src="https://demos.laraget.com/images/loading.gif" alt="Loading..." />', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
                           padding: 0,
                           nextSelector: '.pagination li.active + li a',
                           contentSelector: 'div.infinite-scroll',
                           callback: function() {
                               $('ul.pagination').remove();
                           }
                       });
                   });
   
             
               </script>


        </body>
 </html>
        
 @include('sweetalert::alert')

@endsection
