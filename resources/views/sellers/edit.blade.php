@extends('layouts.app1')

@section('content')


<div class="page-content">
        <div class="form-v5-content">
            <form class="form-detail"  action="{{ route('sellers.update') }}" method="POST"  enctype="multipart/form-data">
                @csrf
               
            
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
              
              <input type="hidden" name="SellerID" value="{{$seller->SellerID}}">
                     

                <h2> Seller Edit Post</h2>
                <div class="form-row">
                    <label for="Name">Name</label>
                    <input type="text" name="Name" maxlength="200" class="input-text inputchar" value="{{ $seller->Name }}" placeholder="Name" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='Name'">
                    {{-- <i class="fas fa-user"></i> --}}
                </div>
                 <div class="form-row">
                    <label for="CompanyName">Company Name</label>
                    <input type="text" name="CompanyName" maxlength="200" class="input-text inputchar" value="{{ $seller->CompanyName }}" placeholder="Company Name" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='CompanyName'">
                 </div>
                 
    
                   <div class="form-row">
                    <label for="Description">Description</label>
                    
                    <textarea type="text" name="Description" maxlength="255" rows="5" class="input-text inputchar" placeholder="Description" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='Description'">{{ $seller->Description }}</textarea>
                </div>
    
                <div class="form-row">
                        <label for="Location">Location</label>
                        <input type="text" name="Location" maxlength="255" class="input-text inputchar" value="{{ $seller->Location }}" placeholder="Location" required oninput="this.className = ''"  onfocus="this.placeholder=''" onblur="this.placeholder='Location'">
                        
                 </div>
                   
                  <div class="form-row-last">
                    <input type="submit"  class="register" value="Submit" style="background: #f82249;font-family: 'Sen', sans-serif;color: #fff;border-bottom-right-radius: 25px;border-top-left-radius: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('community') }}"><input type="button" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;" class="register" value="@lang('home.templefunc_create_cancel')"></a>
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
    
    



@endsection
