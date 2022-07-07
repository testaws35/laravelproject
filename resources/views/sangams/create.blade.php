@extends('layouts.app1')

@section('content')

<html>

<head>

    <title>Sangams</title>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- References: https://github.com/fancyapps/fancyBox -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <style>
        input::placeholder 
        {
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
            font-weight: 400;
            height: 100%; 
            font-family: 'Sen', sans-serif;
        }
          
     </style>
</head>

<body>


        <div class="page-content">
                <div class="form-v5-content">
                    <form class="form-detail" action="{{ route('sangams.store') }}"  method="POST" enctype="multipart/form-data">
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
                      
                      
                      
                        <h2>@lang('home.sangams_index_upbtn')  </h2>
                        <div class="form-row">
                            <label for="Sangam_Name">@lang('home.Sangam Name')<span style="color:red">*</span></label>
                            <input type="text" name="Sangam_Name" maxlength="1000" class="input-text inputchar" placeholder="@lang('home.Sangam Name')" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='@lang('home.sangams_create_title_placeholder')'">
                            {{-- <i class="fas fa-user"></i> --}}
                        </div>
                         <div class="form-row">
                            <label for="Sangam_Description">@lang('home.sangams_create_desc_placeholder')<span style="color:red">*</span></label>
                            <textarea type="text" name="Sangam_Description" maxlength="5000" rows="10" class="input-text inputchar" placeholder="@lang('home.sangams_create_desc_placeholder')" required oninput="this.className = ''"  onfocus="this.placeholder=''" ></textarea>
                            
                          </div>
                          <div class="form-row">
                            <label for="Sangam_StartedOn">@lang('home.sangams_create_funcdate')<span style="color:red">*</span></label>
                            <input type="date"  name="Sangam_StartedOn"  id="Sangam_StartedOn" class="input-text" placeholder="Sangam StartedOn"  required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='Sangam StartedOn'">
                           </div>
            
                           <div class="form-row">
                                <label for="Num_of_members">@lang('home.sangams_create_nomem')<span style="color:red">*</span></label>
                                <input type="tel" name="Num_of_members" maxlength="4" minlength="1" class="input-text inputchar" placeholder="@lang('home.sangams_create_nomem')" required oninput="this.className = ''"  onfocus="this.placeholder=''" >
                        
                            </div>
                            <div class="form-row">
                                    <label for="Sangam_Activities">@lang('home.sangams_create_sanact')<span style="color:red">*</span></label>
                                    <input type="text" name="Sangam_Activities" maxlength="255" class="input-text inputchar" placeholder="@lang('home.sangams_create_sanact')" required oninput="this.className = ''"  onfocus="this.placeholder=''" >
                                   
                                </div>
                                <div class="form-row">
                                        <label for="Sangam_Location">@lang('home.sangams_create_sanloc')<span style="color:red">*</span></label>
                                        <input type="text" name="Sangam_Location" maxlength="27" class="input-text inputchar" placeholder="@lang('home.sangams_create_sanloc')" required oninput="this.className = ''"  onfocus="this.placeholder=''">
                                       
                                    </div>


                           <div class="form-row">
                            <label for="Photo">@lang('home.templefunc_create_upphoto')</label>
                            
                            <input type="file" id="Photo" onchange="checkfile()" name="Sangam_Photo" class="input-text" required>
                            <p id="Photo_error" style="color:red"></p>
                        </div>
            
                           
            
            
                        <div class="form-row-last">
                            <input type="submit"  onclick="photocheck()" class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('sangams.index') }}"><input type="button"  class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="Cancel"></a>
            
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
                                $('#Sangam_StartedOn').attr('min', maxDate);
                            });
               </script>
           
        
        </body>
             </html>
            
            
    
@endsection
