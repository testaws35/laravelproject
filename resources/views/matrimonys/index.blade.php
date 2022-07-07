@extends('layouts.app1')
@section('content')

<!--{{-- /**
// classname - Matrimony-Indexblade.php
// author - Raveendra 
// release version - 1.0
// Description-  This model represents the Matrimony registration table
// created date - Nov 2019
**/ --}}-->


<!DOCTYPE html>

<html>

<head>

    <title>Matrimony</title>

    <style type="text/css">


/* Matrimony CARD */
.card {
    background: #ffffff;
    margin-top: 15px;
    margin-bottom: 15px;
    transition: .5s;
    border: 0;
    border-radius: .1875rem;
    display: inline-block;
    position: relative;
    width: 100%;
    -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); 
	-moz-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);
    box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);
   }
  .card:hover{
	box-shadow: 2px 4px 10px 4px #7b6c53; 
	-webkit-box-shadow: 2px 4px 10px 4px #7b6c53; 
	-moz-box-shadow:2px 4px 10px 4px #7b6c53;
	}
  .card .body {
    font-size: 14px;
    color: #424242;
    padding: 20px;
    font-weight: 400;
   }
  .profile-page .profile-header {
    position: relative
   }

  .profile-page .profile-header .profile-image img {
    border-radius: 50%;
    width: 140px;
    height:140px;
    border: 3px solid #fff;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)
   }

  .profile-page .profile-header .social-icon a {
    margin: 0 5px
   }

  .profile-page .profile-sub-header {
    min-height: 60px;
    width: 100%
   }

  .profile-page .profile-sub-header ul.box-list {
    display: inline-table;
    table-layout: fixed;
    width: 100%;
    background: #eee
   }

  .profile-page .profile-sub-header ul.box-list li {
    border-right: 1px solid #e0e0e0;
    display: table-cell;
    list-style: none
  }

  .profile-page .profile-sub-header ul.box-list li:last-child {
    border-right: none
   }

  .profile-page .profile-sub-header ul.box-list li a {
		display: block;
		padding: 15px 0;
		color: #424242
		}
  .ParagraphColor p{
    color:#000000; 
    font-size: 18px;
    font-weight:400;
    font-family: 'Sen', sans-serif;
   }
   body{
    background:#eee;    
}

/* Matrimony CARD END */


/* Price Table*/
.pb-100 {
	padding-bottom: 100px;
}
.pt-100 {
	padding-top: 100px;
}
a{
    text-decoration:none;
}

.section-title h4 {
  font-size: 14px;
  font-weight: 500;
  color: #777;
}
.section-title h2 {
	font-size: 32px;
	text-transform: capitalize;
	margin: 15px 0;
	display: inline-block;
	position: relative;
	font-weight: 700;
	padding-bottom: 15px;
	letter-spacing: 1px;
	text-transform: uppercase;
}
.section-title p {
	font-weight: 300;
	font-size: 14px;
}
.black-bg .section-title h2, .black-bg .section-title h4, .black-bg .section-title p {
  color:#fff
}
.section-title h2:before {
  position: absolute;
  content: "";
  width: 150px;
  height: 1px;
  background-color: #777;
  bottom: 0;
  left: 50%;
  margin-left: -75px;
}
.section-title h2:after {
  position: absolute;
  content: "";
  width: 80px;
  height: 3px;
  background-color: #e16038;
  border: darkblue;
  bottom: -1px;
  left: 50%;
  margin-left: -40px;
}
.section-title {
  margin-bottom: 70px;
}
.single-price {
	text-align: center;
	padding: 30px;
	box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.2);
}
.price-title h4 {
  font-size: 24px;
  text-transform: uppercase;
  font-weight: 600;
}
.price-tag {
  margin: 30px 0;
}
.price-tag {
	margin: 30px 0;
background-color: #fafafa;
	color: #000;
	padding: 10px 0;
}
.center.price-tag {
	background-color: tomato;
	color:#fff
}
.price-tag h2 {
	font-size: 45px;
	font-weight: 600;
	font-family: 'Sen', sans-serif;
}
.price-tag h2 span {
  font-weight: 300;
  font-size: 16px;
  font-style: italic;
}
.price-item ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.price-item ul li {
  font-size: 14px;
  padding: 5px 0;
  border-bottom: 1px dashed #eee;
  margin: 5px 0;
}
.price-item ul li:last-child {
  border-bottom: 0;
}
.single-price a {
  margin-top: 15px;
}
a.box-btn {
	background-color: tomato;
	padding: 5px 20px;
	display: inline-block;
	color: #fff;
	text-transform: capitalize;
	border-radius: 3px;
	font-size: 15px;
	transition: .3s;
}
a.box-btn:hover, a.border-btn:hover {
	background-color: #d35400;
}


/* NEW PRICE MEMBERSHIP */
/******************* Pricing Table Demo - 6 *****************/
/*.demo6{background:#DEDDDB;padding:30px 0} */
.pricingTable6{padding-bottom:20px;margin-bottom: 80px;background:#fff;border-radius:10px;text-align:center;position:relative;transition:all .3s ease 0s}
.pricingTable6 .title{padding:40px 20px 170px;margin:0 0 30px;background:linear-gradient(to bottom right,#fa6fe6,#ffef65);font-size:30px;font-weight:600;color:#fff;text-transform:uppercase;overflow:hidden;position:relative}
.pricingTable6 .title:after,.pricingTable6 .title:before{content:"";width:280px;height:200px;border-radius:80px;background:#fff;position:absolute;bottom:-175px;left:-46px;transform:rotate(-85deg)}
.pricingTable6 .title:after{border-radius:100px;bottom:auto;top:150px;left:auto;right:-70px;transform:rotate(-40deg)}
.pricingTable6 .price-value{display:inline-block;width:140px;height:140px;line-height:65px;border-radius:50%;background:#fff;box-shadow:0 0 0 8px rgba(0,0,0,.3);padding:30px 0;font-size:35px;font-weight:600;color:#404040;position:absolute;top:110px;left:50%;transform:translateX(-50%);transition:all .3s ease 0s}
.pricingTable6:hover .price-value{background:linear-gradient(to bottom,#fa6fe6,#ffef65);color:#fff}
.pricingTable6 .month{display:block;font-size:16px;font-weight:400;line-height:0}
.pricingTable6 .pricing-content{list-style:none;padding:0;margin-bottom:20px;text-align:left;transition:all .3s ease 0s}
.pricingTable6 .pricing-content li{padding:7px 0 7px 50px;font-size:16px;font-weight:600;color:#000;letter-spacing:1px;position:relative}
.pricingTable6 .pricing-content li:before{content:"\f00c";font-family:"Font Awesome 5 Free";font-weight:900;width:24px;height:24px;line-height:20px;border-radius:50%;border:2px solid #fb6ee5;color:#fb6ee5;text-align:center;position:absolute;top:50%;left:12px;transform:translateY(-50%)}
.pricingTable6 .pricing-content li.disable{color:#707070}
.pricingTable6 .pricing-content li.disable:before{display:none}
.pricingTable6 .pricingTable-signup{display:inline-block;padding:13px 45px;border-radius:30px;background:linear-gradient(to right,#fa6fe6,#ffef65);font-size:22px;font-weight:700;color:#404040;text-transform:uppercase;z-index:1;position:relative;transition:all .3s ease 0s;border:none;}
.pricingTable6 .pricingTable-signup:hover{color:#fff}
.pricingTable6 .pricingTable-signup:before{content:"";width:98%;height:92%;border-radius:30px;background:#fff;position:absolute;top:2px;left:2px;z-index:-1}
.pricingTable6 .pricingTable-signup:hover:before{background:0 0}
.pricingTable6.blue .title{background:linear-gradient(to bottom right,#44f2b5,#4cbde2)}
.pricingTable6.blue:hover .price-value{background:linear-gradient(to bottom,#44f2b5,#4cbde2)}
.pricingTable6.blue .pricing-content li:before{border-color:#44f2b5;color:#44f2b5}
.pricingTable6.blue .pricingTable-signup{background:linear-gradient(to bottom right,#44f2b5,#4cbde2)}
.pricingTable6.green .title{background:linear-gradient(to bottom right,#66fd9c,#f6fa60)}
.pricingTable6.green:hover .price-value{background:linear-gradient(to bottom,#66fd9c,#f6fa60)}
.pricingTable6.green .pricing-content li:before{border-color:#66fd9c;color:#66fd9c}
.pricingTable6.green .pricingTable-signup{background:linear-gradient(to bottom right,#66fd9c,#f6fa60)}
@media only screen and (max-width:990px){.pricingTable6{margin-bottom:30px}
}
@media only screen and (max-width:767px){.pricingTable6 .title:before{height:400px;top:100px;left:55px}
.pricingTable6 .title:after{width:550px;height:550px;top:150px;right:-100px;transform:rotate(-20deg)}
}
@media only screen and (max-width:480px){.pricingTable6 .title:after,.pricingTable6 .title:before{width:280px;height:200px;top:220px;left:-46px}
.pricingTable6 .title:after{top:150px;left:auto;right:-70px}
}

/* END PRICE MEMBERSHIP */

</style>

</head>

<body>

<!-- Container -->
<div class="container profile-page">
        <div class="title">
           
          <!-- checking whether User is Registered Member-->
          <?php if (\Auth::user()->IsReginMatrimony==1 ) {?>
                
                <!-- checking whether No Failures and User ihas created profile and has a result-->
                <?php if (is_null($Failed)  && (isset($matrimonys)  && count($matrimonys)  >0  ) && (isset($profileuser)) ) {?>
                <!--{{-- <php if (! is_null($matrimonys)  && $matrimonys[0]->RegistrationID  >0  ) {?> --}}-->

                  <!-- START MATRIMONY CSS IN APP1.BLADE.PHP    -->
                  <div class="container matrimonyprofile-page">
                          <!-- *********************************************************************************
                              ************************************** start Top panel******************************************* -->
                                    
                          <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="matrimonycard matrimonyprofile-header">
                                                <div class="body">
                                                  <form id="casteForm"  name="casteForm" method="GET" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-12">
                                                          <h6 style="font-family: 'Sen', sans-serif;font-size:30px; ">@lang('home.matrimonys_index_welcome_heading') </h6><br/>
                                                            <!--start inner row-->
                                                            <div class="row">
                                                            <div class="col-md-3"> 
                                                            <label><b style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_edit_panelprecaste')</b>&nbsp;</label>
                                                            </div>
                                                            <div name="lblcastediv" id="lblcastediv" class="col-md-3"> 
                                                                     <label name="lblcaste" id="lblcaste"><b style="font-family: 'Sen', sans-serif;">{{$profileuser->ProfileUser_PreferredCaste}} </b></label>
                                                            </div>
                                                            <div class="col-md-3" id="User_Castediv" name="User_Castediv" style="display:none" >   
                                                              <select id="User_Caste" name="User_Caste"     required onchange="fetchindex()" style="font-family: 'Sen', sans-serif;" >
                                                                  <option value="" disabled selected > @lang('home.matrimonys_index_welcome_select_option')</option>
                                                                    @foreach($castemasters as $key => $caste)
                                                                      <option value="{{$caste}}"> {{$caste}}</option>
                                                                    @endforeach
                                                                    <option value="All" style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_index_welcome_select_optionall')</option>
                                                               </select> 
                                                            </div><br/>
                                                            <div class="col-md-6"> 
                                                            <button type="button" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;height:50px; width:500px"   onclick="showCaste()">@lang('home.matrimony_chngpref_caste')</button>
                                                            </div>
                                                      </div><br/><!--end inner row-->

                                                      
                                                      <div class="row">
                                                            <div class="col-md-8"> 
                                                            
                                                            <label style="font-family: 'Sen', sans-serif;"><b style="font-family: 'Sen', sans-serif;">@lang('home.Your_Caste'):</b> &nbsp; {{$profileuser->ProfileUser_Category}} </label>
                                                            </div>
                                                      </div><!--end inner row-->
                                                      <div class="row">
                                                          <div class="col-md-8"> 
                                                            <label style="font-family: 'Sen', sans-serif;"><b style="font-family: 'Sen', sans-serif;">@lang('home.Your_Subcaste'):</b> &nbsp; {{$profileuser->ProfileUser_Subcaste}} </label>
                                                          </div>
                                                     </div><!--end inner row-->

                                                          <br/>
                                                          
                                                  </div><!-- end col-lg-6--> 
                                                            <div class="col-lg-6 col-md-6 col-12">
                                                                <h5 style="margin-bottom: 40px;font-family: 'Sen', sans-serif;"><br/><br/>@lang('home.matrimony_data1')@lang('home.matrimony_data2') 
                                                                     <br/> 
                                                    
                                                                       <a  href="{{ route('matrimonys.edit',$profileuser->RegistrationID) }}" title="Edit Matrimony profile"><b style="font-size:10px;">
                                                                            <i class="fa fa-edit fa-2x"></i></b></a>  
                                                                      <br/> <br/>  <br/> 
                                                                      @lang('home.matrimony_profile_delete') 
                                                                       <a  href="{{ route('matrimonys.delete',$profileuser->RegistrationID) }}" title="Unpublish profile"><b style="font-size:10px;">
                                                                            <i class="fa fa-unlink fa-2x"></i></b></a>  
                                                                </h5>
                                                            </div> <!-- end col-lg-6-->               
                                                    </div><!-- end first row-->
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                  </form>
                                            </div>                    
                                            </div>
                                        </div>
                                      </div>
                                      </div>  <!-- END MATRIMONY -->
                              <!-- *********************************************************************************
                              **************************************end Top panel******************************************* -->
                                    
                                       
                                <h1 class="font-bold text-center matrimonys_index_welcome_listmsg">@lang('home.matrimonys_index_welcome_listmsg'),   {{$profileuser->ProfileUser_Name}} !
                                </h1> 
                               
                                <br/>
                                 <!-- *********************************************************************************
                                **************************************start Profile display******************************************* -->
                                    
                                 <!--START Row  -->
                                  <div class="row">
                             
                   
                                            @foreach ($matrimonys as $matrimony)

                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                            
                                                <div class="card profile-header"  > 
                                                      <div class="body">
                                                          <div class="row"> 
                                                              <div class="col-lg-4 col-md-4 col-12">
                                                              
                                                               
                                                <div class="profile-image float-md-right"> 
                                                      @if($matrimony->ProfileUser_Photo)
                                                      <img class="img-thumbnail" src="{{ $matrimony->ProfileUser_Photo }}" alt="Profile">
                                                      @else 
                                                      <img class="img-thumbnail" src="/images/frontend_images/avatar.png">
                                                      @endif    
                                                </div>
                                                  
                                                      </div>
                                                      
                                                      <div class="col-lg-8 col-md-8 col-12 ParagraphColor">
                                                          <a href="{{ route('matrimonys.show',$matrimony->RegistrationID) }}" style="text-decoration:none;">
                                                              <h4 class="m-t-0 m-b-0 matrimony_proname">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $matrimony->ProfileUser_Name }}</b> </h4>
                                                           <p>{{ $matrimony->ProfileUser_Age }} yrs,&nbsp;&nbsp;
                                                              {{ $matrimony->ProfileUser_Height }} /ft,&nbsp;&nbsp; {{ $matrimony->ProfileUser_DOB }} <br/>
                                                              {{ $matrimony->ProfileUser_Category }}<br/>
                                                               {{ $matrimony->ProfileUser_LocationID }},
                                                               {{ $matrimony->ProfileUser_Degree }}<br/>
                                                               {{ $matrimony->ProfileUser_CurrentDesignation }}     &nbsp;&nbsp; {{ $matrimony->ProfileUser_Rashi }} 
                                                          </p>

                                                          </a>
                                                      </div>   
                                                                
                                                  </div>
                                              </div>                    
                                          </div> <!-- </a>-->
                                      </div><!-- end col 12-->
                                @endforeach
                

                              </div><!-- Row END -->  

                               <!-- *********************************************************************************
                              **************************************end display profile******************************************* -->
                                    
                              
                              <?php } else if (isset($Failed) && (isset($profileuser)) && ( strcmp( $Failed, "Sorry no matching profiles") == 0)  ) { ?>
                               

                               <!-- *********************************************************************************
                              **************************************start Top panel******************************************* -->
                                    
                                         <!-- START MATRIMONY CSS IN APP1.BLADE.PHP    -->
                                <div class="container matrimonyprofile-page">
                                  <form id="casteForm"  name="casteForm" method="GET"   enctype="multipart/form-data">
                                  <div class="row">
                                      <div class="col-xl-12 col-lg-12 col-md-12">
                                          <div class="matrimonycard matrimonyprofile-header">
                                              <div class="body">
                                                  <div class="row">
                                                      <div class="col-lg-6 col-md-6 col-12">
                                                        <h6 style="font-family: 'Sen', sans-serif;font-size:30px;">Based on your preference </h6><br/>
                                                          <!--start inner row-->
                                                          <div class="row">
                                                          <div class="col-md-3"> 
                                                          <label><b style="font-family: 'Sen', sans-serif;">@lang('home.matrimony_prefcaste'):</b>&nbsp;</label>
                                                          </div>
                                                          <div name="lblcastediv" id="lblcastediv" class="col-md-3"> 
                                                            {{-- <label name="lblcaste" id="lblcaste"><b>{{$profileuser->ProfileUser_PreferredCaste}} </b></label> --}}
                                                            <label name="lblcaste" id="lblcaste"><b style="font-family: 'Sen', sans-serif;">{{$profileuser->ProfileUser_PreferredCaste}} </b></label>
                                                          </div>
                                                          <div class="col-md-3" id="User_Castediv" name="User_Castediv" style="display:none" >   
                                                            <select id="User_Caste" name="User_Caste"     required onchange="fetchindex()" style="font-family: 'Sen', sans-serif;">
                                                                <option value="" disabled selected > Select</option>
                                                                  @foreach($castemasters as $key => $caste)
                                                                    <option value="{{$caste}}"> {{$caste}}</option>
                                                                  @endforeach
                                                                  <option value="All">All</option>
                                                             </select> 
                                                          </div><br/>
                                                          <div class="col-md-6"> 
                                                          <button type="button" class="btn"  style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;height:50px; width:500px"  onclick="showCaste()">@lang('home.matrimony_chngpref_caste')</button>
                                                          </div>
                                                    </div><br/><!--end inner row-->

                                                    <div class="row">
                                                      <div class="col-md-8"> 
                                                    
                                                      <label style="font-family: 'Sen', sans-serif;"><b style="font-family: 'Sen', sans-serif;">@lang('home.Your_Caste'):</b> &nbsp; {{$profileuser->ProfileUser_Category}} </label>
                                                      </div>
                                                    </div><!--end inner row-->
                                                    <div class="row">
                                                          <div class="col-md-8"> 
                                                          <label style="font-family: 'Sen', sans-serif;"><b style="font-family: 'Sen', sans-serif;">@lang('home.Your_Subcaste'):</b> &nbsp; {{$profileuser->ProfileUser_Subcaste}} </label>
                                                          </div>
                                                    
                                                    </div><!--end inner row-->
                                                        <br/>
                                                        
                                                </div><!-- end col-lg-6--> 
                                                          <div class="col-lg-6 col-md-6 col-12">
                                                              <h5 style="margin-bottom: 40px;font-family: 'Sen', sans-serif;"><br/><br/>@lang('home.matrimony_data1') <br/>
                                                               @lang('home.matrimony_data2')
                                                                <a  href="{{ route('matrimonys.edit',$profileuser->RegistrationID) }}" title="Edit Matrimony profile"><b style="font-size:10px;color:red;">Edit<i class="fa fa-pencil fa-2x"></i></b></a> 
                                                     <br/> <br/>  <br/> 
                                                                 @lang('home.matrimony_profile_delete')
                                                                       <a  href="{{ route('matrimonys.delete',$profileuser->RegistrationID) }}" title="Unpublish profile"><b style="font-size:10px;">
                                                                            <i class="fa fa-unlink fa-2x"></i></b></a>  

                                                              </h5>
                                                          </div> <!-- end col-lg-6-->               
                                                  </div><!-- end first row-->
                                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                             </form>
                                          </div>                    
                                          </div>
                                      </div>
                                    </div>
                                    </div>  <!-- END MATRIMONY -->

                                 <!-- *********************************************************************************
                                **************************************end Top panel******************************************* -->
                                    
                                    <br>
                                    <br>

                                    <h2 class="font-bold text-center" style="font-family: 'Sen', sans-serif;">Sorry  {{$profileuser->ProfileUser_Name}}  , currently there is no matching profiles for you!!  New profiles will be added every day and so please keep checking this page later..
                                    </h2>
                                    <br> <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br><br>
                                    <br>

                               <?php } else if (isset($Failed) && ( strcmp( $Failed,"Your membership had expired. Kindly renew.") == 0)  ) { ?>
                                      <h2 class="font-bold text-center " style="font-family: 'Sen', sans-serif;">@lang('home.mem_expire')
                                      </h2>
                                      
                                                      
                                   <!-- Matrimonial Price Plans   
                                   --- commented for free service ----->
                          
                                    <script>
                                    $(document).ready(function(){
                                        $('#payment').css('display','block');
                                    });
                                    </script>
                                    <br/>
                                    
                             
                            
                             <!-- <a class="btn btn-info fa-3x" href="{{ route('matrimonys.create') }}">
                                   <b style="font-size:20px;font-family: 'Sen', sans-serif;text-align:center;">Create Matrimony profile</b>
                              </a>-->
                             
                                                  
                      <?php } else if(isset($Failed) && ( strcmp( $Failed, "You have deleted profile in Matrimony section") == 0) ) { ?>
                          <h2 class="font-bold text-center " style="font-family: 'Sen', sans-serif;">You may have deleted profile. Kindly re-register in Matrimony. Please read the plan, pay and avail the services
                          </h2> 
                                    <script>
                                    $(document).ready(function(){
                                        $('#payment').css('display','block');
                                    });
                                    </script>
                          
                                  
                              
                         <?php } else if(isset($Failed) && ( strcmp( $Failed,@lang('home.matri_noactive')) == 0) ) { ?>
                             <br/>
                             <br/>
                              <h2 class="font-bold text-center mat_heading">@lang('home.matri_noactive')@lang('home.kindly_create')  </h2> 
                              <a class="btn btn-info fa-3x matrimony_createbtn" href="{{ route('matrimonys.create') }}">
                                   <b class="mat_createpro_title">Create Matrimony profile</b>
                              </a>  
                              <br> <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    
                 <?php } ?>  <!-- end of inner if-->

              <!--  else of outer if- scenario Not registered  
                  /********************
                    * Free membership code - Begin
                    */     
                  -->
              <?php } else { ?>
               
                   <?php  if (isset($Message)  && ( strcmp( $Failed, "Free Service") == 0)  ) {  ?> 
                             <br/>
                             <br/>
                              <h2 class="font-bold text-center " style="font-family: 'Sen', sans-serif;">Free Matrimony services are provided for a short time. Kindly avail the opporunity  </h2> 
                              <a class="btn btn-info fa-3x matrimony_createbtnfree" href="{{ url('/setMatrimonyExpiry/?Message=4') }}">
                                   <b style="font-size:20px;font-family: 'Sen', sans-serif;text-align:center;">Avail Free Matrimony services</b>  
                               
                              </a>  
                              <br> <br>
                                   
                                    
                   <?php } else { ?>  <!--  end of Free memebership --> 
                  
                            <h2 class="font-bold text-center " style="font-family: 'Sen', sans-serif;">@lang('home.matrimony_reg_msg')
                            </h2>
                                    <script>
                                    $(document).ready(function(){
                                        $('#payment').css('display','block');
                                    });
                                    </script>
                                              
                            <!-- Matrimonial Price Plans   -->
                      
                           
                          <!-- Add membership plan -->
                      <?php } ?><!-- end of else of Free memebership -->
                    
                  <?php } ?><!-- end of outer if -->
                             
                            <div class="demo6" id="payment" style="display:none">
                                <div class="container">
                                    <h2  class="text-center" style="font-family: 'Sen', sans-serif;">@lang('home.mem_plans') </h2>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="pricingTable6">
                                                <h3 class="title" style="font-family: 'Sen', sans-serif;">Standard</h3>
                                                <div class="price-value" style="font-family: 'Sen', sans-serif;"><i class="fa fa-inr"></i> 200
                                                    <span class="month" style="font-family: 'Sen', sans-serif;">/ @lang('home.monthly') </span>
                                                </div>
                                                <ul class="pricing-content" style="font-family: 'Sen', sans-serif;">
                                                    <li>@lang('home.login_welcomemenu')</li>
                                                    <li>@lang('home.matrimony_mem_p2')</li>
                                                    <li>@lang('home.matrimony_mem_p3')</li>
                                                    <li>@lang('home.matrimony_mem_p4')</li>
                                                    <li>50 @lang('home.matrimony_mem_p5')</li>
                                                  {{--  <li class="disable"><i class="fa fa-times"></i></li>
                                                    <li class="disable"><i class="fa fa-times"></i></li> --}}
                                                </ul>
                                                <button  value="month"  id="rzp-button" onclick="Razorpayment(this.value)" class="pricingTable-signup rzp-button" style="font-family: 'Sen', sans-serif;">@lang('home.matrimony_mem_p6')</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="pricingTable6 blue">
                                                <h3 class="title" style="font-family: 'Sen', sans-serif;">Business</h3>
                                                <div class="price-value" style="font-family: 'Sen', sans-serif;"><i class="fa fa-inr"></i> 600
                                                    <span class="month" style="font-family: 'Sen', sans-serif;">/@lang('home.half_yearly')</span>
                                                </div>
                                                <ul class="pricing-content" style="font-family: 'Sen', sans-serif;">
                                                    <li>@lang('home.login_welcomemenu')</li>
                                                    <li>@lang('home.matrimony_mem_p2')</li>
                                                    <li>@lang('home.matrimony_mem_p3')</li>
                                                    <li>@lang('home.matrimony_mem_p4')</li>
                                                    <li>150 @lang('home.matrimony_mem_p5')</li>
                                                </ul>
                                                <button  value="half" id="rzp-button-1"  onclick="Razorpayment(this.value)"  class="pricingTable-signup rzp-button" style="font-family: 'Sen', sans-serif;">@lang('home.matrimony_mem_p6')</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="pricingTable6 green">
                                                <h3 class="title" style="font-family: 'Sen', sans-serif;">Premium</h3>
                                                <div class="price-value" style="font-family: 'Sen', sans-serif;"><i class="fa fa-inr"></i> 1000
                                                    <span class="month" style="font-family: 'Sen', sans-serif;">/ @lang('home.per_year')</span>
                                                </div>
                                                <ul class="pricing-content" style="font-family: 'Sen', sans-serif;">
                                                    <li>@lang('home.login_welcomemenu')</li>
                                                    <li>@lang('home.matrimony_mem_p2')</li>
                                                    <li>@lang('home.matrimony_mem_p3')</li>
                                                    <li>@lang('home.matrimony_mem_p4')</li>
                                                    <li>@lang('home.unlimtd_pro')</li>
                                                </ul> 
                                                <button  value="year" id="rzp-button-2"  onclick="Razorpayment(this.value)"  class="pricingTable-signup rzp-button" style="font-family: 'Sen', sans-serif;" >@lang('home.matrimony_mem_p6')</a>
                                            </div>
                                        </div>
                                        <input type="hidden" value="" id="paymentId" readonly>
                                    </div>
                                </div>
                            </div>
                            
                          
         </div>
  </div><!-- Container END -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $("#div1").fadeIn();
  
  });

</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  /** add this function where you are using the ShowToast Alert ***/
  function showToastAlert(title, body, icon)
  {
	$.toast({
	heading: title,
	text: body,
	showHideTransition: 'fade',
	icon: icon,
	position: 'top-center'
	});
  }
  //monthly
  function Razorpayment(mem){
      var amt;
      if(mem == "half")
      {
          amt = 200;
      }
      else if(mem == "month")
      {
          amt = 100;
      }
      else if(mem == "year")
      {
          amt = 300;
      }
      else{}
      var options = 
         {
            "key":"{{$razorPayKey}}", // Enter the Key ID generated from the Dashboard    
            "amount": amt, 
            // "amount" : "{{$total *100}}",
            "currency": "INR",   
            "name": "Tecple",   
            "description": "Online Payment",  
            "image": "https://tecpleglobal.com/img/tecple-logo.jpg", 
            "prefill": {
        		"name": "{{$user->name}}", // pass customer name
        		"email": "{{$user->email}}" ,              //'info@rvsion.in',// customer email
        		"contact": "{{$user->User_Phone}}"
        	},
        
        	"theme": 
        	{
        		"color": "#f82249" // screen color
        	},
            "handler": function (response)
            {
        	    console.log(response); 
        
        	    $('#paymentId').val(response.razorpay_payment_id);
        	
        	   $.toast({
                	heading: "Payment Success!",
                	text: "Please wait Processing... Do not press back button or refresh",
                	showHideTransition: 'fade',
                	icon: "success",
                	position: 'bottom-right'
                }); 
                membershipcreate(mem);
            }
         };
             var rzp = new Razorpay(options);
             rzp.open();    
        
  }

 </script>
 <script>
     
     function membershipcreate(mem)
     {
         let paymentId = $('#paymentId').val();
		 console.log(paymentId);
		 $.get( "/get/razor/payment/"+paymentId, function( payment ) {
			console.log(payment);
		 
		 let paymentObj = JSON.parse(payment);
		 let finalAmount =paymentObj.amount;
		
    	
    	
		 let paymentMethod = paymentObj.method;   //$('#paymentMethod').val();	 
		 let transactionStatus = paymentObj.status; //$('#transactionStatus').val();
		
		let data = {
			 
		     "flag" : {
		         "flag" : mem
		     },      
			 "payment": {
				"finalamount": finalAmount,
				"transactionid": paymentId,
				"transactionstatus": transactionStatus,
				"paymentmethod": paymentMethod
			
			 },
			 
			
			 
		}
		 console.log(data);
		$.post( "/setMatrimonyExpiry", data, function( res ) 
		{
			 if(res.success){
				window.location.href="/matrimonys/create/?success=1";
			 }
		});
		
	    });
     }
     
     
 </script>
 
<!--  CASTE SUBCASTE  SCRIPT -->
<script>
      
    function showCaste(){
      //alert("in showcaste");
      document.getElementById("User_Castediv").style.display="block";
      document.getElementById("lblcastediv").style.display="none";
    }

    function fetchindex()
    {
      var e = document.getElementById("User_Caste");
      var CasteName = e.options[e.selectedIndex].value;
    
     if(CasteName == "All")
     {
          window.location.href = "{{url('/matrimonys?User_Caste=All')}}";
     }
     else if(CasteName == "Tamil Viswakarma")
     {
         window.location.href = "{{url('/matrimonys?User_Caste=Tamil Viswakarma')}}";
     }
     else if(CasteName == "Telugu Viswakarma")
     {
         window.location.href = "{{url('/matrimonys?User_Caste=Telugu Viswakarma')}}";
     }
     else
     {
         
     }
     /*if(confirm("Are you sure you want to change caste?")){
              event.preventDefault();
              document.getElementById("casteForm").submit();
     }*/
    }
    </script>
    <!-- END CASTE SUBCASTE Script  -->

    </body>
 </html>
        

@endsection
