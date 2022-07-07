
{{-- Aruna remove this file
    

@extends('layouts.app1')

@section('content')

<!-- End Bradcaump area -->
<div class="page-blog-details section-padding--lg bg--white">
        <div class="container">
               
            <div class="row">
                   
                <div class="col-lg-9 col-12">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post-thumbnail"><!-- images\frontend_images\blog\big-img\1.jpg -->
                                <div class="card-header card-header-image">
                                   
                                    <a href="#">
                                            <a href="#pablo">
                                                    <img class="img" src="/images/helppost/{{ $helppost->Photo }}">
                            
                                                  <!--  <div class="card-title">
                                                        Ramesh
                                                    </div>-->
                                                </a>
                                      <!--  <div class="card-title">
                                            Ramesh
                                        </div>-->
                                    </a>
                                <div class="colored-shadow" style="background-image: url('/images/helppost/{{ $helppost->Photo }}');opacity: 1;"></div>
                            
                            </div>
                            </div>
                            <div class="post_wrapper">
                                <div class="post_header">
 
                                    <h2>{{ $helppost->Type }}    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <a href="{{ route('helpposts.index') }}" class="btn btn-info fa-3x pull-right"><b style="font-size:10px;">Back</b></a></h2>
                                    <div class="blog-date-categori">
                                        <ul>
                                            <li>{{ $helppost->created_at->format('d-m-Y') }}
                                            </li>
                                        
                                        </ul>
                                    </div>
                                </div>
                                <div class="post_content">
                                    <p>{{ $helppost->Description }}</p>
                                
                                 

<a href="{{ route('helpposts.destroy', $helppost) }}"
      onclick="event.preventDefault();
      document.getElementById('delete-form').submit();"  class="pull-right ml-5">
      <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
    </a>
    <a onclick="return myEdit();" href="{{ route('helpposts.edit', $helppost->HelpID)  }}" class="pull-right ml-5">
        <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
        </a>
        <script>
            function myDelete() {
                if(!confirm("Are you sure you want to delete this Help Post?"))
                event.preventDefault();
            }
            function myEdit() {
                if(!confirm("Are you sure you want to edit this Help Post?"))
                event.preventDefault();
            }
           </script>
    
    
   <form id="delete-form" action="{{ route('helpposts.destroy', $helppost) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    </form>



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

                        <div class="comment_respond">
                            <h3 class="reply_title">Leave a Reply {{-- <small><a href="#">Cancel reply</a></small> --</h3>
                           
                            <hr />
                         





                    @include('partials._helpcomment_replies', ['comments' => $helppost->comments, 'post_id' => $helppost->HelpID])
                          
                            <h4>Add comment</h4>
                            <form method="post" action="{{ route('comment.add') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="comment_body" class="form-control" placeholder="leave a comment here"/>

                                    
                                    <input type="hidden" name="post_id" value="{{ $helppost->HelpID }}" />

                                   

                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info" value="Add Comment" />
                                </div>
                            </form> 
                           
                           
                            {{--  <form class="comment__form" action="#">
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
                            </form> -
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__sidebar">
                        <!-- Start Single Widget -->
                        <aside class="widget search_widget">
                            <h3 class="widget-title">Search</h3>
                            <form action="#">
                                <div class="form-input">
                                    <input type="text" placeholder="Search...">
                                    <button><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </aside>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <aside class="widget recent_widget">
                            <h3 class="widget-title">Recent</h3>
                            <div class="recent-posts">
                                <ul>
                                    <li>
                                        <div class="post-wrapper d-flex">
                                            <div class="thumb">
                                                <a href="blog-details.html"><img src="https://img.traveltriangle.com/blog/wp-content/tr:w-700,h-400/uploads/2018/01/Kapaleeswarar-Temple-kb6592.jpg" alt="blog images"></a>
                                            </div>
                                            <div class="content">
                                                <h4><a href="blog-details.html">Kapaleeswarar Temple at Chennai</a></h4>
                                                <p>	Sept 10, 2019</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post-wrapper d-flex">
                                            <div class="thumb">
                                                <a href="blog-details.html"><img src="https://img.traveltriangle.com/blog/wp-content/tr:w-700,h-400/uploads/2018/01/Marundheeswarar-Temple-kb6592fh.jpg" alt="blog images"></a>
                                            </div>
                                            <div class="content">
                                                <h4><a href="blog-details.html">Marundheeswarar Temple at Chennai</a></h4>
                                                <p>	Aug 10, 2019</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post-wrapper d-flex">
                                            <div class="thumb">
                                                <a href="blog-details.html"><img src="https://img.traveltriangle.com/blog/wp-content/tr:w-700,h-400/uploads/2018/01/Ekambareswarar-Temple-kb6592.jpg" alt="blog images"></a>
                                            </div>
                                            <div class="content">
                                                <h4><a href="blog-details.html">Ekambareswarar Temple at Chennai</a></h4>
                                                <p>	July 10, 2019</p>
                                            </div>
                                        </div>
                                    </li>
                                  
                                
                                </ul>
                            </div>
                        </aside>
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
                        <aside class="widget archives_widget">
                            <h3 class="widget-title">Archives</h3>
                            <ul>
                                <li><a href="#">March 2019</a></li>
                                <li><a href="#">September 2019</a></li>
                                <li><a href="#">December 2018</a></li>
                                <li><a href="#">November 2018</a></li>
                                <li><a href="#">September 2018</a></li>
                                <li><a href="#">August 2018</a></li>
                            </ul>
                        </aside>
                        <!-- End Single Widget -->
                    </div>
                </div>
                
            </div><!-- END ROW-->


        </div>
    </div>



<script id="dsq-count-scr" src="//www-tecpleglobal-com.disqus.com/count.js" async></script>


@endsection
--}}