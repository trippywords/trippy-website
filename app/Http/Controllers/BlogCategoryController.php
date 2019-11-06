<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use App\Smtp;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Userpreferance;
use App\Blog;
use App\Genre;

class BlogCategoryController extends Controller {

    public function __construct() {
       // $this->middleware('auth');
    }

    public function index() {
        $genArrayLatest =[];
        if(Auth()->user()){
            $loginId = Auth()->user()->id;
            $genArray = Genre::getGenres($loginId);
            if (count($genArray) == 0) {
                $genArrayLatest= Genre::getLatestGenres();
            }
        }else{
            $genArray = Genre::getGenres();
        }
        
        $latest_blogs = DB::table('blogs')->select('blogs.*','users.first_name','users.last_name','users.profile_image')
        ->join('users','users.id','blogs.created_by')
        ->where('blogs.blog_status','1')
        ->where('blogs.is_deleted','0')
        ->where('users.is_delete','0')
        ->where('users.is_verified','=',1)
        ->orderBy('blogs.id', 'DESC')
        ->limit(4)->get();
	
        $featured_blogs = DB::table('blogs')->select('blogs.*','users.first_name','users.last_name','users.profile_image')
        ->join('users','users.id','blogs.created_by')
        ->where('blogs.blog_status','1')->where('blogs.is_deleted','0')
        ->where('blogs.is_featured','1')->where('users.is_delete','0')
        ->where('users.is_verified','=',1)->orderBy('blogs.id', 'DESC')->limit(4)->get();
	
        $tranding_blogs = DB::table('blogs')->select('blogs.*','users.first_name','users.last_name','users.profile_image')
        ->join('users','users.id','blogs.created_by')
        ->where('blogs.blog_status','1')->where('blogs.is_deleted','0')
        ->where('blogs.is_trending','1')->where('users.is_verified','=',1)->where('users.is_delete','=','0')
        ->orderBy('blogs.id', 'DESC')->limit(4)->get();
        
        $popular_blogs = [];
        if (count($latest_blogs) > 4) {
            $popular_blogs = DB::table('blogs')->select('blogs.*','users.first_name','users.last_name','users.profile_image')
            ->join('users','users.id','blogs.created_by')->where('blogs.blog_status','1')
            ->where('blogs.is_deleted','0')->where('users.is_delete','0')
            ->where('users.is_verified','=',1)->get()->random(4);
        }else{
            $popular_blogs = DB::table('blogs')->select('blogs.*','users.first_name','users.last_name','users.profile_image')
            ->join('users','users.id','blogs.created_by')->where('blogs.blog_status','1')
            ->where('blogs.is_deleted','0')->where('users.is_delete','0')
            ->where('users.is_verified','=',1)->limit(4)->get();
        }
	  
        return view('blog.blog_category', compact('genArray','genArrayLatest','latest_blogs','featured_blogs','tranding_blogs','popular_blogs'));
    }

}
