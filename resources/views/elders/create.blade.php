@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - elders/Create.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for creating FAQ posts
// created date - Nov 2019
**/ --}} -->


<html>

<head>

    <title>Create a FAQ Post Elder</title>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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
    </style>

</head>

<body>




<div class="page-content">
    <div class="form-v5-content">
        <form class="form-detail" action="{{ route('elders.store') }}"  method="POST" enctype="multipart/form-data">
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
        
        
           <!--  {{-- @if ($message = Session::get('success'))
        
            <div class="alert alert-success alert-block">
        
                <button type="button" class="close" data-dismiss="alert">×</button>
        
                    <strong>{{ $message }}</strong>
        
            </div>
        
            @endif
           --}} -->
          
          
            <h2>@lang('home.Raise_Query')</h2>
            <div class="col-md-12">
                        <strong>@lang('home.templefunc_create_title'): <span style="color:red">*</span></strong>
                        <input type="text" name="Title" class="input-text" placeholder="@lang('home.templefunc_create_title')" required><br/><br/>
                </div>
                <div class="col-md-12">
                            <strong>@lang('home.templefunc_edit_desc'): <span style="color:red">*</span></strong>
                            <textarea type="text" name="Description" class="input-text"  rows="10" placeholder="@lang('home.templefunc_edit_desc')" required></textarea>
                <br/><br/>
                </div>
                <div class="col-md-12">
                            <strong>Upload File: <span style="color:red">*</span></strong>
                            <input type="file" id="Photo" name="Photo" class="input-text" onchange="checkfile()" required><br/><br/>
                            <p id="Photo_error" style="color:red;"></p>
                </div> 
    
                         <div class="col-md-12">
                               {{--  <button type="submit" class="btn btn-info"><b style="font-size:20px;">@lang('home.matrimonys_create_finalsubmitbtn')</b></button>&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:20px;">@lang('home.posts_create_cancelbtn')</b></a>
                                --}}
                                <input type="submit" onclick="photocheck()"  class="register ml-4" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="@lang('home.matrimonys_create_finalsubmitbtn')">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('elders.index') }}"><input type="button" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" class="register" value="@lang('home.templefunc_create_cancel')"></a>
                 
                                
                                <br/><br/>
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





















    </body>
</html>
       
@include('sweetalert::alert')


@endsection
