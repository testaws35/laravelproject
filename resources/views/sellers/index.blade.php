@extends('layouts.app1')
@section('content')



<!DOCTYPE html>
<html>
<head>

    <title>Sellers</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <style>
            /* Limited Charaters in EVENTS Menu */
            .mytable p{
            max-width:900px; /* Customise it accordingly */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            }
            .mytable h4 {
            color:#000;
            max-width:310px; /* Customise it accordingly */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            }
            .btnproColor {color:#000000;}
            /* Limited Charaters in EVENTS Menu */
    </style>
</head>

<body>
<!-- Container -->
 @if(isset($success))
 <div class="alert alert-success align-div-center" id="success-alert">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong> Success! </strong> Seller Created Successfully!
  
    <script type="text/javascript"> 
        setTimeout(function () 
        { 
            // Closing the alert 
            $('#success-alert').alert('close'); 
        }, 5000); 
    </script> 
 </div>
 @endif
  @if ($message = Session::get('success'))

        <div class="alert alert-success" style="width:400px;margin:0 auto;text-align:center;" id="alertmsg">

            <p>{{ $message }}</p>
                <script type="text/javascript"> 
                    setTimeout(function () { 
                    // Closing the alert 
                      $('#alertmsg').alert('close'); 
                  },5000); 
                </script> 
        </div>

  @endif
<div class="container">
    <div class="row">
                <div class="title">
                   <h1 class="font-bold text-center text-uppercase">Sellers Showing of Month {{$currentMonthName}},{{$currentYear}}&nbsp;&nbsp;&nbsp;&nbsp;
                   </h1>
                 <div>
    </div>
    <div class="row">
                   <!-- Create Seller button is opened up for Tecple only-->
                   
                    
                     
                  <div class="container mrgtop">
                    <div class="row">
                            @if(isset($sellers) && (count($sellers)>0))
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
                             <p> <h4 class="alert alert-info anno_failedmsg" >  {{$Failed}} </h4> </p>
                            @endif 
                    </div>
                    <!-- till this date, no payment schemes -->
                    @if(Auth::user()->IsSeller==0)   
                    
                        <!-- Seller Price Plans   -->
                        <div  style="background-color:#fff;">
                        <section class="pricing-area pt-100 pb-100" id="pricing">
                                    <div class="container">
                                                <div class="row">
                                                    <div class="col-xl-8 mx-auto text-center" style="font-family: 'Sen', sans-serif;">
                                                        <div class="section-title">
                                                            
                                                            <h2>Seller Membership Plans</h2>
                                                            <p>It is a platform where all Sellers can interract and meet each other.</p>
                                                        </div>
                                                    </div>
                                                </div>  <!--end inner row-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                                <div class="single-price" style="font-family: 'Sen', sans-serif;">
                                                                                <div class="price-title">
                                                                                
                                                                                </div>
                                                                                <div class="price-tag">
                                                                                <h2>1500<span>/Per Year</span></h2>
                                                                                </div>
                                                                                <div class="price-item">
                                                                                <ul>
                                                                                    <li>Login</li>
                                                                                    <li>Available all basic features</li>
                                                                                    <li>Register as Seller</li>
                                                                                    <li>Upload all your products</li>
                                                                                    <li>Customers will contact you directly</li>
                                                                                </ul>
                                                                                </div>
                                                                                <a href="{{ route('sellers.create') }}" class="btn  waves-effect" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;">Register</a>
                                                                                
                                                                </div>
                                                    </div>
                                                    
                                                   
                                                </div>  <!-- end row-->
                                    </div>  <!-- end container-->
                            </section>
                        </div>
                    @else 
                      <br/> <br/>
                      <!--<p class="seller_title"> Please inform Tecple team at +91 944858088 for registering as Seller in this website  </p>-->
                    @endif
                  </div><!-- Container END -->
           </div><!-- Row END -->
        </div><!-- Container END -->
    </body>
 </html>
        




@endsection
