@extends('layouts.app1')
@section('content')


<!DOCTYPE html>

<html>

<head>

    <title>Personal Functions </title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


    <style type="text/css">

 /* Limiting column data */
   .mytable p{
    max-width:900px; /* Customise it accordingly */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    }
    .mytable h4{
    max-width:280px; /* Customise it accordingly */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    }

    /* END Limiting column data */
    
    </style>

</head>

<body>

    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" style="margin-top:-100px;">
            <!-- Container -->
                <div class="container">
                    <!--- ********** Outer row Area***********************************
                        ********************************************************-->
            
                        <div class="row">  <!-- outer row -->
            
                            <!--- ********** 1st column Area***********************************
                            ********************************************************-->
                            
                            <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
            
                                <div class="row"> <!-- begin  1 col row -->
                                        <div class="shop__sidebar">
                                                <aside class="wedget__categories poroduct--cat">
                                                        <h3 class="wedget__title personal_catwise"><b>@lang('home.announcements_index_leftside_catewise')</b></h3>
            
                                                        <form id="prodindex"  >
                                                                <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                                                                or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
                                                                                {!! csrf_field() !!}
                                                                <ul class="properties-filter">
                                                                    <li  class="selected" name="General" id="General"><a href="{{ url('/personalfunctions/?cat=General') }}" class="click">@lang('home.announcements_index_leftside_general')</a>
                                                                    </li> 
                                                                    <li  class="selected" name="Birthday" id="Birthday"><a href="{{ url('/personalfunctions/?cat=Birthday') }}" class="click">@lang('home.personalfunctions_index_leftsise_bircere')</a>
                                                                    </li> 
                                                                    <li  class="selected" name="Marriage" id="Marriage"><a href="{{ url('/personalfunctions/?cat=Marriage') }}" class="click">@lang('home.personalfunctions_index_leftsise_marcere')</a>
                                                                    </li> 
                                                                    <li  class="selected" name="60marriage" id="60marriage"><a href="{{ url('/personalfunctions/?cat=60marriage') }}" class="click">@lang('home.personalfunctions_index_leftsise_60mar')</a>
                                                                    </li> 
                                                                    <li  class="selected" name="70marriage" id="70marriage"><a href="{{ url('/personalfunctions/?cat=70marriage') }}" class="click">@lang('home.personalfunctions_index_leftsise_70mar')</a>
                                                                    </li>  
                                                                    <li  class="selected" name="80marriage" id="80marriage"><a href="{{ url('/personalfunctions/?cat=80marriage') }}" class="click">@lang('home.personalfunctions_index_leftsise_80mar')</a>
                                                                    </li>  
                                                                    <li  class="selected" name="Naming" id="Naming"><a href="{{ url('/personalfunctions/?cat=Naming') }}" class="click">@lang('home.personalfunctions_index_leftsise_namcere')</a>
                                                                    </li>
                                                                    <li  class="selected" name="Maturity" id="Maturity"><a href="{{ url('/personalfunctions/?cat=Maturity') }}" class="click">@lang('home.personalfunctions_index_leftsise_matcere') </a>
                                                                    </li>  
                                                                    <li  class="selected" name="HouseWarming " id="HouseWarming "><a href="{{ url('/personalfunctions/?cat=HouseWarming') }}" class="click">@lang('home.personalfunctions_index_leftsise_housecere')</a>
                                                                    </li>  
                                                                    <li  class="selected" name="BabyShower" id="BabyShower"><a href="{{ url('/personalfunctions/?cat=BabyShower') }}" class="click">@lang('home.personalfunctions_index_leftsise_baby')</a>
                                                                    </li>  
                                                                </ul>
                                                    </form>
                                            </aside>
                                        </div>
                                </div>
            
                    <!--- ********** second row in 1st column Area***********************************
                    ********************************************************-->
                                
                                <div class="row">
                                    <aside class="wedget__categories poroduct--cat">
                                        <h3 class="wedget__title personal_current"><b>@lang('home.announcements_index_leftside_current') </b></h3>
                                                <ul>
                                                    <li><a href="{{ url('/personalfunctions/') }}">Current Month </li>
                                                </ul>
                                        </h3>
                                    </aside>
                                </div>
                                    <!-- Start search_widget Widget -->
                                <!-- <div class="row">
                                        <aside class="widget search_widget">
                                                <h3 class="wedget-title"><b>Search </b></h3>
                                                <form action="#">
                                                    <div class="form-input">
                                                        <input type="text" placeholder="Search...">
                                                        <button><i class="fa fa-search"></i></button>
                                                    </div>
                                                </form>
                                            </aside> 
                                        </div> -->
                            <!-- End search_widget Widget -->
                                <div class="row">
                                        <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
            
                                        <!-- Start Single Widget -->
                                        <aside class="wedget__categories poroduct--cat">
                                            <h3 class="wedget__title personal_arc"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
                                            <ul>
                                                
                                                <li><a href="{{ url('/personalfunctions/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/personalfunctions/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/personalfunctions/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/personalfunctions/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/personalfunctions/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/personalfunctions/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                                
                                            </ul>
                                        </aside>
                                        <!-- End Single Widget -->
                                        <?php ?>
                                </div>
            
                </div> <!-- end  1 col row -->
            <!--- ********** 2nd column Area***********************************
            ********************************************************-->
            
                <div class="col-lg-9 col-12  order-1 order-lg-2">
                    <div class="tab__container">
                    <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
            
                        <!-- Row  -->
                        <div class="row">
                                <div class="title">
                                    @if($cat)
                                       <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;"> {{$cat}} @lang('home.head_personal_functions') &nbsp;&nbsp;&nbsp;&nbsp;
                                    @else
                                       <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.head_personal_functions') of {{$currentMonthName}}, {{$currentYear}}&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                        <a class="btn  fa-3x" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;margin-left:550px;" href="{{ route('personalfunctions.create') }}"><b style="font-size:12px;font-family: 'Sen', sans-serif;">@lang('home.personalfunctions_index_upbtn')</b></a>  
                                    </h1>  
                                
                                </div>
              
                                <!--- ********** Elders List Area***********************************
                                ********************************************************-->
                                <?php if (isset($personalfunctions)   && (count($personalfunctions) >0 )  )  { ?>   
                                    
                                    @foreach ($personalfunctions as $personalfunction)
                                            <div class="col-md-4">
                                                    <div class="card card-profile">
                                                            <div class="card-header card-header-image">
                                                                
                                                                        <a href="{{ route('personalfunctions.show',$personalfunction->PersonalFunctionID) }}">
                                                                            @if(($personalfunction->Photo != '') || ($personalfunction->Photo != null))
                                                                                <img src="{{$personalfunction->Photo}}" alt="photo">
                                                                            @elseif($personalfunction->Video != '')
                                                                                 <video width="225" height="215" controls>
                                                                                    <source src="{{ $personalfunction->Video }}" type="video/mp4">
                                                                                </video>
                                                                            @else
                                                                               <img src="/images/No-image2.png" alt="photo">
                                                                            @endif
                                                                            
                                                                        </a>
                                                            </div>
                                                        
                                                            <div class="card-body mytable">
                                                                <h4 class="card-title">{{ $personalfunction->Title }} <!--<span> {{ $personalfunction->FunctionDate}}</span>--> </h4>
                                                                <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                            
                                                            {{ $personalfunction->Function_Content }} 
                                                                </p>
                                                                <a href="{{ route('personalfunctions.show',$personalfunction->PersonalFunctionID) }}" class="btn waves-effect" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;font-size:14px;">@lang('home.temple_functions_readmore_btn')</a> 
                                                            </div>

                                                        
                                                            <br/>      
                                                        
                                                        </div><!-- card profile -->
                                            </div>
                                            @endforeach
                                        <?php } else{ ?>
                                                        <br>  <br>
                                                        <p><h4 class="alert alert-info" style="font-family: 'Sen', sans-serif;"> {{$Failed}}</h4>  <p>
                                        <?php }   ?>
            
                            </div><!-- Row END -->
            
                                            
                            </div>  <!-- end of inner row-->
                        </div>
                    </div>
                 </div>  <!-- end second column-->
            
                            
            
                    <!--- ********** End Outer row ***********************************
                    ********************************************************-->
                    </div><!-- END Outer  ROW -->
                </div><!-- Container END -->
            </div>    <!-- End Shop Page -->
    </body>
</html>
        
  @include('sweetalert::alert')

@endsection
