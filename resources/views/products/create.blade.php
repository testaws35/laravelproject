@extends('layouts.app1')

@section('content')
<html>

<head>

    <title>Create New Product</title>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- References: https://github.com/fancyapps/fancyBox -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<style>
input::placeholder {
   color: #000;
   font-size: 16px;
   font-weight: 400;
   font-family: 'Sen', sans-serif;
   height: 100%;
}

textarea::placeholder{
    color: #000;
    font-size: 16px;
    font-weight: 400;
    font-family: 'Sen', sans-serif;
  }
select{
    color: #000;
    font-size: 16px;
    font-weight: 400;height: 100%; font-family: 'Sen', sans-serif;
  }
  
    </style>

</head>

<body>
         <div class="page-content">
                <div class="form-v5-content">
                    <form class="form-detail" action="{{ route('products.store') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                    
                    
                        @if (count($errors) > 0)
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                 @endif
                    
                    
                       {{--  @if ($message = Session::get('success'))
                    
                        <div class="alert alert-success alert-block">
                    
                            <button type="button" class="close" data-dismiss="alert">×</button>
                    
                                <strong>{{ $message }}</strong>
                    
                        </div>
                    
                        @endif
                       --}}
                      
                      
                        <h2>@lang('home.products_create_heading') </h2>
                        <div class="form-row">
                            <label for="ProductName">@lang('home.products_create_productname')<span style="color:red">*</span></label>
                            <input type="text" name="ProductName" maxlength="200" class="input-text" placeholder="@lang('home.products_create_productname')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.products_create_pn_placeholder')'">
                        </div>
                         <div class="form-row">
                            <label for="Description">@lang('home.products_create_productdesc')<span style="color:red">*</span></label>
                            <textarea type="text" name="Description" maxlength="255" rows="10" class="input-text" placeholder="@lang('home.products_create_productdesc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.products_create_productplaceholder')'"></textarea>
                         </div>
                         
            
                        <div class="form-row">
                            <label for="Photo">@lang('home.templefunc_create_upphoto')<span style="color:red">*</span></label>
                            <input type="file" name="Photo" class="input-text" id="Photo"onchange="checkfile()" required>
                            <p class="error-block" id="Photo_error" style="color:red;"></p>
                        </div>
            
                        <div class="form-row">
                                <label for="Weight">@lang('home.matrimonys_create_phydetails_weight')<span style="color:red">*</span></label>
                                <input type="number" name="Weight" maxlength="3" class="input-text" placeholder="@lang('home.matrimonys_create_phydetails_weight')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.products_create_weight_placeholder')'">
                        </div>
                        <div class="form-row">
                            <label for="Price">@lang('home.products_create_price')<span style="color:red">*</span></label>
                            <input type="number" name="Price" maxlength="27" class="input-text" placeholder="@lang('home.products_create_price_placeholder')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.products_create_price_placeholder')'">
                        </div>
                        <div class="form-row">
                                <label for="Carats">@lang('home.products_create_carats')<span style="color:red">*</span></label>
                                <input type="number" name="Carats" maxlength="27" class="input-text" placeholder="@lang('home.products_create_carats_placeholder')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.products_create_carats_placeholder')'">
                            </div>   
                        <div class="form-group">
                                    <label for="title">@lang('home.products_create_category'):</label>
                                    <select id="category" name="category" class="select" >
                                        @foreach ($categorys as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                     </select>
                        </div>
                        <div class="form-group">

                                    <label for="title">@lang('home.products_create_subcategory'):</label>
                                      <select name="SubCategoryID" class="select" >
                                    </select>
                        </div>
                        <script type="text/javascript">
                               $(document).ready(function() {
                                   $('select[name="category"]').attr('change', function() {
                                        var cateID = $(this).val();
                                            if(cateID) {
                                                $.ajax({
                                                   //url:  "{{url('get-subcategory-list')}}?CategoryID="+cateID,
                                                   url: '/myform/ajax/'+cateID,
                                                   type: "GET",
                                                   dataType: "json",
                                                   success:function(data) {
                                                      $('select[name="SubCategoryID"]').empty();
                                                          $.each(data, function(key, value) {
                                                          $('select[name="SubCategoryID"]').append('<option value="'+ key +'">'+ value+'</option>');
                                                       });
                                                   }
                                
                                                });
                                             }else{
                                                $('select[name="SubCategoryID"]').empty();
                                             }
                                
                                        });
                                
                                    });
                                
                                </script> 

                         
            
                        <div class="form-row-last">
                            <input type="submit" onclick="photocheck()" class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="@lang('home.matrimonys_create_finalsubmitbtn')">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('products.index') }}"><input type="button" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" class="register" value="@lang('home.templefunc_create_cancel')"></a>
            
                        </div>
                    </form>
                </div>
            </div>
            
            
            <script src="js/frontend_js/vendor/jquery-3.4.1.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.7.0/bootstrap-maxlength.min.js"></script>
                <script type="text/javascript">
                    $('.inputchar').maxlength({
                          alwaysShow: true,
                          threshold: 10,
                          warningClass: "label label-success",
                          limitReachedClass: "label label-danger",
                          separator: ' out of ',
                          preText: 'You write ',
                          postText: ' chars.',
                          validate: true
                    });
                </script>
            
            <script type="text/javascript">
                $('textareaa').maxlength({
                      alwaysShow: true,
                      threshold: 10,
                      warningClass: "label label-success",
                      limitReachedClass: "label label-danger",
                      separator: ' out of ',
                      preText: 'You write ',
                      postText: ' chars.',
                      validate: true
                });
            </script>
            

            <!--  CASTE SUBCASTE  SCRIPT -->
    <script>
        function categories() {
          var CateID =  document.getElementById("cate").value;
          alert("The text has beendocumen changed.");
          if(CateID){  
              $.ajax({
                 type:"GET",
                 url:"{{url('get-subcategory-list')}}?CategoryID="+CateID,
                 success:function(res){               
                  if(res){
                      $("#cate").empty();
                      $("#cate").append('<option>Select Subcaste</option>');
                 
                      $.each(res,function(key,value){
                          $("#cate").append('<option value="'+key+'">'+value+'</option>');
                          
                      });
                 
                  }else{
                     $("#cate").empty();
                  }
                 }
              });
          }else{
              $("#cate").empty();
             
          }      
         }
        
          </script>
        <!-- END CASTE SUBCASTE Script  -->

<script>
$(document).ready(function() {
	$("#parent_cat").change(function() {
		$.get('loadsubcat/' + $(this).val(), function(data) {
			$("#sub_cat").html(data);
		});
    });

});


 </script>   
</body>
</html>

@include('sweetalert::alert')   

@endsection
