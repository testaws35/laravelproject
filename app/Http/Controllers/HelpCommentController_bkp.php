<?php

// classname - HelpCommentController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the HelpComments feature. Helpcomments exists with Help Post
// created date - Nov 2019


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\HelpComment;
use App\HelpPost;

use Auth;

class HelpCommentController extends Controller
{

   /**
     * Store a resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r("hiii");
         //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check())
        {
             return view('auth.SessionTimeout');
        }
     
        if (isset($request->post_id) ){
              $comment = new HelpComment;
              $comment->Description = $request->comment_body;
              $comment->user_id= Auth::user()->id;
              $comment->parent_id=$request->post_id;
              $comment->created_at= Date('Y-m-d');
             
              $comment->save();

              $post = HelpPost::find($request->post_id);
              
              if (isset($post) )
              {
                     $post->updated_at = Date('Y-m-d');
                     $post->save();
              }
              
              // After a comment is added , it returns to the same Individual FAQ page to display the comment
              return back()->with("Success","Thanks for commenting");
    
        }
        else
        {
            return redirect('helpposts')->with("Error","Post ID is null");
        } 
    }



    
}
