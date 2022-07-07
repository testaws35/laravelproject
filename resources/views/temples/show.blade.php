@extends('layouts.app1')
@section('content')

<!-- End Bradcaump area -->
<div class="page-blog-details section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post-thumbnail">
                            <h2 class="text-center" ><b style="font-family: 'Sen', sans-serif;">{{ $temple->Temple_Name }}</b>        <a href="/community" class="pull-left" title="Back to temples"><b style="font-size:10px;"><i class="fa fa-arrow-left fa-3x"></i></b></a> </h2>
                                <div class="card-header card-header-image">
                                         <img class="img-thumbnail" src="{{ $temple->Temple_Photo }}" style="max-height: 500px;width:300px;">
                                <div class="colored-shadow" style="background-image: url('{{ $temple->Temple_Photo }}');opacity: 1;"></div>
                            
                            </div>
                            </div>
                         <div class="post_wrapper">
                    <div class="post_header">

  <table class="table table-bordered table-striped text-center" >
        <tbody style="boder:none">
            <tr>
                <td><b>@lang('home.temples_show_godname')</b></td>
                <td>  {{ $temple->Temple_Name }}</td>
            </tr>
            <tr>
                <td><b>@lang('home.templefunc_edit_desc')</b></td>
                <td>   {{ $temple->Temple_Description }}</td>
            </tr>
            <tr >
                <td><b>@lang('home.temples_create_temon')</b></td>
                <td>  {{ $temple->Temple_StartedOn }}</td>
            </tr>
            <tr >
                <td><b>@lang('home.temples_create_temname')</b></td>
                <td>  {{ $temple->Temple_Head }}</td>
            </tr>
            <tr >
                <td><b>@lang('home.temples_show_city')</b></td>
                <td>  {{ $temple->Temple_Location }}</td>
            </tr>
            <tr >
                <td><b>@lang('home.temples_create_temadd')</b></td>
                <td>  {{ $temple->Temple_Address }}</td>
            </tr>
            <tr>
                <td><b>@lang('home.temples_show_nearcity')</b></td>
                <td> {{ $temple->Temple_Nearby_City }}</td>
            </tr>
            <tr>
                <td><b>@lang('home.temples_show_busroute')</b></td>
                <td>   {{ $temple->Temple_BusRoute }}</td>
            </tr>
            <tr>
                <td><b>@lang('home.temples_show_subsect')</b></td>
                <td> {{ $temple->Temple_OwnedBy_Subsect }}</td>
           </tr>
           <tr>
                <td><b>@lang('home.temples_create_shaany')</b></td>
                <td>  {{ $temple->Temple_SharedWith_Anyone }}</td>
           </tr>
           <tr>
                <td><b>@lang('home.posted_by')</b></td>
                <td>  {{ $temple->name }}</td>
           </tr>
        </tbody>
     </table>
    </div>
  </div>
            </article>
        </div>
</div>


                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__sidebar">
                        <!-- Start Single Widget -->
                        <aside class="widget recent_widget">
                            <h3 class="widget-title" style="font-family: 'Sen', sans-serif !important;">@lang('home.temples_create_rectemples')</h3>
                            <div class="recent-posts">
                                <ul>
                                    <li>
                                        @if( isset($temples)  )
                                            @foreach ($temples->take(5) as $temple)
                                                    <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"> 
                                                    @if($temple->Temple_Photo )
                                                        <a href="{{ route('temples.show',$temple->TempleID) }}" style="text-decoration:none;font-family: 'Sen', sans-serif; "><img src="{{ $temple->Temple_Photo }}" alt="Temple" class="rounded-circle"  width="50" height="50">&nbsp; {{ $temple->Temple_Name }}</a>
                                                    @else 
                                                        <img class="img-thumbnail" src="/images/frontend_images/avatar.png" alt="Temple" class="rounded-circle"  width="50" height="50">
                                                    @endif
                                                    </div> <hr>
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
    </div>

@endsection
