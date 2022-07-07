{{-- Aruna remove this file
    
@extends('layouts.app1')

@section('content')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Edit Help Comments</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('helpposts.index') }}"> Back</a>

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



<form action="{{ route('helpposts.update', $helppost->HelpID) }}" method="POST">


    <input type="hidden" name="_method" value="PUT">

    @csrf

     <div class="row">

        <div class="col-md-12">
            
            <strong>Title:</strong>

             <input type="text" name="Type" value="{{ $helppost->Type }}"  class="form-control" placeholder="Type" disabled><br/><br/>


        </div>
        
     <div class="col-md-12">

    <strong>Description:</strong>
   
    <textarea type="text" name="Description" class="form-control"  rows="15" placeholder="Description">{{ $helppost->Description }}</textarea>
    <br/><br/>
    </div>

 




        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

          <button type="submit" class="btn btn-info">Update</button>

        </div>

    </div>



</form>



@endsection
--}}