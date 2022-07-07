@extends('layouts.app1')
@section('content')



<!DOCTYPE html>

<html>

<head>

    <title>Temple Master</title>

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
                  <h1 class="font-bold text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.temples_index_head')&nbsp;&nbsp;&nbsp;&nbsp;
                       
                        @if(\Auth::user()->IsTempleMember==1)
                        <a class="btn fa-3x" style="background:#f82249;color:#fff;border-bottom-left-radius:25px;border-top-right-radius:25px;" href="{{ route('temples.create') }}"><b style="font-size:20px;">@lang('home.temples_index_upbtn')</b></a>  
                       @endif 
                     </h1>   
                  
              </div>
              <!-- Row  -->
			   @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
              <div class="row">
               @if (isset($temples))
                        @foreach ($temples as $temple)
                            <div class="col-md-4">
                                    <div class="card card-profile">
                                        <div class="card-header card-header-image">
                                            <a href="#">
                                                <img class="img" src="{{ $temple->Temple_Photo }}">
                                            </a>
                                        <div class="colored-shadow" style="background-image: url('{{ $temple->Temple_Photo }}');opacity: 1;"></div>
                                    
                                    </div>
                                    
                                        <div class="card-body mytable">
                                            <h4 class="card-title" style="font-size:20px;">{{ $temple->Temple_Name }} </h4>
                                            <p style="font-family: 'Sen', sans-serif;font-size:16px;">
                                                    {{ $temple->Temple_OwnedBy_Subsect  }} 
                                            </p>
                                            <a href="{{ route('temples.show',$temple->TempleID) }}" class="btn waves-effect" style="font-family: 'Sen', sans-serif;font-size:20px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">@lang('home.temples_index_readmorebtn')</a> 
                                        </div>
                                         <br/>   
                                    </div>
                                </div>

                        @endforeach
                @endif
    
           </div><!-- Row END -->

           
           <div class="float-right">  {{ $temples->links() }}  </div>
            </div><!-- Container END -->
        </body>
    
 </html>
        
@endsection
