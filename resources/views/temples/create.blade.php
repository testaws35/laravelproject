@extends('layouts.app1')

@section('content')

<html>

<head>

    <title>Temples</title>

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
                    <form class="form-detail" action="{{ route('temples.store') }}"  method="POST" enctype="multipart/form-data">
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
                    
                    
                        @if ($message = Session::get('success'))
                    
                        <div class="alert alert-success alert-block">
                    
                            <button type="button" class="close" data-dismiss="alert">×</button>
                    
                                <strong>{{ $message }}</strong>
                    
                        </div>
                    
                        @endif
                      
                      
                      
                        <h2>@lang('home.temples_index_upbtn')   </h2>
                        <div class="form-row">
                                    <label for="Temple_Name">@lang('home.temple_name')<span style="color:red">*</span></label>
                                    <input type="text" name="Temple_Name" maxlength="255" class="input-text inputchar" placeholder="@lang('home.temple_name')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_title_placeholder')'">
                        </div>
                        <div class="form-row">
                                    <label for="Temple_Description">@lang('home.templefunc_edit_desc')<span style="color:red">*</span></label>
                                    <textarea type="text" name="Temple_Description" maxlength="255" rows="10" class="input-text inputchar" placeholder="@lang('home.templefunc_edit_desc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_temdesc_placeholder')'"></textarea>
                        </div>
                        <div class="form-row">
                                    <label for="Temple_StartedOn">@lang('home.temples_create_temon')<span style="color:red">*</span></label>
                                    <input type="date"  name="Temple_StartedOn" id="Temple_StartedOn" class="input-text">
                        </div>
                         <div class="form-row">
                                    <label for="Temple_Head">@lang('home.temples_create_temname')<span style="color:red">*</span></label>
                                    <input type="text" name="Temple_Head" maxlength="255" class="input-text inputchar" placeholder="@lang('home.temples_create_temname')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_temname_placeholder')'">
                         </div>
                         <div class="form-row">
                                    <label for="Temple_Address">@lang('home.temples_create_temadd')<span style="color:red">*</span></label>
                                    <input type="text" name="Temple_Address" maxlength="255" rows="5" class="input-text inputchar" placeholder="@lang('home.temples_create_temadd')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_temadd_placeholder')'">
                         </div>
                         <div class="form-row">
                                    <label for="Temple_NearbyCity">@lang('home.temples_create_temnearby')<span style="color:red">*</span></label>
                                    <input type="text" name="Temple_NearbyCity" maxlength="255" rows="5" class="input-text inputchar" placeholder="@lang('home.temples_create_temnearby')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_temnearby')'">
                         </div>
                         <div class="form-row">
                                    <label for="Temple_Route">@lang('home.temples_create_temroute')<span style="color:red">*</span></label>
                                    <input type="text" name="Temple_Route" maxlength="255" rows="5" class="input-text inputchar" placeholder="@lang('home.temples_create_temroute')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_temroute')'">
                         </div>
                         <div class="form-row">
                                    <label for="Temple_OwnedBy_Subsect">@lang('home.temples_create_temsub')<span style="color:red">*</span></label>
                                    <input type="text" name="Temple_OwnedBy_Subsect" maxlength="255" class="input-text inputchar" placeholder="@lang('home.temples_create_temsub')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_temsub_placeholder')'">
                         </div>
                         <div class="form-row">
                                    <label for="Temple_SharedWith_Anyone">@lang('home.temples_create_shaany')<span style="color:red">*</span></label>
                                    <input type="text" name="Temple_SharedWith_Anyone" maxlength="255" class="input-text inputchar" placeholder="@lang('home.temples_create_shaany')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_shaany_placeholder')'">
                         </div>
                         <div class="form-row">
                                        <label for="Temple_Location">@lang('home.temples_create_temloc')<span style="color:red">*</span></label>
                                        <input type="text" name="Temple_Location" maxlength="27" class="input-text inputchar" placeholder="@lang('home.temples_create_temloc')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.temples_create_temloc_placeholder')'">
                         </div>
                         <div class="form-row">
                            <label for="Photo">@lang('home.templefunc_create_upphoto')</label>
                            <input type="file" name="Temple_Photo" id="Photo" onchange="checkfile()" class="input-text" required>
                         </div>
                         <div class="form-row-last" >
                            <input type="submit" onclick="photocheck()"  class="register"  value="@lang('home.matrimonys_create_finalsubmitbtn')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('temples.index') }}"><input type="button"  class="register"  value="@lang('home.templefunc_create_cancel')" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"></a>
                         </div>
                    </form>
                </div>
            </div>
            <script src="js/frontend_js/vendor/jquery-3.4.1.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.7.0/bootstrap-maxlength.min.js"></script>
          <!--   <script type="text/javascript">
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
        </script> -->
           
        
        
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
                                $('#Temple_StartedOn').attr('min', maxDate);
                            });
               </script>
           
        
        
        
        
        
        </body>
             </html>







@endsection
