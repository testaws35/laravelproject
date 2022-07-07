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
    @csrf
        <div class="row">
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
                                            <div class="col-md-9"><i class="fa fa-inr"></i> 150</div>
                                            <div class="col-md-9"> GST @ 18%</div>
                                            <input type="hidden" name="plan" value="1" >
                                            
                                    <?php } else if ( $Message ==2) { ?>
                                        <div class="col-md-9">Half yearly Membership</div>
                                        <div class="col-md-9"><i class="fa fa-inr"></i> 250</div>
                                        <div class="col-md-9"> GST @ 18%</div>
                                        <input type="hidden" name="plan" value="2"  >
                                        
                                    <?php } else { ?>
                                        <div class="col-md-9">Yearly Membership</div>
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
  
 <!--amount need to be in paisa-->
                    
<!-- Include whatever JQuery which you are using -->

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
    </form>                                  
  
</div>


</body>
</html>

@endsection