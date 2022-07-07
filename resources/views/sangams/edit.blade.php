@extends('layouts.app1')

@section('content')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Sangam Meeting</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('sangammeetings.index') }}"> Back</a>

        </div>

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



<form action="{{ route('sangammeetings.update',$sangammeeting->SangamMeeting_PhotosID) }}" method="POST" enctype="multipart/form-data">

    @csrf

    @method('PUT')



     <div class="row">

        <div class="col-md-12">
            
            <strong>Title:</strong>

             <input type="text" name="Title" value="{{ $sangammeeting->Title }}"  class="form-control" placeholder="Title"><br/><br/>

        </div>
        
     <div class="col-md-12">

    <strong>Description:</strong>
   
    <textarea type="text" name="Description" class="form-control"  rows="15" placeholder="Description">{{ $sangammeeting->Description }}</textarea>
    <br/><br/>
    </div>

     <div class="col-md-12">

        <strong>Upload File:</strong>

        <input type="file" name="Photo" id="Photo"onchange="checkfile()" class="form-control"><br/><br/>
<p id="Photo_error" style="color:red"></p>
    </div>




        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

          <button type="submit"  class="btn btn-info">Submit</button>

        </div>

    </div>



</form>



@endsection
