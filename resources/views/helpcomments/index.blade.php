{{-- Aruna remove this file
    

@extends('layouts.app1')

@section('content')



<!DOCTYPE html>

<html>

<head>

    <title>Help Post Index</title>

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
                  <h1 class="font-bold text-center text-uppercase"> Help Desk &nbsp;&nbsp;&nbsp;&nbsp;
                     {{--    <a class="btn btn-info fa-3x" href="#"><b style="font-size:20px;">See your requests</b></a>  
                     --
                    <a class="btn btn-info fa-3x" href="{{ route('helpcomments.create') }}"><b style="font-size:20px;">Make a Help Request</b></a>  
                    
                     </h1>   
                  
              </div>
              <!-- Row  -->
              <div class="row">
                    @if ($message = Session::get('success'))

                    <div class="alert alert-success">
            
                        <p>{{ $message }}</p>
            
                    </div>
            
              @endif
                   @foreach($helpcomments as $helpcomment)
                <div class="display-comment">
                   {{--  <strong>{{ $helpcomment->user->name }}</strong> --
                    <p>{{ $helpcomment->Description }}</p>
                </div>

       @endforeach 

           </div><!-- Row END -->
            </div><!-- Container END -->


           

        </body>
 </html>
        

@endsection
--}}