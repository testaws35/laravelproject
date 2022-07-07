@extends('layouts.app1')
@section('content')

<html>
<head>

    <title>Temple Functions</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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
            font-weight: 400;height: 100%; 
            font-family: 'Sen', sans-serif;
          }
          btn1{
              background: #f82249;
              font-family: 'Sen', sans-serif;
              color:#fff;
              border-bottom-right-radius:25px;
              border-top-left-radius:25px;"
          }
          
            </style>


</head>

<body>
      <div class="page-content">
                <div class="form-v5-content">
                    <form class="form-detail" action="{{ route('templefunctions.store') }}"  method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
     
                        @if (count($errors) > 0)
                               <div class="alert alert-danger">
                                    <strong>Whoops!</strong> Please fill the missing info<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                        @endif
                    
                        <h2>@lang('home.templefunc_create_head') </h2>
                        <div class="form-row">
                            <label for="Title">@lang('home.templefunc_create_title')<span style="color:red">*</span></label>
                            <input type="text" name="Title"  class="input-text" placeholder="@lang('home.templefunc_create_title')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.templefunc_create_title')'">
                           
                        </div><br/>
                        <div class="form-row">
                            <label for="Function_Content">@lang('home.templefunc_create_desc')<span style="color:red">*</span></label>
                            <textarea type="text" name="Function_Content" maxlength="4000" rows="10" class="input-textr" placeholder="@lang('home.templefunc_create_desc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.templefunc_create_desc_placeholder')'"></textarea>
                        </div><br/>
                        <div class="form-row">
                            <label for="FunctionDate">@lang('home.templefunc_create_funcdate')<span style="color:red">*</span></label>
                            <input type="date"  name="FunctionDate" id="FunctionDate" class="input-text" placeholder="Meeting Date" required>
                        </div>
                        <!--   we are not providing Temple list as we take the Templeid from Temple Member list -->
                        <div class="form-row">
                            <label for="Photo">@lang('home.templefunc_create_upphoto')<span style="color:red">*</span></label>
                            <input type="file"  name="Photo" class="input-text" id="Photo" onchange="checkfile()" required>
                            <p id="Photo_error" style="color:red"></p>
                        </div>
            
                        <div class="form-row">
                            <label for="Video">@lang('home.templefunc_create_video') (Optional)</label>
                             <input type="file" name="Video" id="Video" onchange="checkvideofile()"  class="input-text"><br/>
                            <p style="font-family: 'Sen', sans-serif;font-size:16px;">@lang('home.note'): @lang('home.templefunc_create_msg') </p>
                            <p class="error-block" id="Video_error" style="color:red;"></p>
                        </div> 
                        <div class="form-row-last">
                                <input type="submit" onclick="photocheck()"  class="register  btn1" value="@lang('home.matrimonys_create_finalsubmitbtn')" >&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('templefunctions.index') }}">
                                <input type="button"  class="register btn1" value="@lang('home.templefunc_create_cancel')" ></a>
                        </div>
                    </form>
                </div>
         </div>


               <!-- past date disabled -->
                  <script>
                              $(function(){
                                var dtToday = new Date();
                                
                                var month = dtToday.getMonth() + 1;
                                var day = dtToday.getDate();
                                var year = dtToday.getFullYear();
                                if(month < 10)
                                    month = '0' + month.toString();
                                if(day < 10)
                                    day = '0' + day.toString();
                                
                                var maxDate = year + '-' + month + '-' + day;
                                //alert(maxDate);
                                $('#FunctionDate').attr('min', maxDate);
                            });
               </script>
</body>

</html>
  

@endsection
