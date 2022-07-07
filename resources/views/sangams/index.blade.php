@extends('layouts.app1')

@section('content')



<!DOCTYPE html>

<html>

<head>

    <title>Sangam Master</title>

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

<!-- Container -->
<div class="container">


        <div class="title">
                <!--  <h3 class="mt-5 text-center">Sangam Meetings</h3>-->
                <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.sangams_index_head')&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(\Auth::user()->UserroleID==2 || Auth::user()->IsSangamMember==1)
                          <a class="btn fa-3x" style="background:#f82249;color:#fff;border-bottom-left-radius:25px;border-top-right-radius:25px;" href="{{ route('sangams.create') }}"><b style="font-size:20px;">@lang('home.sangams_index_upbtn')</b></a>  
                         @endif  
                 </h1>   
                  
              </div>
              @if ($message = Session::get('success'))
              <div class="alert alert-success">
             <p>{{ $message }}</p>
              </div>
            @endif
              <!-- Row  -->
              <div class="row">
                   
                @foreach ($sangams as $sangam)
                    <div class="col-md-4">
                            <div class="card card-profile">
                                <div class="card-header card-header-image">
                                    <a href="#pablo">
                                        <img class="img" src="/images/sangamphotos/{{ $sangam->Sangam_Photo }}">
                
                                      <!--  <div class="card-title">
                                            Ramesh
                                        </div>-->
                                    </a>
                                <div class="colored-shadow" style="background-image: url('/images/sangamphotos/{{ $sangam->Sangam_Photo }}');opacity: 1;"></div>
                            
                            </div>
                            
                                <div class="card-body mytable">
                                  <!--  <h6 class="card-category text-info">Madurai Viswakarma Sangam Meeting</h6>-->
                                    <h4 class="card-title" style="font-size:20px;">{{ $sangam->Sangam_Name }} &nbsp;&nbsp;&nbsp;  <span> {{ $sangam->Sangam_StartedOn->format('d-m-Y') }}</span></h4>
                                    <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                            {{ $sangam->Sangam_Description }} <span> 
                                       
                                      </p>
                                      <a href="{{ route('sangams.show',$sangam->SangamID) }}" class="btn  waves-effect" style="font-family: 'Sen', sans-serif;font-size:20px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">@lang('home.sangams_index_readmorebtn')</a> 
                                        
                
                                </div>
                               <!-- <div class="card-footer justify-content-left">--
                                      <br/>  <div class="card-footer justify-content-center" style="font-size:20px;"><i class="fa fa-share" aria-hidden="true" title="Shares"></i>&nbsp;&nbsp;&nbsp;
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -- 
                                    <div class="addthis_inline_share_toolbox"></div> 
                                     <!-- Shares FB,Twitter,WhatsApp END--
                                </div> -->

                            </div>
                        </div>

   @endforeach

           </div><!-- Row END -->
           <div class="float-right">  {{ $sangams->links() }}  </div>
            </div><!-- Container END -->


        </body>


       
        </html>
        





@endsection
