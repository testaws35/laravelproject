@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Helpposts/Edit.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for editing FAQ
// created date - Nov 2019
**/ --}} -->

    <div class="page-content" style="margin-top:0px !important;">
        <div class="row">
            @if (count($errors) > 0)
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
    </div>
            @endif
        
            <?php if(isset($helppost)) {?>
        
                <form action="{{ route('helpposts.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <img src="{{ $helppost->Photo}}"  style="width:100px;height:100px;align:center;"/><br><br>
                        <div class="col-md-12">
                            <input type="file" name="Photo" class="input-text" id="Photo" onchange="checkfile()">
                            <input type="hidden" name="photo_old" value="{{$helppost->Photo}}" >
                            <p class="error-block" id="Photo_error" style="color:red;"></p>
                        </div>
                        <div class="col-md-12">
                            
                            <strong>Title:</strong>
                                
                             <input type="text" name="Type" value="{{ $helppost->Type }}"  class="form-control" placeholder="Type" disabled><br/><br/>
                             <input type="hidden" name="HelpID" value="{{ $helppost->HelpID }}"  class="form-control"><br/><br/>
                        </div>
                        
                        <div class="col-md-12">
                
                            <strong>Description:</strong>
                           
                            <textarea type="text" name="Description" class="form-control"  rows="15" placeholder="Description">{{ $helppost->Description }}</textarea>
                            <br/><br/>
                        </div>
                
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                
                          <input type="submit" class="btn btn-info" value="Update">
                
                        </div>
                
                    </div>
            </form>
        
            <?php } else {?>
                <p> <h2> Sorry unable to get details of the Help Post. Try again ! </h2> <p>
            <?php } ?>
        </div>
    </div>
@endsection
