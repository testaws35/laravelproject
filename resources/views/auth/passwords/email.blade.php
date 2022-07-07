@extends('layouts.welcome')

@section('content')<br/><br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid #f82249;">
                <div class="card-header text-center text-white" style="background: #f82249;font-family: 'Sen', sans-serif;"><h3>@lang('home.reset_heading')</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="color: #f82249;font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_email')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn email_btn" >
                                  @lang('home.matrimonys_create_finalsubmitbtn')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><br/><br/>
 
 @include('inc.footer')
    
    
      <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

@endsection
