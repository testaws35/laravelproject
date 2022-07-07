@extends('layouts.app1')
@section('content')
<style>
    .myml-4{
        margin-left:-60px;
        width:100%;
        
    }
    .text-left{
        text-align:left;
    }
    .pull-right{
        text-align:center !important;
    }
    .wn__sidebar{
        margin-top:-70px;
        width:100%;
        
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- End Bradcaump area -->
<div class="page-blog-details section-padding--lg bg--white">
        <div class="container">
            <div class="row myml-4">
                 <div class="col-lg-10 col-md-10 col-12">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post-thumbnail">
                            <h2 class="text-left" style="font-family: 'Sen', sans-serif;margin-top:-70px;"><b>{{ $templefunction->Title }}</b>    </h2>
                               <div class="row blog-date-categori">
                                  <div class="col-md-6 text-left">
                                  <h5 > <strong>{{ date('d-M-Y', strtotime($templefunction->FunctionDate )) }}</strong></h5>
                                  </div>
                                  <div class="col-md-6 pull-right">
                                  <h5 > <strong><!--Posted By--> @lang('home.posted_by')  : {{ $templefunction->name }}</strong></h5>
                                   </div>
                               </div>
                                <div class="card-header card-header-image" style="margin-left:-20px;">
                                    <div style="width: 650px; margin: 0px auto;">
                                            <div id="myCarouselBig" class="carousel slide" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="item active">
                                                        <div class="col-xs-12 mySlides">
                                                            @if($templefunction->Photo != '')
                                                                  <a href="#">
                                                                   <img class="img-responsive1" src="{{ $templefunction->Photo }}" style="width:619px;height:438px;">
                                                                  </a>
                                                            @elseif($templefunction->Video != '')
                                                                <video class="img-responsive1" controls>
                                                                    <source src="{{ $templefunction->Video }}" type="video/mp4">
                                                                </video>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="col-xs-12 mySlides" style="display:block !important;">
                                                            
                                                            @if($templefunction->Video != '')
                                                                <video class="img-responsive1" controls>
                                                                    <source src="{{ $templefunction->Video }}" type="video/mp4">
                                                                </video>
                                                            
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
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
                                                            @if($templefunction->Photo != '')
                                                                  <a href="#">
                                                                   <img class="img-responsive demo" src="{{ $templefunction->Photo }}" onclick="currentSlide(1)" >
                                                                  </a>
                                                           
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="item" style="display:block;">
                                                        <div class="col-xs-3" style="width:100px;height:100px" >
                                                            
                                                            @if($templefunction->Video != '')
                                                                <video class="img-responsive demo" controls>
                                                                    <source src="{{ $templefunction->Video }}" type="video/mp4" onclick="currentSlide(2)">
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
                            </div>

                            <div class="post_wrapper">
                                <div class="row post_header">
                                        <div class="col-10">
                                              <div class="post_content">
                                                   <p><b class="text-uppercase"><strong>@lang('home.temple_name') : </strong> </b> {{ $templefunction->Temple_Name }}</p>
                                               </div>
                                        </div>
                                            <!-- {{-- Edit button will be shown if User is Admin 
                                             or if the user is the author of the post and he can edit within 30 days --}}-->
                                        <div class="col-2">       
                                            <?php if(($templefunction->Createdby == Auth::user()->id)) 
                                                  {  ?>
                                                <a href="{{ route('templefunctions.edit',$templefunction->TempleFunctionID) }}" ><b style="font-size:10px;"><img src="/images/frontend_images/icons/user-edit-solid.svg" style="width:20px;height:20px;"/> </b></a> 
                                               &nbsp;
                                            <?php }?>
                                            <?php if($templefunction->Createdby == Auth::user()->id)  {  ?>
                                                        <a href="{{ route('templefunctions.delete',$templefunction->TempleFunctionID) }}"  onclick="myFunctionDelete1()"><b style="font-size:10px;"><img src="/images/frontend_images/icons/trash-alt-solid.svg" style="width:20px;height:20px;margin-top:-2px;"/> </b></a> 
                                                      
                                             <?php }?>   
                                                
                                                            <script>
                                                              function myFunctionDelete1() {
                                                                    if(!confirm("Are you sure you want to delete this Function?"))
                                                                    {
                                                                    event.preventDefault();
                                                                      }
                                                              }
                                                            </script>
                                        </div>
                                   
                                </div>
                                <hr/>
                               
                                <div class="post_content">
                                    <p> {{ $templefunction->Function_Content }}</p>
                               </div>
                              
                              
                               <hr/>
                               <!--<div class="post_content">
                                    @if($templefunction->Video != '')
                                            <video width="100%" height="415" controls>
                                                <source src="{{ $templefunction->Video }}" type="video/mp4">
                                            </video>
                                    @endif
                               </div>-->
                           </div>
                        </article>
                     </div>
                </div>

                <div class="col-lg-2 col-12 col-md-2">
                        <div class="wn__sidebar">
                           <!-- Start Single Widget -->
                            <aside class="widget recent_widget">
                                <a href="{{ route('templefunctions.index') }}" class="pull-left" title="Back to Temple Functions"><b style="font-size:10px;">@lang('home.back_temple')</b></a> 
                                <h3 class="widget-title">@lang('home.recent_functions')<!--Recent Functions--></h3>
                                <div class="recent-posts">
                                    <ul>
                                        <li>
                                        @if( isset($templefunctions) )
                                         @foreach ($templefunctions->take(5) as $tempfunction)
                                                <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"> 
                                                    @if($tempfunction->Photo )
                                                    <a href="{{ route('templefunctions.show',$tempfunction->TempleFunctionID) }}" style="text-decoration:none;"><img src="{{ $tempfunction->Photo }}" alt="Temple Function" class="rounded-circle"  width="30" height="30">&nbsp;    {{ $tempfunction->Title }}   </a>
                                                        @else 
                                                    <img class="img-thumbnail" src="/images/frontend_images/avatar.png" alt="templefunctions" class="rounded-circle"  width="30" height="30">
                                                    @endif
                                                </div><hr>
                      
                                           @endforeach
                                        @endif
                                        </li>
                                   </ul>
                                </div>
                            </aside>
                            <!-- End Single Widget -->

      <!-- Start Single Widget -->
      <aside class="wedget__categories poroduct--cat">
            <h3 class="wedget__title"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
            <ul>
                
                <li><a href="{{ url('/templefunctions/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                <li><a href="{{ url('/templefunctions/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                <li><a href="{{ url('/templefunctions/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                <li><a href="{{ url('/templefunctions/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                <li><a href="{{ url('/templefunctions/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                <li><a href="{{ url('/templefunctions/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
              
            </ul>
        </aside>
        <!-- End Single Widget -->

                        </div>
                 </div>
        </div><!-- END ROW-->
     </div>
</div>

@endsection
