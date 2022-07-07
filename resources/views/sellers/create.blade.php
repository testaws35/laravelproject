@extends('layouts.app1')

@section('content')

<div class="page-content">
    <div class="form-v5-content">
        <form class="form-detail" action=""  method="POST" enctype="multipart/form-data">
            @csrf
        
        
            @if (count($errors) > 0)
        
                <div class="alert alert-danger">
        
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
        
                    <ul>
        
                        @foreach ($errors->all() as $error)
        
                            <li>{{ $error }}</li>
        
                        @endforeach
        
                    </ul>
        
                </div>
        
            @endif
        
        
            @if ($message = Session::get('success'))
        
            <div class="alert alert-success alert-block">
        
                <button type="button" class="close" data-dismiss="alert">×</button>
        
                    <strong>{{ $message }}</strong>
        
            </div>
        
            @endif
          
          
          
            <h2>@lang('home.community_sellers_create_btn')</h2>
            <div class="form-row">
                <label for="Name">@lang('home.matrimonys_create_basicdetails_name')</label>
                <input type="text" name="Name" id="Name" maxlength="200" class="input-text inputchar" placeholder="@lang('home.matrimonys_create_basicdetails_name')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.matrimonys_create_basicdetails_name')'">
            </div>
            
                <input type="hidden" name="UserID" id="UserID" value="{{Auth::user()->id}}"   placeholder="UserID" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='UserID'">
            
             <div class="form-row">
                <label for="CompanyName">@lang('home.matrimonys_edit_paneleducompname')</label>
                <input type="text" name="CompanyName" id="CompanyName" maxlength="200" class="input-text inputchar" placeholder="@lang('home.matrimonys_edit_paneleducompname')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.matrimonys_edit_paneleducompname')'">
             </div>
             

               <div class="form-row">
                <label for="Description">@lang('home.templefunc_edit_desc')</label>
                <textarea  name="Description" id="Description" maxlength="255" rows="5" class="input-text inputchar" placeholder="@lang('home.templefunc_edit_desc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.templefunc_edit_desc')'"></textarea>
            
            </div>

            <div class="form-row">
                    <label for="Location">@lang('home.matrimonys_create_basicdetails_loc')</label>
                    <input type="text" name="Location" id="Location" maxlength="255" class="input-text inputchar" placeholder="@lang('home.matrimonys_create_basicdetails_loc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.matrimonys_create_basicdetails_loc')'">
                    
             </div>
             <div class="form-row">
                    <label for="Phone">@lang('home.footer_sub_head_con_phonenumber')</label>
                    <input type="tel" name="Phone" id="Phone" minlength="10" maxlength="10" class="input-text inputchar" placeholder="@lang('home.footer_sub_head_con_phonenumber')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.footer_sub_head_con_phonenumber')'">
                    
             </div>
           <!-- <div class="form-row">
                <label for="Photo">@lang('home.sangammeetings_create_upphoto')</label>
                <input type="file" name="Photo" id="Photo" class="input-text" required>
            </div>-->
               
            <div class="form-row-last">
                
                <button type="button" value="submit" id="rzp-button" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;width: 280px;" class="register btn fa-3x" >@lang('home.matrimony_mem_p6')</button>

                <a href="{{ route('sellers.index') }}">
                    <input type="button"  style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" class="register btn fa-3x" value="@lang('home.templefunc_create_cancel')">
                </a>

            </div>
            <!--<input type="hidden" value="Success" id="transactionStatus" readonly>-->
			<!--<input type="hidden" value="NetBanking" id="paymentMethod" readonly>-->
			<input type="hidden" value="pay_IYWriufxz2vLNc" id="paymentId" readonly>
			<input type="hidden" value="1"  id="finalAmount" readonly>
        </form>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  /** add this function where you are using the ShowToast Alert ***/
  function showToastAlert(title, body, icon)
  {
	$.toast({
	heading: title,
	text: body,
	showHideTransition: 'fade',
	icon: icon,
	position: 'top-center'
	});
  }
 var options = 
 {
    "key":"{{$razorPayKey}}", // Enter the Key ID generated from the Dashboard    
    "amount": "100", 
    // "amount" : "{{$total *100}}",
    "currency": "INR",   
    "name": "Tecple",   
    "description": "Online Payment",  
    "image": "https://tecpleglobal.com/img/tecple-logo.jpg", 
    "prefill": {
		"name": "{{$user->name}}", // pass customer name
		"email": "{{$user->email}}" ,              //'info@rvsion.in',// customer email
		"contact": "{{$user->User_Phone}}"
	},

	"theme": 
	{
		"color": "#f82249" // screen color
	},
    "handler": function (response)
    {
	    console.log(response); 

	    $('#paymentId').val(response.razorpay_payment_id);
	
	   $.toast({
        	heading: "Payment Success!",
        	text: "Please wait Processing... Do not press back button or refresh",
        	showHideTransition: 'fade',
        	icon: "success",
        	position: 'bottom-right'
        }); 
        createSeller();

    }
     
     
 };
 var rzp = new Razorpay(options);
 document.getElementById('rzp-button').onclick = function(e)
 {
  
   rzp.open();    
 }
 
 
 function createSeller()
    {
		 
		 let paymentId = $('#paymentId').val();
		 console.log(paymentId);
		 $.get( "/get/razor/payment/"+paymentId, function( payment ) {
			console.log(payment);
		 
		 let paymentObj = JSON.parse(payment);
		 let finalAmount = $('#finalAmount').val();
		 //seller details start
		 let sellername = $('#Name').val();
    	 let sellercom_name = $('#CompanyName').val();
    	 let sellerdescrip = $('#Description').val();
    	 let selleruserid = $('#UserID').val();
    	 let sellerloc = $('#Location').val();
    	 let sellerphone = $('#Phone').val();
    	
    	//seller detail end
		 let paymentMethod = paymentObj.method;   //$('#paymentMethod').val();	 
		 let transactionStatus = paymentObj.status; //$('#transactionStatus').val();
		
	
	 
		let data = {
			 
		
			 "payment": {
				"finalamount": finalAmount,
				"transactionid": paymentId,
				"transactionstatus": transactionStatus,
				"paymentmethod": paymentMethod			
			 },
			 
			 "seller": {
					'Name': sellername,
            		'CompanyName': sellercom_name,
            		'Description': sellerdescrip,
            		'UserID': selleruserid,
            		'Location': sellerloc,
            		'Phone': sellerphone
            		
			 },
			 
		}
		 console.log(data);
		$.post( "/sellers/store", data, function( res ) 
		{
			 if(res.success){
				window.location.href="/sellers/?success=1";
			 }
		});
		
	    });
    }
    

</script>

<script>
    
</script>



@endsection
