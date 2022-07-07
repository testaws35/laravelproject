@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Search.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view represents the UI that shows the Search result
// created date - Nov 2019
**/ --}} -->

    <!-- Main wrapper -->
   
	<div class="wrapper" id="wrapper">

    <a href="/home" class=" btn float-right" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;margin-right:110px;" >Back to home</a>
      <!--MDB Cards class="card card-sm"-->
      <!-- Aruna added - Every panel in the UI HTML that wants to invoke a controller method must be
        embedded in a Form . We can use either POST or GET Method to pass control from HTML to 
        Controller . In the Form tag, the action method uses route to tell which Controller
        and which method to be invoked. The return value of the controller is accessed using double brackets 
        and $ in the HTML controls-->
     <!-- <form   method="POST" action="{{route('home')}}" enctype="multipart/form-data">  -->
      <div class="container">
        
          <h1 class=" text-center text-uppercase" style="font-family: 'Sen', sans-serif;">@lang('home.Search_Results') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>   
           
          <!-- Aruna added atIF is a PHP code to check the return value from Controller classe
            and prepare the HTML dynamically based on the return values
            Here we are using the variable called Failure to check whether there has been any Failure 
            from Controller 
          
            In this case, Search can give result or Failure that there is no matching records or
            even Search phrase is empty. All these check are handled in controller and the 
            answer is sent to UI HTML-->
           @if( $Failure != null )
              <p>
                <h4> {{$Failure}}</h4>
              </p>
           @endif
          

           @if(  $searchResult != null  & $Failure == null)
            <div class="row" >  
                 @foreach ($searchResult as $Resultshort)
                   <div class="col-md-3 col-xl-3 col-lg-3" style="margin-top:-90px; height=200px;" >
                     <a href="{{ route('profile.index',$Resultshort->id) }}" style="color:red;text-decoration:none;">
                            <div class="card  searchcard" style="background:#f9f6f6 !important; border:1px solid #000 !important;">
                            <!--Background color-->
                                      <div class="card-up info-color">
                                        
                                      </div>
                                      <!--Avatar-->
                                          <div class="avatar mx-auto white"><br/>
                                              @if($Resultshort->User_photo)
                                                <img src="{{ $Resultshort->User_photo }}"  class="rounded-circle img-fluid" style="width:150px;height:150px;">
                                              @else 
                                                <img class="rounded-circle img-fluid" src="/images/frontend_images/avatar.png" class="rounded-circle img-fluid" style="width:150px;height:150px;" >
                                              @endif
                                          </div>
                                          <div class="card-body">
                                          <!--Name-->
                                              <h4 class="font-weight-bold mb-4 text-center" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $Resultshort->name }}  </h4>
                                              <hr style="background-color:red;">
                                              <b style="font-size:18px;text-decoration: none;font-weight:600">Living at :</b> {{ $Resultshort->User_City }}
                                             <!-- <hr> -->
                                              <!--Phone Email Location-->
                                              <p class="mt-1"><b style="font-size:18px;text-decoration: none;font-weight:600">Phone: </b> {{$Resultshort->User_Phone}}  <!--  <br/>   {{$Resultshort->email}}   <br/>   {{$Resultshort->User_City}} --> </p>
                                        </div>
                            </div>
                      </a>
                  </div>
                  <!--end of col-->
                @endforeach
            </div>     <!-- row-->
            @endif
          </div>  <!-- end container-->
      <!--  </form> -->
      

     </div>   <!-- Main wrapper -->


@endsection
