@extends('layouts.app1')

@section('content')

<!-- End Bradcaump area -->
<div class="page-blog-details section-padding--lg bg--white">
        <div class="container">
               
            <div class="row">
                   
                <div class="col-lg-9 col-12" style="margin-top: -100px;">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post-thumbnail">
                                 
                               <!-- <div class="card-header card-header-image">
                                   -->
                                   <!-- <a href="#">  -->
                                            <!-- <a href="#pablo">
                                                    <img class="img" src="https://yt3.ggpht.com/a/AGF-l78nlgaP8LDf9VG4Xbt22CciymOBzqiBpUyHhA=s900-c-k-c0xffffffff-no-rj-mo">
                            
                                                   <div class="card-title">
                                                        Ramesh
                                                    </div>
                                                </a>-->
                                      <!--  <div class="card-title">
                                            Ramesh
                                        </div>-->
                                   <!-- </a> -->
                               
                            <!-- </div> -->
                            </div>
                            <div class="post_wrapper">
                                <div class="post_header">
 
                                    <h2>{{ $seller->Name }}    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/community#sellers" class="pull-left"><b style="font-size:10px;margin-left: -87px;"><i class="fa fa-arrow-left fa-3x"></i></b></a></h2>
                                   <br/><br/> <div class="blog-date-categori">
                                        <ul>
                                            <li><b>Company Name:</b> {{ $seller->CompanyName }}
                                            </li>
                                           {{--  <li><a href="#" title="Posts by boighor" rel="author">Admin</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="post_content">
                                    <p>{{ $seller->Description }}</p>
                                @if( (Auth::user()->IsSeller == 1) && ($seller->Createdby == Auth::user()->id))
                                    <a href="{{ route('sellers.destroy',$seller->SellerID) }}" onclick="return myDelete();"  class="pull-right ml-5">
                                    <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                                  </a>
                                  
                                  <a onclick="return myEdit();" href="{{ route('sellers.edit', $seller->SellerID)  }}" class="pull-right ml-5">
                                      <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
                                  </a>
                                @else
                                
                                @endif
                                      <script>
                                          function myDelete() {
                                              if(!confirm("Are you sure you want to delete this Seller?"))
                                              event.preventDefault();
                                          }
                                          function myEdit() {
                                              if(!confirm("Are you sure you want to edit this Seller?"))
                                              event.preventDefault();
                                          }
                                         </script>
                                  
                                  
                               
                                   
                               <!--     <blockquote>Lorem ipsum dolor sit amet, consecte adipisicing elit, sed do eiusmod tempor deo incididunt labo dolor magna aliqua. Ut enim ad minim veniam quis nostrud geolans work.</blockquote>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehendrit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore of to magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehnderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia dser mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo.</p>
                               -->
                                </div>
                              <!--  <ul class="blog_meta">
                                    <li><a href="#">3 comments</a></li>
                                    <li> / </li>
                                    <li>Tags:<span>fashion</span> <span>t-shirt</span> <span>white</span></li>
                                </ul> -->
                                <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                                <div class="addthis_inline_share_toolbox"></div> 
                            </div>
                        </article>
                      <!--  <div class="comments_area">
                            <h3 class="comment__title">1 comment</h3>
                            <a href="https://www-tecpleglobal-com.disqus.com/#disqus_thread" target="_blank"> COMMENTS</a>
                            <ul class="comment__list">
                                <li>
                                    <div class="wn__comment">
                                        <div class="thumb">
                                            <img src="images/blog/comment/1.jpeg" alt="comment images">
                                        </div>
                                        <div class="content">
                                            <div class="comnt__author d-block d-sm-flex">
                                                <span><a href="#">admin</a> Post author</span>
                                                <span>October 6, 2014 at 9:26 am</span>
                                                <div class="reply__btn">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <p>Sed interdum at justo in efficitur. Vivamus gravida volutpat sodales. Fusce ornare sit</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="comment_reply">
                                    <div class="wn__comment">
                                        <div class="thumb">
                                            <img src="images/blog/comment/1.jpeg" alt="comment images">
                                        </div>
                                        <div class="content">
                                            <div class="comnt__author d-block d-sm-flex">
                                                <span><a href="#">admin</a> Post author</span>
                                                <span>October 6, 2014 at 9:26 am</span>
                                                <div class="reply__btn">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <p>Sed interdum at justo in efficitur. Vivamus gravida volutpat sodales. Fusce ornare sit</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> -->

                     {{--    <div class="comment_respond">
                            <h3 class="reply_title">Leave a Reply <small><a href="#">Cancel reply</a></small></h3>
                            <form class="comment__form" action="#">
                                <p>Your email address will not be published.Required fields are marked </p>
                                <div class="input__box">
                                    <textarea name="comment" placeholder="Your comment here"></textarea>
                                </div>
                                <div class="input__wrapper clearfix">
                                    <div class="input__box name one--third">
                                        <input type="text" placeholder="name">
                                    </div>
                                    <div class="input__box email one--third">
                                        <input type="email" placeholder="email">
                                    </div>
                                    <div class="input__box website one--third">
                                        <input type="text" placeholder="website">
                                    </div>
                                </div>
                                <div class="submite__btn">
                                    <a href="#">Post Comment</a>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__sidebar">
                       
                        
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
               <!--         <aside class="widget comment_widget">
                            <h3 class="widget-title">Comments</h3>
                            <a href="#disqus_thread">comments</a>
                            <ul>
                                <li>
                                    <div class="post-wrapper">
                                        <div class="thumb">
                                            <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                        </div>
                                        <div class="content">
                                            <p>demo says:</p>
                                            <a href="#">Quisque semper nunc vitae...</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper">
                                        <div class="thumb">
                                            <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                        </div>
                                        <div class="content">
                                            <p>Admin says:</p>
                                            <a href="#">Curabitur aliquet pulvinar...</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper">
                                        <div class="thumb">
                                            <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                        </div>
                                        <div class="content">
                                            <p>Irin says:</p>
                                            <a href="#">Quisque semper nunc vitae...</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper">
                                        <div class="thumb">
                                            <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                        </div>
                                        <div class="content">
                                            <p>Boighor says:</p>
                                            <a href="#">Quisque semper nunc vitae...</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-wrapper">
                                        <div class="thumb">
                                            <img src="images/blog/comment/1.jpeg" alt="Comment images">
                                        </div>
                                        <div class="content">
                                            <p>demo says:</p>
                                            <a href="#">Quisque semper nunc vitae...</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </aside> -->
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                     <!--   <aside class="widget category_widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Electronics</a></li>
                                <li><a href="#">Kids</a></li>
                                <li><a href="#">Flower</a></li>
                                <li><a href="#">Books</a></li>
                                <li><a href="#">Jewelle</a></li>
                            </ul>
                        </aside> -->
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="row">
                            <aside class="wedget__categories poroduct--cat">
                                <h3 class="wedget__title anno_current"><b>@lang('home.announcements_index_leftside_current')  </b></h3>
                                        <ul>
                                            <li><a href="{{ url('/sellers/?mon=0') }}">Current Month </li>
                                        </ul>
                                </h3>
                            </aside>
                        </div>
                        <div class="row">
                            
                            <aside class="wedget__categories poroduct--cat">
                                <h3 class="wedget__title"><b>Archives </b></h3>
                                <ul>
                                    
                                    <li><a href="{{ url('/sellers/?mon=1') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 1 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/sellers/?mon=2') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 2 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/sellers/?mon=3') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 3 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/sellers/?mon=4') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 4 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/sellers/?mon=5') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 5 months')  ) ); ?></a></li>
                                    <li><a href="{{ url('/sellers/?mon=6') }}"><?php echo date('F Y', ( strtotime(date('Y').'-'.date('m').'-'.date('j').' - 6 months')  ) ); ?></a></li>
                                  
                                </ul>
                            </aside>
                        <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
                
            </div><!-- END ROW-->


        </div>
    </div>





<script id="dsq-count-scr" src="//www-tecpleglobal-com.disqus.com/count.js" async></script>


@endsection
