@extends('layouts.app1')
@section('content')

{{-- /**
// classname - Elders-Indexblade.php
// author - Raveendra 
// release version - 1.0
// Description-  This class represents the FAQ pages
// created date - Nov 2019
**/ --}}



<!DOCTYPE html>

<html>

<head>

    <title>Elder Details</title>

    <!-- Latest compiled and minified CSS -->

   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    -->
    <!-- References: https://github.com/fancyapps/fancyBox -->

  <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>  -->

<style>
    .iColor li a{color:black;text-decoration: none;}
    .iColor h1{color:black;}
    .iCheck input{margin-left: 25px;}
    
    .hidden {
         display:none;
    }

      /* dropdown alignment issue on click language tab 03052021*/ 
        @media (min-width: 992px){
          .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 
            {float: left;}
         }
   /* dropdown alignment issue on click language tab 03052021*/
.card-title{
    font-weight: 700 !important;
    margin-top: 10px;
    color: #3c4858;
    font-family: 'Sen', sans-serif;
}
.card {
    border: 0;
    margin-bottom: 30px;
    margin-top: 100px;
    border-radius: 6px !important;
    color: rgba(0,0,0,.87);
    background: #fff;
    width: 100%;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
}

.card .card-body{
    padding: .9375rem 1.875rem;
}

.card-description{
    color: #999;
}

.card.card-profile{
    text-align: center;
}
.card .card-header.card-header-image {
    position: relative;
    padding: 0;
    z-index: 1;
    margin-left: 15px;
    margin-right: 15px;
    margin-top: -81px;  /* -30px to 81px dec 15 2020*/
    border-radius: 6px;
    max-height: 215px;
}

.card .card-header.card-header-image a {
    display: block;
}

.card .card-header.card-header-image img {
    width: 100%;
    height: 215px;
    border-radius: 6px;
    pointer-events: none;
    box-shadow: 0 5px 15px -8px rgba(0,0,0,.24), 0 8px 10px -5px rgba(0,0,0,.2);
}

.card-home-header-image img {
    width: 100%;
    height: 215px;
    border-radius: 6px;
    pointer-events: none;
    box-shadow: 0 5px 15px -8px rgba(0,0,0,.24), 0 8px 10px -5px rgba(0,0,0,.2);
}




.card .card-header.card-header-image .colored-shadow {
    transform: scale(.94);
    top: 12px;
    filter: blur(12px);
    position: absolute;
    width: 100%;
    height: 100%;
    background-size: cover;
    z-index: -1;
    transition: opacity .45s;
    opacity: 1;
}

.card .card-header.card-header-image .card-title {
    position: absolute;
    bottom: 5px;
    left: 15px;
    color: #fff;
    font-size: 1.125rem;
    text-shadow: 0 2px 5px rgba(33,33,33,.5);
    font-weight: 700;
    font-family: 'Sen', sans-serif;
}

.card .card-category {
    margin-top: 15px;
    margin-bottom: 10px;
}

.card .card-body+.card-footer {
    padding-top: 0;
    border: 0;
    border-radius: 6px;
}

.card .card-footer {
    display: flex;
    align-items: center;
    background-color: transparent;
    border: 0;
}

.card-profile .card-footer .btn.btn-just-icon{
    font-size: 20px;
    padding: 12px 13px;
    line-height: 1em;
}

.card .card-footer {
    padding: .9375rem 1.875rem;
}


.card-profile .card-body+.card-footer{
    margin-top: -15px;
}
.card .text-info {
    color: #00bcd4!important;
}

.card-profile .card-avatar {
    width: 130px;
    max-width: 130px;
    max-height: 130px;
    margin: -50px auto 0;
    border-radius: 50%;
    overflow: hidden;
    padding: 0;
    box-shadow: 0 16px 38px -12px rgba(0,0,0,.56), 0 4px 25px 0 rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);
}

.card-profile .card-avatar img{
    width: 100%;
}
.card-profile .card-avatar+.card-body{
    margin-top: 15px;
}
</style>
</head>


 <body>

   <!-- if User is Elder he will see His FAQs , Other FAQs and Elder List -->
    <?php  if   ($flag == 1 )  {?>

        <!-- Start Shop Page -->
     <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" style="margin-top:-100px;">
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
                                                            <h3 class="wedget__title"><b>@lang('home.posts_index_lhactions')</b></h3>

                                                            <form id="prodindex"  >
                                                                <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                                                              or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
                                                                              {!! csrf_field() !!}
                                                              <ul class="properties-filter">
                                                                   <li  class="selected" name="HisFAQ" id="HisFAQ"  ><a href="javascript:ashowonlyone('newwboxes4');" class="click">@lang('home.faq_raised_by_u')</a>
                                                      </li> 
                                                                  <li  class="selected" name="OtherFAQ" id="OtherFAQ"  ><a href="javascript:ashowonlyone('newwboxes5');" class="click">@lang('home.posts_index_lhfaqothers')</a>
                                                                  </li> 
                                                                  <li  class="selected" name="elderlist" id="elderlist"  ><a href="javascript:ashowonlyone('newwboxes6');" class="click">@lang('home.lis_volunteers')</a>
                                                                  </li> 
                                                               </ul>
                                                <style>
                                                  .newwboxes {
                                                        display: none;
                                                    }
                                                  </style>
                                                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                                  <script>
                                                      function ashowonlyone(thechosenone) {
                                                         
                                                        $('.newwboxes').each(function(index) {
                                                             
                                                              if ($(this).attr("id") == thechosenone) {
                                                                $(this).show();
                                                                }
                                                              else {
                                                                    $(this).hide();  } 
                                                              });
                                                        }
                                                  </script>
                                           </form>
                                        </aside>
                                   </div>
                               </div>

                       <!--- ********** second row in 1st column Area***********************************
                       ********************************************************-->
                                  
                                    <div class="row">
                                        <aside class="wedget__categories poroduct--cat">
                                            <h3 class="wedget__title"><b>@lang('home.posts_index_lsfaq') </b></h3>
                                                  <ul>
                                                      <li><a href="{{ url('/elders/') }}" >@lang('home.templefunc_index_lhscumonth') </li>
                                                  </ul>
                                            </h3>
                                        </aside>
                                    </div>
                                    <div class="row">
                                            <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
            
                                            <!-- Start Single Widget -->
                                            <aside class="wedget__categories poroduct--cat">
                                                <h3 class="wedget__title"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
                                                <ul>
                                                    
                                                    <li><a href="{{ url('/elders/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/elders/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/elders/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/elders/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/elders/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                                    <li><a href="{{ url('/elders/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                                  
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
                                    <div class="title">
                                    <h3 class="font-bold text1-center text-uppercase" style="font-family: 'Sen', sans-serif;margin-left: 37px;">@lang('home.posts_index_rsmsg') 
                                        <a class="btn  fa-3x" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;margin-top:20px"  href="{{ route('elders.create') }}"><b style="font-size:20px;font-family: 'Sen', sans-serif;">@lang('home.Raise_Query')</b></a>  
                                    </h3>  
                                    </div>
                                    <br/><br/><br/>
                                    <div class="container"> 
                                         <!--  @if ($message = Session::get('success'))
                                          <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                          </div>
                                          @endif  --> 
                                    </div>
            
                                    <!--- ********** His FAQ Area ***********************************
                                        ********************************************************-->
                                    <?php if (isset($Hisfaqs)   && (count($Hisfaqs) >0 )  )  { ?>
                                                    <div  class="infinite-scroll newwboxes" id="newwboxes4" style="display: block;">
                                            <h2 class="text-center elderfaqrhs">  @lang('home.faq_raised_by_u')</h2>
                                                            
                                                        @foreach ($Hisfaqs as $hisfaq)
                                                            <div  class="col-md-6 mb-4" >
                                                                    <div class="card card-profile" >
                                                        <div class="card-header card-header-image">
                                                                                    <a href="{{ route('elders.show',$hisfaq->FAQ_PostID) }}">
                                                                                                    <img src="{{ $hisfaq->FAQ_Photo }}"  alt="/images/frontend_images/avatar.png">
                                             </a>
                                                                                                                        </div>
                                                                            <div class="card-body mytable"  style= width:250px; ">
                                                                                <h4 class="card-title indigo-text">{{ $hisfaq->FAQ_Title }}</h4>
                                                                                
                                            <p class="card-text">                                                                                  Created On:  {{ $hisfaq->FAQ_CreatedDate }} </p>       
                                            
                                            </div>
                                                                    </div> 
                                                                    <!--end card profile-->
                                                          </div> <!-- End col-md-4 -->
                                                          @endforeach

                                                      </div> <!-- END infinite-scroll -->
                                                  
                                                  <?php }else { ?>


                                                        <p > <h3 class="newwboxes alert alert-warning" id="newwboxes4" style="display: block;"> There is no FAQ created by you during {{$currentMonthName}} , {{$currentYear}}  </h3> <br> <br> </p>
                                                        
                                                                                          <?php }  ?>

                                      <!--- ********** Others FAQ Area***********************************
                                          ********************************************************-->
                                          <?php if (isset($Othersfaqs)   && (count($Othersfaqs) >0 )  )  { ?>
                                            <div   class="newwboxes"  id="newwboxes5" >
                                                    <h2 class="text-center" style="font-family: 'Sen', sans-serif;">@lang('home.posts_index_lhfaqothers')</h2>
                                                <!--Right side page -->
                                                 <div class="row">
                                                @foreach ($Othersfaqs as $otherfaq)
                                               
                                                    <div  class="col-md-4" >
                                                            <div class="card card-profile" style=" width:250px;margin-left:40px; ">
                                                                      <div class="card-header card-header-image" style="height:300px; width:215px; ">
                                                                            <a href="{{ route('elders.show',$otherfaq->FAQ_PostID) }}">
                                                                                <img class="img" src="{{ $otherfaq->FAQ_Photo }}"> 
                                                                            </a>
                                      
                                                                      </div>
                                                                    
                                                                      <div class="card-body mytable">
                                                                              <h4 class="card-title" style=" font-size:16px;">{{ $otherfaq->FAQ_Title }}</h4>
                                                                              <p class="card-description">
                                                                                {{ $otherfaq->FAQ_CreatedDate }} <br/><br/>
                                                                              <a href="{{ route('elders.show',$otherfaq->FAQ_PostID) }}" class="btn waves-effect" style="font-family: 'Sen', sans-serif;font-size:26px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;font-size:18px;">@lang('home.temple_functions_readmore_btn')</a> 
                                                                              </p>
                                                                      </div>
                                                              </div>
                                                               </div> <!-- End col-md-4 -->
                                                     
                                                 @endforeach
                                                 </div>
                                             </div> <!-- END infinite-scroll -->
                              
                                              <?php }else { ?>
                                             
                                             <div>
                                                 <br/>  <br/>
                                             </div>
                                                 <div id="newwboxes5" class="newwboxes eldermsgrhs" style="display: none;" ><h3>There is no FAQ created by others during {{$currentMonthName}} , {{$currentYear}}  </h3> </div>
                                                     
                                                 <!-- <p > <h3 class="newwboxes alert alert-warning" id="newboxes5" style="display: block;"> There is no FAQ created by Others during {{$currentMonthName}} , {{$currentYear}}  </h3> <br> <br> </p>   -->
                                                     
                                              <?php }  ?>
  
                                              <!--- ********** Elders List Area***********************************
                                            ********************************************************-->
                                             <?php if (isset($elders)   && (count($elders) >0 )  )  { ?>                                       
                                                                                    
                                                        <div   class="newwboxes"  id="newwboxes6" >
                                                                <h2 class="text-center">  @lang('home.posts_index_rselderdetails')</h2>
                                                            <!--Right side page -->
                                                            @foreach ($elders as $elder)
                                                            
                                                   <!-- Grid column -->
                                                <div class="col-lg-6 col-md-12 mb-4" style="margin-top:-80px;">
                                                    
                                                    <!--Card-->
                                                    <div class="card">
                
                                                    <!--Card image-->
                                                    <div class="view overlay hm-white-slight card-home-header-image">
                                            
                                                        <a href="{{ route('profile.index',$elder->UserID) }}">
                                                           @if(($elder->User_photo == "") || ($elder->User_photo == "null"))
                                                            <img class="img" src="/images/frontend_images/avatar.png"  alt="">
                                                           @else
                                                            
                                                            <img class="img" src="{{ $elder->User_photo }}"  alt="">
                                                           @endif
                                                            
                                                           
                                                        </a>
                                                    </div>
                
                                                    <!--Card content-->
                                                    <div class="card-body mytable">
                                                        <!--Title-->
                                                        <h4 class="card-title">{{ $elder->name }}</h4>
                                                                                            <p class="card-description">
                                                                                                
                                                                                                  <a href="{{ route('profile.index',$elder->UserID) }}" class="btn  waves-effect" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">@lang('home.check_profile')</a> 
                                                                                            </p>
                                                                                         </div>
                                                                                    </div>
                                        </div>
                                                              
                                                          @endforeach
                                                </div> <!-- END infinite-scroll -->          
                                                            
                          
                                      
                                              <?php } ?>
                    </div>  <!-- end of inner row-->
                  </div>
                </div>
              </div>

           <!--- ********** End Outer row ***********************************
           ********************************************************-->
          </div><!-- END ROW -->
    </div>
 </div>
      
        <!-- End Shop Page -->
           
    
    <!--- ********** User Not Elder Area***********************************
      *****************************************************************     
      ********************************************************-->
    <?php } else { ?>
            <!-- if User is not  Elder he will see His FAQs , Other FAQs and Elder List -->
                  
           <!--  <form name="sort" id="sort"  method="post" action="/" > -->
          
              <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                      or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
              {!! csrf_field() !!}

                    <!-- Start Shop Page -->
                 <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" style="margin-top:-100px;">
                    <div class="container">

                      <!--- ********** Outer Row Area***********************************
                      ********************************************************-->
                      <div class="row"> <!-- outer Row -->


                        <!--- ********** 1st column Area***********************************
                            ********************************************************-->
                              <div class="col-lg-3 col-3 order-1 order-lg-1 md-mt-40 sm-mt-40">
                                  <div class="row"> <!-- begin  1 col row -->
                                            <div class="shop__sidebar">
                                              <aside class="wedget__categories poroduct--cat">
                                                <h3 class="wedget__title"><b>@lang('home.posts_index_lhactions') </b></h3>
                                                <form id="prodindex"  >
                                                    <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                                                  or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
                                                                  {!! csrf_field() !!}
                                                  <ul class="properties-filter">
                                                      <li  class="selected" name="HisFAQ" id="HisFAQ"  ><a href="javascript:showonlyone('newboxes1');" class="click">@lang('home.faq_raised_by_u')</a>
                                                      </li> 
                                                      <li  class="selected" name="elderlist" id="elderlist"  ><a href="javascript:showonlyone('newboxes2');" class="click">@lang('home.lis_volunteers')</a>
                                                      </li> 
                                                      <li  class="selected" name="volunterform" id="volunterform"  ><a href="javascript:showonlyone('newboxes3');" class="click">@lang('home.Volunteer_Form')</a>
                                                      </li> 
                                                  </ul>

                                                
                                                  <style>
                                                  .newboxes {
                                                        display: none;
                                                    }
                                                  </style>
                                                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                                  <script>
                                                      function showonlyone(thechosenone) {
                                                        $('.newboxes').each(function(index) {
                                                             
                                                              if ($(this).attr("id") == thechosenone) {
                                                                $(this).show();
                                                                }
                                                              else {
                                                                    $(this).hide();  } 
                                                              });
                                                        }
                                                  </script>
                                                </form>
                                              </aside>
                                            </div>
                                  </div>
                                  <!--- ********** second row in 1st column Area***********************************
                                    ********************************************************-->
                                      <div class="row">
                                        <aside class="wedget__categories poroduct--cat">
                                            <h3 class="wedget__title"><b>Current FAQ </b></h3>
                                                  <ul>
                                                      <li><a href="{{ url('/elders/') }}">Current Month </li>
                                                  </ul>
                                            </h3>
                                        </aside>
                                    </div>
                                    <div class="row">
                                        <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
                                              <!-- Start Single Widget -->
                                              <aside class="wedget__categories poroduct--cat">
                                                  <h3 class="wedget__title"><b>Archives </b></h3>
                                                  <ul>
                                                      <li><a href="{{ url('/elders/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                                      <li><a href="{{ url('/elders/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                                      <li><a href="{{ url('/elders/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                                      <li><a href="{{ url('/elders/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                                      <li><a href="{{ url('/elders/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                                      <li><a href="{{ url('/elders/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                                    
                                                  </ul>
                                              </aside>
                                              <!-- End Single Widget -->
                                        <?php ?> 
                                    </div>

                              </div> <!-- end  1 col row -->

                              <!--- ********** 2nd  column Area***********************************
                            ********************************************************-->
                            <div class="col-lg-9 col-9 order-1 order-lg-2">
                              <div class="tab__container">
                                <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">


                                  <div class="row">  <!-- middle column row -->
                                      <!--- ********** Title Area ***********************************
                                            ********************************************************-->
                                            <div class="title">
                                              <h3 class="font-bold text1-center text-uppercase" style="font-family: 'Sen', sans-serif;font-size: 24px;    margin-left: 0px;">@lang('home.reactout')  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              <a class="btn  fa-3x" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" href="{{ route('elders.create') }}"><b style="font-size:20px;font-family: 'Sen', sans-serif;">@lang('home.Raise_Query')</b></a>  
                                              </h3>  
                                            </div>
                                            <!--- ********** His FAQ Area***********************************
                                                ********************************************************-->
                                              <?php if (isset($Hisfaqs)   && (count($Hisfaqs) >0 )  )  { ?>
                                                    <div  class="infinite-scroll newboxes" id="newboxes1" style="display: block;">
                                                            <h2 class="text-center" style="font-family: 'Sen', sans-serif;"> @lang('home.faq_raised_by_u')</h2>
                                                        <!--Right side page -->
                                                        @foreach ($Hisfaqs as $hisfaq)
                                                            <div  class="col-lg-4 col-md-12 mb-4" style="max-width:100%" >
                                                                    <div class="card card-profile" style="width:250px; ">
                                                                            <div class="card-header card-header-image" style="height:300px; width:215px; " >
                                                                                    <a href="{{ route('elders.show',$hisfaq->FAQ_PostID) }}">
                                                                                                    <img src="{{ $hisfaq->FAQ_Photo }}"  alt="/images/frontend_images/avatar.png">
                                             </a>
                                                                                    <!--<div class="colored-shadow" style="background-image: url('{{ $hisfaq->FAQ_Photo }}');opacity: 1;">
                                                                                    </div>-->
                                                                            </div>
                                                                            <div class="card-body mytable"  style= width:250px; ">
                                                                                <h4 class="card-title indigo-text">{{ $hisfaq->FAQ_Title }}</h4>
                                                                                
                                            <p class="card-text">                                                                                  Created On:  {{ $hisfaq->FAQ_CreatedDate }} </p>       
                                            
                                            </div>
                                                                    </div> <!--end card profile-->
                                                          </div> <!-- End col-md-4 -->
                                                          @endforeach

                                                      </div> <!-- END infinite-scroll -->
                                                  
                                                  <?php }else { ?>


                                                        <p > <h3 class="newboxes alert alert-warning" id="newboxes1" style="display: block;"> There is no FAQ created by you during {{$currentMonthName}} , {{$currentYear}}  </h3> <br> <br> </p>
                                                  <?php }  ?>

                                              <!--- ********** Elder List  Area***********************************
                                              ********************************************************-->

                                              <?php if (isset($elders)   && (count($elders) >0 )  )  { ?>                                              
                                                                        
                                                <div   class="infinite-scroll newboxes" id="newboxes2">
                                                        <h2 class="text-center" style="font-family: 'Sen', sans-serif;">  Elder Details</h2>
                                                          <!--Right side page -->
                                                          @foreach ($elders as $elder)
                                          
                                                                  
                                                                      
                                        <!-- Grid column -->
                                                <div class="col-lg-6 col-md-12 mb-4" style="margin-top:-80px;">
                                                    
                                                    <!--Card-->
                                                    <div class="card">
                
                                                    <!--Card image-->
                                                    <div class="view overlay hm-white-slight  card-home-header-image">
                                            
                                                        <a href="{{ route('profile.index',$elder->UserID) }}">
                                                            
                                                           <img class="img" src="{{ $elder->User_photo }}"  alt="/images/frontend_images/avatar.png"> 
                                                           
                                                        </a>
                                                    </div>
                
                                                    <!--Card content-->
                                                    <div class="card-body mytable">
                                                        <!--Title-->
                                                        <h4 class="card-title">{{ $elder->name }}</h4>
                                                                                            <p class="card-description">
                                                                                                
                                                                                                  <a href="{{ route('profile.index',$elder->UserID) }}" class="btn  waves-effect" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">@lang('home.check_profile')</a> 
                                                                                            </p>
                                                                                         </div>
                                                                                    </div>
                                        </div>
                                                              
                                                          @endforeach
                                                </div> <!-- END infinite-scroll -->
                                                    
                                        <?php }else { ?>
                                                      <p> <h3 id="newboxes2" class="newboxes" style="font-family: 'Sen', sans-serif;">  There is no FAQ created by others during {{$currentMonthName}} , {{$currentYear}} </h3>  </br> </br></p>
                                        <?php }  ?>

                                                    <!--- ********** Volunteer Form Area***********************************
                                                    ********************************************************-->

                                                <form id="newboxes3"  class="newboxes" name="volform" method="POST" action="{{route('elders.volunteer')}}">
                                                        {{csrf_field()}}
                                                                    
                                            
                                                    <div class="iColor">
                                                        <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;"> @lang('home.volunteer_p1') </h1>   
                                                    </div>
                                                    <br/><br/><br/>
                                                    <div class="page-content" style="width:80%;">
                                                        <div class="form-v5-content">
                                                            <div class="row col-md-12">
                                                    
                                                                <ul class="iColor" style="margin-top:10px;margin-left:25px;color:black;">
                                                                <li><a href="#"><i class="fa fa-check "></i>&nbsp;&nbsp;&nbsp;<b>@lang('home.volunteer_p2') </b></a></li>
                                                                <li><a href="#"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;<b>@lang('home.volunteer_p3') </b></a></li>
                                                                <li><a href="#"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;<b>@lang('home.volunteer_p4') </b></a></li>
                                                                <li><a href="#"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp; <b>@lang('home.volunteer_p5')</b></a></li>
                                                                </ul>
                                                                <br/>
                                                            
                                                                <div class="iCheck">
                                                                    <input type="checkbox" name="checkbox_field" class="form-check-input" value="1" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<b style="color:#000;">@lang('home.volunteer_p6')</b><br/> <br/>
                                                                    
                                                                    <p id="checkboxerr" style="color:red;text-align: center;"></p>
                                                                </div>
                                                                <br/><br/>
                                                                <div>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                                <button type="submit" class="btn ml-4" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;" onclick="accept_elder()">
                                                                    <b >@lang('home.form_accept')</b></button>
                                                                <button type="submit" class="btn ml-4" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;"  onclick="return false;" > 
                                                                    <b style="font-siz:29px;">@lang('home.form_decline')</b></button>  <br/> <br/>
                                                                </div>
                                                                <script>
                                                                function accept_elder(){
                                                                      if (!$('input[name="checkbox_field"]').is(':checked'))
                                                        			  {
                                                        				$('#checkboxerr').html("Please select the checkbox");
                                                        				event.preventDefault();
                                                        			  }
                                                        			  else
                                                        			  {
                                                        			       $("#checkboxerr").html("");
                                                        			  }
                                                                    
                                                                }
                                                                </script>
                                                            </div> <!-- end row -->
                                                        </div> <!--  end form-v5  -->
                                                    </div>  <!--end page -->
                                                </form>

                            </div> <!-- middle column row -->
                            </div>
                          </div>
                        </div>
                      </div><!-- END Outer ROW -->
                    </div>
                  </div>
                  
                    <!-- End Shop Page -->
       <?php  }  ?>

      
      <script type="text/javascript">
   
   /* The below line can be made to either show pagination index or hide it. 
   If pagination is needed, then make it as $('ul.pagination').show(); and remove the function below*/

       $('ul.pagination').show();
       /* $(function() {
           $('.infinite-scroll').jscroll({
               autoTrigger: true,
               loadingHtml: '<img class="center-block" src="/images/frontend_images/avatar.png" alt="Loading..." />', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
               padding: 0,
               nextSelector: '.pagination li.active + li a',
               contentSelector: 'div.infinite-scroll',
               callback: function() {
                   $('ul.pagination').remove();
               }
           });
       }); */

 
   </script>

   



</body>
</form>
</html>
@include('sweetalert::alert')

@endsection
