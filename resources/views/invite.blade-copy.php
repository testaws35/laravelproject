@extends('layouts.app1')

<!--{{-- /**
// classname - Invite.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This blade represents the Invite page in User Profile
// created date - Nov 2019
**/ --}} -->


@section('content')


<div class="container" style="margin-top:-100px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-uppercase">
                  <h2 style="font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_heading') </h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('invite') }}">
                        @csrf

                    
                        <div class="form-group row">
                                    <label for="Invitee_Name" class="col-md-4 col-form-label text-md-right" style="font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_name')</label>
                                    <div class="col-md-6">
           
                                    <input id="Invitee_Name" type="text" class="form-control @error('Invitee_Name') is-invalid @enderror"  name="Invitee_Name" value="{{ old('Invitee_Name') }}" required autofocus>
                                        @error('Invitee_Name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                         </div>
                       
                        <div class="form-group row">
                                <label for="Mobile_Number" class="col-md-4 col-form-label text-md-right" style="font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_mobileno')</label>
    
                                <div class="col-md-6">
                                    <input id="Mobile_Number" type="text" class="form-control @error('Mobile_Number') is-invalid @enderror"  name="Mobile_Number" value="{{ old('Mobile_Number') }}" required autofocus>
                                    @error('Mobile_Number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="font-family: 'Sen', sans-serif;">@lang('home.myprofile_show_invite_email')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autofocus>
                               
                            </div>
                        </div>
               
                         <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;">
                                    @lang('home.myprofile_show_invite_sendbtn')
                                </button>
                            </div>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')

@endsection