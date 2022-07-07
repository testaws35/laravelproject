@extends('layouts.app1')
@section('content')

       <!-- DIV page-content    -->
        <div class="page-content">
             <!-- DIV form-v5-content    -->
        <div class="form-v5-content">

                <div class="row">
                        <div class="col-lg-12 margin-tb"><br/>
                        <h2 class="text-center">@lang('home.templefunc_edit_head')</h2>
                        </div>
                </div>
                    
                     @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Please fill the missing info<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    
                    <?php if(isset($templefunction)) {?>
                    <form class="form-detail" action="{{ route('templefunctions.update',$templefunction->TempleFunctionID) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                         <div class="row">
                                {{-- Added by Aruna --}}
                                <div class="col-md-12"  style="display:none">
                                        <label>@lang('home.templefunc_create_title'):</label>
                                        <input type="hidden" name="TempleFunctionID" value="{{ $templefunction->TempleFunctionID }}"  class="form-control" placeholder="ID"><br/><br/>
                                </div>

                                <div class="col-md-12 col-xs-12 col-sm-12">
                                        <label>@lang('home.templefunc_create_title')</label>
                                        <input type="text" name="Title" value="{{ $templefunction->Title }}" maxlength="200" class="input-text inputchar" placeholder="Title" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='Title'">
                                </div>
                                <div class="col-md-12">
                                    <label>@lang('home.templefunc_edit_desc'):</label>
                                    <textarea type="text" name="Description" class="input-text"  rows="15" placeholder="Description" >{{ $templefunction->Function_Content }}</textarea>
                                    <br/><br/>
                                </div>
                        </div>
                        <div class="form-row">
                                    <label for="FunctionDate">@lang('home.templefunc_create_funcdate')</label>
                                    <input type="date" id="FunctionDate" name="FunctionDate" class="input-text" placeholder="Meeting Date" value ="{{ date('Y-m-d',strtotime($templefunction->FunctionDate) ) }}"  required>
                        </div>
                        <div class="row">
                                <div class="form-row col-md-12">
                                       <p><label >@lang('home.templefunc_alreadyuploaded_photo')</label> </p>
                                        <!-- Aruna - current image is not coming properly . must check -->
                                        <img class="img" src="{{ $templefunction->Photo }}"  width="340" height="215">  
                                </div>
                                <div class="form-row col-md-12">
                                    <strong>@lang('home.templefunc_edit_file'):</strong>
                                    <input type="file" id="Photo" onchange="checkfile()" name="Photo" class="input-text"><br/><br/>
                                    <p id="Photo_error" style="color:red;"></p>
                                </div>
                        </div>
                        <div class="row">
                           <p> <label >@lang('home.templefunc_alreadyuploaded_video')</label></p>
                            @if($templefunction->Video != '')
                                            <video width="340" height="215" controls>
                                                <source src="{{ $templefunction->Video }}" type="video/mp4">
                                            </video>
                            @endif
                        </div>
                         <div class="form-row">
                        </div>
                        <div class="form-row">
                            <label for="Video">@lang('home.templefunc_create_video') (Optional)</label>
                             <input type="file" name="Video" id="Video" onchange="checkvideofile()"  class="input-text"><br/>
                            <p style="font-family: 'Sen', sans-serif;font-size:16px;">@lang('home.note'): @lang('home.templefunc_create_msg') </p>
                            <p class="error-block" id="Video_error" style="color:red;"></p>
                        </div> 

                        <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <input type="submit"    class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="@lang('home.matrimonys_create_finalsubmitbtn')">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('templefunctions.index') }}"><input type="button" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" class="register" value="@lang('home.templefunc_create_cancel')"></a>
                                </div>
                        </div>
                    </form>
                <?php } else {?>
                        <p> <h2> Sorry unable to get details of the function. Try again ! </h2> <p>
                <?php } ?>

            </div><!--end div form-v5-content  -->
        </div><!-- end div page-content   -->
        
        
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
        
        
        
@include('sweetalert::alert')

@endsection
