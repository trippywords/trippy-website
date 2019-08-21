<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Blog;
use App\User;
use App\Genre;

class FrontController extends Controller
{
    public function index()
    {
        //$userExist = User::whereRaw("(`email` = 'c.kanholkar@gmail.com') AND `is_delete`='0'")->first()->toArray();
    	//echo "Hello This is chaitrali";
    	//$publish_blogs = Genre::all()->toArray();
        /*$blogs = DB::table('blogs')
        ->join('genre','genre.blog_genre','=','genre.id')
        ->join('users','users.created_by','=','users.id')
        
        ->where('blogs.is_delete',"=","0")
        ->where('blogs.is_recommended',"=",0)
        ->select('blogs.id','blog_title','blog_genre','blog_image', 'blogs.created_at','created_by','blog_slug','blog_status','is_tranding','is_featured')               
        ->orderBy('blogs.created_at', 'desc') */   

              //->get();
            /*$blogs= genre::table('blogs')
            ->join('users','users.id','=','blogs.created_by')
            ->join('genres','genres.id','=','blogs.blog_genre')
            ->select('blog_heading','blog_genre','users.name','genres.name')
            ->get();
              echo "<pre>";
              print_r($blogs);*/

              //select b.blog_title,g.name,u.name from blogs b,genres g,users u where b.created_by = u.id and b.blog_genre = g.id
              $blogs = DB::table('blogs')
              ->join('users','blogs.created_by','=','users.id')
              ->join('genres','blogs.blog_genre','=','genres.id')
              //->where('blogs.is_delete',"=","0")
              ->where('blogs.is_recommended',"=",1)
              ->select('blogs.blog_title','genres.name as genre','users.name as user')                      
              ->orderBy('blogs.created_at', 'desc')    
              ->get();

              echo "<pre>";
              print_r($blogs);

    	//DB::enableQueryLog();
    	//DB::table('blogs')->get();
    	//$log= DB::getQueryLog();
    	//dd($log);
    	//print_r("Chaitrali");
    	//$publish_blogs = Blog::getBlogs(Auth::user()->id,0,array('blog_status'=>1));
    	//dd($publish_blogs);
    	//return view('front/front',['name'=>'james']);//,compact($publish_blogs));
    	//return view('front/front',compact('publish_blogs'));
    }
}
