<!-- {{-- /**
// classname - inc/navbar.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for Menus
// created date - Nov 2019
**/ --}} -->

<style>
    
    .mainmenu__nav{
        margin-top:10px;
    }
</style>
<!-- Header -->
<header id="wn__header" class="header__area header__absolute sticky__header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-6 col-lg-2">
          <div class="logo">
            <a href="/home">
              <img src="{{ asset('../images/frontend_images/logo/vclogo.png') }}" style="border-radius:50%;height:70px;"  alt="VC">
            </a>
          </div>
        </div>
        <div class="col-lg-8 d-none d-lg-block">
          <nav class="mainmenu__nav">
            <ul class="meninmenu d-flex justify-content-start">
              <li><a href="/home"  title="Home"><i class="fa fa-home fa-2x"></i></a></li>
              <li><a href="/matrimonys" title="Matrimony">@lang('home.matrimonial_menu')</a></li>
              <li><a href="/products" title="Jewellery">@lang('home.viewallitems_menu') </a></li>           
              <li><a href="/helpposts" title="Seek Help">@lang('home.askhelp_menu')</a></li>
              <li><a href="/elders" title="Ask Elders">@lang('home.askelders_menu')</a></li>
              <li><a href="/community" title="community">@lang('home.knowcommunity_menu') </a></li>
              <li><a href="/education" title="education">@lang('home.education_menu') </a></li>
             <li><a href="/contact-us" title="Contact us">@lang('home.contact_menu')</a></li>
            
             <li><a href="#" class=" dropdown-toggle"  data-toggle="dropdown">@lang('home.language_menu')</a>
          
             <div class="dropdown-menu" style="background:#f82249;font-family: 'Sen', sans-serif;color:#000;border:none;outline:0;border-bottom-right-radius:25px;border-bottom-left-radius:25px;">
               <a class="dropdown-item" href="/locale/en">English</a>
               <a class="dropdown-item" href="/locale/ta">Tamil</a>
               <!--<a class="dropdown-item" href="locale/kn">Kannada</a> -->
             </div>
            
            </li>

             </ul>
          </nav>
        </div>
        <div class="col-md-6 col-sm-6 col-6 col-lg-2">
          <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
 
            <li class="setting__bar__icon">
              <a class="setting__active" href="#" style="color:black;"><br/>  
                     @if(auth()->user()->User_photo)
                        <img src="{{ asset(auth()->user()->User_photo) }}" style="border-radius: 50%;border: 1px solid #f82249;float:right;margin-top:-20px;height:70px;width:70px;margin-top:-19px;margin-left: 2px;"  alt="VC">
                     @else 
                        <img src="/images/frontend_images/avatar.png" style="border-radius: 50%;border: 1px solid #f82249;height:70px;width:70px;margin-top: -19px;margin-left: 2px;"  alt="VC">
                     @endif
              </a>
            
              <div class="searchbar__content setting__block">
                <div class="content-inner">
                  <div class="switcher-currency">
                    <strong class="label switcher-label">
                      <span>My Account</span>
                    </strong>
                    <div class="switcher-options">
                      <div class="switcher-currency-trigger">
                        <div class="setting__menu">
                          <span><a class="dropdown-item" href="{{ route('profile.index',auth()->user()->id ) }}"><i class="fa fa-user fa-2x"></i>@lang('home.my_profile')</a></span>
                          <span><a  href="{{ route('changePassword') }}"><i class="fa fa-lock fa-2x"></i> @lang('home.myprofile_show_changepwd_heading')</a></span>
                          <span><a href="{{ route('logout') }}">  <i class="fa fa-sign-out fa-2x"></i> @lang('home.logout_menu')</a></span>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- Start Mobile Menu -->
      <div class="row d-none">
        <div class="col-lg-12 d-none">
          <nav class="mobilemenu__nav">
                  <ul class="meninmenu">
                      <li><a href="/home"  title="Home"><i class="fa fa-home fa-2x"></i></a></li>
                        <li><a href="/matrimonys" title="Matrimony">@lang('home.matrimonial_menu')</a></li>
                        <li><a href="/products" title="Jewellery">@lang('home.viewallitems_menu') </a></li>
                        <li><a href="/helpposts" title="Seek Help">@lang('home.askhelp_menu')</a></li>
                        <li><a href="/elders" title="Ask Elders">@lang('home.askelders_menu')</a></li>
                        <li><a href="/community">@lang('home.knowcommunity_menu') </a></li>
                      <li><a href="/contact-us" title="Contact us">@lang('home.contact_menu')</a></li>
                      

                  </ul>
                </div>
              </li>  
            </ul>
          </nav>
        </div>
      </div>
      <!-- End Mobile Menu -->
            <div class="mobile-menu d-block d-lg-none">
            </div>
            <!-- Mobile Menu -->	
    </div>		
  </header>
  <!-- //Header -->
  <!-- Start Search Popup -->
  <div class="brown--color box-search-content search_active block-bg close__top">
    <form id="search_mini_form" class="minisearch" action="#">
      <div class="field__search">
        <input type="text"  placeholder="Search entire store here...">
        <div class="action">
          <a href="#"><i class="fa fa-search"></i></a>
        </div>
      </div>
    </form>
    <div class="close__wrap">
      <span>close</span>
    </div>
  </div>
  <!-- End Search Popup -->
      <!-- Start Slider area -->
      <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
        <!-- Start Single Slide -->
        <div class="slide animation__style10 bg-image--1 fullscreen align__center--left">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="slider__content">
                    <div class="contentbox">
                     {{--  <h2>@lang('home.slidertitle')</h2> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Single Slide -->
        <!-- Start Single Slide -->
        <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="slider__content">
                    <div class="contentbox">
                    {{--   <h2>@lang('home.slidertitle')</h2> --}}
                     </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Single Slide -->
      </div>
      <!-- End Slider area -->


  