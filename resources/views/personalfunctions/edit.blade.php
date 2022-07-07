@extends('layouts.app1')
@section('content')


 <!-- DIV page-content    -->
 <div class="page-content">
        <!-- DIV form-v5-content    -->
         <div class="form-v5-content">
                <div class="row">
                        <div class="col-lg-12 margin-tb"><br/>
                        <h2 class="text-center">Edit Personal Functions</h2>
                        </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <?php if(isset($personalFunction)) {?>
                    <form class="form-detail" action="{{ route('personalfunctions.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="PersonalFunctionID" style="display:none" value="{{$personalFunction->PersonalFunctionID}}" class="form-control">
                                <input type="hidden" name="PersonalFunction_PhotosID" value="{{ $personalFunction->PersonalFunction_PhotosID}}"  class="form-control" placeholder="Title">
                                <strong>Title:</strong>
                                <input type="text" name="Title" value="{{ $personalFunction->Title }}"  class="input-text" placeholder="Title">
                            </div>
                            <div class="col-md-12">
                                <strong>Description:</strong>
                                <textarea type="text" name="Description" class="input-text"  rows="10" placeholder="Description">{{ $personalFunction->Function_Content }}</textarea>
                                
                            </div>
                        </div>
                        <div class="form-row">
                                <label for="FunctionDate"><strong>Personal Function Date</strong></label>
                                <input type="date"  name="FunctionDate" class="input-text" placeholder="Meeting Date" value ="{{ date('Y-m-d',strtotime($personalFunction->FunctionDate) ) }}"  required>
                        </div>
                        <div class="form-row">
                                    <label for="Category"><strong>Functions Category</strong></label>
                                    <select name="Category" id="Category"  class="input-text"  >
                                            <option value="" disabled selected>Select Category</option>
                                            <option value="General"      {{$personalFunction->Category == 'General'?'selected':''}}>General </option>
                                            <option value="Birthday"     {{$personalFunction->Category == 'Birthday'?'selected':''}}>Birthday </option>
                                            <option value="60marriage"   {{$personalFunction->Category == '60marriage'?'selected':''}}>60th Marriage</option>
                                            <option value="70marriage"   {{$personalFunction->Category == '70marriage'?'selected':''}}>70th Marriage</option>
                                            <option value="80marriage"   {{$personalFunction->Category == '80marriage'?'selected':''}}>80th Marriage</option>
                                            <option value="Naming"       {{$personalFunction->Category == 'Naming'?'selected':''}}>Naming Ceremony</option>
                                            <option value="Maturity"     {{$personalFunction->Category == 'Maturity'?'selected':''}}>Maturity Ceremony</option>
                                            <option value="HouseWarming" {{$personalFunction->Category == 'HouseWarming'?'selected':''}}>House Warming Ceremony</option>
                                            <option value="BabyShower"   {{$personalFunction->Category == 'BabyShower'?'selected':''}}>Baby Shower</option>
                                    </select>
                         </div>
                         <div class="row">
                            <div class="form-row col-md-12">
                                    <!-- Aruna - current image is not coming properly . must check -->
                                    <!-- changes by Aruna due to storing whole file path in DB-->
                                   <p><label >@lang('home.templefunc_alreadyuploaded_photo')</label> </p>
                                   <img class="img" src="{{ $personalFunction->Photo }}">  
                            </div>
                            <div class="col-md-12">
                                <strong>Upload File:</strong>
                                <input type="file" name="Photo" id="Photo" onchange="checkfile()" class="input-text"><br/><br/>
                                <p class="error-block" id="Photo_error" style="color:red;"></p>
                            </div>
                        </div>
                        <div class="row">
                           <p> <label >@lang('home.templefunc_alreadyuploaded_video')</label></p>
                            @if($personalFunction->Video != '')
                                            <video width="340" height="215" controls>
                                                <source src="{{ $personalFunction->Video }}" type="video/mp4">
                                            </video>
                            @endif
                        </div>
                          <!--  chnaged by Aruna - will do Video later-->
                            <div class="form-row">
                                    <label for="Video">@lang('home.templefunc_create_video') (Optional)</label>
                                    <input type="file" name="Video" id="Video" onchange="checkvideofile()"  class="input-text"><br/>
                                    <p style="font-family: 'Sen', sans-serif;font-size:16px;">@lang('home.note'): @lang('home.templefunc_create_msg') </p>
                                    <p class="error-block" id="Video_error" style="color:red;"></p>
                            </div> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                           
                            <input type="submit"   class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="@lang('home.matrimonys_create_finalsubmitbtn')">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('personalfunctions.index') }}"><input type="button" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" class="register" value="@lang('home.templefunc_create_cancel')"></a>
            
                        </div>
                        </div>
                    </div>
                    </form>

                <?php } else {?>
                        <p> <h2 style="font-family: 'Sen', sans-serif;"> Sorry unable to get details of the function. Try again ! </h2> <p>
                <?php } ?>
        </div><!--end div form-v5-content  -->
</div><!-- end div page-content   -->

@include('sweetalert::alert')

@endsection
