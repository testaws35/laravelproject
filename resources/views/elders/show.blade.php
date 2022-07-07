@extends('layouts.app1')
@section('content')


<!-- {{-- /**
// classname - Elders/Show.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for displaying specific FAQ
// created date - Nov 2019
**/ --}} -->



<!-- End Bradcaump area -->
<?php if(isset($faqs ) )   {?>
        <div class="page-blog-details section-padding--lg bg--white">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-12 md-mt-40 sm-mt-40">
                                <div class="blog-details content">
                                    <article class="blog-post-details">
                                            <div class="post-thumbnail"><!-- images\frontend_images\blog\big-img\1.jpg -->
                                            <h2><a href="{{ route('elders.index') }}" class="pull-left"><b style="font-size:10px;"><i class="fa fa-arrow-left fa-3x"></i></b>
                                                                </a> &nbsp;&nbsp;&nbsp;{{$faqs->FAQ_Title}}  </h2>  <hr/>  <br/>
                                                        <div class="card-header card-header-image">
                                                            <a href="#pablo">
                                                                            @if($faqs->FAQ_Photo)
                                                                                <img class="img-thumbnail" src="{{$faqs->FAQ_Photo}}"  alt="VC" width="200" height="200">
                                                                            @else 
                                                                                <img class="img-thumbnail" src="/images/frontend_images/avatar.png"  alt="VC" width="200" height="200" >
                                                                            @endif
                                                            </a>
                                                            <div class="colored-shadow" style="background-image: url('{{$faqs->FAQ_Photo}}');opacity: 1;" width="200" height="200">
                                                            </div>
                                                        </div>
                                            </div>
                                        
                                            <div class="post_wrapper">
                                                        <div class="post_header">
                                                            <p> Posted by {{$faqs->name}}   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; posted on {{$faqs->FAQ_CreatedDate}}  
                                                                
                                                            </p> 
                                                            <hr/>
                                                        </div>
                                                        <div class="post_content" >
                                                            <p>{{$faqs->FAQ_Body}}</p> 
                                                        </div>
                                            </div>
                                        
                                    </article>

                                    <?php if(( isset($comments)) && (count($comments) >0) )  { ?>
                                            <div class="comment_respond">
                                                            <h3 class="reply_title">Comments</h3>
                                                        
                                                            <hr />
                                                        @include('partials._comment_replies', ['comments' => $comments])
                                            </div>
                                    <?php } ?> <!-- inner if-->
                                        <form class="comment__form" method="post" action="{{ route('faqcomment.add') }}">
                                                        @csrf
                                                        <br/> <br/>
                                                        <h3 class="reply_title">Leave a Reply </h3>
                                                      
                                                        <div class="input__box">
                                                                <p class="lead emoji-picker-container">
                                                                <textarea name="comment_body" class="form-control" rows="5" placeholder="Your comment here" data-emojiable="true" required></textarea>
                                                                <input type="hidden" name="post_id" value="{{ $faqs->FAQ_PostID}}" /> 
                                                        </div>
                                                    
                                                        <div class="submite__btn">
                                                                <input type="submit" class="btn" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;" value="Add Comment" />
                                                        </div>
                                        </form> 
                                </div>  
                        </div> <!--col end-->
              
                        <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                            <div class="wn__sidebar">
                                <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
                                    <!-- Start Single Widget -->
                                    <aside class="widget recent_widget">
                                        <h3 class="widget-title">Archives</h3>
                                        <div class="recent-posts">
                                            <ul>
                                                <li><a href="{{ url('/elders/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/elders/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/elders/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/elders/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/elders/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                                <li><a href="{{ url('/elders/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                            </ul>
                                        </div>
                                    </aside>
                                    <!-- End Single Widget -->
                                <?php ?>
                            </div>
                        </div>
                        
                    </div><!-- END ROW-->
                </div>
        </div>

<?php } else { ?>  <!-- outer if-->

        <div class="page-blog-details section-padding--lg bg--white">
                <div class="container">
                   <div class="row">
                        <div class="col-lg-9 col-12">
                             <b> {{$Failed}}  </b>
                        </div>
          
                       
                        <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                            <div class="wn__sidebar">
                                <!-- Start Single Widget --
                                <aside class="widget search_widget">
                                    <h3 class="wedget-title"><b>Search </b></h3>
                                    <form action="#">
                                        <div class="form-input">
                                            <input type="text" placeholder="Search...">
                                            <button><i class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </aside>
                                <!-- End Single Widget -->
        
                            
                                <?php    $month = date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?>
        
                                <!-- Start Single Widget -->
                                <aside class="wedget__categories poroduct--cat" style="text-align:right">
                                    <h3 class="wedget-title"><b>Archives</b></h3>
                                    <ul>
                                        <li><a href="{{ url('/elders/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                        <li><a href="{{ url('/elders/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                        <li><a href="{{ url('/elders/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                        <li><a href="{{ url('/elders/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                        <li><a href="{{ url('/elders/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                        <li><a href="{{ url('/elders/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                      
                                    </ul>
                                </aside>
                                <!-- End Single Widget -->
                            </div>
                        </div>
                        
                    </div><!-- END ROW-->
        
        
                </div>
        </div>

<?php } ?>


@endsection
