@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Announcements/Create.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for creating Announcements
// created date - Nov 2019
**/ --}} -->

<html>

<head>
    <title>Announcements </title>

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
            font-weight: 400;height: 100%; font-family: 'Sen', sans-serif;
          }
          
   </style>
 
</head>

<body>
    <div class="page-content">
            <div class="form-v5-content">
                    <!-- Aruna added - Every panel in the UI HTML that wants to invoke a controller method must be
                        embedded in a Form . We can use either POST or GET Method to pass control from HTML to 
                        Controller . In the Form tag, the action method uses route to tell which Controller
                        and which method to be invoked. The return value of the controller is accessed using double brackets 
                        and $ in the HTML controls-->

                       <form class="form-detail" action="{{  route('announcements.store') }}"  method="POST" enctype="multipart/form-data">
                      
                        <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                            or use csrffield like below 0r simply use atsymbolcsrf. This is necessary to pass data between HTML and PHP -->
                        {!! csrf_field() !!}
                    
                        <!-- Aruna added such a IF staement is used in all input forms to capture error from HTML validation
                            and show it in the blade -->
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
    
                        <h2>@lang('home.announcements_create_head')   </h2>
                        <div class="form-row">
                                <label for="Title">@lang('home.templefunc_create_title')<span style="color:red">*</span></label>
                                <input type="text" name="Title" class="input-text inputchar" placeholder="@lang('home.templefunc_create_title')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.announcements_create_title_placeholder')'"  required>
                         </div>
                         <div class="form-row">
                               <label for="Function_Content">@lang('home.announcements_create_desc')<span style="color:red">*</span></label>
                               <textarea type="text" name="Function_Content" maxlength="5000" rows="10" class="input-text inputchar" placeholder="@lang('home.announcements_create_desc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.announcements_create_desc_placeholder')'" required></textarea>
                         </div>
                         <div class="form-row">
                                <label for="FunctionDate">@lang('home.announcements_create_funcdate')<span style="color:red">*</span></label>
                                <input type="date"  name="FunctionDate" id="FunctionDate" class="input-text" placeholder="Meeting Date" required>
                         </div>
                         <div class="form-row">
                                <label for="Category">@lang('home.announcements_create_anncategory')<span style="color:red">*</span></label>
                                <select name="Category" id="Category"  class="input-text"  required>
                                        <option value="" disabled selected>@lang('home.matrimonys_index_welcome_select_option')</option>
                                        <option value="General">General </option>
                                        <option value="Temple">Temple </option>
                                        <option value="Sangam">Sangam</option>
                                        <option value="Promotion">Promotion</option>
                                        <option value="Invitation">Invitation</option>
                                        <option value="Death">Death</option>
                                        <option value="Funeral">Funeral</option>
                                </select>
                         </div>
                         <div class="form-row">
                               <label for="Photo">@lang('home.templefunc_create_upphoto')<span style="color:red">*</span></label>
                               <input type="file" name="Photo" id="Photo" class="input-text" onchange="checkfile()">
                               <p class="error-block" id="Photo_error" style="color:red;"></p>
                         </div>
                        <!--   We will add Video upload later-->
                         <div class="form-row">
                               <label for="Video">@lang('home.templefunc_create_video') (Optional)</label>
                               <input type="file" name="Video" id="Video" onchange="checkvideofile()" class="input-text"><br/>
                               <p style="font-family: 'Sen', sans-serif;">@lang('home.note'): @lang('home.templefunc_create_msg') </p>
                               <p class="error-block" id="Video_error" style="color:red;"></p>
                         </div>  
                         <div class="form-row-last">
                                <input type="submit" onclick="photocheck()"  class="register" value="@lang('home.matrimonys_create_finalsubmitbtn')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{ route('announcements.index') }}"><input type="button"  class="register" value="@lang('home.templefunc_create_cancel')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"></a>
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

@include('sweetalert::alert')

@endsection
