@extends('layouts.app1')
@section('content')

<html>

<head>

    <title>Sangam Meetings</title>

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
        <form class="form-detail" action="{{ route('sangammeetings.store') }}"  method="POST" enctype="multipart/form-data">
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
  
          
            <h2>@lang('home.sangammeetings_create_head')  </h2>
            <p> @lang('home.note'): &nbsp;<span style="color:red;">*</span> @lang('home.mandatory')</p>
            <div class="form-row">
                <label for="Title">@lang('home.templefunc_create_title') &nbsp;<span style="color:red;">*</span></label>
                <input type="text" name="Title"  class="input-text" placeholder="@lang('home.sangammeetings_create_title_placeholder')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.sangammeetings_create_title_placeholder')'">
            </div>
             <div class="form-row">
                <label for="Meeting_Content">@lang('home.sangammeetings_create_desc') &nbsp;<span style="color:red;">*</span></label>
                <textarea type="text" name="Meeting_Content"  rows="10" class="input-text" placeholder="@lang('home.sangammeetings_create_desc_placeholder')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.sangammeetings_create_desc_placeholder')'"></textarea>
             </div>
            <div class="form-row">
                <label for="MeetingDate">@lang('home.announcements_create_funcdate') &nbsp;<span style="color:red;">*</span></label>
                <input type="date"  name="MeetingDate" id="MeetingDate" class="input-text" placeholder="Meeting Date" required>
            </div>
            <div class="form-row">
                <label for="Photo">@lang('home.templefunc_create_upphoto') &nbsp;<span style="color:red;">*</span></label>
                <input type="file" name="Photo" id="Photo" class="input-text" onchange="checkfile()" required>
                <p class="error-block" id="Photo_error" style="color:red;"></p>
            </div>
            <div class="form-row">
                <label for="Video">@lang('home.templefunc_create_video') (Optional)</label>
                <input type="file" name="Video" id="Video" onchange="checkvideofile()"  class="input-text"><br/>
                <p style="font-family: 'Sen', sans-serif;font-size:16px;">@lang('home.note'): @lang('home.templefunc_create_msg') </p>
                <p class="error-block" id="Video_error" style="color:red;"></p>
            </div>


            <div class="form-row-last">
                <input type="submit" onclick="photocheck()" name="register" class="register" value="@lang('home.matrimonys_create_finalsubmitbtn')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('sangammeetings.index') }}"><input type="button"  class="register" value="@lang('home.templefunc_create_cancel')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"></a>
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
        $('#MeetingDate').attr('min', maxDate);
    });
</script>
              
              
</body>
</html>
   
@include('sweetalert::alert')
@endsection
