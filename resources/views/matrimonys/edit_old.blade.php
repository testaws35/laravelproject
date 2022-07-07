@extends('layouts.app1')

<style type="text/css">

        /* WRAPPERS */
        #wrapper {
          width: 100%;
          overflow-x: hidden;
        }
        .wrapper {
          padding: 0 20px;
        }
        .wrapper-content {
          padding: 20px 10px 40px;
        }
        #page-wrapper {
          padding: 0 15px;
          min-height: 568px;
          position: relative !important;
        }
        @media (min-width: 768px) {
          #page-wrapper {
            position: inherit;
            margin: 0 0 0 240px;
            min-height: 2002px;
          }
        }

        /* Payments */
        .payment-card {
          background: #ffffff;
          padding: 20px;
          margin-bottom: 25px;
          border: 1px solid #e7eaec;
        }
        .payment-icon-big {
          font-size: 60px;
          color: #d1dade;
        }
        .payments-method.panel-group .panel + .panel {
          margin-top: -1px;
        }
        .payments-method .panel-heading {
          padding: 15px;
          background: #f82249;
        }
        .payments-method .panel {
          border-radius: 0;
        }
        .payments-method .panel-heading h5 {
          margin-bottom: 5px;
        }
        .payments-method .panel-heading i {
          font-size: 26px;
        }

        .payment-icon-big {
            font-size: 60px !important;
            color: #d1dade;
        }

        .form-control,
        .single-line {
          background-color: #FFFFFF;
          background-image: none;
          border: 1px solid #e5e6e7;
          border-radius: 1px;
          color: inherit;
          display: block;
          padding: 6px 12px;
          transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
          width: 100%;
          font-size: 14px;
        }
        .text-navy {
            color: #1ab394;
        }
        .text-success {
            color: #1c84c6;
        }
        .text-warning {
            color: #f8ac59;
        }
        .ibox {
          clear: both;
          margin-bottom: 25px;
          margin-top: 0;
          padding: 0;
        }
        .ibox.collapsed .ibox-content {
          display: none;
        }
        .ibox.collapsed .fa.fa-chevron-up:before {
          content: "\f078";
        }
        .ibox.collapsed .fa.fa-chevron-down:before {
          content: "\f077";
        }
        .ibox:after,
        .ibox:before {
          display: table;
        }
        .ibox-title {
          -moz-border-bottom-colors: none;
          -moz-border-left-colors: none;
          -moz-border-right-colors: none;
          -moz-border-top-colors: none;
          background-color: #ffffff;
          border-color: #e7eaec;
          border-image: none;
          border-style: solid solid none;
          border-width: 3px 0 0;
          color: inherit;
          margin-bottom: 0;
          padding: 14px 15px 7px;
          min-height: 48px;
        }
        .ibox-content {
          background-color: #ffffff;
          color: inherit;
          padding: 15px 20px 20px 20px;
          border-color: #e7eaec;
          border-image: none;
          border-style: solid solid none;
          border-width: 1px 0;
        }
        .ibox-footer {
          color: inherit;
          border-top: 1px solid #e7eaec;
          font-size: 90%;
          background: #ffffff;
          padding: 10px 15px;
        }
        .text-danger {
            color: #ed5565;
        }
            

                /* Style the tab */
        .tab {
          
          border: 1px solid #ccc;
          background-color: #f1f1f1;
          width:100%;
          height: 300px;
        }

        /* Style the buttons inside the tab */
        .tab button {
          display: block;
          background-color: inherit;
          color: black;
          padding: 22px 16px;
          width: 100%;
          border: none;
          outline: none;
          text-align: left;
          cursor: pointer;
          transition: 0.3s;
          font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
          background-color: #ddd;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
          background-color: #ccc;
        }


        .TabColor{
            background: #fff; 
            border: 1px solid #ffb606;
            padding: 10px;
            box-shadow: 5px 10px 18px #888888;
          }
 </style>

    @section('content')

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong>{{ $message }}</strong>
                    </div>
                @endif


<div class="container">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container">
            <div class="wrapper wrapper-content animated fadeInRight">
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title text-center" style="font-family: 'Sen', sans-serif;font-size:30px;">
                              @lang('home.matrimonys_edit_heading')
                            </div>
                            <div class="ibox-content">
                                  <div class="panel-group payments-method" id="accordion">
                                    <!-- START panel-default-->
                                  <div class="panel panel-default">
                                        <div class="panel-heading">
                                             <h5 class="panel-title text-white">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#about" style="font-family: 'Sen', sans-serif;color:#fff;text-transform:uppercase;">@lang('home.matrimonys_edit_panelabout') </a>
                                            </h5>
                                        </div>
                                        <div id="about" class="panel-collapse collapse show">
                                            <div class="panel-body"><br/>
                                             <div class="row">
                                                 <div class="col-md-6"> 
                                                      <img src="{{ $matrimony->ProfileUser_Photo }}" alt="Profile" class="img-thumbnail matrimonyedit_photo"> 
                                                  </div><!-- col-md-6 -->
                                                   <div class="col-md-6"> 
                                                          <img src="{{ $matrimony->ProfileUser_Photo1 }}" alt="Profile" class="img-thumbnail matrimonyedit_photo1">
                                                    </div><!-- col-md-6 -->
                                            </div><!--end row --><br/>
                                            
                                           







                                               <div class="row">
                                                    <div class="col-md-12">
                                                       <div class="container">
        
                                                        <!--Grid row-->
                                                        <div class="row">
                                                             <!--Grid column-->
                                                            <div class="col-md-12 mb-4">
                                                              <form action="{{ route('matrimonys.update', $matrimony->RegistrationID) }}" method="POST" enctype="multipart/form-data">
                                                              <input type="hidden" name="RegistrationID" value="{{$matrimony->RegistrationID}}"  >
                                                                @csrf

                                                              <div class="card-details" ><br/>
                                                                   <div class="row">

                                                                 
                                                                             <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                              <!-- <div class="inner-addon right-addon"> -->
                                                                               <div class="inner-addon" >
                                                                                    <label for="card-holder">@lang('home.matrimonys_edit_panelprouname')</label>
                                                                                    <!-- <i class="far fa-user"></i> -->
                                                                                    <input id="card-holder" type="text" class="form-control"  name="ProfileUser_Name"  value="{{ $matrimony->ProfileUser_Name }}" style="font-family: 'Sen', sans-serif;">
                                                                              </div> 
                                                                             </div>

                                                                             
                                                                             <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                               <!-- <div class="inner-addon right-addon"> -->
                                                                                      <div class="inner-addon" >
                                                                                          <label for="card-holder">@lang('home.matrimonys_edit_panelmobileno')</label>
                                                                                          <!-- <i class="far fa-user"></i> -->
                                                                                          <input id="card-holder" type="text" class="form-control"  name="ProfileUser_Mobile"  value="{{ $matrimony->ProfileUser_Mobile  }}" style="font-family: 'Sen', sans-serif;">
                                                                                      </div> 
                                                                             </div>
                                                                  
                                                                             <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                              <!-- <div class="inner-addon right-addon"> -->
                                                                                <div class="inner-addon">
                                                                                  <label>@lang('home.matrimonys_create_basicdetails_gender')</label>
                                                                                    <!-- <i class="far fa-user"></i> -->
                                                                                    <select name="ProfileUser_Gender"  class="form-control" style="font-family: 'Sen', sans-serif;" >
                                                                                      <option value="" disabled selected>@lang('home.matrimonys_create_basicdetails_selectoptiongender')</option>
                                                                                      <option value="Male" {{(old('ProfileUser_Gender') == 'Male'?'selected':'')}}>Male</option>
                                                                                      <option value="Female" {{(old('ProfileUser_Gender') == 'Female'? 'selected':'')}}>Female</option>
                                                                                  </select> <br/><br/>
                                                                                  @if ($errors->has('ProfileUser_Gender'))
                                                                                      <span class="invalid-feedback" role="alert">
                                                                                          <strong>{{ $errors->first('ProfileUser_Gender') }}</strong>
                                                                                      </span>
                                                                                  @endif
                                                                                </select>
                                                                              </div> 
                                                                            </div>

                                                                  
                                                                            <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                              <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                                <label>@lang('home.matrimonys_create_basicdetails_age')</label>
                                                                                <input type="number" name="ProfileUser_Age" class="form-control" value="{{ $matrimony->ProfileUser_Age  }}" min="1" max= "99" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_age_placeholder')">
                                                                                @if ($errors->has('ProfileUser_Age'))
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('ProfileUser_Age') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                                </div> 
                                                                               </div>
                                                                               <div class="col-md-4">
                                                                                <label>@lang('home.matrimonys_create_basicdetails_marstatus')</label> <br>
                                                                              
                                                                                <select  name="ProfileUser_MaritalStatus" class="form-control" required>
                                                                                  <option value="" disabled selected>@lang('home.matrimonys_create_basicdetails_selectoptionstatus')</option>
                                                                                  <option value="Never Married" {{(old('ProfileUser_MaritalStatus') == 'Never Married'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_marstatus_never')</option>
                                                                                  <option value="Divorced" {{(old('ProfileUser_MaritalStatus') == 'Divorced'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_marstatus_divorced')</option>
                                                                                  <option value="Widowed" {{(old('ProfileUser_MaritalStatus') == 'Widowed'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_marstatus_widowed')</option> 
                                                                                </select><br/><br/>
                                                                                @if ($errors->has('ProfileUser_MaritalStatus'))
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('ProfileUser_MaritalStatus') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                               </div>
                                                                               <div class="col-md-4">
                                                                                <label>@lang('home.matrimonys_create_basicdetails_email')</label>
                                                                                <input type="email" class="form-control" name="ProfileUser_email" value="{{ $matrimony->ProfileUser_email  }}" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_email')">
                                                                                @if ($errors->has('ProfileUser_email'))
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('ProfileUser_email') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                               </div>
                                                                               <div class="col-md-4">
                                                                                <label>@lang('home.matrimonys_create_basicdetails_address')</label> <br>
                                                                                <input type="text" class="form-control" name="ProfileUser_Address"  value="{{old('ProfileUser_Address')}}"   oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_address_placeholder')">
                                                                                @if ($errors->has('ProfileUser_Address'))
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $errors->first('ProfileUser_Address') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                                 </div>
                                                                             <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                                      <div class="inner-addon" >
                                                                                        <label for="card-holder">@lang('home.matrimonys_edit_paneldob')</label>
                                                                                        <!-- <i class="far fa-user"></i> -->
                                                                                        <input id="card-holder" type="date" class="form-control"  name="ProfileUser_DOB"  value="{{ $matrimony->ProfileUser_DOB }}" style="font-family: 'Sen', sans-serif;">
                                                                                      </div> 
                                                                             </div>
                                                                            <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                                      <div class="inner-addon">
                                                                                          <label for="card-holder">@lang('home.matrimonys_edit_panelpob')</label>
                                                                                          <!-- <i class="far fa-user"></i> -->
                                                                                          <input id="card-holder" type="text" class="form-control"  name="ProfileUser_PlaceofBirth"  value="{{ $matrimony->ProfileUser_PlaceofBirth }}" style="font-family: 'Sen', sans-serif;">
                                                                                      </div> 
                                                                            </div>
                                                                            <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                              <!-- <div class="inner-addon right-addon"> -->
                                                                                <div class="inner-addon">
                                                                                    <label for="card-holder">@lang('home.matrimonys_edit_panelheight')</label>
                                                                                    <!-- <i class="far fa-user"></i> -->
                                                                                    <select name="ProfileUser_Height"  class="form-control" style="font-family: 'Sen', sans-serif;" >
                                                                                      <option value="" disabled selected style="font-family: 'Sen', sans-serif;">{{ $matrimony->ProfileUser_Height }}</option>
                                                                                      <option value="4ft 1in">4ft 1in </option>
                                                                                      <option value="4ft 2in">4ft 2in </option>
                                                                                      <option value="4ft 3in">4ft 3in</option>
                                                                                      <option value="4ft 4in">4ft 4in</option>
                                                                                      <option value="4ft 5in">4ft 5in</option>
                                                                                      <option value="4ft 6in">4ft 6in</option>
                                                                                      <option value="4ft 7in">4ft 7in</option>
                                                                                      <option value="4ft 8in">4ft 8in </option>
                                                                                      <option value="4ft 9in">4ft 9in</option>
                                                                                      <option value="4ft 10in">4ft 10in</option>
                                                                                      <option value="4ft 11in">4ft 11in</option>
                                                          
                                                                                      <option value="5ft 1in">5ft 1in </option>
                                                                                      <option value="5ft 2in">5ft 2in </option>
                                                                                      <option value="5ft 3in">5ft 3in</option>
                                                                                      <option value="5ft 4in">5ft 4in</option>
                                                                                      <option value="5ft 5in">5ft 5in</option>
                                                                                      <option value="5ft 6in">5ft 6in</option>
                                                                                      <option value="5ft 7in">5ft 7in</option>
                                                                                      <option value="5ft 8in">5ft 8in </option>
                                                                                      <option value="5ft 9in">5ft 9in</option>
                                                                                      <option value="5ft 10in">5ft 10in</option>
                                                                                      <option value="5ft 11in">5ft 11in</option>
                                                          
                                                                                      <option value="6ft 1in">6ft 1in </option>
                                                                                      <option value="6ft 2in">6ft 2in </option>
                                                                                      <option value="6ft 3in">6ft 3in</option>
                                                                                      <option value="6ft 4in">6ft 4in</option>
                                                                                      <option value="6ft 5in">6ft 5in</option>
                                                                                      <option value="6ft 6in">6ft 6in</option>
                                                                                      <option value="6ft 7in">6ft 7in</option>
                                                                                      <option value="6ft 8in">6ft 8in </option>
                                                                                      <option value="6ft 9in">6ft 9in</option>
                                                                                      <option value="6ft 10in">6ft 10in</option>
                                                                                      <option value="6ft 11in">6ft 11in</option>
                                                                                      <option value="7ft">7ft</option>
                                                                                </select>
                                                                              </div> 
                                                                            </div>
                                                                            <div class="form-group col-md-4" style="font-family: 'Sen', sans-serif;">
                                                                                  <!-- <div class="inner-addon right-addon"> -->
                                                                                  <div class="inner-addon">
                                                                                      <label for="card-holder">@lang('home.matrimonys_edit_paneladdress')</label>
                                                                                      <!-- <i class="far fa-user"></i> -->
                                                                                      <input id="card-holder" type="text" class="form-control" name="ProfileUser_Address" value="{{ $matrimony->ProfileUser_Address }}" style="font-family: 'Sen', sans-serif;">
                                                                                  </div> 
                                                                              </div>  <br/>
                                                                              <div class="form-group col-md-12" style="font-family: 'Sen', sans-serif;">
                                                                                    <!-- <div class="inner-addon right-addon"> -->
                                                                                  <div class="inner-addon">
                                                                                      <label for="card-holder">@lang('home.matrimonys_edit_panelexpect')</label>
                                                                                      <!-- <i class="far fa-user"></i> -->
                                                                                      <!-- <textarea id="form7" class="md-textarea form-control" rows="3"></textarea> -->
                                                                                      <input id="card-holder" type="text" class="form-control" name="ProfileUser_Description_Expectation" value="{{ $matrimony->ProfileUser_Description_Expectation}}" style="font-family: 'Sen', sans-serif;">
                                                                                  </div> 
                                                                              </div>
        
                                                                  </div>
                                                                </div>
                                                                <button type = "submit" class = "btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.matrimonys_edit_panelsave_btn')</button>
                                                              </form>
                                                      
                                                            </div>
                                                            <!--Grid column-->
                                                      
                                                          </div>
                                                          <!--Grid row-->
                                                      
                                                        </div><!-- End container   -->
            
                                             
                                                    </div>
                                                </div>
                                                 </div>
                                        </div>
                                    </div> <!--END --> 


           <!-- START panel-default-->
           <div class="panel panel-default">
            <div class="panel-heading">
                <!-- <div class="pull-right">
                    <i class="fa fa-cc-paypal text-success"></i>
                </div> -->
                <h5 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#background" style="font-family: 'Sen', sans-serif;color:#fff;text-transform:uppercase;">@lang('home.matrimonys_edit_panelbgk')</a>
                </h5>
            </div>
            <div id="background" class="panel-collapse collapse show">
                <div class="panel-body">
                      <div class="row">
                        <div class="col-md-10">
                            <div class="container">
        
                             <!--Grid row-->
                             <div class="row">
                                                  <!--Grid column-->
                                                            <div class="col-md-12" >
                                                      
                                                              <form action="{{ route('matrimonys.update', $matrimony->RegistrationID) }}" method="POST" enctype="multipart/form-data">
                                                              <input type="hidden" name="RegistrationID" value="{{$matrimony->RegistrationID}}">
                                                                @csrf

                                                              <div class="card-details"><br/>
                                                                  <!-- <h3 class="title">Enter your Card Details</h3> -->
                                                                  <div class="row" style="font-family: 'Sen', sans-serif;">
                                                                    <div class="form-group col-md-6">
                                                                     <!-- <div class="inner-addon right-addon"> -->
                                                                            <div class="inner-addon">
                                                                      <label for="card-holder">@lang('home.matrimonys_edit_panelcaste')</label>
                                                                      <!-- <i class="far fa-user"></i> -->
                                                                      <input id="card-holder" type="text" class="form-control"  name="ProfileUser_Category"  value="{{ $matrimony->ProfileUser_Category}}" disabled>
                                                                     </div> 
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_panelsubcaste')</label>
                                                                       <!-- <i class="far fa-user"></i> -->
                                                                       <input id="card-holder" type="text" class="form-control"  name="ProfileUser_Subcaste"  value="{{ $matrimony->ProfileUser_Subcaste}}" disabled>
                                                                      </div> 
                                                                     </div>
                                                                    
                                                                     <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_panelfathercaste')</label>
                                                                       <!-- <i class="far fa-user"></i> -->
                                                                       <input id="card-holder" type="text" class="form-control" name="ProfileUser_Father_Caste" value="{{ $matrimony->ProfileUser_Father_Caste}}" >
                                                                      </div> 
                                                                     </div>
                                                                     <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelmothercaste')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <input id="card-holder" type="text" class="form-control" name="ProfileUser_Mother_Caste" value="{{ $matrimony->ProfileUser_Mother_Caste}}" >
                                                                       </div> 
                                                                      </div>  
                                                                 
                                                                 <div class="form-group col-md-6">
                                                                  
                                                                    
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelprecaste')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <!-- <textarea id="form7" class="md-textarea form-control" rows="3"></textarea> -->
                                                                        {{-- <input id="card-holder" type="text" class="form-control" name="ProfileUser_PreferredSubcaste" value="{{ $matrimony->ProfileUser_PreferredSubcaste}}" > --}}
                                                                       
                                                                        <select id="caste" name="ProfileUser_PreferredCaste" class="form-control"  required onchange="castemaster()">
                                                                            <option>Select</option>
                                                                              
                                                                              @foreach($castemasters as $key => $caste)
                                                                                 <option value="{{$caste}}"> {{$caste}}</option>
                                                                              @endforeach
                                                                             {{-- <option value=""  selected>{{ $matrimony->ProfileUser_PreferredCaste}} </option> --}}

                                                                              <option value="All">All</option>
                                                                         </select> 
                                                                      
                                                                        
                                                                      </div>


                                                                      <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelprestar')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <!-- <textarea id="form7" class="md-textarea form-control" rows="3"></textarea> -->
                                                                        <input id="card-holder" type="text" class="form-control" name="ProfileUser_PreferredStar" value="{{ $matrimony->ProfileUser_PreferredStar}}" >
                                                                       </div> 
                                                                      </div>


        
                                                                  </div>
                                                                </div>
                                                                <button type ="submit" class ="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.matrimonys_edit_panelsave_btn')</button>
                                                              </form>
                                                      
                                                            </div>
                                                            <!--Grid column-->
                                                      
                                                          </div>
                                                          <!--Grid row-->
                          
                            </div>
                        
        
                 
                        </div>
                    </div>
                     </div>
            </div>
        </div> <!--END --><br/>
        
        
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="margin-top:-20px;">
                                            <!-- <div class="pull-right">
                                                <i class="fa fa-cc-amex text-success"></i>
                                                <i class="fa fa-cc-mastercard text-warning"></i>
                                                <i class="fa fa-cc-discover text-danger"></i>
                                            </div> -->
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#family" style="font-family: 'Sen', sans-serif;color:#fff;text-transform:uppercase;">@lang('home.matrimonys_edit_panelfamily')</a>
                                            </h5>
                                        </div>
                                        <div id="family" class="panel-collapse collapse show">
                                            <div class="panel-body">
            
                                                
                                             <!--Grid row-->
                                             <div class="row" style="font-family: 'Sen', sans-serif;">
                                                  <!--Grid column-->
                                                            <div class="col-md-12 mb-4">
                                                      
                                                              <form action="{{ route('matrimonys.update', $matrimony->RegistrationID) }}" method="POST" enctype="multipart/form-data">
                                                              <input type="hidden" name="RegistrationID" value="{{$matrimony->RegistrationID}}">
                                                                @csrf

                                                              <div class="card-details" ><br/>
                                                                  <!-- <h3 class="title">Enter your Card Details</h3> -->
                                                                  <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                     <!-- <div class="inner-addon right-addon"> -->
                                                                            <div class="inner-addon">
                                                                      <label for="card-holder">@lang('home.matrimonys_edit_panelfatname')</label>
                                                                      <!-- <i class="far fa-user"></i> -->
                                                                      <input id="card-holder" type="text" class="form-control"  name="ProfileUser_FatherName"  value="{{ $matrimony->ProfileUser_FatherName}}" >
                                                                     </div> 
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_panelmomname')</label>
                                                                       <!-- <i class="far fa-user"></i> -->
                                                                       
                                                                       <input id="card-holder" type="text" class="form-control"  name="ProfileUser_MotherName"  value="{{ $matrimony->ProfileUser_MotherName}}">
                                                                    
                                                                      </div> 
                                                                     </div>
                                                                    
                                                                     <div class="col-md-6">
                                                                      <label>@lang('home.matrimonys_create_personaldetails_fatcaste')</label>
                                                                      <input type="text" class="form-control" name="ProfileUser_Father_Caste" value="{{old('ProfileUser_Father_Caste')}}"  oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_fatcaste_placeholder')">
                                                                      @if ($errors->has('ProfileUser_Father_Caste'))
                                                                              <span class="invalid-feedback" role="alert">
                                                                                  <strong>{{ $errors->first('ProfileUser_Father_Caste') }}</strong>
                                                                              </span>
                                                                      @endif
                                                                      </div>
                                                                      <div class="col-md-6">
                                                                        <label>@lang('home.matrimonys_create_personaldetails_momcaste')</label>
                                                                        <input type="text" class="form-control" name="ProfileUser_Mother_Caste" value="{{old('ProfileUser_Mother_Caste')}}"   oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_momcaste_placeholder')"><br/>
                                                                        @if ($errors->has('ProfileUser_Mother_Caste'))
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $errors->first('ProfileUser_Mother_Caste') }}</strong>
                                                                                </span>
                                                                        @endif    
                                                                  </div>
                                                                     
                                                                     <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_panelfatocc')</label>
                                                                       <!-- <i class="far fa-user"></i> -->
                                                                       <select name="ProfileUser_Father_Occupation"   class="form-control" required>
                                                                        <option> {{ $matrimony->ProfileUser_Father_Occupation}} </option>
                                                                        <option value="Employed">Employed </option>
                                                                        <option value="Business">Business </option>
                                                                        <option value="Retired">Retired</option>
                                                                        <option value="Not Employed">Not Employed </option>
                                                                        <option value="Passed Away">Passed Away </option>
                                                                        
                                                                        </select>
                                                                      </div> 
                                                                     </div>
                                                                     <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelmomocc')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <select name="ProfileUser_Mother_Occupation" class="form-control"  required>
                                                                          <option>{{ $matrimony->ProfileUser_Mother_Occupation}}  </option>
                                                                          <option value="Homemaker">Homemaker </option>
                                                                          <option value="Employed">Employed </option>
                                                                          <option value="Business">Business </option>
                                                                          <option value="Retired">Retired</option>
                                                                          <option value="Not Employed">Not Employed </option>
                                                                          <option value="Passed Away">Passed Away </option>
                                                                    </select>
                                                                       
                                                                        {{-- <input id="card-holder" type="text" class="form-control" name="ProfileUser_Mother_Occupation" value="{{ $matrimony->ProfileUser_Mother_Occupation}}" > --}}
                                                                       
                                                                      
                                                                      </div> 
                                                                      </div>  
                                                                 
                                                                 <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelnosis')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <!-- <textarea id="form7" class="md-textarea form-control" rows="3"></textarea> -->
                                                                        <input id="card-holder" type="text" class="form-control" name="ProfileUser_Sisters_Num" value="{{ $matrimony->ProfileUser_Sisters_Num }}" >
                                                                       </div> 
                                                                      </div>
                                                                      <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelnobro')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <!-- <textarea id="form7" class="md-textarea form-control" rows="3"></textarea> -->
                                                                        <input id="card-holder" type="text" class="form-control" name="ProfileUser_Brothers_Num" value="{{ $matrimony->ProfileUser_Brothers_Num}}" >
                                                                       </div> 
                                                                      </div>
                                                                      <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelmarrsis')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <!-- <textarea id="form7" class="md-textarea form-control" rows="3"></textarea> -->
                                                                        <input id="card-holder" type="text" class="form-control" name="ProfileUser_MarriedSis_Num" value="{{ $matrimony->ProfileUser_MarriedSis_Num  }}" >
                                                                       </div> 
                                                                      </div>
                                                                      <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelmarrbro')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <!-- <textarea id="form7" class="md-textarea form-control" rows="3"></textarea> -->
                                                                        <input id="card-holder" type="text" class="form-control" name="ProfileUser_MarriedBro_Num" value="{{ $matrimony->ProfileUser_MarriedBro_Num}}" >
                                                                       </div> 
                                                                      </div>

        
                                                                  </div>
                                                                </div>
                                                                <button type ="submit" class ="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.matrimonys_edit_panelsave_btn')</button>
                                                              </form>
                                                      
                                                            </div>
                                                            <!--Grid column-->
                                                      
                                                          </div>
                                                          <!--Grid row-->
        
        
                                                    </div>
                                               
                                                   </div>
                                            </div> <br/>
                                            <!-- start Panel-default -->
                                            <div class="panel panel-default">
                                        <div class="panel-heading" style="margin-top:-40px;">
                                            <!-- <div class="pull-right">
                                                <i class="fa fa-cc-amex text-success"></i>
                                                <i class="fa fa-cc-mastercard text-warning"></i>
                                                <i class="fa fa-cc-discover text-danger"></i>
                                            </div> -->
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#education" style="font-family: 'Sen', sans-serif;color:#fff;text-transform:uppercase;">@lang('home.matrimonys_edit_paneleducation')</a>
                                            </h5>
                                        </div>
                                        <div id="education" class="panel-collapse collapse show">
                                            <div class="panel-body">
            
                                                
                                             <!--Grid row-->
                                             <div class="row" style="font-family: 'Sen', sans-serif;">
                                                  <!--Grid column-->
                                                            <div class="col-md-12 mb-4">
                                                      
                                                              <form action="{{ route('matrimonys.update', $matrimony->RegistrationID) }}" method="POST" enctype="multipart/form-data">
                                                              <input type="hidden" name="RegistrationID" value="{{$matrimony->RegistrationID}}">
                                                                @csrf

                                                              <div class="card-details" ><br/>
                                                                  <!-- <h3 class="title">Enter your Card Details</h3> -->
                                                                  <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                     <!-- <div class="inner-addon right-addon"> -->
                                                                            <div class="inner-addon">
                                                                      <label for="card-holder">@lang('home.matrimonys_edit_paneldegree')</label>
                                                                      <!-- <i class="far fa-user"></i> -->
                                                                      <input id="card-holder" type="text" class="form-control"  name="ProfileUser_Degree"  value="{{ $matrimony->ProfileUser_Degree}}" >
                                                                     </div> 
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_paneldesig')</label>
                                                                       <!-- <i class="far fa-user"></i> -->
                                                                       <input id="card-holder" type="text" class="form-control"  name="ProfileUser_CurrentDesignation"  value="{{ $matrimony->ProfileUser_CurrentDesignation }}">
                                                                      </div> 
                                                                     </div>
                                                                    
                                                                     <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_paneleducompname')</label>
                                                                       <!-- <i class="far fa-user"></i> -->
                                                                       <input id="card-holder" type="text" class="form-control" name="ProfileUser_CurrentCompany" value="{{ $matrimony->ProfileUser_CurrentCompany}}" >
                                                                      </div> 
                                                                     </div>
                                                                     <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_paneleincome')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <select name="ProfileUser_Salary" class="form-control" required>
                                                                          <option value="" disabled selected>{{ $matrimony->ProfileUser_Salary}} </option>
                                                                          <option value="Upto INR 1 Lakh">Upto INR 1 Lakh </option>
                                                                          <option value="INR 1 Lakh to 2 Lakh">INR 1 Lakh to 2 Lakh </option>
                                                                          <option value="INR 2 Lakh to 4 Lakh">INR 2 Lakh to 4 Lakh</option>
                                                                          <option value="INR 4 Lakh to 7 Lakh">INR 4 Lakh to 7 Lakh </option>
                                                                          <option value="INR 7 Lakh to 10 Lakh">INR 7 Lakh to 10 Lakh</option>
                                                                          <option value="INR 10 Lakh to 15 Lakh">INR 10 Lakh to 15 Lakh</option>
                                            
                                                                          <option value="INR 15 Lakh to 20 Lakh">INR 15 Lakh to 20 Lakh</option>
                                                                          <option value="INR 20 Lakh to 30 Lakh">INR 20 Lakh to 30 Lakh </option>
                                                                          <option value="INR 30 Lakh to 50 Lakh">INR 30 Lakh to 50 Lakh</option>
                                                                          <option value="INR 50 Lakh to 75 Lakh">INR 50 Lakh to 75 Lakh</option>
                                                                          <option value="INR 75 Lakh to 1 Crore">INR 75 Lakh to 1 Crore</option>
                                                                          <option value="INR 1 Crore & above">INR 1 Crore & above</option>
                                                                          <option value="Not Applicable">Not Applicable</option>
                                                                    </select>
                                                                        {{-- <input id="card-holder" type="text" class="form-control" name="ProfileUser_Salary" value="{{ $matrimony->ProfileUser_Salary }}" > --}}
                                                                       </div> 
                                                                      </div>  
                                                                  </div>
                                                                </div>
                                                                <button type ="submit" class ="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.matrimonys_edit_panelsave_btn')</button>
                                                              </form>
                                                      
                                                            </div>
                                                            <!--Grid column-->
                                                      
                                                          </div>
                                                          <!--Grid row-->
        
        
                                                    </div>
                                               
                                                   </div>
                                            </div>   <!-- End Panel-default --><br/>
                                                <!-- start Panel-default -->
                                                <div class="panel panel-default">
                                        <div class="panel-heading" style="margin-top:-40px;">
                                            <!-- <div class="pull-right">
                                                <i class="fa fa-cc-amex text-success"></i>
                                                <i class="fa fa-cc-mastercard text-warning"></i>
                                                <i class="fa fa-cc-discover text-danger"></i>
                                            </div> -->
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#phydetails" style="font-family: 'Sen', sans-serif;color:#fff;text-transform:uppercase;">@lang('home.matrimonys_edit_panelphy')</a>
                                            </h5>
                                        </div>
                                        <div id="phydetails" class="panel-collapse collapse show">
                                            <div class="panel-body">
            
                                                
                                             <!--Grid row-->
                                             <div class="row" style="font-family: 'Sen', sans-serif;">
                                                  <!--Grid column-->
                                                            <div class="col-md-12 mb-4">
                                                      
                                                              <form action="{{ route('matrimonys.update', $matrimony->RegistrationID) }}" method="POST" enctype="multipart/form-data">
                                                              <input type="hidden" name="RegistrationID" value="{{$matrimony->RegistrationID}}">
                                                                @csrf

                                                              <div class="card-details" ><br/>
                                                                  <!-- <h3 class="title">Enter your Card Details</h3> -->
                                                                  <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                     <!-- <div class="inner-addon right-addon"> -->
                                                                            <div class="inner-addon">
                                                                      <label for="card-holder">@lang('home.matrimonys_edit_panelbgroup')</label>
                                                                      <!-- <i class="far fa-user"></i> -->
                                                                      <select name="ProfileUser_BloodGroup" class="form-control" required>
                                                                        <option value="" disabled selected>{{ $matrimony->ProfileUser_BloodGroup}} </option>
                                                                        <option value="Don't Know">Don't Know</option>
                                                                        <option value="A+">A+</option>
                                                                        <option value="A-">A-</option>
                                                                        <option value="B+">B+</option>
                                                                        <option value="B-">B-</option>
                                                                        <option value="AB+">AB+</option>
                                                                        <option value="AB-">AB-</option>
                                                                        <option value="O+">O+ </option>
                                                                        <option value="O-">O-</option>
                                                                       
                                                                    </select>
                                                                      {{-- <input id="card-holder" type="text" class="form-control"  name="ProfileUser_BloodGroup"  value="{{ $matrimony->ProfileUser_BloodGroup}}" > --}}
                                                                     
                                                                    </div> 
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_panelstatus')</label>
                                                                       <!-- <i class="far fa-user"></i> -->
                                                                       <input id="card-holder" type="text" class="form-control"  name="ProfileUser_PhysicalStatus"  value="{{ $matrimony->ProfileUser_PhysicalStatus}}">
                                                                      </div> 
                                                                     </div>
                                                                    
                                                                     <div class="form-group col-md-6">
                                                                      <!-- <div class="inner-addon right-addon"> -->
                                                                             <div class="inner-addon">
                                                                       <label for="card-holder">@lang('home.matrimonys_edit_paneldisa')</label>
                                                                       <select  name="ProfileUser_AnyDisability"  class="form-control" required>
                                                                        <option value=""  selected>{{ $matrimony->ProfileUser_AnyDisability}}</option>
                                                                        <option value="Not Applicable">Not Applicable</option>
                                                                        <option value="Never Married">Hearing Disability</option>
                                                                        <option value="Divorced">Vision Disability</option>
                                                                        <option value="Widowed">Polio Disability</option> 
                                                                        <option value="Widowed">Downs syndrome Disability</option> 
                                                                        <option value="Widowed">Dyslexia Disability</option> 
                                                                        <option value="Widowed">Other Disability</option> 
                                                                      </select>

                                                                       {{-- <input id="card-holder" type="text" class="form-control" name="ProfileUser_AnyDisability" value="{{ $matrimony->ProfileUser_AnyDisability}}" > --}}
                                                                      </div> 
                                                                     </div>
                                                                     <div class="form-group col-md-6">
                                                                       <!-- <div class="inner-addon right-addon"> -->
                                                                              <div class="inner-addon">
                                                                        <label for="card-holder">@lang('home.matrimonys_edit_panelbodytype')</label>
                                                                        <!-- <i class="far fa-user"></i> -->
                                                                        <select  name="ProfileUser_BodyType" class="form-control"  required>
                                                                         <option value=""  selected>{{ $matrimony->ProfileUser_BodyType}}</option>
                                                                          <option value="Athletic">Athletic</option>
                                                                          <option value="Average">Average</option>
                                                                          <option value="Heavy">Heavy</option>
                                                                          <option value="Slim">Slim </option>
                                                                        </select> 
                                                                        {{-- <input id="card-holder" type="text" class="form-control" name="ProfileUser_BodyType" value="{{ $matrimony->ProfileUser_BodyType}}" > --}}
                                                                      
                                                                      </div> 
                                                                      </div>  
                                                                  </div>
                                                                </div>
                                                                <button type ="submit" class ="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.matrimonys_edit_panelsave_btn')</button>
                                                              </form>
                                                      
                                                            </div>
                                                            <!--Grid column-->
                                                      
                                                          </div>
                                                          <!--Grid row-->
        
        
                                                    </div>
                                               
                                                   </div>
                                            </div> <br/>  <!-- End Panel-default -->


                              <!-- start Panel-default -->
                              <div class="panel panel-default">
                                                   <div class="panel-heading" style="margin-top:-40px;">
                                            <!-- <div class="pull-right">
                                                <i class="fa fa-cc-amex text-success"></i>
                                                <i class="fa fa-cc-mastercard text-warning"></i>
                                                <i class="fa fa-cc-discover text-danger"></i>
                                            </div> -->
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#horoscopeDetails" style="font-family: 'Sen', sans-serif;color:#fff;text-transform:uppercase;">@lang('home.matrimonys_edit_panelhoro')</a>
                                            </h5>
                                        </div>
                                        <div id="horoscopeDetails" class="panel-collapse collapse show">
                                            <div class="panel-body">
            
                                                
                                             <!--Grid row-->
                                             <div class="row" style="font-family: 'Sen', sans-serif;">
                                                  <!--Grid column-->
                                                            <div class="col-md-12 mb-4">
                                                      
                                                              <form action="{{ route('matrimonys.update', $matrimony->RegistrationID) }}" method="POST" enctype="multipart/form-data">
                                                              <input type="hidden" name="RegistrationID" value="{{$matrimony->RegistrationID}}">
                                                                @csrf
                                                                <br/>
                                                        <img class="img-thumbnail" class="pull-right" src="{{ $matrimony->ProfileUser_Horoscope }}" width="30%" height="30%" > 
  
                                                       <!--   <input id="ProfileUser_Horoscope" type="file" class="form-control" name="ProfileUser_Horoscope">-->
  
                                                        <!--  <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
</div><form class="md-form">
  <div class="file-field">
    <div class="btn btn-primary btn-sm float-left">
      <span>Choose file</span>
      <input type="file">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" placeholder="Upload your file">
    </div>
  </div>
</form> -->               
                                                              </form>
                                                      
                                                            </div>
                                                            <!--Grid column-->
                                                      
                                                          </div>
                                                          <!--Grid row-->
        
        
                                                    </div>
                                               
                                                   </div> 
         
                                            </div>   <!-- End Panel-default -->




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        
        
        </div><!-- End Div COntainer-->


      <script>
        $(document).ready(function() {
          alert("in ready!");
          alert({{$matrimony->ProfileUser_PreferredCaste}});
              $('caste select').val({{$matrimony->ProfileUser_PreferredCaste}});
       alert("ready!");
});
     
          </script>



@endsection
