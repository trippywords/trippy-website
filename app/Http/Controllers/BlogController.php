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
use App\UserGenrePreference;
//use App\Genre;
use App\Bookmarks;
use App\Notifications;
use App\Usernotification;
use App\Smtp;
use App\ChildGenres;
use App\ParentGenres;

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
      
      $genres=ParentGenres::getComposeGenre();
        //dd($genres);
      if ($request->ajax()) {
          $view = view('blog.view_published_blog', compact('publish_blogs'))->render();
          return response()->json(['html' => $view]);
      }
      
      return view('blog.create',compact('genres','publish_blogs','publish_total'));
    }


    
    //For storing blog into database
    public function store(Request $request)
    {
      
      request()->validate([
          'txtBlogName' => 'required',
          //'txtBlogHeading' => 'required',
          'txtckDescription' => 'required',           
          'blog_genre' => 'required',
          'blog_image'=> 'required|image|mimes:jpeg,png,jpg,gif',
               
          'txtBlogKeywords' => 'required',
          
      ]);
      $blog = new Blog();
      $blog->blog_title   = $request->get('txtBlogName');  
      //$blog->blog_heading = $request->get('txtBlogName');

      //adding parent genre to blog table
      $blog->parent_genre_id = $request->get('parent_genre_id'); 
      //adding child genre to blog table
      $blog->blog_genre = $request->get('blog_genre');
       $blog_image="";

       if ($file = $request->hasFile('blog_image')) {

                $file            = $request->file('blog_image');

                $customimagename  = time() . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('blog_img/');

                $file->move($destinationPath, $customimagename);

                $blog_image = $customimagename;                

            }
      
      $blog->created_by                = Auth::user()->id;
      $blog->blog_description          = $request->get('txtckDescription');  
      $blog->blog_meta_description     = $request->get('txtBlogMetaDescription');
      $blog->blog_image=$blog_image;  
      $blog->blog_keywords             = $request->get('txtBlogKeywords');
     

      if($request->has('draft_btn')){
        $blog->blog_status           = 2;
      }else{
        $blog->blog_status           = 1;
      }
      $val = str_slug($blog->blog_title, '-');
      
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


    public function edit($id, Request $request)
    { 
    
      $genres=ParentGenres::getComposeGenre();

        $blog= Blog::select('*')->where('id','=',$id)->first();

        $childgenres=DB::table('child_genres')->select('id','child_genre_name')->where('is_deleted','=',0)->get()->toArray();

        $blogid=$request->blog_slug;
        if (empty($blog)) {
          return redirect('dashboard');
        }
        return view('blog.edit',compact('blog','genres','childgenres'));
    }



    public function update(Request $request)
    {
     
      request()->validate([
          'txtBlogName' => 'required',
          'blog_genre' => 'required'      
          
      ]);
        if($request->has('draft_btn')){
        $blog_status           = 2;
      }else{
        $blog_status           = 1;
      }
        Blog::where('id', '=', $request->txtBlogId)->update(['blog_title' => $request->txtBlogName,
            'blog_heading' => $request->txtBlogName,
            'blog_status'=>$blog_status,
            'blog_description' => $request->txtDescription,
            'blog_meta_description' => $request->txtBlogMetaDescription,
            'blog_keywords' => $request->txtBlogKeywords,
            'parent_genre_id' => $request->parent_genre_id,
            'blog_genre' => $request->blog_genre,
            //'blog_genre' => $request->smtp_security,
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
        Blog::where('id','=',$id)->update(['is_deleted'=>'1']);

        Bookmarks::where('blog_id',$id)->update(['is_delete'=>'1']);
        return Redirect::back();
    }


    public function viewDraftBlogs(Request $request){
      //dd("After click on draft button");
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
        $blog_details=Blog::where('is_deleted','=','0')->where('blog_slug','=',$slug)->first(); 
        if($blog_details==null)
        {
            return Redirect::back();
        }else{
              return view('blog.blog_detail_page',compact('blog_details'));    
        }
    }

//Implemented API logic for blog detail page not using it now (first will get approved and design)
    public function userBlogDetailpage($id)
    {
     
        if (Auth::user()) {
          session(['is_first_login'=>0]);
        }
        //$blog_details=Blog::select('*')->where('is_deleted','=','0')->where('blog_status','=','1')->where('id','=',$id)->first();
//Single query for blog with comments
/*$blog_details=DB::select("select a.id commentatorId,a.name commentatorName,a.created_at,b.id blogId,b.blog_title,b.blog_image ,b.blog_description ,b.tags blogTags,c.comments,c.user_id,c.created_at commentedAt,u.id authorId,u.name authorName,u.description aurthorSummary,g.id,g.child_genre_name 
  from users u,users a,child_genres g,blogs b left join comments c
  on b.id=c.blog_id
  WHERE b.created_by=u.id
  and b.blog_genre=g.id
  and b.id=$id
  and a.id=c.user_id
");


$finalArray = array();
foreach ($blog_details as $row)
{
   if(empty($finalArray)) {
        $finalArray['blogDetail'] = [
            'bid' => $row->blogId,
            'blogChildGenre' => $row->child_genre_name,
            'blogTitle' => $row->blog_title,
            'blogImage' => $row->blog_image,
            'blogDescription' => $row->blog_description,
            'authorId' => $row->authorId,
            'authorName' => $row->authorName,
            'aurthorSummary' => $row->aurthorSummary

        ];
    }
   
   
    $finalArray['blogDetail']['comments'][] = [
        'comment' => $row->comments,
        'commentatorName'=> $row->commentatorName,
        'commentatorId' => $row->commentatorId,
        'commentedAt' => $row->commentedAt
    ];

}
$comm=json_encode($finalArray,JSON_PRETTY_PRINT);
echo "<pre>";
print_r($comm);
}*/

   /* $prev_blog = 0;

    $finalArray = array();

    foreach ($blog_details as $student) 
    { 
        if ($prev_blog != $student->id)
        {
            $finalArray['blog'][] = array('bid' => $student->id,
                                    'blogTitle' => $student->blog_title,
                                    'blogImage' => $student->blog_image,
                                    'blogDescription' => $student->blog_description
                                    );
            $prev_blog = $student->id;
        }
        $finalArray[key($finalArray)][] = array('comment ' => $student->comments);

    }
    $comm=json_encode($finalArray);
    print_r($comm);

   // dd($blog_details);
  }*/

$blog_details=DB::select("select b.id blogId,g.child_genre_name blogChildGenre,b.blog_title blogTitle,b.blog_image blogImage,b.blog_description blogDescription,b.blog_keywords blogTags,u.id authorId,u.name,u.description aurthorSummary 
  from blogs b,users u,child_genres g
  where b.id=$id
  and b.blog_genre=g.id
  and b.created_by=u.id 
  ");


    foreach ($blog_details as $row) 
    {
        
      $comments=DB::select("select c.comments comment,u.name commentatorName,u.id commentatorId,c.created_at commentedAt 
        from comments c,users u 
        where c.blog_id=$row->blogId
        and c.user_id=u.id");

      //dd($comments);
      
      $row->comments=$comments;
      $blogResult=array();
    
      $finalsResult[]=$row;
            
    }
    $BlogsDetails = json_encode(['blogDetail' => $finalsResult],JSON_PRETTY_PRINT);
      echo "<pre>";
      print_r($BlogsDetails);
  }
        /*if($blog_details==null)
        {
            return Redirect::back();
        }else{*/
         /* $user_genere_details= Userpreferance::select('preference_id')->groupBy('preference_id')->where('user_id','=',$blog_details->created_by)->where('is_delete','=','0')->get();*/
          //$user_genere_details= UserGenrePreference::select('child_preference_id')->groupBy('parent_preference_id')->get();

         // $topblogdata= Blog::select('*')->where('created_by','=',$blog_details->created_by)->where('is_deleted','=','0')->where('id','!=',$blog_details->id)->where('blog_status','=','1')->orderBy('id', 'DESC')->limit(4)->get();

          ///$comments = Comments::select('comments.*','users.first_name','users.last_name')->join('users','users.id','comments.user_id')->where('comments.blog_id','=',$blog_details->id)->where('comments.is_delete','=','0')->orderBy('comments.id','desc')->get();

          //$auther = User::where('id','=',$blog_details->created_by)->first();
          
          //$users = getUsers();
          //$url = url('blog/'.$id);
          //return view('blog.user_blog',compact('blog_details','user_genere_details','topblogdata','comments','auther','url','users'));    
       /* }
    }
*/
    public function userBlogDetailById($id)
    {
      //dd($id);
        if (Auth::user()) {
          session(['is_first_login'=>0]);
        }
        $blog_details=Blog::where('is_deleted','=','0')->where('blog_status','=','1')->where('id','=',$id)->first(); 

        //dd($blog_details);

        if($blog_details==null)
        {
            return Redirect::back();
        }else{
         /* $user_genere_details= Userpreferance::select('preference_id')->groupBy('preference_id')->where('user_id','=',$blog_details->created_by)->where('is_delete','=','0')->get();*/
          $user_genere_details= Userpreferance::select('preference_id')->groupBy('preference_id')->get();

          $topblogdata= Blog::select('*')->where('created_by','=',$blog_details->created_by)->where('is_deleted','=','0')->where('id','!=',$blog_details->id)->where('blog_status','=','1')->orderBy('id', 'DESC')->limit(4)->get();

          $comments = Comments::select('comments.*','users.first_name','users.last_name')->join('users','users.id','comments.user_id')->where('comments.blog_id','=',$blog_details->id)->where('comments.is_delete','=','0')->orderBy('comments.id','desc')->get();

          $auther = User::where('id','=',$blog_details->created_by)->first();
          $users = getUsers();
          $url = url('blog/'.$id);
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

      $blogs = Blog::join('users','blogs.created_by','=','users.id')->where('blogs.blog_status','=',1)->where('blogs.is_deleted','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')
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

      $searchCount = Blog::join('users','blogs.created_by','=','users.id')->where('blogs.blog_status','=',1)->where('blogs.is_deleted','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')
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
        $blogs = Blog::where('is_deleted','=','0')
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

     
      $results = Blog::where('is_deleted','=','0')
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
