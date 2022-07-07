@extends('layouts.welcome')
@section('content')
<style>
    .myfont{
        color: black; 
        font-family: 'Sen', sans-serif;
     }
</style>
<br/><br/><br/><br/>


<div class="container" >

    <div class="row justify-content-center" style="margin-top:-50px;">
        <div class="col-md-8">
              <div class="card" style="border: 1px solid #f82249;">
                <div class="card-header text-center" style="background: #f82249;border-bottom-left-radius:50px;border-bottom-right-radius:50px;"><h3 style="color:#fff; font-family: 'Sen', sans-serif;">@lang('home.login_welcomemenu')</h3></div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                               <?php if( isset($Failed) ) { ?>
                            
                       <h6 style="color:red;" class="text-center ml-5">  {{$Failed}} </h6> 
                            
                               <?php } ?>
                        </div>
                        <div class="form-group row">
                               <!-- Aruna changed -->
                                <label for="username" class="col-md-4 col-form-label text-md-right myfont" >@lang('home.login_emailuser')</label>

                                <div class="col-md-6">

                                  <input id="username" type="name" class="form-control @error('email') is-invalid @enderror"  name="username" value="{{ old('username') }}" required autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right myfont" >@lang('home.login_password')</label>

                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                        </div>

                    <!--   {{--   <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}} -->

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;margin-left:30px;">
                                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @lang('home.login_welcomemenu') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                            </div>   
                            <div class="col-md-12 offset-md-4"> 
                                <p class="myfont" >   @lang('home.login_newuser') ?<a class="btn btn-link" href="{{ route('register') }}" > @lang('home.login_reghere')! </a>
                                    
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link myfont" href="{{ route('password.request') }}" >
                                      @lang('home.login_forgotpwd')
                                    </a>
                                @endif
                                </p>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     
    </div>
  </div>
</div>  <br/><br/>

  <!--==========================
        Footer
      ============================-->
      <footer id="footer">
        <div class="footer-top">
          <div class="container">
            <div class="row">
    
              <div class="col-lg-3 col-md-6 footer-info footer-links">
                <!-- <img src="img/logo.png" alt="TheEvenet"> -->
                <h4>@lang('home.footer_head_about')</h4>
                <p>@lang('home.footer_about_msg')</p>
              </div>
    
              <div class="col-lg-3 col-md-6 footer-links">
                <h4>@lang('home.footer_head_social_activities')</h4>
                <ul>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_sa_reachelders')</a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_askhelp')</a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_community')</a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_temples')</a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.head_sangam_meetings')</a></li>
                </ul>
              </div>

              <div class="col-lg-3 col-md-6 footer-links">
                <h4>@lang('home.footer_head_services_offered')</h4>
                <ul>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_matrimony_services')</a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_events') </a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_viewproducts')</a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.footer_sub_head_publicize')</a></li>
                  <li><i class="fa fa-angle-right"></i> <a href="#">@lang('home.head_announcements')</a></li>
                </ul>
              </div>
    
              <div class="col-lg-3 col-md-6 footer-contact">
                <h4>@lang('home.footer_head_contactus')</h4>
                <p>
                  @lang('home.footer_sub_head_con_address')<br>
                 
                  <strong>@lang('home.footer_sub_head_con_phonenumber'):</strong> +91 94489 58088<br>
                  <strong>@lang('home.footer_sub_head_con_emailaddress'):</strong> info@telunguviswakarma-tn.in<br>
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
            &copy; 2020 - <?php echo "" . date("Y") ;?>, @lang('home.footer_copyright')
          </div>
          <div class="credits">
  
          {{--   @lang('home.welcomefooter_powerby') --}}
        <a href="http://www.tecpleglobal.com" target="_blank" style="text-decoration:none;color:#fff;"> @lang('home.footer_powerby')</a>
          </div>
        </div>
      </footer><!-- #footer -->

      @include('sweetalert::alert')

      
@endsection
