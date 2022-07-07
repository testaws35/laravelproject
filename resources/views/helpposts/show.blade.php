@extends('layouts.app1')
@section('content')

<!-- {{-- /**
// classname - Helpposts/show.blade.php
// author - Raveendra 
// release version - 1.0
// Description-  This view Ui is used for diplaying specific FAQ post
// created date - Nov 2019
**/ --}} -->

<style>
    .emoji-menu{
        margin-top:-149px;
    }
    .alert-success{
        width:30%;
        height:50px;
        justify-content: center;
        margin: 0 auto;
       
    }
</style>
<!-- End Bradcaump area -->
@if ($message = Session::get('Success'))
  <div class="alert alert-success"  id="alertad">
    <p style="text-align:center;">{{ $message }}</p>
    <script type="text/javascript"> 
              setTimeout(function () { 
              // Closing the alert 
                $('#alertad').alert('close'); 
            }, 5000); 
   </script> 
  </div>
@endif
<?php if(isset($helppost ) )   {?>
<div class="page-blog-details section-padding--lg bg--white">
     
        <div class="container">
           
            <div class="row" >  <!-- outer row -->
                 <div class="col-lg-9 col-12">  <!-- 1st column -->
                        <div class="blog-details content">
                            <article class="blog-post-details">
    
                                <h2 class="text-center">{{ $helppost->Type }}    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <a href="{{ route('helpposts.index') }}" class=" pull-left" title="Back to helpposts"><b style="font-size:10px;"><i class="fa fa-arrow-left fa-3x"></i></b></a></h2>
                                
                                <div class="post-thumbnail"><!-- images\frontend_images\blog\big-img\1.jpg -->
                                    <div class="card-header card-header-image">
                                            <a href="#pablo">
                                            <img class="img-thumbnail" src="{{ $helppost->Photo }}" style="max-height: 400px;width:90%; margin-top:30px;">
                                            </a>
                                            <div class="colored-shadow" style="background-image: url('{{ $helppost->Photo }}');opacity: 1;">
                                            </div>
                                    </div>
                                </div>
                                <div class="post_wrapper">
                                        <div class="post_header">
                                           <!-- <div class="blog-date-categori"> usha - commented class because the style that return was not aligned correctly-->
                                            <div class="blog-date-category">
                                                <ul>
                                                    <li>Posted On : {{ date('d-M-Y', strtotime($helppost->created_at)) }}
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>@lang('home.posted_by') : {{ $helppost->name }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="post_content">
                                            
                                            <p>Description : {{ $helppost->Description }}</p>
                                            
                                        </div>
                                        
                                        <div class="post_icon">
                                            
                                            @if( $helppost->CreatedBy == Auth::user()->id)
                                                <a href="/helpposts/destroy/{{$helppost->HelpID}}" onclick="return myDelete();"  class="pull-right ml-5">
                                                    <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                                                </a>
                                              
                                                <a onclick="return myEdit();" href="{{ route('helpposts.edit', $helppost->HelpID)  }}" class="pull-right ml-5">
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
                                        </div>
                                        
                                        
                                 </div>
                                 <hr/>
                            </article>
                         
                            <?php if(( isset($comments)) && (count($comments) >0) )  { ?>
                                <div class="comment_respond">
                                    {{--   <h3 class="reply_title"><b>Comments</b></h3> --}}
                                      <h3 class="reply_title">Comments</h3>
                                      <hr />
                               @include('partials._helpcomment_replies', ['comments' => $comments]) 
                                </div>   
                                      
                            <?php } ?> <!-- inner if-->
    
    
                            
                            <br/> <br/>
                            <form class="comment__form1" method="post" action="{{route('comment.add')}}">
                                    {!! csrf_field() !!}
                                    <h3 class="reply_title" style="font-family: 'Sen', sans-serif;">@lang('home.helpposts_show_heading') {{-- <small><a href="#">Cancel reply</a></small> --}}</h3>
                                    <hr />
                                    <div class="input__box" style="font-family: 'Sen', sans-serif;">
                                            <p class="lead emoji-picker-container">
                                            <textarea name="comment_body" class="form-control" id="comment" rows="10" placeholder="@lang('home.helpposts_show_placeholder')" data-emojiable="true" required></textarea>
                                             <input type="hidden" name="post_id" value="{{ $helppost->HelpID }}" />
                                             
                                             <p id="cmnt_error" style="color:red"></p>
                                    </div>
                                 
                                    <div class="submite__btn">
                                            <input type="submit" onclick="checktext()" class="btn" style="font-family: 'Sen', sans-serif;font-size:16px;border-bottom-right-radius:25px;border-top-left-radius:25px;background: #f82249;color:#fff;" value="@lang('home.helpposts_show_addcomment_btn')" />
                                    </div>
                            </form> 
    
                          
                        </div> <!-- blog details content-->
                 </div>  <!-- end 1st col-->
        
                 <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__sidebar">
                      <!-- Start Single Widget -->
                        <aside class="widget recent_widget">
                                    <h3 class="widget-title">Recent Posts</h3>
                                    <div class="recent-posts">
                                        <ul>
                                            <li>
                                            @foreach ($helpposts->take(5) as $helppost)
                                                <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin-bottom:5px;"> 
                                                        <a href="{{ route('helpposts.show',$helppost->HelpID) }}" style="text-decoration:none; ">
                                                            @if($helppost->Photo == "" || $helppost->Photo == "null")  
                                                            <img src="/images/No-image2.png" alt="photo" class=" rounded-circle" width="50" height="50">
                                                            
                                                            @else
                                                            <img src="{{ $helppost->Photo }}" alt="Help Posts" class=" rounded-circle" width="50" height="50">&nbsp;
                                                            @endif
                                                        
                                                        {{ Illuminate\Support\Str::limit(ucwords($helppost->Description), 80, $end='...') }}</a>
                                                </div>
                                            @endforeach
                                            </li>
                                        </ul>
                                    </div>
                        </aside>
                        <!-- End Single Widget -->
                     </div> <!-- end side bar-->
                </div>

                
          
                
        </div><!-- END outer  ROW-->
         
     </div> <!-- container-->
 <!--</div>  remove div on 19-1-2020 page blog-->
<?php } else { ?>


    <div class="page-blog-details section-padding--lg bg--white">
            <div class="container">
                <div class="row" >  <!-- outer row -->
                      <div class="col-lg-9 col-9">  <!-- 1st column -->
                         <div class="row">
                         </div> <!-- end row -->
                          <p style="font-family: 'Sen', sans-serif;"> <br>  <br> <br><br>  <br> <br> <b> {{$Failed}}  </b></p>
                         </div> <!-- end row -->
                      </div>  <!-- end 1st col-->
                 
                      <div class="col-lg-3 col-3 md-mt-40 sm-mt-40">
                             <div class="wn__sidebar">
                               <!-- Start Single Widget -->
                                 <aside class="widget recent_widget">
                                     <h3 class="widget-title" style="font-family: 'Sen', sans-serif;">Recent Posts</h3>
                                     <div class="recent-posts">
                                         <ul>
                                             <li>
                                               @foreach ($helpposts->take(5) as $helppost)
                                                  <div class="thumb" style="max-width:900px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"> 
                                                            <a href="#"><img src="{{ $helppost->Photo }}" alt="Help Posts" class="rounded-circle" width="50" height="50"></a>
                                                   </div><br/>
                                                  <div class="content" style="font-family: 'Sen', sans-serif;">
                                                               <h4>    {{ $helppost->Type }}</h4>
                                                                {{ $helppost->Description }}
                                                                
                                                               
                                                  </div><br/>
                                               @endforeach
                                             </li>
                                         </ul>
                                     </div>
                                 </aside>
                                 <!-- End Single Widget -->
                              </div> <!-- end side bar-->
                         </div>
                     </div>  <!--end col2 -->
                         
                  </div><!-- END outer  ROW-->
              </div> <!-- container-->
          </div> <!-- page blog-->


<?php } ?>


<script id="dsq-count-scr" src="//www-tecpleglobal-com.disqus.com/count.js" async></script>
<script>
    
    function checktext(){
        
        //var cmnt = document.getElementById("comment");
        var message = $('textarea#comment').val();
        if(message == "")
        {
            $("#cmnt_error").html("Please provide your comment");
            event.preventDefault();
        }
        else
        {
            $("#cmnt_error").html("");
        }
    }
    
</script>

@endsection
