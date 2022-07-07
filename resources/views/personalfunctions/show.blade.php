@extends('layouts.app1')
@section('content')

<style>
      
   .text-left{
        text-align:left;
    }
     .myml-4{
        margin-left:-60px;
        width:100%;
        
    }
    .text-center{
        text-align:center !important;
    }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- End Bradcaump area -->
<div class="page-blog-details  bg--white">
        <div class="container">
               
            <div class="row myml-4">
                   
                <div class="col-lg-10 col-md-10  col-12">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post-thumbnail">
                                <h2 class="text-left" style="font-family: 'Sen', sans-serif;">   <b>{{ $personalfunction->Title }}  </b> </h2>
    
                                <div class="row blog-date-categori">
                                                     <div class="col-md-6 text-left">
                                                      <h5 > <strong>{{ date('d-M-Y', strtotime($personalfunction->FunctionDate )) }}</strong></h5>
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <h5 > <strong> @lang('home.posted_by')  : {{ $personalfunction->name }}</strong></h5>
                                                     </div>
                               </div>
                                   
                                <div class="card-header" style="margin-left:-20px;" >
                                     <div style="width: 650px; margin: 0px auto;">
                                            <div id="myCarouselBig" class="carousel slide" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner">
                                                    
                                                    <div class="item active">
                                                        <div class="col-xs-12 mySlides">
                                                            @if($personalfunction->Photo != '')
                                                                  <a href="#">
                                                                   <img class="img-responsive1" src="{{ $personalfunction->Photo }}" style="width:619px;height:438px;">
                                                                  </a>
                                                           @elseif($personalfunction->Video != '')
                                                            <video class="img-responsive1" controls>
                                                                    <source src="{{ $personalfunction->Video }}" type="video/mp4">
                                                            </video>
                                                            @else
                                                                <img src="/images/No-image2.png" alt="photo">
                                                           @endif
                                                           
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    @if($personalfunction->Video != '')
                                                    <div class="item">
                                                        <div class="col-xs-12 mySlides" style="display:block !important;">
                                                            
                                                           
                                                                <video class="img-responsive1" controls>
                                                                    <source src="{{ $personalfunction->Video }}" type="video/mp4">
                                                                </video>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                        
                                                <a class="left carousel-control" href="#myCarouselBig" role="button" data-slide="prev" style="margin-left:-130px;">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#myCarouselBig" role="button" data-slide="next" style="margin-right:-130px;">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        
                                            <div id="myCarousel" class="carousel slide" style="margin-top:15px;">
                                        
                                                <div class="carousel-inner">
                                                    <div class="item active">
                                                        <div class="col-xs-3" style="width:100px;height:100px">
                                                            @if($personalfunction->Photo != '')
                                                                  <a href="#">
                                                                   <img class="img-responsive demo" src="{{ $personalfunction->Photo }}" onclick="currentSlide(1)" >
                                                                  </a>
                                                           
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="item" style="display:block;">
                                                        <div class="col-xs-3" style="width:100px;height:100px" >
                                                            
                                                            @if($personalfunction->Video != '')
                                                                <video class="img-responsive demo" controls>
                                                                    <source src="{{ $personalfunction->Video }}" type="video/mp4" onclick="currentSlide(2)">
                                                                </video>
                                                            @else
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                        
                                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="display: none;">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="display: none;">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        
                                        </div>
                                            
    
                                </div>
  
                                <div class="row post_wrapper">
                               <!--     <div class="post_header">
                                        <div class="row blog-date-categori" >-->
                                            <div class="col-10">
                                             &nbsp;
                                            </div>
                                            <div class="col-2">
                                                         <!--     {{-- Edit button will be shown if User is Admin   or if the user is the author of the post and he can edit within 30 days --}} -->
                         
                                                        <?php if(  (Auth::user()->userroleID==2) ||   (  ( $personalfunction->Createdby == Auth::user()->id) )  )        {  ?>
                                                            <a onclick="return myEdit();" href="{{ route('personalfunctions.edit',$personalfunction->PersonalFunctionID) }}"><b style="font-size:10px;"><img src="/images/frontend_images/icons/user-edit-solid.svg" style="width:20px;height:20px;"title="Edit Personal function"></i> </b></a> 
                                                             &nbsp;&nbsp;
                                                        <?php }?>
                                                        <?php if($personalfunction->Createdby == Auth::user()->id)  {  ?>   
                                                            <a onclick="return myDelete();" href="{{ route('personalfunctions.destroy',$personalfunction->PersonalFunctionID) }}"><b style="font-size:10px;"><img src="/images/frontend_images/icons/trash-alt-solid.svg" style="width:20px;height:20px;"/> </b></a> 
                                                             &nbsp;&nbsp;
                                                        <?php }?>
                                            </div>
                                       </div>
                                <hr/>
                                <div class="post_content">
                                   <p> {{ $personalfunction->Function_Content }}</p>
                                </div>
                                <hr/>
                                <!--<div class="post_content">
                                    @if($personalfunction->Video != '')
                                            <video width="100%" height="415" controls>
                                                <source src="{{ $personalfunction->Video }}" type="video/mp4">
                                            </video>
                                    @endif
                                </div>-->
 
                            </div>
                        </article>
                    </div>
                </div>

                {{-- RHS Panel--}}
                    <div class="col-lg-2 col-12 ">
                    <div class="wn__sidebar">
                       
                        <!-- Start Single Widget -->
                        <aside class="widget recent_widget">
                            <a href="{{ route('personalfunctions.index') }}" class="pull-left" title="Back to Personal Functions"><b style="font-size:10px;">@lang('home.back_personal')</b></a>
                            <h3 class="widget-title"><small>@lang('home.recent_functions')</small></h3>
                            <div class="recent-posts">
                                <ul>
                                    <li>
                                        @if( isset($personalfunctions) )
                                            @foreach ($personalfunctions->take(5) as $personalfunction)
                                            <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"> 
                                           
                                                   @if($personalfunction->Photo )
                                                    <a href="{{ route('personalfunctions.show',$personalfunction->PersonalFunctionID) }}" style="text-decoration:none; "><img src="{{ $personalfunction->Photo }}" alt="/images/personalfunctions/personalfunction_default.png" class="rounded-circle"  width="30" height="30">&nbsp; {{ $personalfunction->Title }}</a>
                                                    @else 
                                                    <img class="img-thumbnail" src="/images/frontend_images/avatar.png" alt="personalfunctions" class="rounded-circle"  width="30" height="30">
                                                   @endif
                                           </div>
                                           <hr>
                                        @endforeach
                                        @endif
                                    </li>
                                    
                                   </ul>
                            </div>
                        </aside>
                        <!-- End Single Widget -->
                           <!-- Start Archives Widget -->
                           <aside class="wedget__categories poroduct--cat">
                                <h3 class="wedget__title"><b> @lang('home.templefunc_index_lhsarch') </b></h3>
                                <ul>
                                    <li><a href="{{ url('/personalfunctions/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/personalfunctions/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/personalfunctions/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/personalfunctions/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/personalfunctions/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/personalfunctions/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                
                                </ul>
                            </aside>
                          <!-- End Archives Widget -->
                       </div>
                </div>
                
            </div><!-- END ROW-->
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
