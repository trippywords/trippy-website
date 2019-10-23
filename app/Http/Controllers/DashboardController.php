<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Blog;
use App\UserGenrePreference;
use App\Userpreferance;
use App\Genre;
use App\User;
use App\Connection;
use App\Followers;
use App\ParentGenres;
use App\ChildGenres;
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
    public function index(Request $request)
    {
        $roles=$request->user()->roles;
        foreach ($roles as $role)
        {
            if($role->name=='super-admin')
            {
                $is_admin=true;
            }else{
                $is_admin=false;
            }
        }

        $user_pref=Userpreferance::where('user_id','=',Auth::user()->id)->where('is_delete','=','0')->count();
        //dd($user_pref);
        $userData=User::where('id','=',Auth::user()->id)->first();
        if(isset($userData->created_at) && trim($userData->created_at)==trim($userData->last_login))
        //if(isset($userData->name)=='asdfg')
        {
            $request->session()->put('is_first_login',1);
            return redirect('preference');
        }else{
            $request->session()->put('is_first_login',0);
            $publish_blogs = Blog::getBlogs(Auth::user()->id,0,array('blog_status'=>1));
            
            $publish_total = count(Blog::getBlogs(Auth::user()->id,4,array('blog_status'=>1)));
            if ($request->ajax()) {
                $view = view('blog.view_published_blog', compact('publish_blogs'))->render();
                return response()->json(['html' => $view]);
            }                        
            return view('dashboard.profile', compact('is_admin','publish_blogs','publish_total'));
        }
}
    public function viewDraftBlogsDashboard(Request $request){

        $draft_blogs = Blog::where('blog_status',2)->where('created_by',Auth::user()->id)->where('is_delete','=','0')->orderBy('id', 'desc')->get();
        $publish_blogs = Blog::getBlogs(Auth::user()->id,0,array('blog_status'=>1));
        $publish_total = count(Blog::getBlogs(Auth::user()->id,4,array('blog_status'=>1)));
        if ($request->ajax()) {
            $view = view('blog.view_published_blog',compact('publish_blogs'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('blog.view_draft',array('draft_blogs' => $draft_blogs,'publish_blogs' => $publish_blogs,'publish_total'=>$publish_total));
    }


    public function preference(){ 
        session(['preference_redirect_url'=>'']); 
        //if (Auth()->user()) {
            //$genres= Userpreferance::select('genres.*')->join('genres','genres.id','=','preference_id')->where('user_id','=',Auth::user()->id)->where('is_deleted','=','N')->where('is_published','=','Y')->where('is_delete','=','0')->distinct()->get(); 
        //}else{
       $genres=ParentGenres::getComposeGenre();
        //dd($genres);
            //$genres= Genre::where('is_deleted','=','N')->where('is_published','=','Y')->where('parent_genre_id','!=',0)->get();
        //}
        return view('dashboard.preferance',compact('genres'));
    }
    
    public function savePreferance(Request $request){
        
        if(isset($request->gen) && count($request->gen)>=3){

            $parent= $request->gen;
            
            foreach ($parent as $key_gen=>$val_gen) {
            
            $childlist = ChildGenres::select('id','child_genre_name')->where('parent_genre_id',$key_gen)->get();
             
            if(count($childlist)>0)
            {
                foreach ($childlist as $child) {
                $up=new UserGenrePreference;
                $up->parent_preference_id = $key_gen;
                $up->child_preference_id = $child->id;
                $up->user_id = Auth::user()->id;
                //$up->is_deleted = 0;                
                $up->save();
                }
            }
           
        }
         $request->session()->put('is_first_login',0);
            User::where('id','=',Auth::user()->id)->update(['last_login'=>date("Y-m-d H:i:s")]);
            return redirect('dashboard');


           /* Userpreferance::where('user_id','=',Auth::user()->id)->update(['is_delete'=>1]);
            foreach($request->gen as $key_gen=>$val_gen)
            {
                $up = new Userpreferance;
                $up->preference_id = $key_gen;
                $up->user_id = Auth::user()->id;
                $up->is_delete = 0;                
                $up->save();
                
                $pargen=Genre::where('is_deleted','=','N')->where('is_published','=','Y')->where('id','=',$key_gen)->first();
                if ($pargen!=null) {
                    if (isset($pargen->parent_genre_id) && intval($pargen->parent_genre_id) > 0) {
                        $parent_genre_id=Userpreferance::select('id')->where('is_delete','=',0)->where('user_id','=',Auth::user()->id)->where('preference_id','=',$pargen->parent_genre_id)->first();
                        if ($parent_genre_id==null) {
                            $up = new Userpreferance;
                            $up->preference_id = $pargen->parent_genre_id;
                            $up->user_id = Auth::user()->id;
                            $up->is_delete = 0;                
                            $up->save();
                        }
                        
                    }
                }
                $subgen=Genre::select('id')->where('is_deleted','=','N')->where('is_published','=','Y')->where('parent_genre_id','=',$key_gen)->get();
                if (count($subgen) > 0) {
                    foreach($subgen as  $sbgen)
                    {
                        $up2 = new Userpreferance;
                        $up2->preference_id = $sbgen->id;
                        $up2->user_id = Auth::user()->id;
                        $up2->is_delete = '0';                
                        $up2->save();
                    }
                }
                
            }

            $request->session()->put('is_first_login',0);
            User::where('id','=',Auth::user()->id)->update(['last_login'=>date("Y-m-d H:i:s")]);
            return redirect('dashboard');*/
        }else{
            return back()->withInput()->withErrors(['Select 3 or more to continue']);
        }
    }
    


    public function delete_image(Request $request)
    {
       $user_id = Auth()->user()->id;
       $delete = User::where("id",'=',$user_id)->update(['profile_image'=>'']);
       return $delete;
    }
    public function removeFollower(Request $request){
        $exist= Followers::where('user_id','=',$request->follower_id)->where('follower_id','=',Auth::user()->id)->first();
        if($exist!=null)
        {
            Followers::where('user_id','=',$request->follower_id)->where('follower_id','=',Auth::user()->id)->delete();
            return 1;
        }
    }
    public function ascendingfollowing(Request $request) {
        if (!isset(Auth::guard('web')->user()->id)) {
            return redirect('login');
        } else {
            if($request->sortconnaz=='yes') {
                $user_follower = Followers::join('users','user_following.follower_id','=','users.id')
                ->where('user_following.user_id',"=",Auth::guard('web')->user()->id)
                ->where('user_following.is_delete',"=",0)
                ->orderBy('users.first_name', 'ASC')
                ->orderBy('users.last_name','ASC');
                if(isset($request->name) && $request->name != ""){
                    $user_follower = $user_follower->where('users.name','LIKE','%'.$request->name."%");
                }
                $user_follower = $user_follower->paginate(4);
                return view('profile.ajax_ascfollowing', compact('user_follower'));
            } else {
                return 0;
            }
        }
    }
    public function descendingfollowing(Request $request) {
        if (!isset(Auth::guard('web')->user()->id)) {
            return redirect('login');
        } else {
            if($request->sortconnaz=='yes') {
                $user_follower = Followers::join('users','user_following.follower_id','=','users.id')
                ->where('user_following.user_id',"=",Auth::guard('web')->user()->id)
                ->where('user_following.is_delete',"=",0)
                ->orderBy('users.first_name', 'DESC')
                ->orderBy('users.last_name','DESC');
                if(isset($request->name) && $request->name != ""){
                    $user_follower = $user_follower->where('users.name','LIKE','%'.$request->name."%");
                }
                $user_follower = $user_follower->paginate(4);
                return view('profile.ajax_desfollowing', compact('user_follower'));
            } else {
                return 0;
            }
        }
    }
    public function ascendingFollower(Request $request) {
        if (!isset(Auth::guard('web')->user()->id)) {
            return redirect('login');
        } else {
            if($request->sortconnaz=='yes') {
                $user_followers = Followers::join('users','user_following.user_id' , '=' ,'users.id')->where("user_following.follower_id","=",Auth::guard('web')->user()->id)->where('user_following.is_delete','=',0)->orderBy('users.first_name', 'ASC')->orderBy('users.last_name','ASC')->paginate(4);
                return view('profile.ajax_ascfollower', compact('user_followers'));
            } else {
                return 0;
            }
        }
    }
    public function descendingFollower(Request $request) {
        if (!isset(Auth::guard('web')->user()->id)) {
            return redirect('login');
        } else {
            if($request->sortconnaz=='yes') {
                $user_followers = Followers::join('users','user_following.user_id' , '=' ,'users.id')->where("user_following.follower_id","=",Auth::guard('web')->user()->id)->where('user_following.is_delete','=',0)->orderBy('users.first_name', 'DESC')->orderBy('users.last_name','DESC')->paginate(4);
                return view('profile.ajax_desfollower', compact('user_followers'));
            } else {
                return 0;
            }
        }
    }
    public function searchFollower(Request $request) {

        if (!isset(Auth::guard('web')->user()->id)) {
            return redirect('login');
        } else {
 
 
            if($request->search_follower!='')
            {
                $userid = User::select('id')
                ->where('first_name','like',"%".$request->search_follower."%")
                ->orwhere('last_name','like',"%".$request->search_follower."%")
                ->get();
                foreach ($userid as $value) {
                    $userfollower = Followers::select()
                    ->where('follower_id',"=",Auth::guard('web')->user()->id)
                    ->where('user_id','=',$value->id)
                    ->where('is_delete',"=",1)
                    ->first();
                    if(!empty($userfollower)){
                        $user_follower[] = $userfollower->user_id;
                    }
                }
                if (!isset($user_follower)) {
                    $user_follower = array();
                }
                return view('profile.ajax_follower', compact('user_follower'));
            }else{
                $userid = User::select('id')->get();
                foreach ($userid as $value) {
                    $userfollower = Followers::select()
                    ->where('follower_id',"=",Auth::guard('web')->user()->id)
                    ->where('user_id','=',$value->id)
                    ->where('is_delete',"=",1)
                    ->first();
                    if(!empty($userfollower)){
                        $user_follower[] = $userfollower->user_id;
                    }
                }
                if (!isset($user_follower)) {
                    $user_follower = array();
                }
                return view('profile.ajax_follower', compact('user_follower'));
            }
 
        }
    }
    
    public function viewBlockUser()
    {
        $block_user=Connection::getBlockUsers(Auth::guard('web')->user()->id,false);
        $block_user_total=count(Connection::getBlockUsers(Auth::guard('web')->user()->id,false,array(),'ASC',4));
        return view('profile.block_user',compact('block_user','block_user_total'));
    }
    public function unblockUser(Request $request)
    {
       $connection_id = $request['connection_id'];
       $block_user = Connection::where("user_id",'=',Auth::user()->id)
       ->where('connect_user_id','=',$connection_id)
       ->where('is_block','=',1)
       ->update(['is_block'=>0]);
       return 1;
    }

    public function getBlockUsers(Request $request) {
        if (!isset(Auth::guard('web')->user()->id)) {
            return redirect('login');
        } else {
            $orderBy = $request->orderBy;
            $page = $request->page+4;
            $whereArr = array('search_connection' =>$request->search_block);
            $block_user=Connection::getBlockUsers(Auth::guard('web')->user()->id,false,$whereArr,$orderBy,$request->page);
            $block_user_total=count(Connection::getBlockUsers(Auth::guard('web')->user()->id,true,$whereArr,$orderBy,$page));
            return view('profile.ajax_block_user', compact('block_user','block_user_total','page'));
        }
    }
   
}
