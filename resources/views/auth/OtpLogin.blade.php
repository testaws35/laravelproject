@extends('layouts.welcome')

@section('content')
<br/><br/>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border: 1px solid #f82249;">
                    <div class="card-header text-center text-white" style="background: #f82249;"><h3>{{ __('Login with OTP') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('loginWithOtp') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No') }}</label>

                                <div class="col-md-6">
                                    <input id="User_Phone" type="text" class="form-control" name="User_Phone" required autofocus>

                                </div>
                            </div>



                           <div class="form-group row otp">
                                <label for="password" class="col-md-4 col-form-label text-md-right">OTP</label>

                                <div class="col-md-6">

                                    <input id="otp" type="number" class="form-control" name="otp" >
                                </div>
                            </div>
                        

                            
                            <div class="form-group row mb-0 otp">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </div> 
                        </form>


                        <div class="form-group row send-otp">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-success" onclick="sendOtp()">Send OTP</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div><br/><br/>

   
   <!-- Added by raveendra on 15-11-19  -->
    <script src="js/frontend_js/vendor/jquery-3.4.1.min.js"></script>
    
    <script>
        $('.otp').hide();
        function sendOtp() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // alert($('#mobile').val());
            $.ajax( {
                url:'sendOtp',
                type:'post',
                data: {'User_Phone': $('#User_Phone').val()},
                success:function(data) {
                    // alert(data);
                    if(data != 0){
                        $('.otp').show();
                        $('.send-otp').hide();
                    }else{
                        alert('Mobile Number No not found');
                    }

                },
                error:function () {
                    console.log('error');
                }
            });
        }
    </script>

    <script>

$(function() {   
 $('.uppercase').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
});
    </script>    

<!--==========================
        Footer
      ============================-->
      <footer id="footer">
          <div class="footer-top">
            <div class="container">
              <div class="row">
      
                <div class="col-lg-3 col-md-6 footer-info footer-links">
             <h4>Vishwakarma Community</h4>
                  <p>The Vishwakarma community, also known as the Vishwabrahmin, are a social group of India, sometimes described as a caste. The community comprises five sub-groups—carpenters, blacksmiths, bronze smiths, goldsmiths and stonemasons—who believe that they are descendants of Vishvakarman, a Hindu deity.</p>
           </div>
      
                <div class="col-lg-3 col-md-6 footer-links">
                  <h4>Social Activities</h4>
                  <ul>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Reach out to elders</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Ask for Help</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Know your Community</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Know your temples</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Sangam Meetings</a></li>
                  </ul>
                </div>
      
                <div class="col-lg-3 col-md-6 footer-links">
                  <h4>Services Offered</h4>
                  <ul>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Matrimony Services</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Events News </a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">View products</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Publicize your functions</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="#">Announcements</a></li>
                  </ul>
                </div>
      
                <div class="col-lg-3 col-md-6 footer-contact">
                  <h4>Contact Us</h4>
                  <p>
                  Tecple Innoventive Solutions Pvt Ltd
                  #102 Vijayanagar, 3rd Stage, <br>
                   Mysuru 570017<br>
                   
                    <strong>Phone:</strong> +91 94489 58088<br>
                    <strong>Email:</strong> arunavp2019@gmail.com<br>
                  </p>
      
                  <div class="social-links">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                  </div>
                  <br/>
                  <a href="https://info.flagcounter.com/UIQ4"><img src="https://s11.flagcounter.com/count2/UIQ4/bg_ffffff/txt_000000/border_CCCCCC/columns_3/maxflags_10/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
                </div>
      
              </div>
            </div>
          </div>
      
          <div class="container">
            <div class="copyright">
              &copy; Copyright 2020. All Rights Reserved
            </div>
            <div class="credits">
       
              Powered by Tecple Innoventive Solutions Pvt. Ltd.
            </div>
          </div>
        </footer><!-- #footer -->
    
      <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>


@endsection
