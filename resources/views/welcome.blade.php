<!doctype html>

<!-- {{-- /**
// classname - welcome.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for first page which is Welcome page
// created date - Nov 2019
**/ --}} -->

<html lang="{{ app()->getLocale() }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to Viswakarma Community</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">

        <!-- Main Stylesheet File -->
        <link href="{{ asset('css/landing_css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <!-- Bootstrap CSS File -->
        <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">

        <!-- Libraries CSS Files -->
        <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }} " rel="stylesheet">
        <link href="{{ asset('lib/animate/animate.min.css') }} " rel="stylesheet">
        <link href="{{ asset('lib/venobox/venobox.css') }} " rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }} " rel="stylesheet">
        

</head>   
<body >

<!--==========================
    Header
  ============================-->
  <div style="overflow:hidden;">
  <header id="header">
        <div class="container">

                   <!-- @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif-->
                   
              <div id="logo" class="pull-left">
                <!-- Uncomment below if you prefer to use a text logo -->
               <a href="/"> <img src="{{ asset('../images/frontend_images/logo/vclogo.png') }}" style="border-radius: 50%;  0 4px 8px 0 rgba(0, 0, 0, 0.7), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"  alt="VC">
               </a>
              </div>
        
              <nav id="nav-menu-container">
                  <ul class="nav-menu">
                    <li class="menu-active"><a href="#intro">@lang('home.home_menu')</a></li>
                    <li><a href="#activities">@lang('home.act_welcomemenu')</a></li>
                    <li><a href="#faq">@lang('home.faq_welcomemenu')</a></li>
                    <!--/* changed by Aruna removed membership plans and added Language menu */-->
                       <a href="#" class=" dropdown-toggle lidislap"  data-toggle="dropdown">@lang('home.language_menu')</a>
                       <div class="dropdown-menu" style="background:#f82249;font-family: 'Sen', sans-serif;color:#000;border:none;outline:0;border-bottom-right-radius:25px;border-bottom-left-radius:25px;">
                            <a class="dropdown-item" href="locale/en">English</a>
                            <a class="dropdown-item aa" href="locale/ta" >
                                தமிழ்
                            </a>
                       </div>
                    <li><a href="{{ route('welcome') }}">@lang('home.login_welcomemenu')</a></li>
                    <li><a href="#contact">@lang('home.contact_menu')</a></li>
                  </ul>
              </nav><!-- #nav-menu-container -->
        </div>
 </header><!-- #header -->
    
      <!--==========================
        Intro Section
      ============================-->
      <section id="intro">
        <div class="intro-container wow fadeIn">
            <div class="videoWidth">
              <a href="https://www.youtube.com/watch?v=YtpjNsCYMps&feature=youtu.be" class="venobox play-btn mb-4" data-vbtype="video"
              data-autoplay="true"  ></a>
            </div>
        </div>
      </section>
     <!--  *************************************************************************************
      ---                                   Login form
      ---
      ---*******************************************************************************************/!-->
      <main id="main">  
         <div class="container" >
          <div class="row justify-content-center" style="margin-top:30px;">
              <div class="col-md-8">
                    <div class="card" style="border: 1px solid #f82249;">
                      <div class="card-header text-center " style="background: #f82249;border-bottom-left-radius:50px;border-bottom-right-radius:50px;"><h3 style="color:#fff; font-family: 'Sen', sans-serif;">@lang('home.login_welcomemenu')</h3></div>
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
                                      <label for="username" class="col-md-4 col-form-label text-md-right" style="color: #f82249; font-family: 'Sen', sans-serif;">@lang('home.login_emailuser')</label>
                                      <div class="col-md-6">
      
                                        <input id="username" type="text" class="form-control @error('email') is-invalid @enderror"  name="username" value="{{ old('username') }}" required autofocus>
                                          @error('username')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                              </div>
      
                              <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right" style=" font-family: 'Sen', sans-serif;color: #f82249;">@lang('home.login_password')</label>
      
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
                                        <div class="col-md-12 offset-md-4" >
                                          <button type="submit" class="btn loginbtn_txt" style="margin-left:30px;">
                                           &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  @lang('home.login_welcomemenu') &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                          </button>
                                        </div>
                                        <div class="col-md-12 offset-md-4">
                                           <p class="landtxt landtxt_langtel"> @lang('home.login_newuser') ?<a class="btn btn-link landtxt landtxt_langtel" href="{{ route('register') }}">@lang('home.login_reghere')!
                                              </a>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                           @if (Route::has('password.request'))
                                              <a class="btn btn-link landtxt landtxt_langtel" href="{{ route('password.request') }}">
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
     <br><br>

        <!--==========================
          About Section
        ============================-->

        <section id="aboutuslanding" class="section-with-bg wow fadeInUp" >
                <div class="container-fluid">
                      <div class="row cardpadding">
                              <div class="col-lg-3 cardcol" >
                                <h1 class="card-title text-muted text-uppercase text-center welcome_heading" ><b>@lang('home.about_whatweoffer_heading')</b></h1>
                          
                                <hr>
                                <ul class="fa-ul">
                                    <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whatweoffer_sub_mat')</li>
                                    <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whatweoffer_sub_jewe')</li>
                                    <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whatweoffer_sub_info') </li>
                                    <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whatweoffer_sub_comm') </li>
                                    <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span> @lang('home.about_whatweoffer_sub_ann')</li>
                                
                                </ul>
                              <!-- <hr>  horizontal line -->
                              </div>
                              <div class="col-lg-3 cardcol">
                                <h1 class="card-title text-muted text-uppercase text-center welcome_heading"><b>@lang('home.about_whychooseus_heading')</b></h1>
                                <hr> <!-- horizontal line -->
                                <ul class="fa-ul">
                                  <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whychooseus_sub_matr')</li>
                                  <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whychooseus_sub_help')</li>
                                  <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whychooseus_sub_know') </li>
                                  <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_whychooseus_sub_seek') </li>
                                <!--  <li><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span> @lang('home.about_whychooseus_sub_reach')</li>-->
                                </ul>
                              <!-- <hr> -->
                              </div>
                              <div class="col-lg-3 cardcol">
                                  <h1 class="card-title text-muted text-uppercase text-center welcome_heading"><b>@lang('home.about_value_heading')</b></h1>
                                  <hr>
                                    <ul class="fa-ul">
                                          <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_value_sub_uni')</li>
                                          <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_value_sub_unit')</li>
                                          <li class="marb"> <span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_value_sub_motto') </li>
                                          <li class="marb"><span class="fa-li"><i class="fa fa-dot-circle-o"></i></span>@lang('home.about_value_sub_rem')</li>
                                    </ul>
                            
                              </div>
                      </div><!-- end row -->
                </div><!--container-fluid -->
        </section><!-- end aboutuslanding -->

         


        
         

  <!--==========================
      activities Section
    ============================-->
    <section id="activities" class=" wow fadeInUp" style="margin-top: -40px;">
          <div class="container-fluid">
                        <div class="section-header">
                                  <h2>@lang('home.act_welcomemenu')</h2>
                                  <p>@lang('home.activities_subheading')</p>
                        </div>
                          <!--  stopped auto scroll by removing data-ride="carousel" in the below div -->
                        <div id="myCarousel_topnotch" class="carousel slide col-lg-12 offer_area container-fluid" >
                          <!-- Wrapper for slides -->
                                    <div class="row product_inner ">
                                      <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item  active  ">
                                                  <div class="row " >
                                                    @foreach ($templefunctions as $templefunction)
                                                                  <div class="col-lg-2 col-md-6 col-6 "  >   
                                                                      <div class="activities activities_card">
                                                              
                                                                        <div class="activities-img card-home-header-welcomeimage">
                                                                          <img src="{{ $templefunction->Photo }}" alt="activities"  id="act_photo" class="img-fluid">
                                                                        </div>
                                                                        <div class="mytable">
                                                                          <h3>{{ $templefunction->Title }}</h3>
                                                                          {{--  <p>{{ $templefunction->Function_Content }}</p>  --}}
                                                                        </div>
                                                                      </div> <!-- speaker-->
                                                                  </div>
                                                          @endforeach
                                              
                                                    
                                                  
                                                      @foreach ($sangammeetings as $sangammeeting)
                                                                <div class="col-lg-2 col-md-6 col-6 "  >   
                                                                            <div class="activities activities_card">
                                                                              <div class="activities-img card-home-header-welcomeimage">
                                                                                <img src="{{ $sangammeeting->Photo }}" alt="sangammeeting"  id="act_photo" class="img-fluid">
                                                                              </div>
                                                                              <div class="mytable"><h3>
                                                                                {{ $sangammeeting->Title }}</h3>
                                                                              {{--  <p>{{ $sangammeeting->Meeting_Content }}</p> --}} 
                                                                              </div>
                                                                              </div>
                                                                    </div>
                                                            @endforeach
                                                            </div>
                                                      
                                                
                                                
                                              </div><!-- end row -->
                                          </div>
                                    </div> <!-- product_inner-->
                        </div> <!-- myCarousel_topnotch-->
                        <div class="row">
                                    <div class="col-md-6">                     
                                        <a class="carousel-control right_slide_act" href="#myCarousel_topnotch" role="button" data-slide="next">
                                            <img src="images/right-arrow.png">
                                        </a>     
                                    </div>
                                    <div class="col-md-6">
                                        <a  class="carousel-control left_slide_act" href="#myCarousel_topnotch" role="button" data-slide="prev">
                                                <img src="images/left-arrow.png">
                                        </a><!-- Controls -->
                                    </div>
                        </div>
          </div><!--container-fluid -->
      
    </section> 
    
      
        <!--==========================
          F.A.Q Section
        ============================-->
    <section id="faq" class="section-with-bg wow fadeInUp" >
    
          <div class="container">
    
            <div class="section-header">
              <h2>@lang('home.faq_heading') </h2>
            </div>
    
            <div class="row justify-content-center">
              <div class="col-lg-9">
                  <ul id="faq-list">
                    <li>
                      <a data-toggle="collapse" class="collapsed" href="#faq1"> @lang('home.q1')<i class="fa fa-minus-circle"></i></a>
                      <div id="faq1" class="collapse show" data-parent="#faq-list">
                        <p>         @lang('home.q1_answer')                        </p>
                      </div>
                    </li>
                    <li>
                       <a data-toggle="collapse" class="collapsed" href="#faq2"> @lang('home.q2')<i class="fa fa-minus-circle"></i></a>
                       <div id="faq2" class="collapse" data-parent="#faq-list">
                          <p> @lang('home.q2_answer') </p>
                       </div>
                    </li>
                    <li>
                      <a data-toggle="collapse" class="collapsed" href="#faq3">@lang('home.q3')<i class="fa fa-minus-circle"></i></a>
                      <div id="faq3" class="collapse" data-parent="#faq-list">
                        <p> @lang('home.q3_answer')  </p>
                      </div>
                    </li>
                    <li>
                      <a data-toggle="collapse" href="#faq4" class="collapsed">@lang('home.q4')<i class="fa fa-minus-circle"></i></a>
                      <div id="faq4" class="collapse" data-parent="#faq-list">
                        <p>
                          @lang('home.q4_answer')
                        </p>
                      </div>
                    </li>
                    <li>
                      <a data-toggle="collapse" href="#faq5" class="collapsed">@lang('home.q5')<i class="fa fa-minus-circle"></i></a>
                      <div id="faq5" class="collapse" data-parent="#faq-list">
                        <p>
                          @lang('home.q5_answer')
                        </p>
                      </div>
                    </li>
                    <li>
                      <a data-toggle="collapse" href="#faq6" class="collapsed">@lang('home.q6') <i class="fa fa-minus-circle"></i></a>
                      <div id="faq6" class="collapse" data-parent="#faq-list">
                        <p>
                          @lang('home.q6_answer')
                        </p>
                      </div>
                    </li>
                    <li>
                      <a data-toggle="collapse" href="#faq7" class="collapsed">@lang('home.q7')<i class="fa fa-minus-circle"></i></a>
                      <div id="faq7" class="collapse" data-parent="#faq-list">
                        <p>
                          @lang('home.q7_answer')
                        </p>
                      </div>
                    </li>
                 </ul>
              </div>
            </div>
    
          </div>
    
        </section>
    
  
    
        <!--==========================
          Contact Section
        ============================-->
        <section id="contact" class="section-bg wow fadeInUp">
    
          <div class="container">
    
            <div class="section-header">
              <h2>@lang('home.footer_head_contactus')</h2>
              <p>@lang('home.contact_subheading')</p>
            </div>
    
            <div class="row contact-info">
    
              <div class="col-md-4">
                <div class="contact-address">
                  <i class="ion-ios-location-outline"></i>
                  <h3>@lang('home.footer_head_contactus')</h3>
                  <address style="font-family: 'Sen', sans-serif;">@lang('home.contact_panel_address')</address>
                </div>
              </div>
    
              <div class="col-md-4">
                <div class="contact-phone">
                  <i class="ion-ios-telephone-outline"></i>
                  <h3>@lang('home.contact_mobile_number')</h3>
                  <p><a href="tel:+9194489 58088" style="font-family: 'Sen', sans-serif;color:#212529;text-decoration:none;">+9194489 58088</a></p>
                </div>
              </div>
    
              <div class="col-md-4">
                <div class="contact-email">
                  <i class="ion-ios-email-outline"></i>
                  <h3>@lang('home.matrimonys_create_basicdetails_email')</h3>
                  <p><a href="mailto:telunguviswakarma-tn.in" style="font-family: 'Sen', sans-serif;color:#212529;text-decoration:none;">info@telunguviswakarma-tn.in</a></p>
                </div>
              </div>
    
            </div>
            <!--  *************************************************************************************
          ---                                   Contact US form
          ---
          ---*******************************************************************************************/!-->
    
            <div class="form">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <form action="{{ route('contactusland') }}"  method="post" role="form" class="contactForm">
              @csrf
              @if (count($errors) > 0)
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="@lang('home.contact_panel_name_placeholder')" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required/>
                    <div class="validation">
                        @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="@lang('home.contact_panel_email_placeholder')" data-rule="email" data-msg="Please enter a valid email" required/>
                    <div class="validation">
                                         @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror   
                    </div>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div> -->
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="@lang('home.contact_message')" required></textarea>
                  <div class="validation">
                                          @error('message')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                  </div>
                </div>
                <div class="text-center"><button type="submit">@lang('home.contact_sendmessage_btn')</button></div>
              </form>
            </div>
    
          </div>
        </section><!-- #contact -->
    
      </main>
    
    
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
    
      <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
   </div>

  <!-- JavaScript Libraries -->
  <script src="{{ asset('lib/jquery/jquery.min.js') }} "></script>
  <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }} "></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <script src="{{ asset('lib/easing/easing.min.js') }} "></script>
  <script src="{{ asset('lib/superfish/hoverIntent.js') }} "></script>
  <script src="{{ asset('lib/superfish/superfish.min.js') }} "></script>
  <script src="{{ asset('lib/wow/wow.min.js') }} "></script>
  <script src="{{ asset('lib/venobox/venobox.min.js') }} "></script>
  <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }} "></script>


  <!-- Template Main Javascript File -->
  <script src="js/landing_js/main.js"></script>

  @include('sweetalert::alert')

 </body>
 </html>
