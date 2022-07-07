<!DOCTYPE html>
<!-- html lang="{{ str_replace('_', '-', app()->getLocale()) }}">  -->

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome to Viswakarma Community</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Fonts -->
    
     <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">


         <!-- Main Stylesheet File -->
             <link href="{{ asset('css/landing_css/style.css') }}" rel="stylesheet">
         
               <!-- Bootstrap CSS File -->
           <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
         
           <!-- Libraries CSS Files -->
           <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }} " rel="stylesheet">
           <link href="{{ asset('lib/animate/animate.min.css') }} " rel="stylesheet">
           <link href="{{ asset('lib/venobox/venobox.css') }} " rel="stylesheet">
           <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }} " rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         

          <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>-->
          <!-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
            <script src="{{ asset('js/jquery-1.12.4.min.js') }}" ></script>-->
            <!-- Toast alert css -->
            <link rel="stylesheet" href="{{ asset('css/jquery.toast.css') }} ">  
           <!-- <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" />-->
    


    <style>
            html, body {
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;  
           background: #f6f7fd;  
            color: #636b6f;
            font-family: 'Sen', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                color: whitesmoke;
            }

            .links > a {
                color: whitesmoke;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
  /*          .card {
    border: 0;
    background-color: transparent;
}  */

/* START NEW REGISTER */

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: 'Sen', sans-serif;
  padding: 40px;
  width: 70%;
  min-width: 300px;
  margin-top: -10px;
  border-bottom-color: #f82249;
  border-bottom-style: solid ;
  border-top-color: #f82249;
  border-top-style: solid ;
  /*border: 1px solid #ffffff;  */
  box-shadow: 5px 10px 18px #888888;
}

h1 {
  text-align: center;  
}

input  {
  padding: 10px;
  width: 100%;
  font-size: 16px;
  font-family: 'Sen', sans-serif;
  border: 1px solid #aaaaaa;
}
select  {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: 'Sen', sans-serif;
  border: 1px solid #aaaaaa;
}


/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #f82249;
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


  /** Register page terms and conditions CSS  **/

      .box{
        color: #fff;
        padding: 20px;
        display: none;
        margin: 10px;
      
    }
    .red{ background: rgb(248, 34, 73); }

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  white-space:pre-line;  
  position:relative;
  top:-7px;
  
}


/* END NEW REGISTER PAGE */
/*****  Circle Buttons for Languages ***
.btn-circle.btn-sm { 
            width: 30px; 
            height: 30px; 
            padding: 6px 0px; 
            border-radius: 15px; 
            font-size: 8px; 
            text-align: center; 
        } 
        .btn-circle.btn-md { 
            width: 50px; 
            height: 50px; 
            padding: 7px 10px; 
            border-radius: 25px; 
            font-size: 10px; 
            text-align: center; 
        } 
        .btn-circle.btn-xl { 
            width: 70px; 
            height: 70px; 
            padding: 10px 16px; 
            border-radius: 35px; 
            font-size: 12px; 
            text-align: center; 
        }

        .btnWidth { 
            background-size: auto; 
            text-align: center; 
            padding-top: 30px ; 
          margin-right:80%;
       } 

       .videoWidth{
          background-size: auto; 
            text-align: center; 
            padding-top: 30px ; 
          margin-right:80%;
          margin-bottom: -30px;

       }
        .btn-primary{background: #f82249;border: 0;color:#fff;font-family: 'Sen', sans-serif;}

        @media only screen and (max-width: 900px) {
          .btnWidth { 
            padding-top: 30px ; 
          margin-right:10%;
           
           } }

        @media only screen and (max-width: 900px) {
          .btnWidth { 
            padding-top: 30px ; 
          margin-right:10%;
           
           } }

        @media only screen and (max-width: 900px) {
          .videoWidth { 
            padding-top: 30px ; 
           } }

           @media only screen and (max-width: 500px){
             .dropdown{
               background: #888888;
             }
           }
/*****  END Circle Buttons for Languages ***/

 </style>
 
  
</head>
<body>
     <div id="app" >
      <header id="header">
         <div class="container">
            <div id="logo" class="pull-left">
                <!-- Uncomment below if you prefer to use a text logo -->
                <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
               <a href="/"> <img src="{{ asset('../images/frontend_images/logo/vclogo.png') }}" style="border-radius: 50%;  0 4px 8px 0 rgba(0, 0, 0, 0.7), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"  alt="VC"></a>
              </div>
                 <nav id="nav-menu-container">
                    <ul class="nav-menu">
                      <li class="menu-active"><a href="/#intro">@lang('home.home_menu')</a></li>
                      <li><a href="/#activities">@lang('home.act_welcomemenu')</a></li>
                      <li><a href="/#faq">@lang('home.faq_welcomemenu')</a></li>
                      <li><a href="{{ route('welcome') }}">@lang('home.login_welcomemenu')</a></li>
                      
                      <!-- changed by Aruna -added Lnguage menu-->
                          <li><a href="#" class=" dropdown-toggle"  data-toggle="dropdown">Language</a>
                              <div class="dropdown-menu" style="background:#f82249;font-family: 'Sen', sans-serif;color:#000;border:none;outline:0;border-bottom-right-radius:25px;border-bottom-left-radius:25px;">
                                <a class="dropdown-item" href="locale/en" style="display:block;">English</a>
                                <a class="dropdown-item" href="locale/ta" style="display:block;">Tamil
                                </a>
                               <!-- <a class="dropdown-item" href="locale/kn" style="display:block;"> Kannada</a>-->
                             </div>
                        </li>
                        
      <li><a href="/#contact">@lang('home.contact_menu')</a></li>
      
      
                  <!---    <a class = "dropdown">
                        <a class = "dropdown-toggle" 
                        data-toggle = "dropdown"  style="color: #fff;">Language</a>
                        
                        <div class = "dropdown-menu" style="color: :red !important;background:#f82249;border:0;height:100px;">
                           <a class = "dropdown-item" href = "locale/en">English</a>
                           <a class = "dropdown-item" href = "locale/ta">Tamil</a>
                           <a class = "dropdown-item" href = "locale/kn">Kannada</a>
                        </div>
                       </a>-->
                       
                       
                       
                      </ul>
                  </nav><!-- #nav-menu-container -->
           </div><!-- end container -->
                  </header><!-- #header -->

 <!--==========================
        Intro Section
      ============================-->
      <section id="intro">
            <div class="intro-container wow fadeIn">
            <!--  {{--  <h1 class="mb-4 pb-0">Viswakarma CommunityHistory </h1>
              <p class="mb-4 pb-0">Click here </p>
              <a href="https://www.youtube.com/watch?v=5kcnkgi-1xA" class="venobox play-btn mb-4" data-vbtype="video"
                data-autoplay="true"></a>
              <a href="/#about" class="about-btn scrollto">About Viswakarma Community</a>
            --}} -->
            <div class="videoWidth">
              <a href="https://www.youtube.com/watch?v=YtpjNsCYMps&feature=youtu.be" class="venobox play-btn mb-4" data-vbtype="video"
              data-autoplay="true"  ></a>
            </div>
            </div>
          </section>
          <main> 
               {{--  <main class="py-4"> --}}
            @yield('content')
        </main>
    </div>



<!-- JS Files -->
   
   
    

  


<script>
$(document).ready(function(){
    $('input[type="checkbox"]').click(function(){
        var inputValue = $(this).attr("value");
        $("." + inputValue).toggle();
    });
});
</script>
<!-- JavaScript Libraries -->
<script src="{{ asset('js/frontend_js/vendor/jquery-3.2.1.min.js') }}"></script> 
    <script src="{{ asset('js/frontend_js/popper.min.js') }}"></script>
    <script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script>
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

<!-- Aruna added this for Sweet Alert -->
<!-- {{-- <script>
  @include('sweetalert::alert')
</script> --}} -->
<script>
 $(document).ready(function(){
                    $('input[type=text]').bind('input', function () {
                        var c = this.selectionStart,
                            r = /[^a-z ]/gi,
                            v = $(this).val();
                        if (r.test(v)) {
                            $(this).val(v.replace(r, ''));
                            c--;
                        }
                        this.setSelectionRange(c, c);
                    });
 });
               </script>
</body>
</html>
