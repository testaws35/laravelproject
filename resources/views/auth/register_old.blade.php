@extends('layouts.welcome')

@section('content')

<section class="testimonial py-5" id="testimonial" >
    <div class="container" style=" box-shadow: 10px 10px 5px #aaaaaa;border-bottom-color:rgb(248, 34, 73);border-bottom-style: solid;border-top-color:rgb(248, 34, 73);border-top-style: solid;">
        <div class="row ">
            <div class="col-md-4 py-5 bg-primary text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="{{ asset('../images/frontend_images/registration_bg.png') }}" style="width:30%">
                        <h2 class="py-3" style="font-family: 'Sen', sans-serif;">@lang('home.reg_heading')</h2>
                        <p style="font-size:18px;color:#fff;font-family: 'Sen', sans-serif;"><b style="font-weight:600;">@lang('home.reg_note'):</b> @lang('home.reg_note_msg')  </p>
                   </div>
                </div>
            </div>


            @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif

            <div class="col-md-8 py-5 border">
                <h4 class="pb-4" style="font-family: 'Sen', sans-serif;">@lang('home.reg_subhead')</h4>
               <form  name="myform" class="form-detail" method="POST" action="{{ route('register.store') }}"  enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <!--START 1st form-row  -->
                     <div class="form-row">
                            <!--START form-group col-md-6  -->
                              <div class="form-group col-md-6 {{ $errors->has('User_Phone') ? 'has-error' : '' }}">
                                <label> <b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_mobileno') :</b></label>
                                  <input type="text"  id="User_Phone"  name="User_Phone" value="{{ old('User_Phone') }}" required  placeholder="@lang('home.reg_mobileno_placeholder')" oninput="this.className = ''" onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.reg_mobileno_placeholder')'" >
                                  <span class="text-danger">{{ $errors->first('User_Phone') }}</span>
                              </div>
                              <!--END form-group col-md-6  -->

                              <!--START form-group col-md-6  -->
                              <div class="form-group col-md-6">
                              <label><b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_inviteid') :</b></label>
                              <input id="User_InvitationID" type="text"  name="User_InvitationID" value="{{ old('User_InvitationID') }}" required  onchange="checkInvite()" placeholder="@lang('home.reg_inviteid_placeholder')"   oninput="this.className = ''" onfocus="this.placeholder=''" onblur="checkInvite()">
                                @if ($errors->has('User_InvitationID'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('User_InvitationID') }}</strong>
                                  </span>
                                @endif
                              </div> <!--END form-group col-md-6  -->

                      </div>  
                       <!--END 1st form-row  -->
                     
                     <!--START 2nd form-row  -->
                     <div class="form-row">

                            <!--START form-group col-md-6  -->
                            <div class="form-group col-md-6">
                                <label><b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_personaldetails-name') : </b></label>
                                <input id="name" type="text"  name="name" value="{{ old('name') }}" required placeholder="@lang('home.reg_personaldetails-name_placeholder')" oninput="this.className = ''" onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.reg_personaldetails-name_placeholder') ' ">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!--START form-group col-md-6  -->
                              <div class="form-group col-md-6">
                                <label><b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_logindetails-uname') : </b></label>
                                <input id="username" type="text"  name="username" value="{{ old('username') }}" required placeholder="@lang('home.reg_logindetails-uname_placeholder')" onchange="checkUniqueUser()"  oninput="this.className = ''" onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.reg_logindetails-uname_placeholder')' ">
                                  @if ($errors->has('username'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                                  @endif
                              </div>
                              <!--END form-group col-md-6  -->

                       

                      </div>  
                       <!--END 2nd form-row  -->

                       <!--START 3rd form-row  -->
                     <div class="form-row">
                            <!--START form-group col-md-6  -->
                              <div class="form-group col-md-6">
                                  <label><b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_logindetails-pwd') : </b></label>
                                  <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required   autocomplete="new-password" onchange="validatepassword()" placeholder="@lang('home.reg_logindetails-pwd_placeholder')" oninput="this.className = ''" onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.reg_logindetails-pwd_placeholder')'">
                                  <!--  Provide your password with more than 6 characters long, at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character. -->
                                    @if ($errors->has('password'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                    @endif
                              </div>
                              <!--END form-group col-md-6  -->

                              <!--START form-group col-md-6  -->
                              <div class="form-group col-md-6">
                                    <label><b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_logindetails-cpwd') :</b></label>
                                    <input id="password-confirm" type="password"  name="password_confirmation" required   onchange="validatepassword()"  autocomplete="new-password"placeholder="@lang('home.reg_logindetails-confirm_placeholder')" oninput="this.className = ''" onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.reg_logindetails-confirm_placeholder')'">
                                    <span name ="password-confirmmsg" class="invalid-feedback" role="alert" style="display:none">
                                        <strong>Passwords Dont match. Please try again  </strong>
                                    </span>
                              </div> <!--END form-group col-md-6  -->

                      </div>  
                       <!--END 3rd form-row  -->

                      <!--START 4th form-row  -->
                     <div class="form-row">
                            <!--START form-group col-md-6  -->
                            <div class="form-group col-md-6">
                                  <label><b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_personaldetails-caste') :</b></label>
                                  <select id="caste" name="User_Caste"  required onchange="castemaster()">
                                     <option>@lang('home.matrimonys_create_basicdetails_selectoption')</option>
                                      @foreach($castemasters as $key => $caste)
                                        <option value="{{$key}}"  {{(old('User_Caste') == $caste? selected:'')}}> {{$caste}}</option>
                                      @endforeach
                                      </select> 

 
                                    @if ($errors->has('User_Caste'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('User_Caste') }}</strong>
                                    </span>
                                    @endif 
                           </div>
                           <!--END form-group col-md-6  -->

                            <!--START form-group col-md-6  -->
                            <div class="form-group col-md-6">
                                <label><b style="font-family: 'Sen', sans-serif;font-weight:700;">@lang('home.reg_personaldetails-subcaste')  :</b></label>
                                <select name="User_Subcaste" id="subcaste"  required> </select>
                                    @if ($errors->has('User_Subcaste'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('User_Subcaste') }}</strong>
                                    </span>
                                    @endif 
                            </div> <!--END form-group col-md-6  -->
                    </div>  
                    <!--END 4th form-row  -->
                    
                    
                     <!--START T&C form-row  -->
                     <div class="form-row">
                            <!--START form-group col-md-6  -->
                            <div class="form-group col-md-1">
                                  <input type="checkbox" class="register_checkboxmob" name="colorCheckbox" value="red"> 
                           </div>
                           <!--END form-group col-md-6  -->

                            <!--START form-group col-md-6  -->
                            <div class="form-group col-md-11">
                                <label class="form-check-label" for="remember">
                                        I Agree to Terms & Conditions
                                    </label>
                            </div> <!--END form-group col-md-6  -->
                            <div class="red box">
                                 In your case, this can be a Terms and Conditions, a Terms of Service, a Terms of Use, a Privacy Policy or a Website Disclaimer that users must read and agree to in products to create an account on your website or mobile app.
                            </div>
                    </div>  
                    <!--END T&C form-row  -->
                    
                   <div class="form-row">
                        <button type="submit" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">@lang('home.reg_nextbtn')</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
    <script>
     function checkInvite() {

 
        var Usr_InvitationID = document.getElementById("User_InvitationID").value;
        var Mobile_Number = document.getElementById("User_Phone").value;
 
        if (Usr_InvitationID == '') {
            alert("Invitation ID is empty");
             showToastAlert("Warning", 'Invitation ID is empty', 'Warning');
            return;
        }
        $.ajax({
           type:"GET",
           url:"{{url('validateinvitationID')}}?UserInvitationID="+Usr_InvitationID+"&Userphone="+Mobile_Number,
           success:function(res){
               
               if(res){

                              if (  res.msg === "Invitation and Phone number matches.  Please proceed" )  
                              {
                                    alert(" Your invitation is validated. Kindly proceed"); 
                                    showToastAlert("Info", 'Your invitation is validated. Kindly proceed!', 'info');
                                    $("#name").focusin();
                              }
                              else if ( res.msg === "Invitation is already used. Kindly try with a new Invitation" )  
                              {
                              
                                  alert("Invitation is already used. Kindly try with a new Invitation");
                                  /*JQuery refers to html control by $("#controlname")*/
                                  showToastAlert("Error", 'Invitation is already used. Kindly try with a new Invitation', 'error');
                                  $("#User_InvitationID").val("");
                                  $("#User_InvitationID").focusin();
                              } 
                              else if ( res.msg === "Given Phone number is wrong. It doesnot match with this Invitation ID" )  
                              {
                              
                                    alert("Given Phone number is wrong. It doesnot match with this Invitation ID");
                                    showToastAlert("Error", 'Given Phone number is wrong. It doesnot match with this Invitation ID', 'error');
                                    /*JQuery refers to html control by $("#controlname")*/
                                    $("#User_InvitationID").val("");
                                    $("#User_InvitationID").focusin();
                              } 
                              else if ( res.msg === "Given Phone number and Invitation ID is wrong. It doesnot match with any Invitation" )  
                              {
                              
                                    alert("Given Phone number and Invitation ID is wrong. It doesnot match with any Invitation");
                                    showToastAlert("Error", '"Given Phone number and Invitation ID is wrong. It doesnot match with any Invitation', 'error');
                                    /*JQuery refers to html control by $("#controlname")*/
                                    $("#User_InvitationID").val("");
                                    $("#User_InvitationID").focusin();
                              } 
                              else 
                              {

                                    /*JQuery refers to html control by $("#controlname")*/
                                    $("#User_InvitationID").val("");
                                    $("#User_InvitationID").focusin();
            
                              } 
               }
               else
               {
                        /*JQuery refers to html control by $("#controlname")*/
                        $("#User_InvitationID").val("");
                        $("#User_InvitationID").focusin();
              
               }
         }////success

      });
  }



function checkUniqueUser() {
 //  alert ("in unique user");
        var Username = document.getElementById("username").value;
        alert("in check unique user"+ Username);
       
       //Aruna- while asking Ajax calls, please remember
       //1. url should be correctly spelled in web.php 
       //2. this is always a GET call only
       //3. for multiple parameters use"+" to concatenate
       //4. alway the controller sends some data . So mostly control will come to success only
       //5. use controler logic to send both success and failure
       //6. use "==="  for string comparision
       // 7. when you use normal javascript you will use document.getElementById
       //8. when you use JQuery you will use $("#controlid")
        $.ajax({
           type:"GET",
           url:"{{url('checkUniqueUser/')}}"+'/'+Username,
           success:function(res){    
             if(res)
             {
                  res= json_decode(res);

                  if (res  === "Yes"  )
                  {
                    alert(" Username doesnot exists. Kindly proceed"); 
                      $("#password").focusin();
                  }
                  if (res  === "Sorry"  )
                  {
                    alert("Sorry this username exists already. Choose a unique one");
                    /*JQuery refers to html control by $("#controlname")*/
                    $("#username").empty();
                    $("#username").focusin();
                  } 
           }
           else{
                alert("error");
                 $("#username").empty();
                        $("#username").focusin();
           }
           },
             error: function(res){
                        alert(res); 
                        /*JQuery refers to html control by $("#controlname")*/
                        $("#username").empty();
                        $("#username").focusin();
              
             }
         });
}
    </script>
    
    
</section>

   @include('inc.footer')






<script>

var currentTab = 0; // Current tab is set to be the first tab (0)

//alert('hello');
showTab(currentTab); // Display the current tab

          
          
function showTab(n) {
        // This function will display the specified tab of the form...
        //alert (n);
        var x = document.getElementsByClassName("tab");
        //x.style.display = "block";
        //... and fix the Previous/Next buttons:
        /* if (n == 0) {
          document.getElementById("prevBtn").style.display = "none";
        } else {
          document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
          document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
          document.getElementById("nextBtn").innerHTML = "Next";
        } */
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
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
              //...the form gets submitted:
              document.getElementById("regForm").submit();
              return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
  }
          
          
          
function validateForm() {

            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");

            y = x[currentTab].getElementsByTagName("input");

            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
              // If a field is empty...
              if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
              }
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
      /* for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active"; */
}
</script>






<!--  CASTE SUBCASTE  SCRIPT -->
<script>
function castemaster() {
  var CasteID =  document.getElementById("caste").value;
  //alert("The text has beendocumen changed.");
  if(CasteID){  
      $.ajax({
         type:"GET",
         url:"{{url('get-subcaste-list')}}?CasteID="+CasteID,
         success:function(res){               
          if(res){
              $("#subcaste").empty();
              $("#subcaste").append('<option>Select Subcaste</option>');
         
              $.each(res,function(key,value){
                  $("#subcaste").append('<option value="'+key+'">'+value+'</option>');
                  
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

function validatepassword(){
//alert ("in validate password");
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password-confirm").value;
      //  alert (password);
      //  alert(confirmPassword);
        if ( password !="" &&  confirmPassword !="" ) {
        //   alert("inside oiuter if");
          if ( password != confirmPassword){
            //$("#password-confirm").focusin();
            document.getElementById("password-confirm").style.borderColor='red';
            //document.getElementById("password-confirmmsg").style="display:block";
          //  alert("Passwords do not match");
          }
        }
        
}


	 function showToastAlert(title, body, icon){
			$.toast({
			heading: title,
			text: body,
			showHideTransition: 'fade',
			icon: icon,
			position: 'bottom-right'
		});
		} 
		
		
  </script>
<!-- END CASTE SUBCASTE Script  -->








<!--  Crop Img  -->
{{-- <script type="text/javascript">


  $.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  
  
  $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      viewport: {
          width: 200,
          height: 200,
          type: 'circle'
      },
      boundary: {
          width: 300,
          height: 300
      }
  });
  
  
  $('#upload').on('change', function () { 
    var reader = new FileReader();
      reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
          url: e.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
  });
  
  
  $('.upload-result').on('click', function (ev) {
    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (resp) {
      $.ajax({
        url: "/image-crop",
        type: "POST",
        data: {"User_photo":resp},
        success: function (data) {
          html = '<img src="' + resp + '" />';
          $("#upload-demo-i").html(html);
        }
      });
    });
  });
  
   
  </script> --}}




 


@include('sweetalert::alert')


@endsection