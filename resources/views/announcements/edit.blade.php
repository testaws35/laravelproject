@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Announcements/Edit.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for editing Announcements
// created date - Nov 2019
**/ --}} -->



  <div class="page-content">
        <div class="form-v5-content">
                <div class="row">
                    <div class="col-lg-12 margin-tb"><br/>
                        <h2 class="text-center">@lang('home.announcements_edit_head')</h2>
                    </div>
                </div>


        <!-- Aruna added such a IF staement is used in all input forms to capture error from HTML validation
                                    and show it in the blade -->
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

        <?php if(isset($announcement)) {?>
                <form class="form-detail" action="{{ route('announcements.update',$announcement->AnnouncementsID) }}" method="POST" enctype="multipart/form-data">
                        <!--Aruna added  Either you can use a hidden control and set its value as csrf_token()  
                            or use csrffield  0r simply use atsymbolcsrf as below. This is necessary to pass data between HTML and PHP -->
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <strong>@lang('home.templefunc_create_title'):</strong>
                                <input type="hidden" name="AnnouncementsID" value="{{ $announcement->AnnouncementsID }}"  class="form-control" placeholder="Title">
                                <input type="hidden" name="Announcements_PhotosID" value="{{ $announcement->Announcements_PhotosID}}"  class="form-control" placeholder="Title">
                                <!-- Aruna added -  setting value= $announement->Title        sets the value in the control-->
                                <input type="text" name="Title" value="{{ $announcement->Title }}"  class="input-text" placeholder="Title">
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <strong>@lang('home.templefunc_edit_desc'):</strong>
                                <textarea type="text" name="Description"  class="input-text"  rows="10" placeholder="Description">{{  $announcement->Function_Content }}</textarea>
                                
                            </div>
                            <div class="form-row col-md-12 col-xs-12 col-sm-12">
                                    <label for="FunctionDate">  <strong>@lang('home.announcements_create_funcdate') </strong></label>
                                    <input type="date"  name="FunctionDate" class="input-text" placeholder="Meeting Date"  value ="{{ date('Y-m-d',strtotime($announcement->FunctionDate) ) }}" >
                            </div>
                            <div class="form-row col-md-12 col-xs-12 col-sm-12">
                                        <label for="Category">  <strong>@lang('home.announcements_create_anncategory') </strong></label>
                                     
                                        <select name="Category" id="Category"  class="input-text"  >
                                                <option value="" disabled selected>Select Category</option>
                                                <option value="General" {{$announcement->Announcement_Category == 'General'?'selected':''}}>General </option>
                                                <option value="Temple" {{$announcement->Announcement_Category == 'Temple'?'selected':''}}>Temple </option>
                                                <option value="Sangam" {{$announcement->Announcement_Category == 'Sangam'?'selected':''}}>Sangam</option>
                                                <option value="Promotion" {{$announcement->Announcement_Category == 'Promotion'?'selected':''}}>Promotion</option>
                                                <option value="Invitation" {{$announcement->Announcement_Category == 'Invitation'?'selected':''}}>Invitation</option>
                                                <option value="Death" {{$announcement->Announcement_Category == 'Death'?'selected':'' }}> Death </option>
                                                <option value="Funeral" {{$announcement->Announcement_Category == 'Funeral'?'selected':''}}>Funeral</option>
                                        </select>
                            </div>
                            <div class="form-row col-md-12">
                                <!-- Aruna - current image is not coming properly . must check-->
                                  <p><label >@lang('home.templefunc_alreadyuploaded_photo')</label> </p>
                                <img class="img" src="{{$announcement->Photo}}">  
                            </div>
                            <div class="form-row col-md-12">
                                <strong>@lang('home.templefunc_edit_file'):</strong>
                                 <input type="file" name="Photo" class="input-text" id="Photo" onchange="checkfile()"><br/><br/>
                                 <p class="error-block" id="Photo_error" style="color:red;"></p>
                            </div>
                            <div class="row">
                               <p> <label >@lang('home.templefunc_alreadyuploaded_video')</label></p>
                                @if($announcement->Video != '')
                                                <video width="340" height="215" controls>
                                                    <source src="{{ $announcement->Video }}" type="video/mp4">
                                                </video>
                                @endif
                            </div>
                              <!--   We will add Video upload later-->
                            <div class="form-row">
                                <label for="Video">@lang('home.templefunc_create_video') (Optional)</label>
                                <input type="file" name="Video" id="Video" onchange="checkvideofile()"  class="input-text"><br/>
                                <p style="font-family: 'Sen', sans-serif;">@lang('home.note'): @lang('home.templefunc_create_msg') </p>
                                <p class="error-block" id="Video_error" style="color:red;"></p>
                            </div> 
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <input type="submit"   class="register" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" value="@lang('home.matrimonys_create_finalsubmitbtn')">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('announcements.index') }}"><input type="button" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" class="register" value="@lang('home.templefunc_create_cancel')"></a>

                            </div>
                        </div>

            </form>

        <?php } else {?>
                <p> <h2> Sorry unable to get details of the Announcement. Try again ! </h2> <p>
        <?php } ?>



</div><!--end div form-v5-content  -->
</div><!-- end div page-content   -->

@include('sweetalert::alert')

@endsection
