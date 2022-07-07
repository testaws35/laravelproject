@extends('layouts.app1')

@section('content')

<html>

<head>

    <title>Matrimony</title>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- References: https://github.com/fancyapps/fancyBox -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!-- Link for sweet alert -->
   
    
    <script src="path/to/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="path/to/sweet-alert.css" />

    <script src="sweet\node_modules\sweetalert\dist\sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweet\node_modules\sweetalert\dist\sweetalert.css">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css"/> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    <style type="text/css">
     
 
      /* START NEW REGISTER */

          #regForm {
            background-color: lightdark;
          /*   margin: 100px auto; comment ravenndra on 14-01-2020*/
              font-family: 'Sen', sans-serif;
            padding: 40px;
            width: 90%;
            min-width: 300px;
            margin-left: 60px;  /* raveendra added 22-06-2020 */
          /* // border: 1px solid #fff; */
            -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); 
              -moz-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); 
            box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); /* comment ravenndra on 14-01-2020 */
            /* box-shadow: 10px 10px 5px #aaaaaa;border-bottom-color:rgb(248, 34, 73); */
            
            border-bottom-color:rgb(248, 34, 73);
            border-bottom-style: solid;
            border-top-color:rgb(248, 34, 73);
            border-top-style: solid;
          }
          
          .required {
                      color: red;
                    }

          h1 {
            text-align: center;  
          }

          input {
            padding: 10px;
            width: 100%;
            font-size: 13px;
            font-family: 'Sen', sans-serif;
            border: 1px solid #aaaaaa;
            
          }

          select {
            padding: 10px;
            width: 100%;
            font-size: 15px;
            font-family: 'Sen', sans-serif;
          }

          /* Mark input boxes that gets an error on validation: */
          input.invalid {
            background-color: #ffdddd; color: red;
          }

          /* Hide all steps by default: */
          .tab {
            display: none;
          }

          button {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: 'Sen', sans-serif;
            cursor: pointer;
          }

          button:hover {
            opacity: 0.8;
          }

          #prevBtn {
            background-color: #bbbbbb;
          }

          /* Make circles that indicate the steps of the form: */
          .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;  
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
          }

          .step.active {
            opacity: 1;
          }

          /* Mark the steps that are finished and valid: */
          .step.finish {
            background-color: #4CAF50;
          }

          .rrow {
            margin:15px 0;
          }


          .rrow label {
            margin-bottom: 0;
            margin-left: 5px;
            padding-bottom:10px;
              color: #000000;
              font-size: 14px;
              font-weight: 700;
              font-family: 'Sen', sans-serif;
              white-space: nowrap;
          }
          .invalid-feedback{
              color:red;
              font-size: 14px;
          }

          input::placeholder {
              color: #000;
              font-size: 14px;
              font-weight: 400;
              font-family: 'Sen', sans-serif;
          }

         /* END NEW REGISTER PAGE */
         /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
            }
            
            /* Firefox */
            input[type=number] {
              -moz-appearance: textfield;
            }
    </style>

</head>

<body >
<div class="container">

    <div class="title">
          <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_create_heading')</h1>   
    </div> 
    <div class="row">
      <div class="col-sm-12">
        <form action="{{ route('matrimonys.store') }}" id="regForm"  class="form-image-upload" method="POST" enctype="multipart/form-data">

             <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                   or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
            {!! csrf_field() !!}
       
           <!--  @if (count($errors) > 0)
        
                <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                </div>
        
            @endif  -->
         @if(isset($success))
         <div class="alert alert-success align-div-center" id="success-alert">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong> Success! </strong>Your Membership created Successfully!
          
            <script type="text/javascript"> 
                setTimeout(function () 
                { 
                    // Closing the alert 
                    $('#success-alert').alert('close'); 
                }, 5000); 
            </script> 
         </div>
         @endif
           @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>
                                  {{ $error }}
                              </li>
                          @endforeach
                      </ul>
                </div>
            @endif

          
                    
            <!-- One "tab" for each step in the form: -->
            <div class="tab" id="tab1">
            <h2 class="text-center" style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_create_panelbasicdetails_head')</h2>
               <div class="row rrow">
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_basicdetails_name') <span aria-hidden="true" class="required">*</span></label>
                            <!-- Aruna added- expression value="old('ProfileUser_Name')}}" is used  to set the old value
                                  in the form in case of error
                                  otherwise the form is cleared every time there is an error 
                                  This is one example where the dropdown is filled by foreach clause -->
                            <input type="text" id="name" name="ProfileUser_Name" maxlength="20" value="{{old('ProfileUser_Name')}}"  oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_name')">
                            <span id="name_error" class="invalid-feedback" style="display:none;">Please provide Name</span>
                            
                                                          
                      </div>

                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_basicdetails_gender')<span aria-hidden="true" class="required">*</span></label>
                              <!-- Aruna added- expression (old('ProfileUser_Gender') == 'Male'?'selected':'')}} is used  to set the old value in the form in case of error
                                    otherwise the form is cleared every time there is an error 
                                    This is one example where the dropdown is populated by actual values like Male, Female -->
                              <select id="gender" name="ProfileUser_Gender" required>
                                  <option value="0" disabled>@lang('home.matrimonys_create_basicdetails_selectoptiongender')</option>
                                  <option value="Male" {{(old('ProfileUser_Gender') == 'Male'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_gender_male')</option>
                                  <option value="Female" {{(old('ProfileUser_Gender') == 'Female'? 'selected':'')}}>@lang('home.matrimonys_create_basicdetails_gender_female')</option>
                              </select> <br/><br/>
                              <span id="gender_error" class="invalid-feedback" style="display:none;">Please Select gender</span>
                              @if ($errors->has('ProfileUser_Gender'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Gender') }}</strong>
                                  </span>
                              @endif
                      </div>
                     <div class="col-md-6">
                          <label>@lang('home.matrimonys_create_basicdetails_dob')<span aria-hidden="true" class="required"><span aria-hidden="true" class="required">*</span></span></label>
                          <input type="date" id="dob" name="ProfileUser_DOB" value="{{old('ProfileUser_DOB')}}" onblur="getage()"  oninput="this.className = ''" placeholder="Date of birth" required>
                          @if ($errors->has('ProfileUser_DOB'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('ProfileUser_DOB') }}</strong>
                              </span>
                          @endif
                          <span id="dtebrth" class="invalid-feedback" style="display:none">Please provide your date of birth</span>
                      </div>
                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_basicdetails_age')<span aria-hidden="true" class="required">*</span></label>
                              <input id="userage" type="number"  name="ProfileUser_Age" value="{{old('ProfileUser_Age')}}" minlength="2" maxlength="2" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_age')"  readonly>
                              <span id="age_error" class="invalid-feedback" style="display:none;">Please provide Age</span>
                                  
                              
                      </div>

                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_basicdetails_marstatus')<span aria-hidden="true" class="required">*</span></label> <br>
                            
                              <select id="maritalstatus"  name="ProfileUser_MaritalStatus" required>
                                <option value="0" disabled>@lang('home.matrimonys_create_basicdetails_marstatus')</option>
                                <option value="Never Married" {{(old('ProfileUser_MaritalStatus') == 'Never Married'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_marstatus_never')</option>
                                <option value="Divorced" {{(old('ProfileUser_MaritalStatus') == 'Divorced'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_marstatus_divorced')</option>
                                <option value="Widowed" {{(old('ProfileUser_MaritalStatus') == 'Widowed'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_marstatus_widowed')</option> 
                              </select><br/><br/>
                              <span id="ms_error" class="invalid-feedback" style="display:none;">Please select Marital Status</span>
                              @if ($errors->has('ProfileUser_MaritalStatus'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_MaritalStatus') }}</strong>
                                  </span>
                              @endif
                       </div>

                      
                       <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_basicdetails_email')<span aria-hidden="true" class="required"><span aria-hidden="true" class="required"><span aria-hidden="true" class="required">*</span></span></span></label>
                              <input type="email" id="email" name="ProfileUser_email" value="{{old('ProfileUser_email')}}" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_email')" required>
                              <span id="usremail" class="invalid-feedback" style="display:none"> Entered Email not valid. Please enter proper Email-ID </span>
                         <!--  @if ($errors->has('ProfileUser_email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_email') }}</strong>
                                  </span>
                              @endif-->
                      </div>

                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_basicdetails_pob')<span aria-hidden="true" class="required">*</span></label> <br>
                              <input type="text" maxlength="20" name="ProfileUser_PlaceofBirth" id="pob" value="{{old('ProfileUser_PlaceofBirth')}}" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_pob')" required><br/><br/>
                              <span id="pob_error" class="invalid-feedback" style="display:none">Please Provide Place of Birth</span>

                              <!--@if ($errors->has('ProfileUser_PlaceofBirth'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_PlaceofBirth') }}</strong>
                                  </span>
                              @endif-->
                      </div>
                     
                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_basicdetails_address')<span aria-hidden="true" class="required">*</span></label> <br>
                              <input type="address" id="address" maxlength="50" name="ProfileUser_Address"  value="{{old('ProfileUser_Address')}}"   oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_address')" required>
                              <span id="address_error" class="invalid-feedback" style="display:none">Please Provide Address</span>
                              <!--@if ($errors->has('ProfileUser_Address'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Address') }}</strong>
                                  </span>
                              @endif-->
                      </div>

                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_basicdetails_loc')<span aria-hidden="true" class="required">*</span></label>
                              <input type="text" id="loc" maxlength="50" name="ProfileUser_LocationID" value="{{old('ProfileUser_LocationID')}}" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_loc')" required><br/><br/>
                              <span id="location_error" style="color:red; display:none">Please Provide Address</span>
                              <!--@if ($errors->has('ProfileUser_LocationID'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_LocationID') }}</strong>
                                  </span>
                              @endif-->
                      </div>
                      
                     

                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_basicdetails_disa')<span aria-hidden="true" class="required">*</span></label> <br>
                            <select id="anydis"  name="ProfileUser_AnyDisability" required>
                              <option value="0" disabled>@lang('home.matrimonys_index_welcome_select_option')</option>
                              <option value="Not Applicable" {{(old('ProfileUser_AnyDisability') == 'Not Applicable'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_disa_notapp')</option>
                              <option value="Hearing Disability" {{(old('ProfileUser_AnyDisability') == 'Hearing Disability'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_disa_heardis')</option>
                              <option value="Vision Disability" {{(old('ProfileUser_AnyDisability') == 'Vision Disability'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_disa_visdis')</option>
                              <option value="Polio Disability" {{(old('ProfileUser_AnyDisability') == 'Polio Disability'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_disa_poldis')</option> 
                              <option value="Downs syndrome Disability" {{(old('ProfileUser_AnyDisability') == 'Downs syndrome Disability'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_disa_dowsdis')</option> 
                              <option value="Dyslexia Disability" {{(old('ProfileUser_AnyDisability') == 'Dyslexia Disability'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_disa_dydis')</option> 
                              <option value="Other Disability" {{(old('ProfileUser_AnyDisability') == 'Other Disability'?'selected':'')}}>@lang('home.matrimonys_create_basicdetails_disa_othdis')</option> 
                            </select><br/><br/>
                            <span id="anydis_error" class="invalid-feedback" style="display:none">Please Select AnyDisability</span>
                            @if ($errors->has('ProfileUser_AnyDisability'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_AnyDisability') }}</strong>
                                  </span>
                            @endif
                      </div>
                      
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_basicdetails_caste')<span aria-hidden="true" class="required">*</span></label>

                            <select id="caste" name="ProfileUser_Category"  required onchange="castemaster()">
                              <option value="0">@lang('home.matrimonys_index_welcome_select_option')</option>
                                <!-- Aruna added- expression (old('ProfileUser_Category') == $caste?'selected':'')}} is used  to set the old value in the form in case of error
                                  otherwise the form is cleared every time there is an error 
                                  This is one example where the dropdown is filled by foreach clause -->
                                @foreach($castemasters as $key => $caste)
                                  <option value="{{$caste}}"  {{(old('ProfileUser_Category') == $caste?'selected':'')}}> {{$caste}}</option>
                                @endforeach
                            </select> 
                            <span id="category_error" class="invalid-feedback" style="display:none">Please Select caste</span>
                            @if ($errors->has('ProfileUser_Category'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Category') }}</strong>
                                  </span>
                            @endif
                            <br/> <br/>                            
                      </div>

                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_basicdetails_subcaste')<span aria-hidden="true" class="required">*</span></label> <br>
                            <select name="User_Subcaste" id="subcaste"  required  >
                                 <option value="0">@lang('home.matrimonys_index_welcome_select_option')</option>
                            </select> <br/><br/>
                            
                            @if ($errors->has('User_Subcaste'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('User_Subcaste') }}</strong>
                                  </span>
                            @endif
                      </div>
                     
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_basicdetails_mobileno')<span aria-hidden="true" class="required">*</span></label> <br>
                            <input type="tel" id="phonenumber" name="ProfileUser_Mobile" minlength="10" maxlength="10" value="{{old('ProfileUser_Mobile')}}"  oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_basicdetails_mobileno')">
                            @if ($errors->has('ProfileUser_Mobile'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Mobile') }}</strong>
                                  </span>
                            @endif
                            <span id="usrphone" class="invalid-feedback" style="color:red;display:none"> Please Enter Proper Mobile Number  </span>
                          </div>

                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_basicdetails_tob')<span aria-hidden="true" class="required">*</span> &nbsp; @lang('home.matrimonys_create_basicdetails_msgformattime'): 12:33AM</label> <br>
                            <input type="time" id="tob" name="ProfileUser_TOB"  value="{{old('ProfileUser_TOB')}}" oninput="this.className = ''" placeholder="12:33 AM"><br/><br/>
                            @if ($errors->has('ProfileUser_TOB'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_TOB') }}</strong>
                                  </span>
                            @endif
                            <span id="tob_error" class="invalid-feedback" style="color:red;display:none"> Please provide time of birth</span>
                            
                      </div> 
                      
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_basicdetails_precaste')<span aria-hidden="true" class="required">*</span></label> <br>
                            <select id="prefcaste" name="ProfileUser_PreferredCaste"  required onchange="castemaster()">
                                <option value="0" disabled>@lang('home.matrimonys_index_welcome_select_option')</option>
                                  
                                  @foreach($castemasters as $key => $caste)
                                    <option value="{{$caste}}" {{(old('ProfileUser_PreferredCaste') == $caste?'selected':'')}}> {{$caste}}</option>
                                  @endforeach
                            </select> 
                            <span id="prefcaste_error" class="invalid-feedback" style="color:red;display:none"> Please provide your Preferred Caste</span>

                           <!-- @if ($errors->has('ProfileUser_PreferredCaste'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_PreferredCaste') }}</strong>
                                  </span>
                            @endif-->
                      </div>


              </div><!-- END Row -->
            
            </div>

            <div class="tab">
            <h2 class="text-center">@lang('home.matrimonys_create_personaldetails_heading')</h2>
               <div class="row rrow">

                    <div class="col-md-6">
                          <label>@lang('home.matrimonys_create_personaldetails_fatname')<span aria-hidden="true" class="required">*</span></label>
                          <input type="text" id="fathername" name="ProfileUser_FatherName" value="{{old('ProfileUser_FatherName')}}"  oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_fatname')">
                          @if ($errors->has('ProfileUser_FatherName'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_FatherName') }}</strong>
                                  </span>
                          @endif
                          <span id="usrfather" class="invalid-feedback" style="display:none"> Please provide father name  </span>

                    </div>

                    <div class="col-md-6">
                          <label>@lang('home.matrimonys_create_personaldetails_momname')<span aria-hidden="true" class="required">*</span></label>
                          <input type="text"  id="mothername" name="ProfileUser_MotherName" value="{{old('ProfileUser_MotherName')}}"   oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_momname')"><br/><br/>
                          @if ($errors->has('ProfileUser_MotherName'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_MotherName') }}</strong>
                                  </span>
                          @endif
                          <span id="usrmother" class="invalid-feedback" style="display:none"> Please provide mother name  </span>

                        </div>
                    <div class="col-md-6">
                          <label>@lang('home.matrimonys_create_personaldetails_fatcaste')<span aria-hidden="true" class="required">*</span></label>
                          <input type="text" id="fcaste" name="ProfileUser_Father_Caste" value="{{old('ProfileUser_Father_Caste')}}"  oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_fatcaste')">
                          @if ($errors->has('ProfileUser_Father_Caste'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Father_Caste') }}</strong>
                                  </span>
                          @endif
                          <span id="usrfathercaste" class="invalid-feedback" style="display:none"> Please provide father caste  </span>

                    </div>

                    <div class="col-md-6">
                          <label>@lang('home.matrimonys_create_personaldetails_momcaste')<span aria-hidden="true" class="required">*</span></label>
                          <input type="text" id="mcaste"  name="ProfileUser_Mother_Caste" value="{{old('ProfileUser_Mother_Caste')}}"   oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_momcaste')"><br/><br/>
                          @if ($errors->has('ProfileUser_Mother_Caste'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Mother_Caste') }}</strong>
                                  </span>
                          @endif   
                          <span id="usrmothercaste" class="invalid-feedback" style="display:none"> Please provide mother caste  </span>
 
                    </div>

                    <div class="col-md-6">
                          <label>@lang('home.matrimonys_create_personaldetails_fatocc')<span aria-hidden="true" class="required">*</span></label>
                          <select name="ProfileUser_Father_Occupation" required>
                          <option disabled>@lang('home.matrimonys_create_personaldetails_selectoption_fathocc') </option>
                          <option value="Employed" {{(old('ProfileUser_Father_Occupation') == 'Employed'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_emp') </option>
                          <option value="Business" {{(old('ProfileUser_Father_Occupation') == 'Business'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_bus') </option>
                          <option value="Retired" {{(old('ProfileUser_Father_Occupation') == 'Retired'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_ret')</option>
                          <option value="Not Employed" {{(old('ProfileUser_Father_Occupation') == 'Not Employed'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_ntemp') </option>
                          <option value="Passed Away" {{(old('ProfileUser_Father_Occupation') == 'Passed Away'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_pass')</option>
                          
                          </select>
                          @if ($errors->has('ProfileUser_Father_Occupation'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Father_Occupation') }}</strong>
                                  </span>
                          @endif  
                          <br/> <br/> 
                    </div>

                    <div class="col-md-6">
                          <label>@lang('home.matrimonys_create_personaldetails_momocc')<span aria-hidden="true" class="required">*</span></label>
                          <select name="ProfileUser_Mother_Occupation" required>
                                <option disabled>@lang('home.matrimonys_create_personaldetails_selectoption_momocc') </option>
                                <option value="Homemaker" {{(old('ProfileUser_Mother_Occupation') == 'Homemaker'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_momocc_homema') </option>
                                <option value="Employed" {{(old('ProfileUser_Mother_Occupation') == 'Employed'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_emp') </option>
                                <option value="Business" {{(old('ProfileUser_Mother_Occupation') == 'Business'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_bus') </option>
                                <option value="Retired" {{(old('ProfileUser_Mother_Occupation') == 'Retired'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_ret')</option>
                                <option value="Not Employed" {{(old('ProfileUser_Mother_Occupation') == 'Not Employed'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_ntemp') </option>
                                <option value="Passed Away" {{(old('ProfileUser_Mother_Occupation') == 'Passed Away'?'selected':'')}}>@lang('home.matrimonys_create_personaldetails_fatocc_pass') </option>
                          </select>
                          @if ($errors->has('ProfileUser_Mother_Occupation'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Mother_Occupation') }}</strong>
                                  </span>
                          @endif  
                    </div>


                    <div class="col-md-6">
                                <label>@lang('home.matrimonys_create_personaldetails_nosis')<span aria-hidden="true" class="required">*</span></label>
                                <input type="tel"  minlength="1" maxlength="2" id="sisnum" name="ProfileUser_Sisters_Num" onblur="showsismarried()" value="{{old('ProfileUser_Sisters_Num')}}"  oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_nosis')">
                                @if ($errors->has('ProfileUser_Mother_Occupation'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Mother_Occupation') }}</strong>
                                  </span>
                                @endif 
                                <span id="sisnum_error" class="invalid-feedback" style="display:none"> Please provide Number of sisters (mention '0' if none)  </span>

                    </div>

                    <div class="col-md-6">
                                <label>@lang('home.matrimonys_create_personaldetails_nobro')<span aria-hidden="true" class="required">*</span></label> <br>
                                <input type="tel"  minlength="1" maxlength="2" id="bronum" name="ProfileUser_Brothers_Num" onblur="showbromarried()" value="{{old('ProfileUser_Brothers_Num')}}"    oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_nobro')"><br/><br/>
                                @if ($errors->has('ProfileUser_Brothers_Num'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Brothers_Num') }}</strong>
                                  </span>
                                @endif 
                               <span id="bronum_error" class="invalid-feedback" style="display:none"> Please provide Number of brothers (mention '0' if none)  </span>

                    </div>

                    <div class="col-md-6" id="showsismrr" style="display:none">
                                <label>@lang('home.matrimonys_create_personaldetails_nosismarr')<span aria-hidden="true" class="required">*</span></label>
                                <input type="tel"  minlength="1" maxlength="2" id="sismrr_no" name="ProfileUser_MarriedSis_Num" onblur="validatesismrr()" value="{{old('ProfileUser_MarriedSis_Num')}}" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_nosismarr')">
                                @if ($errors->has('ProfileUser_MarriedSis_Num'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_MarriedSis_Num') }}</strong>
                                  </span>
                                @endif 
                                <span id="sismrr_no_error" class="invalid-feedback" style="display:none"> Please provide Number of sister's married (mention '0' if none)  </span>
                                <span id="sismrr_no_error_1" class="invalid-feedback" style="display:none"> Please provide Number of sister's married correctly </span>

                    </div>

                    <div class="col-md-6" id="showbromrr" style="display:none">
                                <label>@lang('home.matrimonys_create_personaldetails_nobromarr')<span aria-hidden="true" class="required">*</span></label> <br>
                                <input type="tel"  minlength="1" maxlength="2" id="bromrr_no" name="ProfileUser_MarriedBro_Num" onblur="validatebromrr()" value="{{old('ProfileUser_MarriedBro_Num')}}"oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_personaldetails_nobromarr')"><br/><br/>
                                @if ($errors->has('ProfileUser_MarriedBro_Num'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_MarriedBro_Num') }}</strong>
                                  </span>
                                @endif 
                                <span id="bromrr_no_error" class="invalid-feedback" style="display:none"> Please provide Number of brother's married (mention '0' if none)  </span>
                                <span id="bromrr_no_error_1" class="invalid-feedback" style="display:none"> Please provide Number of brother's married correctly  </span>

                    </div>
                </div><!-- END Row -->
            </div>

            <div class="tab">
               <h2 class="text-center">@lang('home.matrimonys_create_astrologicaldetails_heading')</h2>
               <div class="row rrow">
                   <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_astrologicaldetails_rashi')<span aria-hidden="true" class="required">*</span></label>
                            <select id="rashi" onblur="validaterashi()"  name="ProfileUser_Rashi" required>
                                <option disabled value="0" >@lang('home.matrimonys_index_welcome_select_option')</option>
                                <option value="Mesham" {{(old('ProfileUser_Rashi') == 'Mesham'?'selected':'')}}>Mesham (மேஷம்)</option>
                                <option value="Rishabham" {{(old('ProfileUser_Rashi') == 'Rishabham'?'selected':'')}}>Rishabham (ரிஷபம்)</option>
                                <option value="Mithunam" {{(old('ProfileUser_Rashi') == 'Mithunam'?'selected':'')}}>Mithunam (மிதுனம்)</option>
                                <option value="Katakam" {{(old('ProfileUser_Rashi') == 'Katakam'?'selected':'')}}>Katakam (கடகம்)</option> 
                                <option value="Simha" {{(old('ProfileUser_Rashi') == 'Simha'?'selected':'')}}>Simha (சிம்மம்)</option> 
                                <option value="Kanni" {{(old('ProfileUser_Rashi') == 'Kanni'?'selected':'')}}>Kanni (கன்னி)</option> 
                                <option value="Tulam" {{(old('ProfileUser_Rashi') == 'Tulam'?'selected':'')}}>Tulam (துலாம்)</option> 
                                <option value="Vrishchikam" {{(old('ProfileUser_Rashi') == 'Vrishchikam'?'selected':'')}} >Vrishchikam (விருச்சகம்)</option>
                                <option value="Dhanush" {{(old('ProfileUser_Rashi') == 'Dhanush'?'selected':'')}}>Dhanush (தனுசு)</option>
                                <option value="Makaram" {{(old('ProfileUser_Rashi') == 'Makaram'?'selected':'')}}>Makaram (மகரம்)</option>
                                <option value="Kumbham" {{(old('ProfileUser_Rashi') == 'Kumbham'?'selected':'')}}>Kumbham (கும்பம்)</option> 
                                <option value="Meenum" {{(old('ProfileUser_Rashi') == 'Meenum'?'selected':'')}}>Meenum (மீனம்)</option> 
                              </select>
                              <span id="rashi_error" class="invalid-feedback" style="display:none"> Please select your rashi  </span>

                              @if ($errors->has('ProfileUser_Rashi'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Rashi') }}</strong>
                                  </span>
                              @endif 
                              <br/> <br/> 
                      </div>
                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_astrologicaldetails_natchithram')<span aria-hidden="true" class="required">*</span></label>
                              
                              <select id="natchithram"  name="ProfileUser_Natchithram" onblur="validatenatchithram()" required>
                                  <option disabled value="0">@lang('home.matrimonys_index_welcome_select_option')</option>
                                  <option value="Ashwini" {{(old('ProfileUser_Natchithram') == 'Ashwini'?'selected':'')}}>Ashwini (அஸ்வினி)</option>
                                  <option value="Barani" {{(old('ProfileUser_Natchithram') == 'Barani'?'selected':'')}}>Barani (பரணி)</option>
                                  <option value="Krittika" {{(old('ProfileUser_Natchithram') == 'Krittika'?'selected':'')}}>Krittika (கார்த்திகை)</option>
                                  <option value="Mrigasira" {{(old('ProfileUser_Natchithram') == 'Mrigasira'?'selected':'')}}>Mrigasira (மிருகசீரிடம்)</option> 
                                  <option value="Arudra" {{(old('ProfileUser_Natchithram') == 'Arudra'?'selected':'')}}>Arudra (திருவாதிரை) </option> 
                                  <option value="Punarpoosam" {{(old('ProfileUser_Natchithram') == 'Punarpoosam'?'selected':'')}}>Punarpoosam (புனர்பூசம்) </option> 
                                  <option value="Poosam" {{(old('ProfileUser_Natchithram') == 'Poosam'?'selected':'')}}>Poosam (பூசம்)</option> 
                                  <option value="Ayilayam" {{(old('ProfileUser_Natchithram') == 'Ayilayam'?'selected':'')}} >Ayilayam (ஆயில்யம் )</option>
                                  <option value="Makham" {{(old('ProfileUser_Natchithram') == 'Makham'?'selected':'')}}>Makham (மகம்)</option>
                                  <option value="Pooram" {{(old('ProfileUser_Natchithram') == 'Pooram'?'selected':'')}}>Pooram (பூரம்)</option>
                                  <option value="Uttaram" {{(old('ProfileUser_Natchithram') == 'Uttaram'?'selected':'')}}>Uttaram (உத்திரம்) </option> 
                                  <option value="Hastam" {{(old('ProfileUser_Natchithram') == 'Hastam'?'selected':'')}}>Hastam (ஹஸ்தம்)</option> 
                                  <option value="Chitarai" {{(old('ProfileUser_Natchithram') == 'Chitarai'?'selected':'')}}>Chitarai (சித்திரை)</option>
                                  <option value="Swathi" {{(old('ProfileUser_Natchithram') == 'Swathi'?'selected':'')}}>Swathi (சுவாதி)</option>
                                  <option value="Visakam" {{(old('ProfileUser_Natchithram') == 'Visakam'?'selected':'')}}>Visakam (விசாகம்)</option>
                                  <option value="Anusam" {{(old('ProfileUser_Natchithram') == 'Anusam'?'selected':'')}}>Anusam (அனுசம்)</option>
                                  <option value="Kettai" {{(old('ProfileUser_Natchithram') == 'Kettai'?'selected':'')}}>Kettai (கேட்டை)</option> 
                                  <option value="Moolam" {{(old('ProfileUser_Natchithram') == 'Moolam'?'selected':'')}}>Moolam (மூலம்)/option> 
                                  <option value="Pooradam" {{(old('ProfileUser_Natchithram') == 'Pooradam'?'selected':'')}}>Pooradam (பூராடம்)/option> 
                                  <option value="Uthradam" {{(old('ProfileUser_Natchithram') == 'Uthradam'?'selected':'')}}>Uthradam (உத்திராடம்)</option> 
                                  <option value="Thiruvoonam" {{(old('ProfileUser_Natchithram') == 'Thiruvoonam'?'selected':'')}}>Thiruvoonam (திருவோணம்)</option> 
                                  <option value="Avittam" {{(old('ProfileUser_Natchithram') == 'Avittam'?'selected':'')}} >Avittam (அவிட்டம்)</option>
                                  <option value="Sadhyam" {{(old('ProfileUser_Natchithram') == 'Sadhyam'?'selected':'')}}>Sadhyam (சதயம்)</option>
                                  <option value="Pooratathi" {{(old('ProfileUser_Natchithram') == 'Pooratathi'?'selected':'')}}>Pooratathi (பூரட்டாதி )</option>
                                  <option value="Uthratathi" {{(old('ProfileUser_Natchithram') == 'Uthratathi'?'selected':'')}}>Uthratathi (உத்திரட்டாதி )</option> 
                                  <option value="Revathi" {{(old('ProfileUser_Natchithram') == 'Revathi'?'selected':'')}}>Revathi (ரேவதி)</option> 
                                  
                              </select>

                                <span id="natchithram_error" class="invalid-feedback" style="display:none"> Please select your natchithram  </span>
                              @if ($errors->has('ProfileUser_Natchithram'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Natchithram') }}</strong>
                                  </span>
                              @endif 
                    </div>

                    <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_astrologicaldetails_anydosam')<span aria-hidden="true" class="required">*</span></label>
                              <select id="dosam" name="ProfileUser_AnyDosam" onblur="validatedosam()" required>
                                  <option value="0" disabled>@lang('home.matrimonys_create_astrologicaldetails_selectdosam') </option>
                                  <option value="NO" {{(old('ProfileUser_AnyDosam') == 'NO'?'selected':'')}}>NO </option>
                                  <option value="YES" {{(old('ProfileUser_AnyDosam') == 'YES'?'selected':'')}}>YES </option>
                                <option value="DON'T KNOW" {{(old('ProfileUser_AnyDosam') == 'DON\'T KNOW'?'selected':'')}}>DON'T KNOW </option>
                                
                              </select>
                               <span id="dosam_error" class="invalid-feedback" style="display:none"> Please select your dosam  </span>
                              @if ($errors->has('ProfileUser_AnyDosam'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_AnyDosam') }}</strong>
                                  </span>
                              @endif 
                              <br/> <br/> 
                    </div>


                    <div class="col-md-6">
                                <label>@lang('home.matrimonys_create_astrologicaldetails_prestar')<span aria-hidden="true" class="required">*</span></label> <br>
                                <select  id="star" name="ProfileUser_PreferredStar" onblur="validatestar()" required>
                                    <option value="0" disabled> @lang('home.matrimonys_index_welcome_select_option')</option>
                                    <option value="Mesham" {{(old('ProfileUser_PreferredStar') == 'Mesham'?'selected':'')}}>Mesham (மேஷம்)</option>
                                    <option value="Rishabham" {{(old('ProfileUser_PreferredStar') == 'Rishabham'?'selected':'')}}>Rishabham (ரிஷபம்)</option>
                                    <option value="Mithunam" {{(old('ProfileUser_PreferredStar') == 'Mithunam'?'selected':'')}}>Mithunam (மிதுனம்)</option>
                                    <option value="Katakam" {{(old('ProfileUser_PreferredStar') == 'Katakam'?'selected':'')}}>Katakam (கடகம்)</option> 
                                    <option value="Simha" {{(old('ProfileUser_PreferredStar') == 'Simha'?'selected':'')}}>Simha (சிம்மம்)</option> 
                                    <option value="Kanni" {{(old('ProfileUser_PreferredStar') == 'Kanni'?'selected':'')}}>Kanni (கன்னி)</option> 
                                    <option value="Tulam" {{(old('ProfileUser_PreferredStar') == 'Tulam'?'selected':'')}}>Tulam (துலாம்)</option> 
                                    <option value="Vrishchikam" {{(old('ProfileUser_PreferredStar') == 'Vrishchikam'?'selected':'')}}  >Vrishchikam (விருச்சகம்)</option>
                                    <option value="Dhanush" {{(old('ProfileUser_PreferredStar') == 'Dhanush'?'selected':'')}}>Dhanush (தனுசு)</option>
                                    <option value="Makaram" {{(old('ProfileUser_PreferredStar') == 'Makaram'?'selected':'')}}>Makaram (மகரம்)</option>
                                    <option value="Kumbham" {{(old('ProfileUser_PreferredStar') == 'Kumbham'?'selected':'')}}>Kumbham (கும்பம்)</option> 
                                    <option value="Meenum" {{(old('ProfileUser_PreferredStar') == 'Meenum'?'selected':'')}}>Meenum (மீனம்)</option> 
                                </select>
                                <span id="star_error" class="invalid-feedback" style="display:none"> Please select your star  </span>
                                @if ($errors->has('ProfileUser_PreferredStar'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_PreferredStar') }}</strong>
                                  </span>
                                @endif 
                      </div>
                       <div class="col-md-12">
                                <label>@lang('home.matrimonys_create_astrologicaldetails_descexp')<span aria-hidden="true" class="required">*</span></label>
                                <input type="textarea" value="{{old('ProfileUser_Description_Expectation')}}" id="desc"   maxlength="255" rows="5" name="ProfileUser_Description_Expectation" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_astrologicaldetails_descexp')">
                                @if ($errors->has('ProfileUser_Description_Expectation'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('ProfileUser_Description_Expectation') }}</strong>
                                  </span>
                                @endif 
                                <span id="descriexp" style="color:red;display:none"> Please provide the Expectations </span>

                       </div>
                     
                 </div><!-- END Row -->
            </div>

            <div class="tab">
            <h2 class="text-center">@lang('home.matrimonys_create_eduoccdetails_heading')</h2>
               <div class="row rrow">
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_eduoccdetails_degree')<span aria-hidden="true" class="required">*</span></label>
                            <input type="text" id="degree" name="ProfileUser_Degree" value="{{old('ProfileUser_Degree')}}"    oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_eduoccdetails_degree')">
                            <span id="usrdegree" style="color:red;display:none"> Please provide degree</span>

                      </div>
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_eduoccdetails_yof')<span aria-hidden="true" class="required">*</span></label>
                            <input type="number"  name="ProfileUser_Deg_FinishingYear" maxlength="4"  value="{{old('ProfileUser_Deg_FinishingYear')}}"  oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_eduoccdetails_yof')"><br/><br/>
                            <span id="usryear" style="color:red;display:none"> Please provide degree</span>
                      </div>
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_eduoccdetails_currentcomp')</label>
                            <!--<input type="text" name="ProfileUser_CurrentCompany" value="{{old('ProfileUser_CurrentCompany')}}"    oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_eduoccdetails_currentcomp')">-->
                            
                               <select name="ProfileUser_CurrentCompany" id="comp" onblur="valcompany()">
                                    <option value="0" disabled>@lang('home.matrimonys_create_eduoccdetails_currentcomp') </option>
                                    <option value="Self-Employed" {{(old('ProfileUser_Salary') == 'Self-Employed'?'selected':'')}}>Self-Employed </option>
                                    <option value="Working in Govt" {{(old('ProfileUser_Salary') == 'Working in Govt'?'selected':'')}}>Working in Govt</option>
                                    <option value="Working in Private" {{(old('ProfileUser_Salary') == 'Working in Private'?'selected':'')}}>Working in Private</option>
                                    <option value="UnEmployed" {{(old('ProfileUser_Salary') == 'UnEmployed'?'selected':'')}}>UnEmployed </option>
                                    <option value="Not Applicable" {{(old('ProfileUser_Salary') == 'Not Applicable'?'selected':'')}}>Not Applicable </option>
                               </select>
                               
                      </div>
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_eduoccdetails_currentdesig')</label> <br>
                            <input type="text" id="designatn" name="ProfileUser_CurrentDesignation"  value="{{old('ProfileUser_CurrentDesignation')}}"    oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_eduoccdetails_currentdesig')"><br/><br/>
                            
                      </div>
                      <div class="col-md-12">
                            <label>@lang('home.matrimonys_create_eduoccdetails_empwhen')</label>
                            <input type="date" name="ProfileUser_EmplSinceWhen" value="{{old('ProfileUser_EmplSinceWhen')}}"    oninput="this.className = ''" placeholder="Employee since when">
                                <br/><br/>
                               
                      </div>
                      <div class="col-md-12">
                                <label>@lang('home.matrimonys_create_eduoccdetails_currentsalary')</label>
                                <select name="ProfileUser_Salary" >
                                    <option value="" disabled selected>@lang('home.matrimonys_create_eduoccdetails_selectannualsaincome') </option>
                                    <option value="Upto INR 1 Lakh" {{(old('ProfileUser_Salary') == 'Upto INR 1 Lakh'?'selected':'')}}>Upto INR 1 Lakh </option>
                                    <option value="INR 1 Lakh to 2 Lakh" {{(old('ProfileUser_Salary') == 'INR 1 Lakh to 2 Lakh'?'selected':'')}}>INR 1 Lakh to 2 Lakh </option>
                                    <option value="INR 2 Lakh to 4 Lakh" {{(old('ProfileUser_Salary') == 'INR 2 Lakh to 4 Lakh'?'selected':'')}}>INR 2 Lakh to 4 Lakh</option>
                                    <option value="INR 4 Lakh to 7 Lakh" {{(old('ProfileUser_Salary') == 'INR 4 Lakh to 7 Lakh'?'selected':'')}}>INR 4 Lakh to 7 Lakh </option>
                                    <option value="INR 7 Lakh to 10 Lakh" {{(old('ProfileUser_Salary') == 'INR 7 Lakh to 10 Lakh'?'selected':'')}}>INR 7 Lakh to 10 Lakh</option>
                                    <option value="INR 10 Lakh to 15 Lakh" {{(old('ProfileUser_Salary') == 'INR 10 Lakh to 15 Lakh'?'selected':'')}}>INR 10 Lakh to 15 Lakh</option>

                                    <option value="INR 15 Lakh to 20 Lakh" {{(old('ProfileUser_Salary') == 'INR 15 Lakh to 20 Lakh'?'selected':'')}}>INR 15 Lakh to 20 Lakh</option>
                                    <option value="INR 20 Lakh to 30 Lakh" {{(old('ProfileUser_Salary') == 'INR 20 Lakh to 30 Lakh'?'selected':'')}}>INR 20 Lakh to 30 Lakh </option>
                                    <option value="INR 30 Lakh to 50 Lakh" {{(old('ProfileUser_Salary') == 'INR 30 Lakh to 50 Lakh'?'selected':'')}}>INR 30 Lakh to 50 Lakh</option>
                                    <option value="INR 50 Lakh to 75 Lakh" {{(old('ProfileUser_Salary') == 'INR 50 Lakh to 75 Lakh'?'selected':'')}}>INR 50 Lakh to 75 Lakh</option>
                                    <option value="INR 75 Lakh to 1 Crore" {{(old('ProfileUser_Salary') == 'INR 75 Lakh to 1 Crore'?'selected':'')}}>INR 75 Lakh to 1 Crore</option>
                                    <option value="INR 1 Crore & above" {{(old('ProfileUser_Salary') == 'INR 1 Crore & above'?'selected':'')}}>INR 1 Crore & above</option>
                                    <option value="Not Applicable" {{(old('ProfileUser_Salary') == 'Not Applicable'?'selected':'')}}>Not Applicable</option>
                              </select>
                          </div>
                      </div><!-- END Row -->
             </div>
             <div class="tab">
               <h2 class="text-center">@lang('home.matrimonys_create_phydetails_heading')</h2>
               <div class="row rrow">
                      <div class="col-md-6">
                            <label>@lang('home.matrimonys_create_phydetails_height')<span aria-hidden="true" class="required">*</span></label>
                           <input type="text" id="height"  name="ProfileUser_Height" value="{{old('ProfileUser_Weight')}}"   oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_phydetails_height')"><br/><br/>

                           <!-- <select name="ProfileUser_Height" required>
                                <option value="" disabled selected>@lang('home.matrimonys_create_phydetails_phycha_selectheight') </option>
                                <option value="4ft 1in" {{(old('ProfileUser_Height') == '4ft 1in'?'selected':'')}}>4ft 1in </option>
                                <option value="4ft 2in" {{(old('ProfileUser_Height') == '4ft 2in'?'selected':'')}}>4ft 2in </option>
                                <option value="4ft 3in" {{(old('ProfileUser_Height') == '4ft 3in'?'selected':'')}}>4ft 3in</option>
                                <option value="4ft 4in" {{(old('ProfileUser_Height') == '4ft 4in'?'selected':'')}}>4ft 4in</option>
                                <option value="4ft 5in" {{(old('ProfileUser_Height') == '4ft 5in'?'selected':'')}}>4ft 5in</option>
                                <option value="4ft 6in" {{(old('ProfileUser_Height') == '4ft 6in'?'selected':'')}}>4ft 6in</option>
                                <option value="4ft 7in" {{(old('ProfileUser_Height') == '4ft 7in'?'selected':'')}}>4ft 7in</option>
                                <option value="4ft 8in" {{(old('ProfileUser_Height') == '4ft 8in'?'selected':'')}}>4ft 8in </option>
                                <option value="4ft 9in" {{(old('ProfileUser_Height') == '4ft 9in'?'selected':'')}}>4ft 9in</option>
                                <option value="4ft 10in" {{(old('ProfileUser_Height') == '4ft 10in'?'selected':'')}}>4ft 10in</option>
                                <option value="4ft 11in" {{(old('ProfileUser_Height') == '4ft 11in'?'selected':'')}}>4ft 11in</option>

                                <option value="5ft 1in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 1in </option>
                                <option value="5ft 2in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 2in </option>
                                <option value="5ft 3in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 3in</option>
                                <option value="5ft 4in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 4in</option>
                                <option value="5ft 5in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 5in</option>
                                <option value="5ft 6in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 6in</option>
                                <option value="5ft 7in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 7in</option>
                                <option value="5ft 8in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 8in </option>
                                <option value="5ft 9in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 9in</option>
                                <option value="5ft 10in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 10in</option>
                                <option value="5ft 11in" {{(old('ProfileUser_Height') == '5ft 1in'?'selected':'')}}>5ft 11in</option>

                                <option value="6ft 1in" {{(old('ProfileUser_Height') == '6ft 1in'?'selected':'')}}>6ft 1in </option>
                                <option value="6ft 2in" {{(old('ProfileUser_Height') == '6ft 2in'?'selected':'')}}>6ft 2in </option>
                                <option value="6ft 3in" {{(old('ProfileUser_Height') == '6ft 3in'?'selected':'')}}>6ft 3in</option>
                                <option value="6ft 4in" {{(old('ProfileUser_Height') == '6ft 4in'?'selected':'')}}>6ft 4in</option>
                                <option value="6ft 5in" {{(old('ProfileUser_Height') == '6ft 5in'?'selected':'')}}>6ft 5in</option>
                                <option value="6ft 6in" {{(old('ProfileUser_Height') == '6ft 6in'?'selected':'')}}>6ft 6in</option>
                                <option value="6ft 7in" {{(old('ProfileUser_Height') == '6ft 7in'?'selected':'')}}>6ft 7in</option>
                                <option value="6ft 8in" {{(old('ProfileUser_Height') == '6ft 8in'?'selected':'')}}>6ft 8in </option>
                                <option value="6ft 9in" {{(old('ProfileUser_Height') == '6ft 9in'?'selected':'')}}>6ft 9in</option>
                                <option value="6ft 10in" {{(old('ProfileUser_Height') == '6ft 10in'?'selected':'')}}>6ft 10in</option>
                                <option value="6ft 11in" {{(old('ProfileUser_Height') == '6ft 11in'?'selected':'')}}>6ft 11in</option>
                                <option value="7ft" {{(old('ProfileUser_Height') == '7ft'?'selected':'')}}>7ft</option>
                          </select>-->
                      </div>

                      <div class="col-md-6">
                                <label>@lang('home.matrimonys_create_phydetails_weight')<span aria-hidden="true" class="required">*</span></label>
                                <input type="text" id="weigh"  name="ProfileUser_Weight" value="{{old('ProfileUser_Weight')}}"   oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_phydetails_weight')"><br/><br/>
                                <span id="usrweigh" style="color:red;display:none"> Please enter  Weight </span>

                    </div>

                      <div class="col-md-6">
                                <label>@lang('home.matrimonys_create_phydetails_bodytype')<span aria-hidden="true" class="required">*</span></label>
                                <select  name="ProfileUser_BodyType" required>
                                  <option value="" disabled selected>@lang('home.matrimonys_create_phydetails_phycha_sebtype')</option>
                                  <option value="Athletic" {{(old('ProfileUser_BodyType') == 'Athletic'?'selected':'')}}>@lang('home.matrimonys_create_phydetails_body_athletic')</option>
                                  <option value="Average" {{(old('ProfileUser_BodyType') == 'Average'?'selected':'')}}>@lang('home.matrimonys_create_phydetails_body_average')</option>
                                  <option value="Heavy" {{(old('ProfileUser_BodyType') == 'Heavy'?'selected':'')}}>@lang('home.matrimonys_create_phydetails_body_heavy')</option>
                                  <option value="Slim" {{(old('ProfileUser_BodyType') == 'Slim'?'selected':'')}}>@lang('home.matrimonys_create_phydetails_body_slim') </option>
                                </select>
                      </div>

                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_phydetails_bgroup')<span aria-hidden="true" class="required">*</span></label>
                              <select id="blood" name="ProfileUser_BloodGroup" required>
                                  <option value="0" disabled>@lang('home.matrimonys_create_phydetails_phycha_sebloodtype') </option>
                                  <option value="Don't Know" {{(old('ProfileUser_BloodGroup') == 'Don not Know'?'selected':'')}}>Don't Know</option>
                                  <option value="A+" {{(old('ProfileUser_BloodGroup') == 'A+'?'selected':'')}}>A+</option>
                                  <option value="A-" {{(old('ProfileUser_BloodGroup') == 'A-'?'selected':'')}}>A-</option>
                                  <option value="B+" {{(old('ProfileUser_BloodGroup') == 'B+'?'selected':'')}}>B+</option>
                                  <option value="B-" {{(old('ProfileUser_BloodGroup') == 'B-'?'selected':'')}}>B-</option>
                                  <option value="AB+" {{(old('ProfileUser_BloodGroup') == 'AB+'?'selected':'')}}>AB+</option>
                                  <option value="AB-" {{(old('ProfileUser_BloodGroup') == 'AB-'?'selected':'')}}>AB-</option>
                                  <option value="O+" {{(old('ProfileUser_BloodGroup') == 'O+'?'selected':'')}}>O+ </option>
                                  <option value="O-" {{(old('ProfileUser_BloodGroup') == 'O-'?'selected':'')}}>O-</option>
                              </select><br/><br/>
                              <span id="bg" style="color:red;display:none"> Please select weight </span>
                      </div>

                      <div class="col-md-6">
                                <label>@lang('home.matrimonys_create_phydetails_phystatus')<span aria-hidden="true" class="required">*</span></label>
                                <input type="text" id="phystat"  name="ProfileUser_PhysicalStatus" value="{{old('ProfileUser_PhysicalStatus')}}" oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_phydetails_phystatus')"><br/><br/>
                                <span id="physcstatus" style="color:red;display:none"> Please enter  Physical Status </span>

                     </div>

                      <div class="col-md-6">
                              <label>@lang('home.matrimonys_create_phydetails_phycha')</label>
                              <input type="text" id="physicaldetail"  name="ProfileUser_PhysicallyChallengedDetails" value="{{old('ProfileUser_PhysicallyChallengedDetails')}}"    oninput="this.className = ''" placeholder="@lang('home.matrimonys_create_phydetails_phycha')"><br/><br/>
                              

                      </div>

                 </div><!-- END Row -->
            </div>
            <div class="tab">
              <h2 class="text-center">@lang('home.matrimonys_create_uploadphoto_heading')</h2>
                 <div class="row rrow">
                        <div class="col-md-12">
                                <label>@lang('home.matrimonys_create_uploadphoto_bridegroom')<span aria-hidden="true" class="required">*</span></label>
                                <input type="file" id="Photo" name="ProfileUser_Photo" value="{{old('ProfileUser_Photo')}}" onbind="checkfile()"    accept="image/*" oninput="this.className = ''" placeholder="Photo">
                        <br/><br/>
                                <span id="Photo_error" style="color:red"></span>
                        </div>
                        <div class="col-md-12">
                                <label>@lang('home.matrimonys_create_uploadphoto_horophoto')<span aria-hidden="true" class="required">*</span></label>
                                <input type="file"  id="Photo_1" name="ProfileUser_Horoscope" value="{{old('ProfileUser_Horoscope')}}"  onbind="checkfile()"  accept="image/*"  oninput="this.className = ''" placeholder="Horoscope"><br/><br/>
                                <span id="Photo_error" style="color:red"></span>
                        </div>
                        <!--div class="col-md-12">
                                <label>@lang('home.matrimonys_create_uploadphoto_another')</label>
                                <input type="file"  name="ProfileUser_Photo1" value="{{old('ProfileUser_Photo1')}}" accept="image/*" oninput="this.className = ''" placeholder="Photos"><br/><br/>
                        </div>
                        <div class="col-md-12">
                                <label>@lang('home.matrimonys_create_uploadphoto_other')</label>
                                <input type="file"  name="ProfileUser_Photo2" value="{{old('ProfileUser_Photo2')}}"  accept="image/*"   oninput="this.className = ''" placeholder="Photos"><br/><br/>
                        </div> -->
                       
                   </div><!-- END Row -->
              </div>


              <div class="tab">
                <h2 class="text-center">@lang('home.matrimonys_create_membershipplan_heading')</h2>
                   <div class="row rrow">
                          <div class="col-md-12">
                       <p>  @lang('home.matrimonys_create_membershipplan_msg') </p>  
                                              
                   </div>

              </div>
              
              <!-- END Row -->
         </div>

        <div style="overflow:auto;">
          <div style="float:left;">
             <h5><span aria-hidden="true" class="required">*</span> means required field</h5>
          </div>
          <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">@lang('home.matrimonys_create_previousbtn')</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">@lang('home.matrimonys_create_finalsubmitbtn')</button>
          </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>
 </form> 

</div><!-- END col 12 -->
</div><!-- END ROW -->
</div><!-- END Container -->



<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    
    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }
    
    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    
    
    
    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, chk, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        //finishing year field to be checked
        
        if(y[i].name ==='ProfileUser_Deg_FinishingYear')
        {
            /*if(parseInt(y[i].value) <1940  &&  parseInt(y[i].value)>new Date().getFullYear())*/
            if(parseInt(y[i].value) <1940){
                  y[i].className += " invalid";
                      // and set the current valid status to false
                      event.preventDefault();
                      valid = false;
            }
        }
        if(y[i].name === "ProfileUser_Name")
        {
           
           var nme = document.getElementById("name").value;
           if(nme == "")
           {
                $('#name_error').css('display','block');
                $("#name_error").fadeOut(6500);
                $('#name').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        if(y[i].name === "ProfileUser_Age")
        {
            chk = parseInt(y[i].value);
            var age = document.getElementById("userage").value;
            if(age == "")
            {
                $('#age_error').css('display','block');
                $("#age_error").fadeOut(6500);
                valid = false;
                event.preventDefault();
                return false;
            }
            else if ( chk <21  && chk >100)
            {
                $('#age_error').css('display','block');
                
                $('#age_error').html("please provide age between 21 and within 100");
                $("#age_error").fadeOut(9500);
                valid = false;
                 event.preventDefault();
            }
            else
            {
                $('#age_error').css('display','none');
                $('#age_error').html("");
                 valid = true;
            }
        }
        if(y[i].name === "ProfileUser_Gender")
        {
           
          
           var gender = $('#gender option:selected').val();
           if(gender == "0")
           {
                $('#gender_error').css('display','block');
                $("#gender_error").fadeOut(6500);
                $('#gender_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        if(y[i].name === "ProfileUser_MaritalStatus")
        {
           
          
           var ms = $('#maritalstatus option:selected').val();
           if(ms == "0")
           {
                $('#ms_error').css('display','block');
                $("#ms_error").fadeOut(6500);
                $('#ms_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        if(y[i].name === "ProfileUser_PlaceofBirth")
        {
           
          
           var pob = document.getElementById("pob").value;
           if(pob == "")
           {
                $('#pob_error').css('display','block');
                $("#pob_error").fadeOut(6500);
                $('#pob_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        if(y[i].name === "ProfileUser_Address")
        {
           
          
           var addr = document.getElementById("address").value;
           if(addr == "")
           {
                $('#address_error').css('display','block');
                $("#address_error").fadeOut(6500);
                $('#address_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        
        if(y[i].name === "ProfileUser_LocationID")
        {
           
          
           var loct = document.getElementById("loc").value;
           if(loct == "")
           {
                $('#location_error').css('display','block');
                $("#location_error").fadeOut(6500);
                $('#location_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        
        if(y[i].name === "ProfileUser_DOB")
        {
           
          
           var dob = document.getElementById("dob").value;
           if(dob == "")
           {
                $('#dtebrth').css('display','block');
                $("#dtebrth").fadeOut(6500);
                $('#dtebrth').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        
        if(y[i].name === "ProfileUser_AnyDisability")
        {
           
          
           var dis = document.getElementById("anydis").value;
           if(dis == "")
           {
                $('#anydis_error').css('display','block');
                $("#anydis_error").fadeOut(6500);
                $('#anydis_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        
        if(y[i].name === "ProfileUser_Category")
        {
           var caste = document.getElementById("caste").value;
           if(caste == "")
           {
                $('#category_error').css('display','block');
                $("#category_error").fadeOut(6500);
                $('#category_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        
        if(y[i].name === "ProfileUser_TOB")
        {
           var tob = document.getElementById("tob").value;
           if(tob == "")
           {
                $('#tob_error').css('display','block');
                $("#tob_error").fadeOut(6500);
                $('#tob_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        
        if(y[i].name === "ProfileUser_PreferredCaste")
        {
           
          
           var prefcaste = $('#prefcaste option:selected').val();
           if(prefcaste == "0")
           {
                $('#prefcaste_error').css('display','block');
                $("#prefcaste_error").fadeOut(6500);
                $('#prefcaste_error').focus();
                event.preventDefault();
                valid = false;
                return false;
           }
           else
           {
               valid = true;
           }
        }
        
        if(y[i].name == 'ProfileUser_email')
        {
          var email = document.getElementById("email").value;
          if(email == "")
          {
                $('#usremail').css('display','block');
                $("#usremail").fadeOut(6500);
                $('#email').focus();
                valid = false;
                return false;
                event.preventDefault();
              
          }
          else
          {
            
            valid = true;
          }
        }
        
        if(y[i].name == 'ProfileUser_Mobile')
        {
          var number = document.getElementById("phonenumber").value;
          if(number == "")
          {
              $('#usrphone').css('display','block');
              $("#usrphone").fadeOut(6500);
              $('#phonenumber').focus();
              valid = false;
              event.preventDefault();
              return false;
              
          }
          else
          {
             valid = true;
          }
        }
        
        //second tab
        if(y[i].name == 'ProfileUser_FatherName')
        {
          var father = document.getElementById("fathername").value;
         
          if (father == "")
          {
              $('#usrfather').css('display','block');
              $("#usrfather").fadeOut(6500);
              $('#fathername').focus();
              valid = false;
              event.preventDefault();
              return false;
            
          }
          else
          {
            $('#usrfather').css('display','none');
            valid = true;
          }
        }
        if(y[i].name == 'ProfileUser_MotherName')
        {
          var mother = document.getElementById("mothername").value;
       
          if (mother == "") 
          {
           
              $('#usrmother').css('display','block');
              $("#usrmother").fadeOut(6500);
              $('#mothername').focus();
              valid = false;
              event.preventDefault();
              return false;
            
          }
          else
          {
            $('#usrmother').css('display','none');
            valid = true;
          }
        }
        if(y[i].name == 'ProfileUser_Father_Caste')
        {
          var facaste = document.getElementById("fcaste").value;
         
          if (facaste == "") 
          {
            $('#usrfathercaste').css('display','block');
            $("#usrfathercaste").fadeOut(6500);
            $('#fcaste').focus();
            valid = false;
            event.preventDefault();
            return false;
          
          }
          else
          {
            $('#usrfathercaste').css('display','none');
            valid = true;
          }
        }
        if(y[i].name == 'ProfileUser_Mother_Caste')
        {
          var mocaste = document.getElementById("mcaste").value;
         
          if (mocaste == "") 
          {
            $('#usrmothercaste').css('display','block');
            $("#usrmothercaste").fadeOut(6500);
            $('#mcaste').focus();
            valid = false;
            event.preventDefault();
            return false;
           
          }
          else
          {
            $('#usrmothercaste').css('display','none');
            valid = true;
          }
        }
        
        if(y[i].name == 'ProfileUser_Sisters_Num')
        {
          var sisnum = document.getElementById("sisnum").value;
         
          if (sisnum == "") 
          {
            $('#sisnum_error').css('display','block');
            $("#sisnum_error").fadeOut(6500);
            $('#sisnum').focus();
            valid = false;
            event.preventDefault();
            return false;
           
          }
          else
          {
            $('#sisnum_error').css('display','none');
            valid = true;
          }
        }
        
        if(y[i].name == 'ProfileUser_Brothers_Num')
        {
          var bronum = document.getElementById("bronum").value;
         
          if (bronum == "") 
          {
            $('#bronum_error').css('display','block');
            $("#bronum_error").fadeOut(6500);
            $('#bronum').focus();
            valid = false;
            event.preventDefault();
            return false;
           
          }
          else
          {
            $('#bronum_error').css('display','none');
            valid = true;
          }
        }
        
        //3rd tab  
        if(y[i].name == 'ProfileUser_Description_Expectation')
        {
          var descriptn = document.getElementById("desc").value;
          if (descriptn == "") 
          {
            $('#descriexp').css('display','block');
            $("#descriexp").fadeOut(6500);
            $('#descriexp').focus();
            event.preventDefault();
            valid = false;
            return false;
          }
          else
          {
            
            valid = true;
          }
        }
        //4th tab
        if(y[i].name == 'ProfileUser_Degree')
        {
          var degree = document.getElementById("degree").value;
          if (degree == "") 
          {
            
            $('#usrdegree').css('display','block');
            $("#usrdegree").fadeOut(6500);
            $('#usrdegree').focus();
            event.preventDefault();
            valid = false;
            return false;
          }
          else
          {
            $('#usrdegree').css('display','none');
            valid = true;
          }
        }
        
        if(y[i].name == 'ProfileUser_CurrentDesignation')
        {
          var designation = document.getElementById("designatn").value;
          
          if ( designation == "") 
          {
            $('#usrdesignatn').css('display','block');
            $("#usrdesignatn").fadeOut(6500);
            $('#designatn').focus();
            event.preventDefault();
            valid = false;
            return false;
          }
          else
          {
            $('#usrdesignatn').css('display','none');
            valid = true;
          }
        }
        
        if(y[i].name == 'ProfileUser_PhysicalStatus')
        {
          var physicalstats = document.getElementById("phystat").value;
         
          if (physicalstats == "") 
          {
            $('#physcstatus').css('display','block');
            $("#physcstatus").fadeOut(6500);
            $('#phystat').focus();
            event.preventDefault();
            valid = false;
            return false;
            
            
          }
          else
          {
            $('#physcstatus').css('display','none');
            valid = true;
          }
        }
        if(y[i].name == 'ProfileUser_Weight')
        {
          var weight = document.getElementById("weigh").value;
         
          if (weight == "") 
          {
            $('#usrweigh').css('display','block');
            $("#usrweigh").fadeOut(6500);
            $('#weigh').focus();
            event.preventDefault();
            valid = false;
            return false;
            
            
          }
          else
          {
            $('#usrweigh').css('display','block');
            valid = true;

          }

        }
        if(y[i].name == 'ProfileUser_Photo')
        {
            var pic = document.getElementById("Photo").value;
            valStr= $('input[type="file"]').val();
            var ext = valStr.substring(valStr.lastIndexOf('.') + 1).toLowerCase(); // get file extention 
            var fileUpload = document.getElementById("Photo");
            if(pic == "") 
            {
                $('#Photo_error').html('Please choose the files.');
                event.preventDefault();
                valid = false;
                return false;
            }
            else if ($.inArray(ext, ['png', 'jpg', 'jpeg','bmp']) == -1) 
            {
                      $('#Photo_error').html('Please choose the files of type .png,.jpg,.jpeg, .bmp');
                      $('input[type="file"]').val('');
                      event.preventDefault();
                      valid = false;
                      return false;
            }
            else if (typeof (fileUpload.files) != "undefined") 
            {
                  $('#Photo_error').html("");
                  var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                  if(size >1024)
                  {
                      $('#Photo_error').html('Please choose the files within 1MB');                      
                      $('input[type="file"]').val('');
                      event.preventDefault();
                      valid = false;
                      return false;
                  }
                  
            } 
            else
            {
                $('#Photo_error').html("");
                 valid = true;
            }
        }
        if(y[i].name == 'ProfileUser_Horoscope')
        {
            var pic = document.getElementById("Photo_1").value;
            valStr= $('input[type="file"]').val();
            var ext = valStr.substring(valStr.lastIndexOf('.') + 1).toLowerCase(); // get file extention 
            var fileUpload = document.getElementById("Photo_1");
            if(pic == "") 
            {
                $('#Photo_error').html('Please choose the files.');
                event.preventDefault();
                valid = false;
                return false;
            }
            else if ($.inArray(ext, ['png', 'jpg', 'jpeg','bmp']) == -1) 
            {
                      $('#Photo_error').html('Please choose the files of type .png,.jpg,.jpeg, .bmp');
                      $('input[type="file"]').val('');
                      event.preventDefault();
                      valid = false;
                      return false;
            }
            else if (typeof (fileUpload.files) != "undefined") 
            {
                  $('#Photo_error').html("");
                  var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                  if(size >1024)
                  {
                      $('#Photo_error').html('Please choose the files within 1MB');                      
                      $('input[type="file"]').val('');
                      event.preventDefault();
                      valid = false;
                      return false;
                  }
                  
            } 
            else
            {
                $('#Photo_error').html("");
                 valid = true;
            }
        }
        // If a field is empty...
        /*if (y[i].value == ""  && y[i].name != "ProfileUser_CurrentCompany" && y[i].name!="ProfileUser_CurrentDesignation" && y[i].name !="ProfileUser_EmplSinceWhen"  && y[i].name !="ProfileUser_Salary" && y[i].name!="ProfileUser_PhysicallyChallengedDetails") {
          // add an "invalid" class to the field:
          y[i].className += "invalid";
          // and set the current valid status to false
          valid = false;
        }*/
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }
    
    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
</script>


<script>
    
    function showsismarried()
    {
        var sisnum_marr =  document.getElementById("sisnum").value;
        if(sisnum_marr !== "0" && sisnum_marr !== "null")
        {
            $("#showsismrr").css('display','block');
        }
        else
        {
            
        }
    }
    
    function showbromarried()
    {
        var bronum_marr =  document.getElementById("bronum").value;
        if(bronum_marr !== "0" && bronum_marr !== "null")
        {
            $("#showbromrr").css('display','block');
        }
        else
        {
            
        }
    }
    
     function validatesismrr()
     {
         var sisnum_marr =  document.getElementById("sisnum").value;
         var sis_mrr =  document.getElementById("sismrr_no").value;
         if(sis_mrr == "")
         {
              $("#sismrr_no_error").css('display','block');
              $("#sismrr_no_error").fadeOut(6500);
              valid=false;
              event.preventDefault();
              return false;
         }
         else if(sis_mrr > sisnum_marr )
         {
              $("#sismrr_no_error_1").css('display','block');
              $("#sismrr_no_error_1").fadeOut(6500);
              valid=false;
              event.preventDefault();
              return false;
         }
         else
         {
             return true;
         }
     }
     
     function validatebromrr()
     {
         var bronum_marr =  document.getElementById("bronum").value;
         var bro_mrr =  document.getElementById("bromrr_no").value;
         if(bro_mrr == "")
         {
              $("#bromrr_no_error").css('display','block');
              $("#bromrr_no_error").fadeOut(6500);
              
               event.preventDefault();
               return false;
         }
         else if(bro_mrr > bronum_marr)
         {
              $("#bromrr_no_error_1").css('display','block');
              $("#bromrr_no_error_1").fadeOut(6500);
              
              event.preventDefault();
              return false;
         }
         {
             return true;
         }
     }
     
     function validatenatchithram()
     {
        var nat = $('#natchithram option:selected').val();
        if(nat == 0)
        {
            $("#natchithram_error").css('display','block');
            $("#natchithram_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     
     function validaterashi()
     {
        var rash = $('#rashi option:selected').val();
        if(rash == 0)
        {
            $("#rashi_error").css('display','block');
            $("#rashi_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     function validatedosam()
     {
        var dosam = $('#dosam option:selected').val();
        if(dosam == 0)
        {
            $("#dosam_error").css('display','block');
            $("#dosam_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     function validatestar()
     {
        var star = $('#star option:selected').val();
        if(star == 0)
        {
            $("#star_error").css('display','block');
            $("#star_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     
     
     
    
</script>

<!--  CASTE SUBCASTE  SCRIPT -->
<script>
  function get_age(born, now) {
      var birthday = new Date(now.getFullYear(), born.getMonth(), born.getDate());
    if (now >= birthday) 
      return now.getFullYear() - born.getFullYear();
    else
      return now.getFullYear() - born.getFullYear() - 1;
  }
  function castemaster() {
    var CasteName =  document.getElementById("caste").value;

    if(CasteName){  
        $.ajax({
           type:"GET",
           url:"{{url('get-subcast-lst')}}?CasteName="+CasteName,
           success:function(res){               
            if(res){
                $("#subcaste").empty();
                
           
                $.each(res,function(key,value){
                    $("#subcaste").append('<option value="'+value+'">'+value+'</option>');
                    
                });
           
            }else{
               $("#subcaste").empty();
            }
           }
        });
    }else{
        $("#subcaste").empty();
       
    }      
   }
</script>
<!-- END CASTE SUBCASTE Script  -->
<script>
    function getage(){
        var val = document.getElementById("dob").value;
        var today = new Date();
        var dob = new Date(val);
        var now = today.getFullYear();
        var full = dob.getFullYear();
        var age = now - full;
        //alert("age is---"+age);
        document.getElementById("userage").value = age;
    }
</script>
<script>
$(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var year1 = dtToday.getFullYear()-22;
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year1 + '-' + month + '-' + day;    
    $('#dob').attr('max', maxDate);
});
    
    
    
    
</script>








  @include('sweetalert::alert')
  
  
   
  
  
</body>


</html>


@endsection
