<?php

// classname - CommentController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the FAQComments feature. FAQ contains comments
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Auth;

class CommentController extends Controller
{
   /**
     * stores a new  resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
                return view('auth.SessionTimeout');
        }

        if (isset($request->post_id) ){
            
                $faqcomment = new Comment;
                $faqcomment->Comment_Body = $request->comment_body;
                $faqcomment->user_id= Auth::user()->id;
                $faqcomment->parent_id=$request->post_id;
                $faqcomment->Status=1;
                $faqcomment->created_at= Date('Y-m-d');
                $faqcomment->save();

                $faq = Post::find($request->post_id);
                if (isset($faq)){
                        $faq->updated_at = Date('Y-m-d');
                        $faq->save();
                }
                // After a comment is added , it returns to the same Individual FAQ page to display the comment
                return back();
        }
        else
        {
            return back()->with("Error","Post ID is null");
        } 
   
    }


}




