@extends('layouts.app1')
@section('content')

<html>

<head>

    <title>Personal Functions</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
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
                    <form class="form-detail" action="{{ route('personalfunctions.store') }}"  method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
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
                    
                      
                        <h2>@lang('home.personalfunctions_create_head') </h2>
                        <div class="form-row">
                            <label for="Title">@lang('home.templefunc_create_title')<span style="color:red">*</span></label>
                            <input type="text" name="Title" maxlength="1000" class="input-text inputchar" placeholder="@lang('home.templefunc_create_title')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.personalfunctions_create_title_placeholder')'">
                         </div>
                         <div class="form-row">
                            <label for="Function_Content">@lang('home.personalfunctions_create_desc')<span style="color:red">*</span></label>
                            <textarea type="text" name="Function_Content" maxlength="5000" rows="10" class="input-text inputchar" placeholder="@lang('home.personalfunctions_create_desc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.personalfunctions_create_desc_placeholder')'"></textarea>
                            
                          </div>
                          <div class="form-row">
                            <label for="FunctionDate">@lang('home.personalfunctions_create_funcdate')<span style="color:red">*</span></label>
                            <input type="date"  name="FunctionDate" id="FunctionDate"class="input-text" placeholder="Meeting Date" required>
                           </div>
                           <div class="form-row">
                                <label for="Category">@lang('home.personalfunctions_create_funcat')<span style="color:red">*</span></label>
                                <select name="Category" id="Category"  class="input-text"  required>
                                        <option value="" disabled selected>@lang('home.sel_category')</option>
                                        <option value="General">@lang('home.announcements_index_leftside_general') </option>
                                        <option value="Birthday">@lang('home.personalfunctions_index_leftsise_bircere') </option>
                                        <option value="60marriage">@lang('home.personalfunctions_index_leftsise_60mar')</option>
                                        <option value="70marriage">@lang('home.personalfunctions_index_leftsise_70mar')</option>
                                        <option value="80marriage">@lang('home.personalfunctions_index_leftsise_80mar')</option>
                                        <option value="Naming">@lang('home.personalfunctions_index_leftsise_namcere')</option>
                                        <option value="Maturity">@lang('home.personalfunctions_index_leftsise_matcere')</option>
                                        <option value="HouseWarming">@lang('home.personalfunctions_index_leftsise_housecere')</option>
                                        <option value="BabyShower">@lang('home.personalfunctions_index_leftsise_baby')</option>
                                </select>
                         </div>
            
                            <div class="form-row">
                                    <label for="Photo">@lang('home.templefunc_create_upphoto')<span style="color:red">*</span></label>
                                    <input type="file" id="Photo" name="Photo" class="input-text" onchange="checkfile()" required>
                                    <p id="Photo_error" style="color:red"></p>
                            </div>

                            <div class="form-row">
                                    <label for="Video">@lang('home.templefunc_create_video') (Optional)</label>
                                    <input type="file" name="Video" id="Video" onchange="checkvideofile()"  class="input-text"><br/>
                                    <p style="font-family: 'Sen', sans-serif;font-size:16px;">@lang('home.note'): @lang('home.templefunc_create_msg') </p>
                                    <p class="error-block" id="Video_error" style="color:red;"></p>
                            </div> 


                            <div class="form-row-last">
                                <input type="submit" onclick="photocheck()"  class="register" value="@lang('home.matrimonys_create_finalsubmitbtn')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('personalfunctions.index') }}"><input type="button"  class="register" value="@lang('home.templefunc_create_cancel')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"></a>
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
