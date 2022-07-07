@extends('layouts.app1')

@section('content')

 <!-- Start Contact Area -->
 <section class="wn_contact_area bg--white pt--80 pb--80">
 <!--  {{--   <div class="google__map pb--80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="googleMap"></div>
                </div>
            </div>
        </div>
    </div> --}} -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="contact-form-wrap">
                    <h2 class="contact__title" style="font-family: 'Sen', sans-serif;
                    ">@lang('home.contact_getin_touch')</h2>
                    <p style="font-family: 'Sen', sans-serif;
                    ">@lang('home.contact_sub_msg')  </p>
                    
                                            
                    
                    {!! Form::open(['route'=>'contactus.store']) !!}
                     <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" style="font-family: 'Sen', sans-serif;">
                    @lang('home.matrimonys_create_basicdetails_name')
                    <input type="text" class="form-control" name="name" placeholder="@lang('home.contact_name_placeholder')" required>
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}" style="font-family: 'Sen', sans-serif;
                        ">
                    @lang('home.footer_sub_head_con_emailaddress')
                    <input type="email" class="form-control" name="email" placeholder="@lang('home.contact_email_placeholder')" required>
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}" style="font-family: 'Sen', sans-serif;
                        ">
                    @lang('home.contact_message')
                    <textarea class="md-textarea form-control" name ="message" rows="3" placeholder="@lang('home.contact_message_placeholder')" required></textarea>
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                    </div>
                    <div class="form-group" style="font-family: 'Sen', sans-serif;
                    ">
                    <button class="btn" style="background: #f82249;font-family: 'Sen', sans-serif;color:#fff;border-bottom-right-radius:25px;border-top-left-radius:25px;"> @lang('home.contact_sendmessage_btn')</button>
                    </div>
                    {!! Form::close() !!}
                </div> 
                <div class="form-output">
                    <p class="form-messege">
                </div>
            </div>
            <div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
                <div class="wn__address">
                    <h2 class="contact__title" style="font-family: 'Sen', sans-serif;">@lang('home.contact_get_info')</h2>
                    <p style="font-family: 'Sen', sans-serif;">@lang('home.contact_get_msg')</p>
                    <div class="wn__addres__wreapper">

                        <div class="single__address">
                            <i class="fa fa-map-marker fa-2x"></i>
                            <div class="content">
                                <span style="font-family: 'Sen', sans-serif;">@lang('home.matrimonys_create_basicdetails_address'):</span>
                                <p style="font-family: 'Sen', sans-serif;font-size:16px;">@lang('home.con_address')</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="fa fa-phone fa-2x"></i>
                            <div class="content">
                                <span style="font-family: 'Sen', sans-serif;">@lang('home.contact_mobile_number'):</span>
                                <p style="font-family: 'Sen', sans-serif;font-size:16px;">@lang('home.con_number')</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="fa fa-envelope-open fa-2x"></i>
                            <div class="content">
                                <span style="font-family: 'Sen', sans-serif;">@lang('home.footer_sub_head_con_emailaddress')</span>
                                <p style="font-family: 'Sen', sans-serif;font-size:16px;">info@telunguviswakarma-tn.in</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="fa fa-globe"></i>
                            <div class="content">
                                <span style="font-family: 'Sen', sans-serif;">@lang('home.contact_website')</span>
                                <p style="font-family: 'Sen', sans-serif;font-size:16px;">www.tecpleglobal.com</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->
@include('sweetalert::alert')  


@endsection




   



