@extends('layouts.app1')
@section('content')

<!DOCTYPE html>

<html>

<head>

    <title>Temple Functions </title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

<!-- ToolTip Script   -->
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
    </script>
<!-- END ToolTip Script   -->

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
                                                <?php if (isset($temples) ) {  ?>
                                                <aside class="wedget__categories poroduct--cat">
                                                        <h3 class="wedget__title tempfun_wise"><b>@lang('home.templefunc_index_lhstemplewise')</b></h3>

                                                        <form id="prodindex" >
                                                            <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                                                                            or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
                                                                            {!! csrf_field() !!}
                                                                        <ul class="properties-filter">
                                                                                    @foreach ($temples as $temple)
                                                                                    <li  class="selected" name="{{$temple->TempleID}}" id="templeid" >
                                                                                        <a href="?templeid={{$temple->TempleID}}" data-filter="{{$temple->TempleID}}" class="click"> {{ Illuminate\Support\Str::limit(ucwords($temple->Temple_Name), 20, $end='...') }}   </a>
                                                                                    </li> 
                                                                                    @endforeach
                                                                        </ul>
                                                        </form>
                                                </aside>
                                                <?php } ?>
                                            
                                        </div>
                                </div>

                    <!--- ********** second row in 1st column Area***********************************
                    ********************************************************-->
                     
                       <div class="row">
                           <aside class="wedget__categories poroduct--cat">
                               <h3 class="wedget__title tempfun_faq"><b>@lang('home.templefunc_index_lhscumonth') </b></h3>
                                     <ul>
                                         <li><a href="{{ url('/templefunctions/') }}">@lang('home.templefunc_index_lhscumonth') </li>
                                     </ul>
                               </h3>
                           </aside>
                       </div>
                       <div class="row">
                               <!-- Start Single Widget -->
                               <aside class="wedget__categories poroduct--cat">
                                   <h3 class="wedget__title tempfun_arc"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
                                   <ul>
                                       <li><a href="{{ url('/templefunctions/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                       <li><a href="{{ url('/templefunctions/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                       <li><a href="{{ url('/templefunctions/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                       <li><a href="{{ url('/templefunctions/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                       <li><a href="{{ url('/templefunctions/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                       <li><a href="{{ url('/templefunctions/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                     
                                   </ul>
                               </aside>
                               <!-- End Single Widget -->
                              
                       </div>

     </div> <!-- end  1 col row -->
        <!--- ********** 2nd column Area***********************************
        ********************************************************-->

       <div class="col-lg-9 col-12 order-1 order-lg-2">
         <div class="tab__container">
             
         
           <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">

            <!-- Row  -->
            <div class="row">
                <div class="title">
                
                @if(isset($temple1)  )
                         <h1 class="font-bold text-center  temp_heading" >@lang('home.head_temple_functions') of {{$temple1->Temple_Name}}
                      
                @else
                     <h1 class="font-bold text-center text-uppercase temp_heading" >@lang('home.head_temple_functions') of {{$currentMonthName}}, {{$currentYear}}
                @endif
                @if(isset($templeUP))
                       </br></br>   <a class="btn fa-3x" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px; margin-left:550px;" href="{{ route('templefunctions.create') }}"><b style="font-size:12px;font-family: 'Sen', sans-serif;">Create Temple Functions</b></a>
                @endif 
                </h1>   
                  
                </div>
            </div>  <!--row end -->
             
            <!-- Row  -->
            <div class="row">
                <!--- ********** Elders List Area***********************************
                   ********************************************************-->
               <?php if (isset($templefunctions)   && (count($templefunctions) >0 )  )  { ?>   
                 
                    @foreach ($templefunctions as $templefunction)
                        <div class="col-md-4">
                                <div class="card card-profile">
                                    <div class="card-header card-header-image">
                                         <a href="{{ route('templefunctions.show',$templefunction->TempleFunctionID) }}">
                                                                    
                                            
                                                      
                                            @if($templefunction->Photo != '')
                                                <img src="{{ $templefunction->Photo }}" alt="photo">
                                            @elseif($templefunction->Video != '')
                                                <video width="225" height="215" controls>
                                                    <source src="{{ $templefunction->Video }}" type="video/mp4">
                                                </video>
                                            @else
                                               <img src="/images/No-image2.png" alt="photo">
                                            @endif          
                                                                       
                                                                       
                                        </a>
                                    </div>
                                
                                    <div class="card-body mytable ">
                                        <h4 class="card-title">{{ $templefunction->Title }}  {{--&nbsp;&nbsp;&nbsp;  <span> {{ $templefunction->FunctionDate }}</span>--}}</h4> 
                                        <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                {{ $templefunction->Function_Content }}  
                                        </p> 
                                        <a href="{{ route('templefunctions.show',$templefunction->TempleFunctionID) }}" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;font-size:14px;">@lang('home.temple_functions_readmore_btn')</a> <br/><br/>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    <?php } else{ ?>
                                    <br>  <br>
                                   
                                    <p><h4 class="alert alert-info templefun_alertfailed">{{$Failed}}</h4> </p>
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
