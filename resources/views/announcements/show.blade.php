@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Announcements/Show.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used showing a specific Announcement
// created date - Nov 2019
**/ --}} -->


<style>
    .wn__sidebar .widget h3.widget-title {
       
        margin: -4px 0 25px !important;
        
    }
    
    .card-header-image:hover {
      -ms-transform: scale(1.5); /* IE 9 */
      -webkit-transform: scale(1.5); /* Safari 3-8 */
      transform: scale(1.5); 
    }
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
 <div class="container">
           <div class="row myml-4">
               
        <?php if (  isset($announcement)    ) { ?>
                <div class="col-lg-10 col-md-10 col-10">
                    <div class="post_wrapper">
                                <div class="post_header">
                                    <h2 style="font-family: 'Sen', sans-serif;" class="text-left">{{ $announcement->Title }}  
                                    <div class="row blog-date-categori">
                                              <div class="col-md-6 text-left">
                                                  <h5 > <strong>{{ date('d-M-Y', strtotime($announcement->FunctionDate )) }}</strong></h5>
                                              </div>
                                              <div class="col-md-6 text-center">
                                                 <h5 > <strong><!--Posted By--> @lang('home.posted_by')  : {{ $announcement->name }}</strong></h5>
                                               </div>
                                    </div>
                                </div>

                                <!--<div class="card card-profile">-->
                                    <div class="card-header " style="margin-left:-20px;" >
                                        <div style="width: 650px; margin: 0px auto;">
                                            <div id="myCarouselBig" class="carousel slide" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner">
                                                    
                                                    <div class="item active">
                                                        <div class="col-xs-12 mySlides">
                                                            @if($announcement->Photo != '')
                                                                  <a href="#">
                                                                   <img class="img-responsive1" src="{{ $announcement->Photo }}" style="width:619px;height:438px;">
                                                                  </a>
                                                           @elseif($announcement->Video != '')
                                                            <video class="img-responsive1" controls>
                                                                    <source src="{{ $announcement->Video }}" type="video/mp4">
                                                            </video>
                                                           @endif
                                                           
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    @if($announcement->Video != '')
                                                    <div class="item">
                                                        <div class="col-xs-12 mySlides" style="display:block !important;">
                                                            
                                                           
                                                                <video class="img-responsive1" controls>
                                                                    <source src="{{ $announcement->Video }}" type="video/mp4">
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
                                                            @if($announcement->Photo != '')
                                                                  <a href="#">
                                                                   <img class="img-responsive demo" src="{{ $announcement->Photo }}" onclick="currentSlide(1)" >
                                                                  </a>
                                                           
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="item" style="display:block;">
                                                        <div class="col-xs-3" style="width:100px;height:100px" >
                                                            
                                                            @if($announcement->Video != '')
                                                                <video class="img-responsive demo" controls>
                                                                    <source src="{{ $announcement->Video }}" type="video/mp4" onclick="currentSlide(2)">
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
                               <!-- </div>-->
                        </div>
                        <!--   {{--Aruna added Edit button will be shown if User is Admin 
                                             or if the user is the author of the post and he can edit within 30 days 
                                             ( ($announcement->CreatedOn  > date('Y-m-d', strtotime(' - 30 days'))  ) && ($announcement->CreatedOn <= date('Y-m-d'))  ) ) 
                                              ---}} -->
                     
                        
                        
                        <div class="post_wrapper">
                                <div class="row post_header">
                                        <div class="col-10">
                                              <div class="post_content">
                                               </div>
                                        </div>
                                            <!-- {{-- Edit button will be shown if User is Admin 
                                             or if the user is the author of the post and he can edit within 30 days --}}-->
                                        <div class="col-2">       
                                             <?php if($announcement->Createdby == Auth::user()->id )  {  ?>
                                                        <a href="{{ route('announcements.edit',$announcement->AnnouncementsID) }}" class="pull-center"><b style="font-size:10px;"> <img src="/images/frontend_images/icons/user-edit-solid.svg" style="width:20px;height:20px;"/></b></a> 
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                             <?php }?>   
                                             <?php if($announcement->Createdby == Auth::user()->id)  {  ?>
                                                        <a href="{{ route('announcements.delete',$announcement->AnnouncementsID) }}" class="pull-center" onclick="myFunctionDelete1()"><b style="font-size:10px;"><img src="/images/frontend_images/icons/trash-alt-solid.svg" style="width:20px;height:20px;"/> </b></a> 
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                             <?php }?>   
                                                    <!--   <a href="{{ route('announcements.index') }}" class="pull-left"><b style="font-size:10px;"><i class="fa fa-arrow-left fa-3x" title="Back to Announcements"></i></b></a></h2>-->
                                                            <script>
                                                              function myFunctionDelete1() {
                                                                    if(!confirm("Are you sure you want to delete this Announcement?"))
                                                                    {
                                                                    event.preventDefault();
                                                                      }
                                                              }
                                                            </script>
                                        </div>
                                   
                                </div>
                                <hr/>
                               
                                <div class="post_content">
                                    <p> {{ $announcement->Function_Content }}</p>
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
                </div>

               
                <?php } else {   ?>

                    <p> <h4 class="alert alert-info"> Sorry... This announcement is not found</h4> </p>
                <?php } ?>
                <!-- This is the recent announcement panel in RHS --->
                <div class="col-lg-2 col-12 col-md-2">
                    <div class="wn__sidebar"  style="margin-left:20px;width:100%">
                       <!-- Start Single Widget -->
                        <aside class="widget recent_widget">
                            <h3 class="widget-title">@lang('home.Recent Announcements')</h3>
                            <div class="recent-posts">
                                <ul>
                                    <li>
                                                @foreach ($announcements->take(5) as $anment)
                                                    <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"> 
                                               
                                                    @if($anment->Photo )
                                                    <a href="{{ route('announcements.show',$anment->AnnouncementsID) }}" style="text-decoration:none; "><img src="{{ $anment->Photo }}" alt="/images/announcements/Announcement_default.jpg" class="rounded-circle"  width="30" height="30">&nbsp;{{ $anment->Title }}  </a>
                                                    @else 
                                                    <a href="{{ route('announcements.show',$anment->AnnouncementsID) }}" style="text-decoration:none; "><img class="img-thumbnail" src="/images/announcements/Announcement_default.jpg" alt="announcements" class="rounded-circle"  width="30" height="30">&nbsp;{{ $anment->Title }}  </a>
                                                   @endif
                                                    <hr>
                                                @endforeach
                                    </li>
                                 </ul>
                            </div>
                        </aside>
                        <!-- End Single Widget -->

                          <!-- Start Single Widget -->
      <aside class="wedget__categories poroduct--cat">
            <h3 class="wedget__title"><b>@lang('home.templefunc_index_lhsarch') </b></h3>
            <ul>
                
                <li><a href="{{ url('/announcements/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                <li><a href="{{ url('/announcements/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                <li><a href="{{ url('/announcements/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                <li><a href="{{ url('/announcements/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                <li><a href="{{ url('/announcements/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                <li><a href="{{ url('/announcements/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
              
            </ul>
        </aside>
        <!-- End Single Widget -->
                      </div>
                </div>
                
            </div><!-- END ROW-->


        {{-- </div> --}}
    </div>
    @include('sweetalert::alert')




@endsection
