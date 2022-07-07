@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Elders/Edit.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for Editing FAQ Posts
// created date - Nov 2019
**/ --}} -->


<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Your Post</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('elders') }}"> Back</a>

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


<?php if(isset($faq)) {?>
<form action="{{ route('elders.update',$faq->FAQ_PostID) }}" method="POST" enctype="multipart/form-data">

    @csrf

    @method('PUT')



     <div class="row">

        <div class="col-md-12">
            
            <strong>Title:</strong>

             <input type="text" name="Title" value="{{ $faq->FAQ_Title }}"  class="form-control" placeholder="Title"><br/><br/>

        </div>
        
     <div class="col-md-12">

    <strong>Description:</strong>
   
    <textarea type="text" name="Description" class="form-control"  rows="15" placeholder="Description">{{ $faq->FAQ_Body }}</textarea>
    <br/><br/>
    </div>

     <div class="col-md-12">

        <strong>Upload File:</strong>

        <input type="file" name="Photo" class="form-control" id="Photo" ><br/><br/>
        <p class="error-block" id="Photo_error" style="color:red;"></p>

    </div>




        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

          <button type="submit" onclick="photocheck()" class="btn btn-info">Submit</button>

        </div>

    </div>
  </form>

<?php } else {?>
    <p> <h2> Sorry unable to get details of the FAQ. Try again ! </h2> <p>
<?php } ?>

@endsection
