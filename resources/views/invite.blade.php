@extends('layouts.app1')

<!--{{-- /**
// classname - Invite.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This blade represents the Invite page in User Profile
// created date - Nov 2019
**/ --}} -->


@section('content')


<div class="container" style="margin-top:-100px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-uppercase">
                  <h2 style="font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_heading') </h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('sendinvite') }}">
                        @csrf

                    
                        <div class="form-group row">
                                    <label for="Invitee_Name" class="col-md-4 col-form-label text-md-right" style="font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_name')</label>
                                    <div class="col-md-6">
           
                                    <input id="Invitee_Name" type="text" pattern="([^\s][A-zA-Z\s]+)" class="form-control @error('Invitee_Name') is-invalid @enderror"  name="Invitee_Name" value="{{ old('Invitee_Name') }}" data-toggle="tooltip" data-placement="top" title="enter only lowercase and uppercase letters.."  placeholder="Enter invitee name" required >
                                        @error('Invitee_Name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                         </div>
                       
                        <div class="form-group row">
                                <label for="Mobile_Number" class="col-md-4 col-form-label text-md-right" style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_create_basicdetails_mobileno')</label>
    
                                <div class="col-md-6">
                                    <input id="Mobile_Number" type="number" class="form-control @error('Mobile_Number') is-invalid @enderror"  name="Mobile_Number" value="{{ old('Mobile_Number') }}" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" data-toggle="tooltip" data-placement="top"  title="starting with 9,8,7 enter 10 digits mobile nuber.." placeholder="Enter 10 digits mobile nuber.." maxlength="10" minlength="10" required >
                                    @error('Mobile_Number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_email')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" onchange="checkemailunique()"  name="email" value="{{ old('email') }}"  data-toggle="tooltip" data-placement="top" title="enter valid email address"  placeholder="Email address" required >
                                
                            </div>
                            <p id="email_error" style="color:red;font-size:12px !important;" ></p>
                        </div>
               
                         <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" id="submit" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" disabled>
                                    @lang('home.myprofile_show_invite_sendbtn')
                                </button>
                            </div>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
    function checkemailunique() {
        //alert ("in unique user");
        var email = document.getElementById("email").value;
       
      
        $.ajax({
           type:"GET",
           contentType: "application/json;charset=utf-8",
           dataType: "JSON",
           url:"{{url('checkUniqueUserEmail')}}?email="+email,
           success:function(res){    
               
                if(res)
                {
                    
                      if(res == "Yes")                         
                      {
                         //alert(" Username doesnot exists. Kindly proceed"); 
                          //$("#password").focusin();
                          document.getElementById("submit").disabled = false;
                          $("#email_error").html("");
                      }
                      if (res  == "Sorry"  )
                      {
                        //alert("Sorry this username exists already. Choose a unique one");
                        //showToastAlert("Error", 'Sorry this username exists already. Choose a unique one', 'error');
                        /*JQuery refers to html control by $("#controlname")*/
                        document.getElementById("submit").disabled = true;
                        $("#email_error").html("Email-ID already registered with Telungu viswakarma.Please use diiferent email address");
                        document.getElementById("email").value = "";
                      } 
                      else
                      {
                          $("#email_error").html("");
                      }
                }
              else{
                    //alert("error");
                    $("#username").empty();
                    $("#username").focusin();
              }
            },
            error: function(xhr, status, error,res){
                      
                   
                      var errorMessage = xhr + ': ' + xhr.statusText
                      //alert('Error - ' + errorMessage);
                     // alert("res-->"+res);
                      ///*JQuery refers to html control by $("#controlname")*/
                      $("#email").empty();
                      $("#email").focusin();
            
            }
         });
}
    
    
</script>



@include('sweetalert::alert')

@endsection