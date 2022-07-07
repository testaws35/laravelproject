 @extends('layouts.app1')
@section('content')


    <title> Know your community </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
      <style>

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
                                          
            .TabColor{
                background: #fff; 
                border-radius:30px;
                padding: 10px;
                box-shadow: 5px 10px 18px #888888;
              }

            .list-group {
                font-family: 'Sen', sans-serif;
                font-size:2rem;
                    }
            .submenu_heading{
                font-family: 'Sen', sans-serif;
            }
        @media (min-width:1441px) and (max-width:1920px) {
          .submenu_heading{
            font-family: 'Sen', sans-serif;
            font-size: 33px !important;

            }
         }  
       @media (min-width:1440px) {
          .submenu_heading{
            font-family: 'Sen', sans-serif;
            font-size: 30px;

            }
         }  
      .btn{
        font-size:14px!important;
       }
       .list-group-item{
           border: 1px solid rgba(0,0,0,.125) !important;
           font-size: 20px !important;
       }
         </style>
</head>


<body>
<div class="container-fluid">
  <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
           <div class="col-lg-12">
                   <div class="ibox">
                            <h1 class="text-center" style="font-family: 'Sen', sans-serif;">
                              @lang('home.footer_sub_head_community')
                          </h1>
                   <div><!--class="ibox-content"  -->
                   <div class="panel-group payments-method" id="accordion">
                   <br/>
                      <div class="panel panel-default">
                          <div id="collapseTwo" class="panel-collapse collapse show">
                             <div class="panel-body">
                               <!-- first row-->
                               <div class="row">
                                        <div class="col-md-3"><br/>
                                          <div class="col-md-12 TabColor ">
                                                <ul class="nav nav-pills flex-column commbtnColor" id="myTab" role="tablist"><br/>
                                                          <li class="nav-item ">
                                                              <a  class="btn btn-block " id="about-tab" data-toggle="tab" href="#about" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.community_about_btn')</a>
                                                          </li>
                                                          <li class="nav-item">
                                                              <a class="btn  btn-block" id="subsects-tab" data-toggle="tab" href="#subsects" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.community_subsects_btn')</a>
                                                          </li>
                                                          <li class="nav-item">
                                                              <a class="btn  btn-block" id="sangams-tab" data-toggle="tab" href="#sangams" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.community_sangams_btn')</a>
                                                          </li>
                                                          <li class="nav-item">
                                                              <a class="btn  btn-block" id="temples-tab" data-toggle="tab" href="#temples" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.community_temples_btn')</a>
                                                          </li>
                                                          <li class="nav-item">
                                                              <a class="btn  btn-block" id="sellers-tab" data-toggle="tab" href="#sellers" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.products_sellers_heading')</a>
                                                          </li>
                                                          <li class="nav-item">
                                                              <a class="btn  btn-block" id="institutions-tab" data-toggle="tab" href="#institutions" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.community_institutions_btn')</a>
                                                          </li>
                                                          <li class="nav-item">
                                                              <a class="btn  btn-block" id="companies-tab" data-toggle="tab" href="#companies" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.community_companies_btn')</a>
                                                          </li>
                                                          <li class="nav-item">
                                                              <a class="btn  btn-block" id="famouspeople-tab" data-toggle="tab" href="#famouspeople" role="tab" style="background:#212529;color:#fff;border-radius:25px;font-family: 'Sen', sans-serif;">@lang('home.community_famous_btn')</a>
                                                          </li>
                                                </ul>
                                             </div>
                                        </div><!--col-md-4-->
                                        <div class="col-md-9"><br/>
                                             <div class="col-md-12 TabColor">
                                                    <div class="tab-content" id="myTabContent">
                                                        <!--******************************************************************************
                                                        ****************************ABOUT TAB *******************************************
                                                        ********************************************************************************-->
                                                        <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                                             <!--Grid row-->
                                                              <div class="row">
                                                                         <!--Grid column-->
                                                                         <div class="col-md-5 mb-4">
                                                                                  <div class="view overlay z-depth-1-half"><br/><br/><br/>
                                                                                        <img src="{{ asset('../images/frontend_images/about-us.png') }}" class="card-img-top" alt="AboutUS">
                                                                                        <div class="mask rgba-white-light">
                                                                                        </div>
                                                                                  </div>
                                                                          </div>
                                                                          <!--Grid column-->
                                                        
                                                                          <!--Grid column-->
                                                                          <div class="col-md-7 mb-4">
                                                                                <h2 style="font-family: 'Sen', sans-serif;">@lang('home.community_about_btn')</h2>
                                                                                <hr>
                                                                                <p style="font-family: 'Sen', sans-serif;">@lang('home.community_about_description') </p>
                                                                                <a href="#" class="btn" style="font-family: 'Sen', sans-serif;background: #f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">
                                                                                @lang('home.temple_functions_readmore_btn')</a>
                                                                          </div>
                                                                          <!--Grid column-->
                                                                </div>
                                                                <!--Grid row-->   
                                                       </div> <!--END-->
                                                        <!--******************************************************************************
                                                        ****************************SUBSECTS TAB *******************************************
                                                        ********************************************************************************-->
                                                        <div class="tab-pane fade" id="subsects" role="tabpanel" aria-labelledby="profile-tab">
                                                            <h2 class="text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.community_subsects_heading')</h2><br/>
                                                            <div class="container">
                                                                  <div class="row">
                                                                          <div class="col-md-6">
                                                                          <h3 class="text-center text-uppercase submenu_heading">Telugu Viswakarma Group <br/>I </h3>
                                                                          <ul class="list-group">
                                                                                    <li class="list-group-item">Kathiroor Vaallu</li>
                                                                                    <li class="list-group-item">Appojulu Vaallu (or) Appanoor Vaallu</li>
                                                                                    <li class="list-group-item">Pohanoor Vaallu (or) Pothojulu Vaallu</li>
                                                                                    <li class="list-group-item">Thotta Vallu (or) Thodur Vaallu</li>
                                                                                    <li class="list-group-item">AAthivoor Vaallu</li>
                                                                                    <li class="list-group-item">Baalagudoor Vaallu</li>
                                                                                    <li class="list-group-item">Surikiloor Vaallu</li>
                                                                                    <li class="list-group-item">Harichandramoor Vaallu</li>
                                                                                    <li class="list-group-item">Moonikandoor Vaallu</li>
                                                                                    <li class="list-group-item">Gunthoor Vaallu</li>
                                                                                    <li class="list-group-item">Noonakandoor Vaallu</li>
                                                                                    <li class="list-group-item">Noolaedoor Vaallu</li>
                                                                                    <li class="list-group-item">Kuppiloor Vaallu</li>
                                                                                    <li class="list-group-item">Kathaloor Vaallu</li>
                                                                                    <li class="list-group-item">Sekiloor Vaallu</li>
                                                                                    <li class="list-group-item">Kallakodoor Vaallu</li>
                                                                                    <li class="list-group-item">Mahadevioor Vaallu</li>
                                                                                    <li class="list-group-item">Thipoor Vaallu</li>
                                                                                    <li class="list-group-item">Nalapochaloor Vaallu</li>
                                                                                    <li class="list-group-item">Mindukandoor Vaallu</li>
                                                                                    <li class="list-group-item">Poovojoor Vaallu</li>
                                                                                    <li class="list-group-item">Ekdojoor Vaallu</li>
                                                                                    <li class="list-group-item">Kattaroor Vaallu</li>
                                                                                    <li class="list-group-item">Edakodoor Vaallu</li>
                                                                                    <li class="list-group-item">Muthojoor Vaallu</li>
                                                                                    <li class="list-group-item">Kunnathoor Vaallu</li>
                                                                                    <li class="list-group-item">NandhikondaPothaloor Vaallu</li>
                                                                                    <li class="list-group-item">Thevoor Vaallu</li>
                                                                                    <li class="list-group-item">Sindhaloor Vaallu</li>
                                                                                    <li class="list-group-item">Aanoor Vaallu</li>
                                                                                    <li class="list-group-item">Paaloor Vaallu</li>
                                                                                    <li class="list-group-item">Nalakooru Vaallu</li>
                                                                                    <li class="list-group-item">Nallojoor Vaallu</li>
                                                                                    <li class="list-group-item">Munapanathi Vaallu</li>
                                                                                    <li class="list-group-item">PalliKondam Vaallu</li>
                                                                                    <li class="list-group-item">Aadaga Vaallu</li>
                                                                                    <li class="list-group-item">Kellikonda Vaallu</li>
                                                                                    <li class="list-group-item">Mothimbu Vaallu</li>
                                                                                    <li class="list-group-item">Maalaila mudippu Vaallu</li>
                                                                                    <li class="list-group-item">Thulabala Vaallu</li>
                                                                                    <li class="list-group-item">Thela gundavoor Vaallu</li>
                                                                                    <li class="list-group-item">Kannadiya Vaallu</li>
                                                                          </ul>
                                                                          </div>

                                                                          <div class="col-md-6">
                                                                            <h3 class="text-center text-uppercase submenu_heading">Telugu Viswakarma Group II </h3>
                                                                                  <ul class="list-group">
                                                                                    <li class="list-group-item">Vatloor Vaallu</li>
                                                                                    <li class="list-group-item">Penukontoor Vaallu</li>
                                                                                    <li class="list-group-item">Yernojoor Vaallu</li>
                                                                                    <li class="list-group-item">Somojoor Vaallu (Somanoor Vaallu)</li>
                                                                                    <li class="list-group-item">Nanabarojoor Vaallu</li>
                                                                                    <li class="list-group-item">Kandhukoor Vaallu</li>
                                                                                    <li class="list-group-item">Senkoor Vaallu</li>
                                                                                    <li class="list-group-item">Koorakoor Vaallu</li>
                                                                                    <li class="list-group-item">Kolakondoor Vaallu (Kolukondoor Vaallu)</li>
                                                                                    <li class="list-group-item">Yeppadamoor Vaallu</li>
                                                                                    <li class="list-group-item">Gundojoor Vaallu</li>
                                                                                    <li class="list-group-item">Manjaaloor Vaallu</li>
                                                                                    <li class="list-group-item">Pothamanettiyoor Vaallu</li>
                                                                                    <li class="list-group-item">Vaadaamoor Vaallu (Vaatamvaallu)</li>
                                                                                    <li class="list-group-item">Vengojoor Vaallu</li>
                                                                                    <li class="list-group-item">Varapaloor Vaallu</li>
                                                                                    <li class="list-group-item">Thikkojoor Vaallu</li>
                                                                                    <li class="list-group-item">Mathikandoor Vaallu</li>
                                                                                    <li class="list-group-item">Rajamoor Vaallu</li>
                                                                                    <li class="list-group-item">Bandhukoloor Vaallu</li>
                                                                                    <li class="list-group-item">Sindhojoor Vaallu</li>
                                                                                    <li class="list-group-item">Nalaboor Vaallu</li>
                                                                                    <li class="list-group-item">Kengaroor Vaallu</li>
                                                                                    <li class="list-group-item">Guntoor Vaallu</li>
                                                                                    <li class="list-group-item">Nellur Vaallu</li>
                                                                                    <li class="list-group-item">Nunamanoor Vaallu</li>
                                                                                    <li class="list-group-item">Kaanakoor Vaallu</li>
                                                                                    <li class="list-group-item">Kaanaga Vaallu</li>
                                                                                    <li class="list-group-item">Kothimundulu Vaallu</li>
                                                                                    <li class="list-group-item">Nagariyoor Vaallu</li>
                                                                                    <li class="list-group-item">Lekkojoor Vaallu</li>
                                                                                    <li class="list-group-item">Pathini Vaallu</li>
                                                                                    <li class="list-group-item">Payittapoovulu Vaallu</li>
                                                                                    <li class="list-group-item">Mothiyaa Vaallu</li>
                                                                                  </ul>
                                                                        </div>
                                                                  </div>
                                                            </div><!--END Container-->
                                                        </div><!--END tab-pane-->
                                                        <!--******************************************************************************
                                                        ****************************SANGAMS TAB *******************************************
                                                        ********************************************************************************-->
                                                        <div class="tab-pane fade" id="sangams" role="tabpanel" aria-labelledby="sangams-tab">
                                                          <div class="container">
                                                                      <div class="title">
                                                                            <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.community_sangams_btn')&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                    @if(\Auth::user()->UserroleID == 2)
                                                                                      <a class="btn fa-3x" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" href="{{ route('sangams.create') }}"><b style="font-size:20px;font-family: 'Sen', sans-serif;">@lang('home.community_sangams_create_btn')</b></a>  
                                                                                    @endif  
                                                                            </h1>   
                                                                      </div>
                                                                      <div class="row">
                                                                        @if(isset($sangams))     
                                                                              @foreach ($sangams as $sangam)

                                                                                  <div class="col-md-4">
                                                                                              <div class="card card-profile">
                                                                                                  <div class="card-header card-header-image">
                                                                                                        @if($sangam->Sangam_Photo != '' ||$sangam->Sangam_Photo != null )
                                                                                                            <a href="{{ route('sangams.show',$sangam->SangamID) }}">
                                                                                                              <img class="img" src="{{ $sangam->Sangam_Photo }}">
                                                                                                            </a>
                                                                                                        @else
                                                                                                           <img src="/images/No-image2.png" alt="photo">
                                                                                                        @endif
                                                                                                     
                                                                                                  <div class="colored-shadow" style="background-image: url('{{ $sangam->Sangam_Photo }}');opacity: 1;"></div>
                                                                                              </div>
                                                                                          
                                                                                              <div class="card-body mytable">
                                                                                                  <h4 class="card-title" style="font-size:20px;">{{ $sangam->Sangam_Name }} &nbsp;&nbsp;&nbsp;  {{-- <span> {{ $sangam->Sangam_StartedOn->format('d-m-Y') }}</span> --}}</h4>
                                                                                                  <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                                                                          {{ $sangam->Sangam_Description }} <span> 
                                                                                                  </p>
                                                                                                  <a href="{{ route('sangams.show',$sangam->SangamID) }}" class="btn  waves-effect" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">@lang('home.temple_functions_readmore_btn')</a> 
                                                                                              </div>
                                                                                          </div>
                                                                                      </div>
                                                                              @endforeach
                                                                        @else
                                                                          </br>
                                                                          </br>
                                                                          <p style="font-family: 'Sen', sans-serif;">Our community sangams are yet to publish details. Kindly wait for their updates.  Keep checking the space for community updates.. </p>
                                                                        @endif

                                                                  </div><!-- Row END -->
                                                             </div><!-- Container END -->
                                                       </div><!--END-->
                                                       <!--******************************************************************************
                                                        ****************************TEMPLES TAB *******************************************
                                                        ********************************************************************************-->
                                                        <!-- Start tab-pane fade -->
                                                          <div class="tab-pane fade" id="temples" role="tabpanel" aria-labelledby="temples-tab">
                                                          <!-- Container -->
                                                              <div class="container">
                                                                      <div class="title">
                                                                          <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.community_temples_btn')&nbsp;&nbsp;&nbsp;&nbsp;
                                                                              @if(\Auth::user()->UserroleID == 2)
                                                                                <a class="btn  fa-3x" style="background:#f82249;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" href="{{ route('temples.create') }}"><b style="font-size:20px;font-family: 'Sen', sans-serif;">@lang('home.community_temples_create_btn')</b></a>  
                                                                              @endif 
                                                                          </h1>   
                                                                      </div>
                                                                      <div class="row">
                                                                        @if (isset($temples))     
                                                                              @foreach ($temples as $temple)
                                                                                  <div class="col-md-4">
                                                                                              <div class="card card-profile">
                                                                                                  <div class="card-header card-header-image">
                                                                                                      <a href="{{ route('temples.show',$temple->TempleID) }}">
                                                                                                          <img class="img" src="{{ $temple->Temple_Photo }}" >
                                                                                                      </a>
                                                                                                  <div class="colored-shadow" style="background-image: url('{{ $temple->Temple_Photo }}');opacity: 1;">
                                                                                                  </div>
                                                                                              </div>
                                                                                          
                                                                                              <div class="card-body mytable">
                                                                                                    <h4 class="card-title">{{ $temple->Temple_Name }} </h4>
                                                                                                    <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                                                                            {{ $temple->Temple_OwnedBy_Subsect  }} 
                                                                                                    </p>
                                                                                                    <a href="{{ route('temples.show',$temple->TempleID) }}" class="btn  waves-effect" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">@lang('home.temple_functions_readmore_btn')</a> 
                                                                                               </div>
                                                                                          </div>
                                                                                      </div>

                                                                                  @endforeach
                                                                            @else
                                                                                  </br>
                                                                                  </br>
                                                                                  <p  style="font-family: 'Sen', sans-serif;"> You would be seeing all the Kuladeivam temple details soon. Exciting to show to your family right? Please wait... Coming soon  </p>
                                                                            @endif

                                                                      </div><!-- Row END -->
                                                               </div><!-- Container END -->
                                                          </div><!--tab-pane fade END-->
                                                           <!--******************************************************************************
                                                            ****************************SELLERS TAB *******************************************
                                                            ********************************************************************************-->
                                                          <!-- Start tab-pane fade -->
                                                            <div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                                                            <!-- Container -->
                                                              <div class="container">
                                                                      <div class="title">
                                                                          <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.products_sellers_heading')&nbsp;&nbsp;&nbsp;&nbsp;
                                                                           </h1>   
                                                                              <!-- Create Seller button is opened up for Tecple only-->
                                                                              <!--@if(\Auth::user()->username=="tecple")    
                                                                              <a class="btn btn-info float-right" href="{{ route('sellers.create') }}"><b style="font-size:15px;">@lang('home.community_sellers_create_btn')</b></a>  
                                                                              @endif-->
                                                                                   
                                                                             
                                                                      </div>
                                                                      <div class="row">
                                                                        @if (isset($sellers))     
                                                                              @foreach ($sellers as $seller)
                                                                                  <div class="col-md-4">
                                                                                              <div class="card card-profile">
                                                                                                          
                                                                                                  <div class="card-body mytable">
                                                                                                        <h4 class="card-title">{{ $seller->CompanyName }} </h4>
                                                                                                        <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                                                                             run by {{$seller->Name }}  at {{ $seller->Location }} 
                                                                                                        </p>
                                                                                                        <a href="{{ route('sellers.show',$seller->SellerID) }}" class="btn  waves-effect" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">@lang('home.temple_functions_readmore_btn')</a> 
                                                                                                  </div>
                                                                                          </div>
                                                                                   </div>
                                                                              @endforeach
                                                                        @else
                                                                            </br>
                                                                            </br>
                                                                            <p  style="font-family: 'Sen', sans-serif;"> You would be seeing all the Seller details soon. Exciting to show to your family right? Please wait... Coming soon  </p>
                                                                        @endif
                                                                          
                                                                          
                                                                      </div><!-- Row END -->
                                                                   
                                                                          @if(\Auth::user()->IsSeller == 0)   
                                                                      
                                                                          
                                                                                <p style="font-family: 'Sen', sans-serif;font-size:20px;"> @lang('home.register as seller')  <a href="{{route('sellers.create')}}" > @lang('home.click_here') </a>  </p>
                                                                          
                                                                  
                                                                          @else
                                                                          
                                                                            <p> Please upload your products clicking <a href="{{route('products.index')}}" >here </a>  </p>
                                                                          @endif
                                                              </div><!-- Container END -->
                                                              
                                                            </div><!--tab-pane fade END-->
                                                          <!--******************************************************************************
                                                          ****************************INSTITUTIONS TAB *******************************************
                                                          ********************************************************************************-->
                                                           <!-- Start tab-pane fade -->
                                                            <div class="tab-pane fade" id="institutions" role="tabpanel" aria-labelledby="institutions-tab">
                                                                <!--START HARE -->
                                                                 <div class="container">
                                                                        <div class="title">
                                                                              <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.community_institutions_btn') </h1>   
                                                                        </div>
                                                                        <div class="row" style="margin-top:-14px;">
                                                                          <div class="col-md-4">
                                                                              <div class="card card-profile">
                                                                                        <div class="card-header card-header-image">
                                                                                            <a href="#">
                                                                                                <img class="img" src="{{ asset('../images/frontend_images/inst.png') }}">
                                                                                            </a>
                                                                                            <div class="colored-shadow" style="background-image: url('../images/frontend_images/inst.png');opacity: 1;">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-body ">
                                                                                              <h4 class="card-title" style="font-family: 'Sen', sans-serif;">GTRAC Mysuru</h4>
                                                                                              <p class="card-description" style="font-family: 'Sen', sans-serif;font-size:16px;color:#000;">
                                                                                                @lang('home.institutions_desc1') <br/>
                                                                                                {{--  <a href="#!" class="btn btn-outline-primary waves-effect">Read more</a>  --}}
                                                                                                </p>
                                                                                        </div>
                                                                              </div>
                                                                           </div><!--End col-md-4-->

                                                                          <div class="col-md-4">
                                                                              <div class="card card-profile">
                                                                                  <div class="card-header card-header-image">
                                                                                      <a href="#pablo">
                                                                                          <img class="img" src="{{ asset('../images/frontend_images/inst1.png') }}">
                                                                                      </a>
                                                                                      <div class="colored-shadow" style="background-image: url('../images/frontend_images/inst1.png');opacity: 1;"></div>
                                                                                  </div>
                                                                                  <div class="card-body ">
                                                                                      <h4 class="card-title" style="font-family: 'Sen', sans-serif;">NIEI, Mysore</h4>
                                                                                      <p class="card-description" style="font-family: 'Sen', sans-serif;font-size:16px;color:#000;">
                                                                                      @lang('home.institutions_desc1')
                                                                                      </p>
                                                                                </div>
                                                                                </div>
                                                                          </div><!-- End col-md-4 -->
                                                                          <div class="col-md-4">
                                                                              <div class="card card-profile">
                                                                                      <div class="card-header card-header-image">
                                                                                          <a href="#pablo">
                                                                                              <img class="img" src="{{ asset('../images/frontend_images/inst1.png') }}">
                                                                                          </a>
                                                                                          <div class="colored-shadow" style="background-image: url('../images/frontend_images/inst1.png');opacity: 1;">
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="card-body ">
                                                                                          <h4 class="card-title" style="font-family: 'Sen', sans-serif;">NIEI, Bangalore</h4>
                                                                                          <p class="card-description" style="font-family: 'Sen', sans-serif;font-size:16px;color:#000;">
                                                                                          @lang('home.institutions_desc1')
                                                                                          </p>
                                                                                      </div>
                                                                                </div>
                                                                              </div><!-- End col-md-4 -->
                                                                    </div>
                                                                </div>
                                                                <!-- END HERE -->
                                                          </div><!--tab-pane fade END-->
                                                          <!--******************************************************************************
                                                        ****************************COMPANIES TAB *******************************************
                                                        ********************************************************************************-->
                                                        <!-- Start tab-pane fade -->
                                                        <div class="tab-pane fade" id="companies" role="tabpanel" aria-labelledby="v-tab">
                                                            <!--START HARE -->
                                                            <div class="container">
                                                                    <div class="title">
                                                                          <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.community_companies_btn')</h1>   
                                                                    </div>
                                                                     <div class="row" style="margin-top:-14px;">
                                                                        <div class="col-md-4">
                                                                            <div class="card card-profile">
                                                                                      <div class="card-header card-header-image">
                                                                                          <a href="#pablo">
                                                                                              <img class="img" src="{{ asset('../images/frontend_images/Tecple-logo.png') }}" alt="Company">
                                                                                          </a>
                                                                                          <div class="colored-shadow" style="background-image: url('../images/frontend_images/Tecple-logo.png');opacity: 1;">
                                                                                          </div>
                                                                                      </div>
                                                                                       <div class="card-body ">
                                                                                            <h4 class="card-title" style="font-family: 'Sen', sans-serif;">Tecple Innoventive Solutions Pvt Ltd</h4>
                                                                                            <p class="card-description" style="font-family: 'Sen', sans-serif;font-size:16px;color:#000;">
                                                                                           "Tecple Innoventive Solutions” - is an innovation and research led Consulting and Services  Organization providing IT and IT enabled Solutions. Situated in Mysore, Karnataka <br/>
                                                                                            </p>
                                                                                       </div>
                                                                            </div>
                                                                       </div>
                                                                  <!--     <div class="col-md-4">
                                                                            <div class="card card-profile">
                                                                                <div class="card-header card-header-image">
                                                                                      <a href="#">
                                                                                          <img class="img" src="{{ asset('../images/frontend_images/comp1.png') }}">
                                                                                      </a>
                                                                                      <div class="colored-shadow" style="background-image: url('../images/frontend_images/comp1.png');opacity: 1;">
                                                                                      </div>
                                                                                </div>
                                                                                <div class="card-body ">
                                                                                        <h4 class="card-title" style="font-family: 'Sen', sans-serif;">Bangalore Hosiery</h4>
                                                                                        <p class="card-description" style="font-family: 'Sen', sans-serif;font-size:16px;color:#000;">
                                                                                        Developing a business plan that suits your purposes means tailoring it to your audience. Sometimes that can mean eliminating a section that isn't applicable to your current project.
                                                                                        </p>
                                                                                </div>
                                                                          </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                          <div class="card card-profile">
                                                                                <div class="card-header card-header-image">
                                                                                        <a href="#pablo">
                                                                                            <img class="img" src="{{ asset('../images/frontend_images/comp3.png') }}" alt="company">
                                                                                        </a>
                                                                                        <div class="colored-shadow" style="background-image: url('../images/frontend_images/comp3.png');opacity: 1;">
                                                                                        </div>
                                                                                </div>
                                                                                <div class="card-body ">
                                                                                        <h4 class="card-title" style="font-family: 'Sen', sans-serif;">Fusion Informatics</h4>
                                                                                        <p class="card-description" style="font-family: 'Sen', sans-serif;font-size:16px;color:#000;">
                                                                                        Developing a business plan that suits your purposes means tailoring it to your audience. Sometimes that can mean eliminating a section that isn't applicable to your current project.
                                                                                        </p>
                                                                                </div>
                                                                            </div>
                                                                      </div>-->
                                                                </div>
                                                            </div>
                                                              <!-- END HERE -->
                                                        </div><!--tab-pane fade END-->
                                                        <!--******************************************************************************
                                                        ****************************FAMOUS PEOPLE TAB *******************************************
                                                        ********************************************************************************-->
                                                        <!-- Start tab-pane fade -->
                                                        <div class="tab-pane fade" id="famouspeople" role="tabpanel" aria-labelledby="famouspeople-tab">
                                                              <!--START HARE -->
                                                                  <div class="container">
                                                                            <div class="title">
                                                                                  <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.community_famous_btn')</h1>   
                                                                            </div>
                                                  <hr>                
                                                                          <div class="row" style="margin-top:-50px;">
                                                                            <!--Grid column-->
                                                                            <div class="col-lg-4 col-md-12 mb-lg-0 mb-4">
                                                                                  <!--Card-->
                                                                                  <div class="card testimonial-card">
                                                                                    <!--Background color-->
                                                                                    <div class="card-up info-color"></div>
                                                                                    <!--Avatar-->
                                                                                          <div class="avatar mx-auto white"><br/>
                                                                                            <img src="{{ asset('../images/frontend_images/Thyagaraja_Bhagavathar-2.jpg') }}" class="rounded-circle img-fluid" style="width:250px;height:250px;">
                                                                                          </div>
                                                                                          <div class="card-body">
                                                                                              <!--Name-->
                                                                                              <h4 class="font-weight-bold mb-4 text-center" style="font-family: 'Sen', sans-serif;">@lang('home.Thiagaraja')</h4>
                                                                                              <hr>
                                                                                              <!--Quotation-->
                                                                                              <p class=" mt-4" style="font-family: 'Sen', sans-serif;font-size:16px;height:470px;"><i class="fa fa-quote-left pr-2"></i>@lang('home.thiagaraja_desc')</p>
                                                                                          </div>
                                                                                  </div>
                                                                                  <!--Card-->
                                                                            </div>
                                                                            <!--Grid column-->
                                                                  
                                                                            <!--Grid column-->
                                                                            <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                                                                              <!--Card-->
                                                                              <div class="card testimonial-card">
                                                                                <!--Background color-->
                                                                                <div class="card-up blue-gradient">
                                                                                </div>
                                                                                <!--Avatar-->
                                                                                <div class="avatar mx-auto white"><br/>
                                                                                  <img src="{{ asset('../images/frontend_images/thangavelu-4.jpg') }}" class="rounded-circle img-fluid" style="width:250px;height:250px;">
                                                                                </div>
                                                                                <div class="card-body">
                                                                                  <!--Name-->
                                                                                  <h4 class="font-weight-bold mb-4 text-center" style="font-family: 'Sen', sans-serif;">@lang('home.Thangavelu') <br/> <br/></h4>
                                                                                  <hr>
                                                                                  <!--Quotation-->
                                                                                  <p class="mt-4" style="font-family: 'Sen', sans-serif;font-size:16px;height:470px;"><i class="fa fa-quote-left pr-2"></i>@lang('home.thangavelu_desc')</p>
                                                                                </div>
                                                                              </div>
                                                                              <!--Card-->
                                                                            </div>
                                                                            <!--Grid column-->
                                                                  
                                                                            <!--Grid column-->
                                                                            <div class="col-lg-4 col-md-6">
                                                                              <!--Card-->
                                                                              <div class="card testimonial-card">
                                                                                <!--Background color-->
                                                                                <div class="card-up indigo"></div>
                                                                                <!--Avatar-->
                                                                                <div class="avatar mx-auto white"><br/>
                                                                                  <img src="{{ asset('../images/frontend_images/mnrajam.jpg') }} " class="rounded-circle img-fluid"  style="width:250px;height:250px;">
                                                                                </div>
                                                                                <div class="card-body">
                                                                                  <!--Name-->
                                                                                  <h4 class="font-weight-bold mb-4 text-center" style="font-family: 'Sen', sans-serif;">@lang('home.Rajam') <br/> <br/></h4>
                                                                                  <hr>
                                                                                  <!--Quotation-->
                                                                                  <p class="mt-4" style="font-family: 'Sen', sans-serif;font-size:16px;height:470px;"><i class="fa fa-quote-left pr-2"></i>@lang('home.rajam_desc') </p>
                                                                                </div>
                                                                              </div>
                                                                              <!--Card-->
                                                                            </div>
                                                                            <!--Grid column-->
                                                                      </div>
                                                                      
                                                                                             <div class="row" style="margin-top:-50px;">
                                                                            <!--Grid column-->
                                                                            <div class="col-lg-4 col-md-12 mb-lg-0 mb-4">
                                                                                  <!--Card-->
                                                                                  <div class="card testimonial-card">
                                                                                    <!--Background color-->
                                                                                    <div class="card-up info-color"></div>
                                                                                    <!--Avatar-->
                                                                                          <div class="avatar mx-auto white"><br/>
                                                                                            <img src="{{ asset('../images/frontend_images/ramasamy-1.jpg') }}" class="rounded-circle img-fluid" style="width:250px;height:250px;">
                                                                                          </div>
                                                                                          <div class="card-body">
                                                                                              <!--Name-->
                                                                                              <h4 class="font-weight-bold mb-4 text-center" style="font-family: 'Sen', sans-serif;">@lang('home.Ramasamy')</h4>
                                                                                              <hr>
                                                                                              <!--Quotation-->
                                                                                              <p class=" mt-4" style="font-family: 'Sen', sans-serif;font-size:16px;height:470px;"><i class="fa fa-quote-left pr-2"></i>@lang('home.ramasamy_desc')</p>
                                                                                          </div>
                                                                                  </div>
                                                                                  <!--Card-->
                                                                            </div>
                                                                            <!--Grid column-->
                                                                  
                                                                  
                                                                      </div>
                                                                      </div>
                                                                      <!-- END HERE -->
                                                                </div><!--tab-pane fade END-->
                                                  </div>
                                                  </div>
                                                                  <!-- /.col-md-8 -->   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


</body>


@include('sweetalert::alert')   

@endsection
