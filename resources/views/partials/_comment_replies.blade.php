<style>.direct-chat-text {
  border-radius: 0.3rem;
  background: #d2d6de;
  border: 1px solid #d2d6de;
  color: #444;
  margin: 25px 0 0 90px;
  padding: 5px 10px;
  position: relative;
}
.direct-chat-img {
    border-radius: 50%;
    float: left;
    height: 70px;
    width: 70px;
}
.direct-chat-text::before {
    border: solid transparent;
    border-right-color: #d2d6de;
    content: ' ';
    height: 0;
    pointer-events: none;
    position: absolute;
    right: 100%;
    top: 15px;
    width: 0;
    border-width: 6px;
    margin-top: -6px;
}
</style>
@foreach($comments as $comment)
    <div class="display-comment">
        <div class="row">
           
           
           <div class="col-lg-12 col-12" >  
               
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-timestamp float-right"style="font-size:12px;">PostedOn&nbsp;&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($comment->created_at)) ?> </span>
                    </div>
                <!-- /.direct-chat-infos -->
                <a href="{{ route('profile.index',$comment->id) }}">
                    <img class="direct-chat-img" src="{{$comment->User_Photo}}" alt="message user image">
                </a>
                <span class="direct-chat-name float-left" style="margin-left:20px;">{{ $comment->name }}</span>
               
               
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                   {{ $comment->Comment_Body}}
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
                
           </div> 
           
                
        </div>
    </div>
@endforeach 
