<?php

// classname - PostController.php
// author - Raveendra 
// release version - 1.0
// Description-  This Controller manages the HelpPost feature
// created date - Nov 2019

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use DB;
use Auth;

/**
 * Display a listing of the resource.
 * 
 * @return \Illuminate\Http\Response
 */

class PostController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
    */
    public function index()
    {

        //Check for Session time out and redirect to Login page on Session time out 
           if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }

        $posts = DB::table('faq_posts')
                        ->join('users', 'users.id', '=', 'faq_posts.FAQ_UserID')
                        ->select('users.id','users.name','users.User_photo','faq_posts.FAQ_PostID','faq_posts.FAQ_Title', 'faq_posts.FAQ_Body', 'faq_posts.FAQ_CreatedDate')
                        ->where('faq_posts.FAQ_IsActive', '1')
                        ->orderby('faq_posts.FAQ_CreatedDate','DESC')
                        //->paginate(6)
                        ->get();
        
         return view('index', compact('posts'));
    }



   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     //Check for Session time out and redirect to Login page on Session time out 
           if ( ! Auth::check()){
            return view('auth.SessionTimeout');
           }

          return view('post');
        
    }

    
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Check for Session time out and redirect to Login page on Session time out 
         if ( ! Auth::check()){
            return view('auth.SessionTimeout');
         }

        $post =  new Post;
        $post->FAQ_Title = $request->get('FAQ_Title');
        $post->FAQ_Body = $request->get('FAQ_Body');
        $post->FAQ_IsActive = 1;
        $post->FAQ_UserID = Auth::user()->id;

        $post->FAQ_CreatedDate = Date('Y-m-d');
        $post->save();
        return redirect('posts');  
    }


   /**
     * Display the specified resource.
     *
     * @param  Posts
     * @return \Illuminate\Http\Response
     * Post is the Model Name
     * 
     */
    public function show($FAQ_PostID)
    {
        //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
            }

        $post = Post::find($FAQ_PostID);
        return view('show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts
     * @return \Illuminate\Http\Response
     */
    public function editPost($FAQ_PostID) {
    //Check for Session time out and redirect to Login page on Session time out 
        if ( ! Auth::check()){
            return view('auth.SessionTimeout');
         }

        $post = Post::find($FAQ_PostID);
        //compact way to get Post of the given id
        return view('post/edit', ['post' => $FAQ_PostID]);
    }

    
   /**
     * update the specified resource.
     *
     * @param  \App\Post  
     * @return \Illuminate\Http\Response
     */
    public function updatePost(Request $request, $FAQ_PostID) {
        //Check for Session time out and redirect to Login page on Session time out 
            if ( ! Auth::check()){
                return view('auth.SessionTimeout');
            }

        $post = Post::find($FAQ_PostID);
        $post->FAQ_Title = $request->FAQ_Title;
        $post->FAQ_Body  = $request->FAQ_Body ;
        $post->save();
        return redirect()->route('posts')->with('success',Lang::get('home.post_update'));
    }




}
