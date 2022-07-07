{{-- Aruna remove this file
    
    @extends('layouts.app1')

@section('content')

<html>

<head>

    <title>Help Comment</title>

    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 
</head>

<body>



<div class="page-content">
    <div class="form-v5-content">
        <form class="form-detail" action="{{ route('helpcomments.store') }}"  method="POST" enctype="multipart/form-data">
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
          
          
          
            <h2>See your Request</h2>

               
            <h4>Add comment</h4>
          
                <div class="form-group">
                    <input type="text" name="Description" class="form-control" placeholder="leave a comment here"/>

                    
                   {{--  <input type="hidden" name="post_id" value="{{ $comment->HelpCommentsID }}" /> 
 --
                

                </div>
               {{--  <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Add Comment" />
                </div> --
           
             <div class="form-row-last">
                <input type="submit"  class="register" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('helpcomments.index') }}"><input type="submit"  class="register" value="Cancel"></a>

            </div>
        </form>
    </div>
</div>


<script src="js/frontend_js/vendor/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-maxlength/1.7.0/bootstrap-maxlength.min.js"></script>
    <script type="text/javascript">
        $('.inputchar').maxlength({
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
    $('textarea').maxlength({
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

</body>
</html>
   
@endsection --}}
