<?php
namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use App\User;
use App\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Comments;
use Illuminate\Support\Facades\DB;
use App\Userpreferance;
use App\Genre;
use App\Bookmarks;
use App\Notifications;
use App\Usernotification;
use App\Smtp;

class BlogController extends Controller
{ 
    function __construct()
    {
//      if (!Auth::user()) {
//          return redirect('/');
//      }
    }

    public function index()
    {
    }

    public function create(Request $request)
    {
      $publish_blogs = Blog::getBlogs(Auth::user()->id,0,array('blog_status'=>1));
      $publish_total = count(Blog::getBlogs(Auth::user()->id,4,array('blog_status'=>1)));
      $genrearr= Genre::select('id','name')->where('is_deleted','=','0')->orderBy('name')->get();
      //die($genrearr);
      if ($request->ajax()) {
          $view = view('blog.view_published_blog', compact('publish_blogs'))->render();
          return response()->json(['html' => $view]);
      }
      $genrearr= Genre::select('id','name')->where('is_deleted','=','0')->orderBy('name')->get();
      return view('blog.create',compact('genrearr','publish_blogs','publish_total'));
    }

    public function store(Request $request)
    {
      request()->validate([
          'txtBlogName' => 'required',
          //'txtBlogHeading' => 'required',
          //'txtckDescription' => 'required',           
          'smtp_security' => 'required'         
          
      ]);
      $blog = new Blog();
      $blog->blog_title   = $request->get('txtBlogName');  
      $blog->blog_heading = $request->get('txtBlogName');
      $blog->blog_genre = $request->get('smtp_security');
      if ($file = $request->hasFile('blog_image')) {
                $file            = $request->file('blog_image');
                $customimagename  = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('blog_img/');
                $file->move($destinationPath, $customimagename);
                $blog->blog_image = $customimagename;                
     }
      
      $blog->created_by                = Auth::user()->id;
      $blog->blog_description          = $request->get('txtckDescription');  
      $blog->blog_meta_description     = $request->get('txtBlogMetaDescription');  
      $blog->blog_keywords             = $request->get('txtBlogKeywords');

      // $varkey = explode(",",$blog->blog_keywords);
      // foreach ($varkey as $valkey) {
      //   if (!empty(trim($valkey))) {
      //     $keywordval[] = $valkey;
      //   }
      // }
      // if($blog->blog_keywords!='')
      // {
      //   implode(",", $keywordval);
      // }

      if($request->has('draft_btn')){
        $blog->blog_status           = 2;
      }else{
        $blog->blog_status           = 1;
      }
      $val = str_slug($blog->blog_title, '-');
      $check_duplicate = Blog::where("blog_slug",$val)->first();
      
      if($check_duplicate){
        $val = $val."1";
      } 
      $blog->blog_slug = $val;
      $blog->created_at = date('Y-m-d H:i:s');
      $blog->updated_at = date('Y-m-d H:i:s');
      $blog->save();
      
      if($request->has('draft_btn')){
         return redirect('draft');
      }else{
         return redirect('profile');
      }
    }
    public function show(Product $product)
    {
        
    }
    public function edit($slug, Request $request)
    { 

        $genrearr= Genre::select('id','name')->where('is_deleted','=',0)->orderBy('name')->get();
        $blog= Blog::select('*')->where('blog_slug','=',$slug)->first();               
        $blogid=$request->blog_slug;
        if (empty($blog)) {
          return redirect('dashboard');
        }
        return view('blog.edit',compact('blog','genrearr'));
    }
    public function update(Request $request)
    {
      request()->validate([
          'txtBlogName' => 'required',
          //'txtBlogHeading' => 'required',
          //'txtckDescription' => 'required',           
          'smtp_security' => 'required'      
          
      ]);
        if($request->has('draft_btn')){
        $blog_status           = 2;
      }else{
        $blog_status           = 1;
      }
        Blog::where('blog_slug', '=', $request->txtBlogSlug)->update(['blog_title' => $request->txtBlogName,
            'blog_heading' => $request->txtBlogName,
            'blog_status'=>$blog_status,
            'blog_description' => $request->txtDescription,
            'blog_meta_description' => $request->txtBlogMetaDescription,
            'blog_keywords' => $request->txtBlogKeywords,
            'blog_genre' => $request->smtp_security,
            'blog_slug' => str_slug($request->txtBlogName,"-"),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($file = $request->hasFile('blog_image')) {
            $file = $request->file('blog_image');
            $customimagename = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('blog_img/');
            $file->move($destinationPath, $customimagename);
            Blog::where('id', '=', $request->txtBlogId)->update(['blog_image' => $customimagename]);
        }
        if($request->has('draft_btn')){
          return redirect('draft');
        }else{
           return redirect('profile');
        }
    }
    public function destroy($id)
    {
        Blog::where('id','=',$id)->update(['is_delete'=>'1']);
        return Redirect::back();
    }
    public function viewDraftBlogs(Request $request){
      $publish_blogs = Blog::getBlogs(Auth::user()->id,0,array('blog_status'=>1));
      $publish_total = count(Blog::getBlogs(Auth::user()->id,4,array('blog_status'=>1)));

      $draft_blogs = Blog::getBlogs(Auth::user()->id,0,array('blog_status'=>2));
      $draft_total = count(Blog::getBlogs(Auth::user()->id,4,array('blog_status'=>2)));
      if ($request->ajax()) {
        if($request->get('draft') == 1){
          $view = view('blog.view_draft_blog',compact('draft_blogs','draft_total'))->render();
          return response()->json(['html'=>$view]);
        } else {
          $view = view('blog.view_published_blog',compact('publish_blogs'))->render();
          return response()->json(['html'=>$view]);
        }
      }
      return view('blog.view_draft',array('draft_blogs' => $draft_blogs,'publish_blogs' => $publish_blogs,'publish_total' => $publish_total,'draft_total' => $draft_total));
    }
    public function blogDetailpage($slug)
    {
        $blog_details=Blog::where('is_delete','=','0')->where('blog_slug','=',$slug)->first(); 
        if($blog_details==null)
        {
            return Redirect::back();
        }else{
              return view('blog.blog_detail_page',compact('blog_details'));    
        }
    }
    public function userBlogDetailpage($slug)
    {
        if (Auth::user()) {
          session(['is_first_login'=>0]);
        }
        $blog_details=Blog::where('is_delete','=','0')->where('blog_status','=','1')->where('blog_slug','=',$slug)->first(); 

        if($blog_details==null)
        {
            return Redirect::back();
        }else{
         /* $user_genere_details= Userpreferance::select('preference_id')->groupBy('preference_id')->where('user_id','=',$blog_details->created_by)->where('is_delete','=','0')->get();*/
          $user_genere_details= Userpreferance::select('preference_id')->groupBy('preference_id')->get();

          $topblogdata= Blog::select('*')->where('created_by','=',$blog_details->created_by)->where('is_delete','=','0')->where('id','!=',$blog_details->id)->where('blog_status','=','1')->orderBy('id', 'DESC')->limit(4)->get();

          $comments = Comments::select('comments.*','users.first_name','users.last_name')->join('users','users.id','comments.user_id')->where('comments.blog_id','=',$blog_details->id)->where('comments.is_delete','=','0')->orderBy('comments.id','desc')->get();

          $auther = User::where('id','=',$blog_details->created_by)->first();
          $users = getUsers();
          $url = url('blog/'.$slug);
          return view('blog.user_blog',compact('blog_details','user_genere_details','topblogdata','comments','auther','url','users'));    
        }
    }
    public function saveBlogcomment(Request $request)
    {
      $this->validate($request, [
          'blog_id' => 'required',
          'comments' => 'required'          
      ]);
      $blogData = Blog::where('id','=',$request->blog_id)->first();

      $comment = formatedComment($request->comments.' ',$blogData);
      $commnets=new Comments;
      $commnets->blog_id=$request->blog_id;
      $commnets->comments=$comment;
      $commnets->user_id=Auth::user()->id;
      $commnets->is_delete='0';
      $commnets->save();  

      if ($blogData!=null) {
        if (isset($blogData->created_by) && intval($blogData->created_by) > 0 && $blogData->created_by!=Auth::user()->id) {
          $usernotification = Usernotification::where(['user_id'=>$blogData->created_by,'notification_id'=>7,'notification_status'=>'1'])->first();
          if($usernotification!=null) {
            $author = User::where('id','=',$blogData->created_by)->first();
            $reciever_name = (isset($author->first_name)?$author->first_name:'').' '.(isset($author->last_name)?$author->last_name:'');
            $sender_name = (isset(Auth::user()->first_name)?Auth::user()->first_name:'').' '.(isset(Auth::user()->last_name)?Auth::user()->last_name:'');
            $to_u = $author->name . "<" .$author->email. ">";
            $subject_u = 'TrippyWords - Comment Email Notification';
            $message_u = view('emails.user_notifications',['reciever_name'=>$reciever_name,'sender_name'=>$sender_name,'comments'=>$request->comments,'blog_name'=>isset($blogData->blog_title)?$blogData->blog_title:'','blog_slug'=>isset($blogData->blog_slug)?$blogData->blog_slug:'']);
            $headers_u = "MIME-Version: 1.0\r\n";
            $headers_u .= "Content-type: text/html; charset: utf8\r\n";
            $headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";
            //end of user email code
            if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
            }
          }
        }
      }
      return 1;
    }
  
    public function blogBookmark(Request $request){
      $exist= Bookmarks::where('blog_id','=',$request->blog_id)->where('user_id','=',Auth::user()->id)->first();
      if($exist==null)
      {
          $bookmark=new Bookmarks;
          $bookmark->user_id=Auth::user()->id;
          $bookmark->blog_id=$request->blog_id;
          $bookmark->bookmark_at=date('Y-m-d H:i:s');
          $bookmark->is_delete=0;
          $bookmark->save();
          return 0;
      }else{
          if($exist->is_delete==1)
          {
              Bookmarks::where('blog_id','=',$request->blog_id)->where('user_id','=',Auth::user()->id)->update(['is_delete'=>0,'bookmark_at'=>date('Y-m-d H:i:s')]);
              return 0;
          }else{
              Bookmarks::where('blog_id','=',$request->blog_id)->where('user_id','=',Auth::user()->id)->update(['is_delete'=>1,'bookmark_at'=>date('Y-m-d H:i:s')]);
              return 1;    
          }
          
      }
    }

    public function removeBookmark(Request $request){
      $exist= Bookmarks::where('blog_id','=',$request->blog_id)->where('user_id','=',Auth::user()->id)->first();
      if($exist==null)
      {
//            $bookmark=new Bookmarks;
//            $bookmark->user_id=Auth::user()->id;
//            $bookmark->blog_id=$request->blog_id;
//            $bookmark->is_delete=0;
//            $bookmark->save();
          Bookmarks::where('blog_id','=',$request->blog_id)->where('user_id','=',Auth::user()->id)->update(['is_delete'=>1]);
          return 1;
      }else{
          Bookmarks::where('blog_id','=',$request->blog_id)->where('user_id','=',Auth::user()->id)->update(['is_delete'=>1]);
          return 1;
      }
    }

    public function delete_multiple_draft(Request $request){
       $postData = $request->all();
     $arrayID = $postData['id'];
       foreach($arrayID as $id){
         Blog::where('id','=',$id)->update(['is_delete'=>'1']);
       } 
        return Redirect::back();
    }

    

    /*Search Blogs by Title*/
    public function searchBlog(Request $request){
      $blogTitle = $request->title;

      $blogs = Blog::join('users','blogs.created_by','=','users.id')->where('blogs.blog_status','=',1)->where('blogs.is_delete','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')
        ->where(function($query) use ($blogTitle) {
          $query->where('blogs.blog_title', 'LIKE', '%'.$blogTitle.'%')
              ->orWhere('blogs.blog_description', 'LIKE', '%'.$blogTitle.'%')
              ->orWhere('blogs.blog_meta_description', 'LIKE', '%'.$blogTitle.'%')
              ->orWhere('blogs.blog_keywords', 'LIKE', '%'.$blogTitle.'%');
      })->paginate(5);

      // $blogs = Blog::where('blog_title','LIKE','%'.$blogTitle.'%')
      //         ->where('is_delete','=','0')
      //         ->where('blog_status','=','1')
      //         ->orderBy('id','desc')
      //         ->paginate(5);

      $searchCount = Blog::join('users','blogs.created_by','=','users.id')->where('blogs.blog_status','=',1)->where('blogs.is_delete','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')
        ->where(function($query) use ($blogTitle) {
          $query->where('blogs.blog_title', 'LIKE', '%'.$blogTitle.'%')
              ->orWhere('blogs.blog_description', 'LIKE', '%'.$blogTitle.'%')
              ->orWhere('blogs.blog_meta_description', 'LIKE', '%'.$blogTitle.'%')
              ->orWhere('blogs.blog_keywords', 'LIKE', '%'.$blogTitle.'%');
      })->count();
      if ($request->ajax()) {
        $view = view('search_more', compact('blogs'))->render();
        return response()->json(['html' => $view]);
      } 
      return view('search_result',compact('blogs','blogTitle','searchCount'));
    }


    /*start*/
    public function getBlogBygenre(Request $request , $slug){
        $user_genere_details= Genre::select('id')->groupBy('id')->get();
        $var = Genre::select('id','name','genre_slug')->where('genre_slug','=',$slug)->first();
        if (empty($var)) {
          return redirect('dashboard');
        }
        $blogs = Blog::where('is_delete','=','0')
                ->where('blog_genre','=',isset($var->id)?$var->id:0)
                ->orderBy('id','desc')->get();
        if ($request->ajax()) {
          $view = view('search_more', compact('blogs'))->render();
          return response()->json(['html' => $view]);
        } 
        return view('blog.blog_genre',compact('blogs', 'var','user_genere_details'));
      }
      /*end*/
    public function getBlogByKeywords($keyword=NULL){
      $key = $keyword;
      //$keyword = str_replace('-',' ',$keyword);

     
      $results = Blog::where('is_delete','=','0')
              ->orderBy('id','desc')->get();
      
      $blogs = array();
      foreach($results as $result)
      {
        if(isset($result->blog_keywords) && !empty($result->blog_keywords))
         {  
            $explode = explode("," ,$result->blog_keywords);        
            foreach($explode as $ex){
                if($keyword == $ex){
                    $blogs[] = $result;
                }              
            }
         }
      
      }
      $blogTitle = $keyword;
      return view('blog.blog_keyword',compact('blogs','key','blogTitle'));
    }


    function uploadEditorImage(Request $request){
      if ($file = $request->hasFile('image')) {
        // Allowed extentions.
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // Get filename.
        $temp = explode(".", $_FILES["image"]["name"]);

        // Get extension.
        $extension = end($temp);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["image"]["tmp_name"]);

        if ((($mime == "image/gif") || ($mime == "image/jpeg") || ($mime == "image/pjpeg") || ($mime == "image/x-png") || ($mime == "image/png")) && in_array($extension, $allowedExts)) {// Generate new random name.
              $file = $request->file('image');
              $customimagename = time() .'.'. $file->getClientOriginalExtension();
              $destinationPath = public_path('blog_img/');
              $destinationPath = public_path('blog_description_img/');
              $file->move($destinationPath, $customimagename);
  
              // Generate response.
              $link = asset('/').'public/blog_description_img/'.$customimagename;
              echo stripslashes(json_encode(array('link'=>$link)));
        }
      }  
    }

    function uploadEditorVideo(Request $request){
      if ($file = $request->hasFile('video')) {
          //$allowedExts = array("mp4","webm","ogg"); 
          $temp = explode(".", $_FILES["video"]["name"]);
          $extension = end($temp);
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $mime = finfo_file($finfo, $_FILES["video"]["tmp_name"]);
          //if((($mime == "video/mp4") || ($mime == "video/webm") || ($mime == "video/ogg")) && in_array($extension,$allowedExts)){
                $file = $request->file('video');
                $customimagename = time() .'.'. $file->getClientOriginalExtension();
                $destinationPath = public_path('blog_img/');
                $destinationPath = public_path('blog_description_video/');
                $file->move($destinationPath, $customimagename);              
                $link = asset('/').'public/blog_description_video/'.$customimagename;
                echo stripslashes(json_encode(array('link'=>$link)));
          //}
      }
    }
}
