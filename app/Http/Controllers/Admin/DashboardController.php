<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Genre;
use App\Comments;
use App\Blog;

class DashboardController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        //$this->middleware('auth');

    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
   {

        $user_count=User::where('is_delete','=','0')->count();       //where('is_delete','=','0')->              
        $genre = Genre::where('is_deleted','0')->count();
        $blogs_count = Blog::where('is_delete','0')->count();
        $publish_blog_count=Blog::where('blog_status','=','1')->where('is_delete','0')->count();
        $draft_blog_count=Blog::where('blog_status','=','2')->where('is_delete','0')->count();

        $users=User::where('is_delete','=','0')->where('role_id','!=',4)->orderBy('id')->limit(5)->get();
        $blogs=Blog::where('is_delete','0')->orderBy('updated_at')->limit(5)->get();
        $comments=Comments::getComments(5);
        $comments_count=Comments::getComments(null,true);

        return view('admin.dashboard',compact('user_count','genre','publish_blog_count','draft_blog_count','users','blogs','blogs_count','comments','comments_count'));
    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function comments()
    {
        $comments=Comments::getComments();
        $comments_count=Comments::getComments(null,true);
        return view('admin.comments',compact('comments','comments_count'));        
    }


}
 
