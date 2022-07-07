@extends('layouts.app1')
@section('content')

<!--  Bradcaump area -->
<div class="page-blog-details section-padding--lg bg--white">
        <div class="container">
            <div class="row">
            <?php if (  isset($sangam)    ) { ?>
                 <div class="col-lg-9 col-12">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post-thumbnail">
                                <h2 class="text-center"><b style="font-family: 'Sen', sans-serif;">{{ $sangam->Sangam_Name  }}</b> <a href="/community" class="pull-left" title="Back to sangams"><b style="font-size:15px; margin-left: 25px;"><i class="fa fa-arrow-left fa-3x"></i></b></a> </h2>
                                <div class="card-header card-header-image">
                                        <a href="#">
                                            <img class="img-thumbnail" src="{{ $sangam->Sangam_Photo }}"  class="img-thumbnail" style="max-height: 300px;width:300px;">
                                        </a>
                                        <div class="colored-shadow" style="background-image: url('{{ $sangam->Sangam_Photo }}');opacity: 1;">
                                        </div>
                                </div>
                            </div>
                            <div class="post_wrapper">
                            <div class="post_header">

                                <table class="table table-bordered table-striped text-center">
                                        <tbody style="boder:none">
                                            <tr>
                                                    <td><b>@lang('home.templefunc_edit_desc')</b></td>
                                                    <td> {{ $sangam->Sangam_Description }}</td>
                                            </tr>
                                            <tr >
                                                    <td><b>@lang('home.sangams_create_funcdate')</b></td>
                                                    <td>  {{ $sangam->Sangam_StartedOn }}</td>
                                            </tr>
                                            <tr>
                                                    <td><b>@lang('home.sangams_create_sanloc')</b></td>
                                                    <td> {{ $sangam->Sangam_Location }}</td>
                                            </tr>
                                            <tr>
                                                    <td><b>@lang('home.sangams_create_sanact')</b></td>
                                                    <td> {{ $sangam->Sangam_Activities }}</td>
                                            </tr>
                                            <tr>
                                                    <td><b>@lang('home.sangams_create_nomem')</b></td>
                                                    <td>  {{ $sangam->Num_of_members }}</td>
                                            </tr>
                                            <tr>
                                                    <td><b>@lang('home.posted_by')</b></td>
                                                    <td>  {{ $sangam->name }}</td>
                                            </tr>
                                        </tbody>
                                </table>   
                         </div>
                        </article>
                        <?php } else {   ?>

                            <p> <h4 class="alert alert-info"> Sorry... This sangam is not found</h4> </p>
                            <?php } ?>
                        <div class="col-lg-8 col-8 md-mt-60 sm-mt-60">
                                <div class="wn__sidebar">
                                <!-- Start Single Widget --><br/>
                                    <aside class="widget recent_widget">
                                        <h3 class="widget-title">Members</h3>
                                        <div class="recent-posts">
                                            <ul >
                                                <li >
                                                @if (isset($members)  )
                                                    @foreach ($members as $member)
                                                            <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"> 
                                                                    @if($member->User_photo )
                                                                        <a href="{{ route('profile.index',$member->id) }}" style="text-decoration:none;font-family: 'Sen', sans-serif;"><img src="{{ $member->User_photo }}" alt="user" class="rounded-circle"  width="50" height="50">&nbsp;&nbsp;&nbsp;&nbsp; {{$member->name}} serving as {{$member->Position}}, since  {{$member->MembersFromWhen}} </a>
                                                                    @else 
                                                                        <a href="{{ route('profile.index',$member->id) }}" style="text-decoration:none;font-family: 'Sen', sans-serif;"><img class="img-thumbnail" src="/images/frontend_images/avatar.png" alt="user" class="rounded-circle"  width="50" height="50">&nbsp;&nbsp;&nbsp;&nbsp; {{$member->name}} serving as {{$member->Position}}, since  {{$member->MembersFromWhen}} </a>
                                                                    @endif
                                                                    <p>
                                                                   
                                                            </div><hr>
                                                    @endforeach
                                                @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </aside>
                                    <!-- End Single Widget -->
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__sidebar">
                      <!-- Start Single Widget --><br/>
                        <aside class="widget recent_widget">
                            <h3 class="widget-title">@lang('home.sangams_create_recentposts')</h3>
                            <div class="recent-posts">
                                <ul >
                                    <li >
                                        @if (isset($sangams) )
                                            @foreach ($sangams->take(5) as $sangam1)
                                                    <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"> 
                                                            @if($sangam1->Sangam_Photo )
                                                                <a href="{{ route('sangams.show',$sangam1->SangamID) }}" style="text-decoration:none;font-family: 'Sen', sans-serif;"><img src="{{ $sangam1->Sangam_Photo }}" alt="personalfunction" class="rounded-circle"  width="50" height="50">&nbsp;&nbsp;&nbsp;&nbsp;{{ $sangam1->Sangam_Name }}</a>
                                                            @else 
                                                                <img class="img-thumbnail" src="/images/frontend_images/avatar.png" alt="personalfunctions" class="rounded-circle"  width="50" height="50">
                                                            @endif
                                                    </div><hr>
                                             @endforeach
                                        @endif
                                    </li>
                                 </ul>
                            </div>
                        </aside>
                        <!-- End Single Widget -->
                       
                    </div>
                </div>
                
            </div><!-- END ROW-->
         </div>
    </div><!-- END Bradcaump area -->
@endsection
