@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Helpposts/Create.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for creating Help posts
// created date - Nov 2019
**/ --}} -->

<html>

<head>

    <title>Help Post</title>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- References: https://github.com/fancyapps/fancyBox -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

{{-- <style>
textarea{resize: none;}
    </style> --}}
</head>

<body>



<div class="page-content">
    <div class="form-v5-content">
        <form class="form-detail" action="{{ route('helpposts.store') }}"  method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
        
        
                    @if (count($errors) > 0)
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                 @endif
        
        
            {{-- @if ($message = Session::get('success'))
        
            <div class="alert alert-success alert-block">
        
                <button type="button" class="close" data-dismiss="alert">×</button>
        
                    <strong>{{ $message }}</strong>
        
            </div>
        
            @endif
           --}}
          
          
            <h2>@lang('home.helpposts_create_heading')</h2>
            <div class="form-row">
                <label for="Title">@lang('home.helpposts_create_type')</label>
            
                <select class="form-control" name="Type" style="width: 94.5%;padding: 10.5px 15px;
                border: 1px solid #e5e5e5;height:30%;">
                        <option value="Job">@lang('home.helpposts_create_type_job')</option>
                        <option value="Education">@lang('home.education_menu')</option>
                        <option value="Health">@lang('home.helpposts_create_type_health')</option>
                        <option value="Finance">@lang('home.matrimonys_create_personaldetails_fatocc_bus')</option>
                        <option value="Others">@lang('home.helpposts_create_type_others') </option>
                      </select>
            </div><br/>
             <div class="form-row">
                <label for="Description">@lang('home.helpposts_create_description')</label>
                <textarea type="text" name="Description"  rows="10" class="input-text" placeholder="@lang('home.helpposts_create_description')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.helpposts_create_description_placeholder')'"></textarea>
                
              </div>
              

               <div class="form-row">
                <label for="Photo">@lang('home.templefunc_create_upphoto')</label>
                
                <input type="file" id="Photo" name="Photo" class="input-text" onchange="checkfile()" required>
                <p class="error-block" id="Photo_error" style="color:red;"></p>
               </div>


            <div class="form-row-last">
                <input type="submit" name="register" class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="@lang('home.matrimonys_create_finalsubmitbtn')">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('helpposts.index') }}"><input type="button"  class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="@lang('home.templefunc_create_cancel')"></a>

            </div>
        </form>
    </div>
</div>


<script src="js/frontend_js/vendor/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.7.0/bootstrap-maxlength.min.js"></script>
    <script type="text/javascript">
        $('.inputcharr').maxlength({
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

</body>
</html>
   
@include('sweetalert::alert')

@endsection
