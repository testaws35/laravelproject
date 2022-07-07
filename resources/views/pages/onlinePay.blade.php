@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - matrimonys/onlinePay.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for showing
// the membership selected and amount to be paid during Matrimony registrtion
// created date - Nov 2019
**/ --}} -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">

.card {
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e5e9f2;
    border-radius: .2rem;
}
.card-header:first-child {
    border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
}

.card-header {
    border-bottom-width: 1px;
}
.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    color: inherit;
    background-color: #fff;
    border-bottom: 1px solid #e5e9f2;
}
svg:not(:root).svg-inline--fa {
    overflow: visible;
}

.svg-inline--fa.fa-fw {
    width: 1.25em;
}

.svg-inline--fa.fa-w-16 {
    width: 1em;
}

.TabColor{
    background: #fff; 
  
    padding: 10px;
    box-shadow: 5px 10px 18px #888888;
   }
</style>
</head>
<body>
<div class="container">
    {{-- <form action="{{ route('payment') }}" method="POST" enctype="multipart/form-data"> --}}
    @csrf
        <div class="row">
          <!--   <div class="col-md-12 col-xl-3"> -->
               <!--  <div class="card mb-3" style="margin-top:-5px;"> -->
                    <div class="card-header">
                        <h2 class="card-title mb-0" style="text-align:center;font-family: 'Sen', sans-serif;">Order Summary</h2>
                    </div>
        </div>
        <div class="card-body">
        <ul class="list-unstyled">
                    <div class="row" style="font-family: 'Sen', sans-serif;">
                            <div class="col-md-12" style="font-family: 'Sen', sans-serif;font-size:30px;"> You have chosen </div>
                                    <?php if ( $Message ==1) { ?>
                                            <div class="col-md-9">Monthly Membership</div>
                                            <!--<div class="col-md-8"> echo date('Y F j', strtotime(date('Y').'-'.date('m').'-'.date('j').' + 1 months') ) </div> -->
                                            <div class="col-md-9"><i class="fa fa-inr"></i> 150</div>
                                            <div class="col-md-9"> GST @ 18%</div>
                                            <input type="hidden" name="plan" value="1" >
                                            
                                    <?php } else if ( $Message ==2) { ?>
                                        <div class="col-md-9">Half yearly Membership</div>
                                       {{--  <div class="col-md-9"> echo date('Y F j', strtotime(date('Y').'-'.date('m').'-'.date('j').' + 6 months') ) </div> --}}
                                        <div class="col-md-9"><i class="fa fa-inr"></i> 250</div>
                                        <div class="col-md-9"> GST @ 18%</div>
                                        <input type="hidden" name="plan" value="2"  >
                                        
                                    <?php } else { ?>
                                        <div class="col-md-9">Yearly Membership</div>
{{--                                         <div class="col-md-9"> echo date('Y F j', strtotime(date('Y').'-'.date('m').'-'.date('j').' + 12 months') ) </div> --}}
                                        <div class="col-md-9"><i class="fa fa-inr"></i> 500</div>
                                        <div class="col-md-9"> GST @ 18%</div>
                                        <input type="hidden" name="plan" value="3"  >
                                    <?php } ?>
                            
                            </div>    <!--col end-->
                  
                    </div> <!--row end-->
                    <hr class="my-0">
                    <div class="card-body">
                      <div class="row" style="font-family: 'Sen', sans-serif;">
                            <div class="h6 card-title col-md-8"> Total </div>
                                <?php if ( $Message ==1) { ?>
                                    <div class="col-md-9"><i class="fa fa-inr"></i>  177</div>
                                <?php } else if ( $Message =2) { ?>
                                    <div class="col-md-9"><i class="fa fa-inr"></i>  295</div>
                                <?php } else { ?>
                                    <div class="col-md-9"><i class="fa fa-inr"></i>  590</div>
                                <?php } ?>
                            </div>
                      </div> <!--- row end-->
                      
                   </div> <!--- card body-->
        </div> <!--- list end-->
       </div> <!--- card body end-->
       <!--  <div class="card"> --
       <div class="col-md-8 col-xl-9">

             <div class="row">
                 <div class="col-md-4">
                      <div class="col-md-12 TabColor">
                           <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a  class="btn btn-outline-info btn-lg btn-block" id="creditdebit-tab" data-toggle="tab" href="#creditdebit" role="tab" aria-controls="home" aria-selected="true">Card / Debit Card</a>
                                </li><br/>
                                <li class="nav-item">
                                    <a class="btn btn-outline-info btn-lg btn-block" id="netbanking-tab" data-toggle="tab" href="#netbanking" role="tab" aria-controls="netbanking" aria-selected="false">Internet Banking</a>
                                </li><br/>
                                <li class="nav-item">
                                    <a class="btn btn-outline-info btnTab btn-lg btn-block" id="mobilewallets-tab" data-toggle="tab" href="#mobilewallets" role="tab" aria-controls="mobilewallets" aria-selected="false">Mobile Wallets</a>
                                </li>
                            </ul>
                         </div></div>
                             <div class="col-md-8">
    
                                <div class="col-md-12 TabColor">
                                            <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="creditdebit" role="tabpanel" aria-labelledby="creditdebit-tab">
                                        
                                             <form>
                                                <div class="card-details" ><br/>
                                                    <h3 class="title">Enter your Card Details</h3>
                                                    <div class="row">
                                                    <div class="form-group col-sm-7">
                                                        -- <div class="inner-addon right-addon"> --
                                                            <div class="inner-addon">
                                                        <label for="card-holder">Card Holder Name</label>
                                                        <!-- <i class="far fa-user"></i> --
                                                        <input id="card-holder" type="text" class="form-control" placeholder="Card Holder" >
                                                        </div> 
                                                    </div>
                                                    <div class="form-group col-sm-5">
                                                        <label for="">Expiration Date</label>
                                                        <div class="input-group expiration-date">
                                                        <input type="text" class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                                                        <span class="date-separator">&nbsp;/&nbsp;</span>
                                                        <input type="text" class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                        <div class="inner-addon">
                                                        <label for="card-number">Card Number</label>
                                                        <!-- <i class="far fa-credit-card"></i> --
                                                        <input id="card-number" type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                                                        </div> 
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <label for="cvc">CVC</label>
                                                        <input id="cvc" type="text" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <button type="submit" class="btn btn-outline-primary btn-block">Make Payment
                                                        </button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </form>
                                        </div> <!--END--
                                        <div class="tab-pane fade" id="netbanking" role="tabpanel" aria-labelledby="profile-tab">
                                        <h2>Pay using Net Banking</h2>
                                        <div class="row">
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                <a href="https://www.onlinesbi.com/" target="_blank">
                                                    <img alt="AltText" src="https://2.bp.blogspot.com/-PPl8Ikis9v4/XAd4an_qzWI/AAAAAAAACB4/ZG0Rfi1UGx4j23muv5_iW7WarYWq3wVmQCLcBGAs/s1600/sbi-logo.jpg" class="img-fluid">
                                                </a>
                                                </div>
                                        
                                                <div class="col-md-2 col-sm-2 col-xs-2">
                                                <a href="https://www.hdfcbank.com/" target="_blank">
                                                    <img  alt="AltText" src="http://animationvisarts.com/wp-content/uploads/2016/10/hdfc-bank-logo-design-300x300.jpg" class="img-fluid">
                                                </a>
                                                </div>
                                        
                                                <div class="col-md-2 col-sm-6 col-xs-12">
                                                <a href="https://www.icicibank.com/" target="_blank">
                                                    <img src="https://www.kappajobs.com/wp-content/uploads/2018/07/ICICI-Bank-job.jpg" alt="AltText" class="img-fluid">
                                                </a>
                                                </div>
                                        
                                                <div class="col-md-2 col-sm-6 col-xs-12">
                                                <a href="https://www.axisbank.com/" target="_blank">
                                                    <img alt="AltText" src="https://brandingreference.com/brlogos/axis-bank-logo.png" class="img-fluid">
                                                </a>
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12">
                                                <a href="https://www.kotak.com/en.html" target="_blank">
                                                    <img src="https://i0.wp.com/corecommunique.com/wp-content/uploads/2016/10/kotak-mahindra-bank_416x416.jpg?resize=300%2C300" alt="AltText" class="img-fluid">
                                                </a>
                                                </div>
                                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                                    <a href="https://www.idbibank.in/index.asp"  target="_blank">
                                                        <img alt="AltText" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxW9dExnu9TsaX6_rdYvX1pURq7wjShXXZupnKYyIl2Mz1yp-SKg&s" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div>Pay ROW END--<br/>
                                            
                                            <select  class="form-control border col-md-6">
                                                    <option>Select Bank</option>
                                                    <option>Allahabad Bank</option>
                                                    <option>Andhra Bank</option>
                                                    <option>Bank of Bahrain and Kuwait</option>
                                                    <option>Bank of Baroda - Corporate Banking</option>
                                                    <option>Bank of Baroda - Retail Banking</option>
                                                    <option>Bank of India</option>
                                                    <option>Bank of Maharashtra</option>

                                                    <option>Canara Bank</option>

                                                    <option>Central Bank of India</option>
                                                    <option>City Union Bank</option>
                                                    <option>Corporation Bank</option>

                                                    <option>Deutsche Bank</option>
                                                    <option>Development Credit Bank</option>
                                                    <option>Dhanlaxmi Bank</option>

                                                    <option>Federal Bank</option>
                                                    <option>Indian Bank</option>
                                                    
                                                    <option>Indian Overseas Bank</option>
                                                    <option>IndusInd Bank</option>
                                                    <option>ING Vysya Bank</option>

                                                    <option>Jammu and Kashmir Bank</option>
                                                    <option>Karnataka Bank Ltd</option>
                                                    <option>Karur Vysya Bank</option>
                                                    <option>Kotak Bank</option>
                                                    <option>Laxmi Vilas Bank</option>
                                                    
                                                    <option>Oriental Bank of Commerce</option>
                                                    <option>Punjab National Bank - Corporate Banking</option>
                                                    <option>Punjab National Bank - Retail Banking</option>
                                                    <option>Punjab & Sind Bank</option>
                                                    <option>Shamrao Vitthal Co-operative Bank</option>

                                                    <option>South Indian Bank</option>
                                                    <option>State Bank of Bikaner & Jaipur</option>
                                                    <option>State Bank of Patiala</option>
                                                    <option>State Bank of Travancore</option>
                                                    <option>Syndicate Bank</option>

                                                    <option>Tamilnad Mercantile Bank Ltd</option>
                                                    <option>UCO Bank</option>
                                                    <option>Union Bank of India</option>
                                                    <option>United Bank of India</option>
                                                    <option>Vijaya Bank</option>

                                                    <option>Yes Bank Ltd</option>
                                                    
                                                    
                                                </select><br/>
                                                
                                                       <!-- <button type="submit" class="btn btn-outline-primary btn-block col-md-6"  >Make Payment</button>-->
                                                       <!-- Aruna changed this-->
  <!-- Note that the amount is in paise = 50 INR -->
                        <!--amount need to be in paisa-->
                    
<!-- Include whatever JQuery which you are using -->
{{-- <form action="matrimonys.payment" method="POST">  --}}


<form action="{{ route('setMatrimonyExpiry',$Message) }}" method="POST" enctype="multipart/form-data">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ Config::get('custom.razor_key') }}" {{-- Enter the Test API Key ID generated from Dashboard → Settings → API Keys --}}
                                data-amount="100"  {{-- Amount is in currency subunits. Hence, 100 refers to 100 paise or ₹1. --}}
                                data-currency="INR" {{-- You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account --}}
                                data-name="Tecple Innoventive Solutions Pvt Ltd"
                                data-description="Online Payment Testing"
                                data-image="https://tecpleglobal.com/img/tecple-logo.jpg"
                                data-prefill.name="name"
                                data-prefill.email="email"
                                data-theme.color="#ffb606"
                                 > </script> 
                      
                        <input type="hidden" name="razor_key" value="{data-key}">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <input type="hidden" name="prefill[name]" value="Tecple">
                        <input type="hidden" name="prefill[contact]" value="9123456780">
                        <input type="hidden" name="prefill[email]" value="tecpleglobal@gmail.com">
                        <input type="hidden" name="order_id" value="razorpay_order_id">
                        <input type="hidden" name="payment_id" value="razorpay_payment_id">
                        <input type="hidden" name="signature" value="razorpay_signature">

        {{--  <button type="submit" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;margin-left:100px;" >Make Payment</button> --}}
    </form>                                  
                                        <!--</div><!--END--
                                        <div class="tab-pane fade" id="mobilewallets" role="tabpanel" aria-labelledby="contact-tab">
                                        <h2>Pay using Wallets</h2><br/>
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                <a href="https://www.onlinesbi.com/" target="_blank">
                                                    <img alt="AltText" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQBcQRLIf2e2tNX1TUxI6SQ-M3gMPyJANhh5-avH3jEPwJoeECN" class="img-fluid">
                                                </a>
                                                </div>
                                        
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                <a href="https://www.hdfcbank.com/" target="_blank">
                                                    <img  alt="AltText" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRF69QLhnLZ3t8y9K_S-xyH7RYXJeoRAsgZTXz7qSXwyWgia3mp" class="img-fluid">
                                                </a>
                                                </div>
                                        
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                <a href="https://www.icicibank.com/" target="_blank">
                                                    <img src="data:image/jpeg;base64,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" alt="AltText" class="img-fluid">
                                                </a>
                                                </div>
                                        
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                <a href="https://www.axisbank.com/" target="_blank">
                                                    <img alt="AltText" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS-9_HFOjJkIoMBIYMp-92iZGi7zlfilRmB2pKTgscRnztv6vJt" class="img-fluid">
                                                </a>
                                                </div>
                                                
                                            
                                            </div><!-- Pay ROW END--
                                        
                                        </div><!--END--
                                        </div>
                                            </div>
                                            <!-- /.col-md-8 -->   



                            <!--  </div> --
                                        </div>

          


        </div><!-- Card -end -->

  <!--  </div><!--end col-9 --
 </div>
</div> -->
{{-- </form> --}}
</div>


</body>
</html>

@endsection