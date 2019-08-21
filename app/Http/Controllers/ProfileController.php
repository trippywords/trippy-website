<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;

use Laravel\Socialite\Facades\Socialite;

use App\Userpreferance;

use App\Genre;

use App\Notifications;

use App\Usernotification;

use App\Blog;

use App\Connection;

use App\Followers;

use Illuminate\Support\Facades\DB;

use stdClass;

use App\Smtp;

use App\Bookmarks;



class ProfileController extends Controller {



	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	function __construct() {

		// $this->middleware('permission:product-list');

		// $this->middleware('permission:product-create', ['only' => ['create','store']]);

		// $this->middleware('permission:product-edit', ['only' => ['edit','update']]);

		// $this->middleware('permission:product-delete', ['only' => ['destroy']]);





		/* Check for if user is logged in or not */



		if(!Auth::user())

		{

		    redirect('/');

		}



	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index() {

			

	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function create() {

		

	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request) {

		

	}



	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */

	public function show(Product $product) {

		

	}

	public function twittercallback(Request $request){
		$user = Socialite::with('twitter')->user();
		$this->twitterLogin($user, 'twitter');
        return redirect("social/#");
	}

	public function twitterLogin($user,$provider) {
		if (Auth::user()) {
    		User::where("id",Auth::user()->id)->update(['twitter_id' => $user->id,'twitter_username' => isset($user->nickname)?$user->nickname:'']);
    		return 1;
    	}
	}


	public function disconnectFB(Request $request)
    {
		if(intval(Auth::user()->id) > 0){
			User::where("id","=",Auth::user()->id)->update(['facebook_id'=>'','facebook_profile_url'=>'']);
			return 0;
		}else{
			return 1;
		}
    }

    public function disconnectTW(Request $request)
    {
		if(intval(Auth::user()->id) > 0){
			User::where("id","=",Auth::user()->id)->update(['twitter_id'=>'','twitter_username'=>'']);
			return 0;
		}else{
			return 1;
		}
    }
	


	/**

	 * Show the form for editing the specified resource.

	 *

	 * @param  \App\Product  $product

	 * @return \Illuminate\Http\Response

	 */


	  public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request,$provider)
    {
        $user = Socialite::with($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);

        $preference_redirect_url = $request->session()->get('preference_redirect_url');
        $facebook_redirect_url = $request->session()->get('facebook_redirect_url');
        if (isset($preference_redirect_url) && $preference_redirect_url!='') {
        	return redirect($preference_redirect_url);
        }elseif (isset($facebook_redirect_url) && $facebook_redirect_url!='') {
        	if (Auth::user()) {
	          session(['is_first_login'=>0]);
	        }
        	return redirect($facebook_redirect_url);
        }
        return redirect("social/#");
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
    	//323880038180740|U8kcf-xJxh-nf2WN4Xey9jr9fOA (facebook access token)
    	if (Auth::user()) {
    		$facebook_profile_url = 'https://www.facebook.com/profile.php/'.$user->id;
    		User::where("id",Auth::user()->id)->update(['facebook_id' => $user->id,'facebook_profile_url'=>$facebook_profile_url]);
    	}else{
    		$authUser = User::where('facebook_id', $user->id)->where('is_delete', '0')->first();
    		$authEmailUser = User::whereRaw("(`email` = '".$user->email."' OR `primary_email` = '".$user->email."')")->first();
	        if (!empty($authUser)) {
		        $authSuccess = Auth::loginUsingId($authUser->id);
		        if($authSuccess) {   
		            date_default_timezone_set('Asia/Kolkata');      
		            $date=date("Y-m-d H:i:s");
		            $facebook_profile_url = 'https://www.facebook.com/profile.php/'.$user->id;
		            if (isset($authUser->email) && $authUser->email==$user->email) {
		            	User::where("email","=",$authUser->email)->update(['last_login'=>$date,'facebook_profile_url'=>$facebook_profile_url,'is_verified'=>1]);
		            }else{
		            	User::where("email","=",$authUser->email)->update(['last_login'=>$date,'facebook_profile_url'=>$facebook_profile_url,'is_verified'=>1,'is_primary_verified'=>1]);
		           	} 
		            return redirect('dashboard');
		        }
	        	return 1;
	        }elseif (!empty($authEmailUser)) {
	        	User::where("email",$user->email)->update(['facebook_id' => $user->id]);
	        	$authUser = User::where('facebook_id', $user->id)->first();
		        $authSuccess = Auth::loginUsingId($authUser->id);
		        if($authSuccess) {   
		            date_default_timezone_set('Asia/Kolkata');      
		            $date=date("Y-m-d H:i:s");
		            $facebook_profile_url = 'https://www.facebook.com/profile.php/'.$user->id;
		            if (isset($authEmailUser->email) && $authEmailUser->email==$user->email) {
		            	User::where("email","=",$authUser->email)->update(['last_login'=>$date,'facebook_profile_url'=>$facebook_profile_url,'is_verified'=>1]);
		            }else{
		            	User::where("email","=",$authUser->email)->update(['last_login'=>$date,'facebook_profile_url'=>$facebook_profile_url,'is_verified'=>1,'is_primary_verified'=>1]);
		           	} 	
		            return redirect('dashboard');
		        }
	        	return 1;
	        }else{
	        	if (isset($user->email) && $user->email!='') {
		        	$first_name = $last_name ='';
		        	$name = preg_split("/[\s,]+/", $user->name);
		        	if (!empty($name)) {
		        		$i =1;
		        		foreach ($name as $value) {
		        			if ($i ==count($name)) {
		        				$last_name = $value;
		        			}else{
		        				$first_name .= $value.' ';
		        			}
		        			$i++;
		        		}
		        	}
		        	$username = preg_split("/[@]+/", $user->email);
		        	$user_name = isset($username[0])?$username[0]:'';
		        	if (isset($user_name) && $user_name!='') {
		        		$usernameExist = User::where(["name"=>$user_name,'is_delete'=>'0'])->count();
		        		if (intval($usernameExist) > 0) {
		        			$user_name = $user_name.'1';
		        		}
		        	}
		        	$password = rand(000000,999999);
		        	$data = array('email'=>$user->email,
		        				  'primary_email'=>$user->email,
		        				  'name'=>$user_name,
		        				  'first_name'=>ucfirst($first_name),
		        				  'last_name'=>ucfirst($last_name),
		        				  'is_verified'=>1,
		        				  'is_primary_verified'=>1,
		        				  'role_id'=> '2',
		                          'is_delete' => '0',
		        				  'password'=>Hash::make($password),
		        				  'created_at'=>date("Y-m-d H:i:s"));
		        	//if (isset($user->profileUrl) && $user->profileUrl!='') {
		        		//$data['facebook_profile_url'] = 'https://www.facebook.com/profile.php/'.$user->id;
		        		//$data['facebook_profile_url']=$user->profileUrl;
		        	//}
		        	if (User::create($data)) {
		        		$facebook_profile_url = 'https://www.facebook.com/profile.php/'.$user->id;
		        		User::where("email",$user->email)->update(['facebook_id' => $user->id,'facebook_profile_url'=>(string) $facebook_profile_url]);
		        		$data['new_password'] = $password ;
		                $to_u = $user->email;
		                $subject_u = 'Trippywords - Facebook Registration';
		                $message_u = view('emails.signup_with_facebook',$data);//$body_u;
		                $headers_u = "MIME-Version: 1.0\r\n";
		                $headers_u .= "Content-type: text/html; charset: utf8\r\n";
		                $headers_u .= "From:TrippyWords <".Smtp::select('from_email')->first()->from_email.">\r\n";
		                //end of user email code
		                if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
		                    
		                }
		                $authSuccess = Auth::attempt(['email'=>$user->email,'password'=>$password], 1);
		                session(['preference_redirect_url'=>'preference/#']);
				        if($authSuccess) {   
				            date_default_timezone_set('Asia/Kolkata');      
				            $date=date("Y-m-d H:i:s");
				            User::where("email","=",$user->email)->update(['last_login'=>$date]);
				            return redirect('dashboard');
				        }
		        		return 1;
		        	}
		       	}else{
		       		echo "string";die;
	        		return false;
	        	}
	       	} 	
	    }  	
    }

	public function edit(Request $request) {
		$publish_blogs = Blog::getBlogs(Auth::user()->id,0,array('blog_status'=>1));
		$publish_total = count(Blog::getBlogs(Auth::user()->id,4,array('blog_status'=>1)));

		if ($request->ajax()) {

			$view = view('blog.view_published_blog', compact('publish_blogs'))->render();

			return response()->json(['html' => $view]);

		}
		return view('profile.edit', compact('publish_blogs','publish_total'));
	}


	public function getBlogs(Request $request) {
		$page = $request->page+4;
		if(isset($request->draft) && $request->draft == 1){
			$draft_blogs = Blog::getBlogs(Auth::user()->id,$request->page,array('blog_status'=>2));
			$draft_total = count(Blog::getBlogs(Auth::user()->id,$page,array('blog_status'=>2)));
          	return view('blog.view_draft_blog', compact('draft_blogs','draft_total','page'));
        } else {
        	$publish_blogs = Blog::getBlogs(Auth::user()->id,$request->page,array('blog_status'=>1));
			$publish_total = count(Blog::getBlogs(Auth::user()->id,$page,array('blog_status'=>1)));
          	return view('blog.view_published_blog', compact('publish_blogs','publish_total','page'));
        }
	}

	/**

	 * Update the specified resource in storage.

	 *

	 * @param  \Illuminate\Http\Request  $request

	 * @param  \App\Product  $product

	 * @return \Illuminate\Http\Response

	 */

	public function update(Request $request, Product $product) {

		

	}



	/**

	 * Remove the specified resource from storage.

	 *

	 * @param  \App\Product  $product

	 * @return \Illuminate\Http\Response

	 */

	public function destroy(Product $product) {

		

	}



	public function update_description(Request $req) {

		$user = User::find(Auth::guard('web')->user()->id);

		$user->description = $req->get('txt_Description');

		$user->save();

		return redirect('profile'); 

	}



	public function update_profile_image(Request $req) {

		if ($req->hasFile('user_image')) {

			$uploadFolder = public_path('user_img/');

			$file = $req->file('user_image');

			$customimagename = time() . '.' . $file->getClientOriginalExtension();

			$destinationPath = $uploadFolder;

			$file->move($destinationPath, $customimagename);

			$profile_img = $customimagename;

			$user = User::find(Auth::guard('web')->user()->id);

			$user->profile_image = $customimagename;

			$user->save();

			return redirect('profile');

		}

	}

	public function accountdetails(Request $request) {

		$request->session()->put('facebook_redirect_url','social/#');

		if (!isset(Auth::guard('web')->user()->id)) {

			return redirect('login');

		} else {
			//function to get notifications
			$notifications = Notifications::getNotifications(0);
			$notifications_total = count(Notifications::getNotifications(10));

			//function to get connections
			$user_connection=Connection::getConnections(Auth::guard('web')->user()->id,false);
			$user_connection_total=count(Connection::getConnections(Auth::guard('web')->user()->id,true,array(),'ASC',4));

			//function to get followers
			$user_followers=Followers::getFollowers(Auth::guard('web')->user()->id,false);
			$user_followers_total=count(Followers::getFollowers(Auth::guard('web')->user()->id,true,array(),'ASC',4));

			//function to get Followings
			$user_follower=Followers::getFollowings(Auth::guard('web')->user()->id,false);
			$user_follower_total=count(Followers::getFollowings(Auth::guard('web')->user()->id,true,array(),'ASC',4));

			//$requserdata=Connection::join('users','user_connection.user_id','=','users.id')->where('connect_user_id','=',Auth::user()->id)->where("user_connection.is_request",'=',1)->where('user_connection.is_delete','=',0)->where('users.is_verified','=',1)->where('users.is_delete',"=",'0')->paginate(4); 
			//$requserdata_total=Connection::join('users','user_connection.user_id','=','users.id')->where('connect_user_id','=',Auth::user()->id)->where("user_connection.is_request",'=',1)->where('user_connection.is_delete','=',0)->where('users.is_verified','=',1)->where('users.is_delete',"=",'0')->count();       

			$requserdata=Connection::getConnectionRequest(Auth::guard('web')->user()->id);
			$requserdata_total=count(Connection::getConnectionRequest(Auth::guard('web')->user()->id,4));

			$bookmarklist=Bookmarks::where('is_delete','=',0)->where('user_id','=',Auth::user()->id)->orderBy('id','DESC')->paginate(4);
			$bookmarklist_total=Bookmarks::where('is_delete','=',0)->where('user_id','=',Auth::user()->id)->count();


	
			if($request->segment(1)=='account-details'){
				$tab='account-details';
			}else if($request->segment(1)=='connections'){
				$tab='connections';
				if ($request->ajax()) {
					$view = view('profile.ajax_profile_tabs', compact('user_connection','tab'))->render();
					return response()->json(['html' => $view]);
				}
			}else if($request->segment(1)=='bookmarks'){
				$tab='bookmarks';
				if ($request->ajax()) {
					$view = view('profile.ajax_profile_tabs', compact('bookmarklist','tab'))->render();
					return response()->json(['html' => $view]);
				}
			}else if($request->segment(1)=='notifications'){
				$tab='notifications';
			}else if($request->segment(1)=='preference-list'){
				$tab='preference-list';
			}else if($request->segment(1)=='notification-list'){
				$tab='notification-list';
				if ($request->ajax()) {
					$view = view('profile.ajax_profile_tabs', compact('notifications','tab'))->render();
					return response()->json(['html' => $view]);
				}
			}else if($request->segment(1)=='social'){
				$tab='social';
			}else if($request->segment(1)=='request'){
				$tab='request';
				if ($request->ajax()) {
					$view = view('profile.ajax_profile_tabs', compact('requserdata','tab'))->render();
					return response()->json(['html' => $view]);
				}
			}else if($request->segment(1)=='following'){
				$tab='following';
				if ($request->ajax()) {
					$view = view('profile.ajax_profile_tabs', compact('user_follower','tab'))->render();
					return response()->json(['html' => $view]);
				}
			}else if($request->segment(1)=='followers'){
				$tab='followers';
				if ($request->ajax()) {
					$view = view('profile.ajax_profile_tabs', compact('user_followers','tab'))->render();
					return response()->json(['html' => $view]);
				}
			}else{
				$tab='account';
			}
			return view('profile.accounts', compact('notifications','notifications_total','user_connection','user_connection_total','user_follower','user_follower_total','tab','requserdata','requserdata_total','bookmarklist','bookmarklist_total','user_followers_total','user_followers'));
		}

	}

	public function getConnDetails(Request $request) {
		if (!isset(Auth::guard('web')->user()->id)) {
			return redirect('login');
		} else {
			$orderBy = $request->orderBy;
			$page = $request->page+4;
			$whereArr = array('search_connection' =>$request->search_connection);
			$user_connection=Connection::getConnections(Auth::guard('web')->user()->id,false,$whereArr,$orderBy,$request->page);
			$user_connection_total=count(Connection::getConnections(Auth::guard('web')->user()->id,true,$whereArr,$orderBy,$page));
			return view('profile.ajax_connection', compact('user_connection','user_connection_total','page'));
		}
	}

	public function getFollowers(Request $request) {
		if (!isset(Auth::guard('web')->user()->id)) {
			return redirect('login');
		} else {
			$orderBy = $request->orderBy;
			$page = $request->page+4;
			$whereArr = array('search_follower' =>$request->search_follower);
			$user_followers=Followers::getFollowers(Auth::guard('web')->user()->id,false,$whereArr,$orderBy,$request->page);
			$user_followers_total=count(Followers::getFollowers(Auth::guard('web')->user()->id,true,$whereArr,$orderBy,$page));
			return view('profile.ajax_follower', compact('user_followers','user_followers_total','page'));
		}

	}

	public function getFollowings(Request $request) {
		if (!isset(Auth::guard('web')->user()->id)) {
			return redirect('login');
		} else {
			$orderBy = $request->orderBy;
			$page = $request->page+4;
			$whereArr = array('search_following' =>$request->search_following);
			$user_follower=Followers::getFollowings(Auth::guard('web')->user()->id,false,$whereArr,$orderBy,$request->page);
			$user_follower_total=count(Followers::getFollowings(Auth::guard('web')->user()->id,true,$whereArr,$orderBy,$page));
			return view('profile.ajax_following', compact('user_follower','user_follower_total','page'));
		}

	}

	public function getNotifications(Request $request) {
		if (!isset(Auth::guard('web')->user()->id)) {
			return redirect('login');
		} else {
			$page = $request->page+10;
			$notifications=Notifications::getNotifications($request->page);
			$notifications_total=count(Notifications::getNotifications($page));
			return view('profile.ajax_notificaions', compact('notifications','notifications_total','page'));
		}

	}

	public function getConnectionRequest(Request $request) {
		if (!isset(Auth::guard('web')->user()->id)) {
			return redirect('login');
		} else {
			$page = $request->page+4;
			$requserdata=Connection::getConnectionRequest(Auth::guard('web')->user()->id,$request->page);
			$requserdata_total=count(Connection::getConnectionRequest(Auth::guard('web')->user()->id,$page));
			return view('profile.ajax_requests', compact('requserdata','requserdata_total','page'));
		}

	}
	
	 public function update_name(Request $req) {
        $user_exist = User::select('name')->where('name', '=', $req->get('txtUsername'))->where('is_delete', '=','0')->where('id','!=',Auth::guard('web')->user()->id)->first();
        if ($user_exist != null) {
            return 1;
        }else{

        	if (trim($req->get('txtUsername'))==Auth::guard('web')->user()->name) {
        		return 2;
        	}else{
        		User::where('id',Auth::guard('web')->user()->id)->update(['name'=>$req->get('txtUsername')]);
           		return 0;
        	}
            
    	}
    }
 



	 public function update_fname(Request $req) {

        $user = User::find(Auth::guard('web')->user()->id);
        if($user->first_name == trim($req->get('txtfUsername'))){
            return 0;
        } 
        else{
            $user->first_name = $req->get('txtfUsername');
            $user->save();
            return 1;
            
        }

    }




	public function update_lname(Request $req) {
		$user= User::find(Auth::guard('web')->user()->id);
		if($user->last_name == trim($req->get('txtlUsername'))){
			return 0;
		}
		else{	
			User::where('id',Auth::guard('web')->user()->id)->update(['last_name'=>$req->get('txtlUsername')]);
	        return 1;
		}
	}

	public function update_email(Request $req) {
		$user_exist = User::whereRaw("(`email` = '".$req->get('txtEmail')."' OR `primary_email` = '".$req->get('txtEmail')."') AND `id` !=".Auth::user()->id."")->first();
		if(!empty($user_exist))
		{
			return 1;
		}else{
			if (Auth::guard('web')->user()->primary_email==$req->get('txtEmail') || Auth::guard('web')->user()->email==$req->get('txtEmail')) {
				return 3;
			}else{
				$user = User::find(Auth::guard('web')->user()->id);
				User::where("id","=",Auth::user()->id)->update(['primary_email'=>$req->get('txtEmail')]);
				if ((trim($user->email)!=trim($req->get('txtEmail'))) && (trim($user->primary_email)!=trim($req->get('txtEmail')))) {
					$remember_token = str_random(50);
					User::where("id","=",Auth::user()->id)->update(["remember_primary_token"=>$remember_token,'primary_email'=>$req->get('txtEmail'),'is_primary_verified'=>0]);
			        $to_u = $user->name . "<" . $req->get('txtEmail') . ">";
					$subject_u = 'TrippyWords - Email Verification';
					$message_u = view('emails.facebooksignup',['user_name'=>$user->name,'token_key'=>$remember_token,'type'=>1,'user_id'=>Auth::user()->id]);
		 			$headers_u = "MIME-Version: 1.0\r\n";
		 			$headers_u .= "Content-type: text/html; charset: utf8\r\n";
		 			$headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";
					//end of user email code
					if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
					}
					$req->session()->flash('facebooksignupmsg', 'Email Updated Successfully please verify your account by your email');
					return 2;
				}elseif ((trim($user->email)==trim($req->get('txtEmail'))) ) {
					User::where("id","=",Auth::user()->id)->update(['is_primary_verified'=>1]);
					return 0;
				}else{
					return 0;
				}
			}	
		}
	}


	public function checkOldpassword(Request $req) {
		$user = User::find(Auth::guard('web')->user()->id);
		if (Hash::check($req->get('oldpass'), $user->password)) {
			return 1;
		} else {
			return 0;
		}
	}


	public function update_password(Request $req) {
		$user = User::find(Auth::guard('web')->user()->id);
		if (Hash::check($req->get('txtnPassword'), $user->password)) {
			return 3;
		}else{
			if (Hash::check($req->get('txtoPassword'), $user->password)) {
				if ($req->get('txtcPassword') == $req->get('txtnPassword')) {
					User::where('id',Auth::guard('web')->user()->id)->update(['password'=>Hash::make($req->get('txtnPassword'))]);
					return 0;
				} else {
					return 2;
				}
			} else {
				return 1;
			}
		}		
	}


	public function facebookLogin(Request $request) {
		return Socialite::driver('facebook')->redirect();
	}



	public function callback(Request $request) {

		$fbdetail = Socialite::driver('facebook')->user();

		$length=8;

		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";

		$password = substr( str_shuffle( $chars ), 0, $length );

		

		$user=new User;

		$user->name=$fbdetail->name;

		$user->email=$fbdetail->email;

		$user->facebook_id=$fbdetail->id;

		$user->password=Hash::make($password);

		$user->remember_token=$user->facebook_id;

		$user->role_id=0;

		$user->is_delete='0';

		$user->is_verified=0;

		$user->save();

		$user_name = $fbdetail->name;

		$email = $fbdetail->email;//'mayur.cosmonautgroup@gmail.com'

		$token_key = $user->facebook_id;

		$password = $password;

		$body_u='<!DOCTYPE html><html><head><title>TrippyWords</title></head>

							<body style="font-family: arial; background-color: #f4f4f4; margin: 0px; padding: 0px;">

							<div style="text-align: center; margin: 30px 0px;">					

								<img src="'.asset("assets/email-template/image/logo.png").'" style="width:300px" />

						   </div>

							<div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">

								<div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">			

									<div style="font-size: 30px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">				

										EMAIL CONFIRMATION

									</div>

								</div>

								<div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">

									<div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">				

										Hey <span style="color: #2e2e2e;">'.$user_name.'</span>, thanks for registration with <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.Simply click the button to verify your email address.

									</div>

									<div style="width:290px; margin: auto;">				

										<a href="'.url("accountactivate/$token_key").'" style="font-size: 18px;text-transform: uppercase;letter-spacing: 1px;padding: 10px 0px;background: #58ba47;color: #fff;border-radius: 5px;cursor: pointer;display: block;">					

											Verify Email Address

										</a>

									</div>

									<div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>

									<div style="display: flex; justify-content: center;">		

										<div>					

											<a href="#" title="Facebook">						

											<img src="'.asset("assets/email-template/image/icon-facebook.png").'" style="width: 40px; margin-right: 15px;">

											</a>

										</div>

										<div>					

											<a href="#" title="Twitter">						

											<img src="'.asset("assets/email-template/image/icon-twitter.png").'" style="width: 40px; margin-right: 15px;">

											</a>

										</div>

										<div>					

											<a href="#" title="Instagram">						

												<img src="'.asset("assets/email-template/image/icon-instagram.png").'" style="width: 40px; margin-right: 15px;">

											</a>

										</div>

										<div>					

											<a href="#" title="Linkedin">						

												<img src="'.asset("assets/email-template/image/icon-linkedin.png").'" style="width: 40px;">

											</a>

										</div>

									</div>	

								</div>

							</div>

							<div style="text-align: center; font-size: 12px; color: #707070; line-height: 145%; margin-bottom: 30px;">		

								Email sent by <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>		

								<br>

								Copyright &copy; 2018 StayRunners - All Rights Reserved.

							</div>

						</body>

						</html>';

						$to_u = $user_name . "<" . $email . ">";

						$subject_u = 'TrippyWords - New Connection Request';

						$message_u = view('emails.facebooksignup',['user_name'=>$user_name,'token_key'=>$token_key]);;//$body_u;

						$headers_u = "MIME-Version: 1.0\r\n";

						$headers_u .= "Content-type: text/html; charset: utf8\r\n";

						$headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";

						//end of user email code

						if (@mail($to_u, $subject_u, $message_u, $headers_u)) {



						}
		$request->session()->flash('facebooksignupmsg', 'Facebook Signup Successfully please verify your account by your email');

		//auth()->login($user);

		return redirect()->to('/home');

	}

	//update by parrent id 
	public function updateUPbyid(Request $request) {
		$checkUP = Userpreferance::where('user_id', '=', Auth::user()->id)->where('is_delete', '=', 0)->where('preference_id', '=', $request->parrent_id)->count();
		
		if (isset($checkUP) && $checkUP > 0) {
			$chilP = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrent_id])->update(['is_delete'=>1]);
			$childgenres = getChildgenres($request->parrent_id);

			foreach ($childgenres as $child) {
				$checkSub = Userpreferance::where('user_id', '=', Auth::user()->id)->where('preference_id', '=', $request->parrent_id)->first();
				if (!empty($checkSub)) {
					Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$child->id])->update(['is_delete'=>1]);
				}else{
					Userpreferance::insert(['user_id'=>Auth::user()->id,'preference_id'=>$child->id,'is_delete'=>1]);
				}
			}
		
			$return['status'] = 0;

			$return['childelement'] = $childgenres;

		} else {
			$checkUP = Userpreferance::where('user_id', '=', Auth::user()->id)->where('preference_id', '=', $request->parrent_id)->count();
			if (isset($checkUP) && $checkUP > 0) {
				$chilP = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrent_id])->update(['is_delete'=>0]);
			}else{
				$chilP = Userpreferance::insert(['is_delete'=>0,'user_id'=>Auth::user()->id,'preference_id'=>$request->parrent_id]);
			}
			
			$childgenres = getChildgenres($request->parrent_id);
			foreach ($childgenres as $child) {
				$checkSub = Userpreferance::where('user_id', '=', Auth::user()->id)->where('preference_id', '=', $child->id)->first();
				if (!empty($checkSub)) {
					Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$child->id])->update(['is_delete'=>0]);
				}else{
					Userpreferance::insert(['user_id'=>Auth::user()->id,'preference_id'=>$child->id,'is_delete'=>0]);
				}
			}

				$return['status'] = 1;

				$return['childelement'] = $childgenres;
		}

		return $return;

	}


	//update by child id 

	public function updateUPbycid(Request $request) {

		$checkUP = Userpreferance::where('user_id', '=', Auth::user()->id)->where('is_delete', '=', 0)->where('preference_id', '=', $request->child_id)->count();
		
		
		if (isset($checkUP) && $checkUP > 0) {
			$chilP = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->child_id])->update(['is_delete'=>1]);
			$chilPare = Userpreferance::where('user_id', '=', Auth::user()->id)->where('preference_id', '=', $request->parrentid)->count();
			$currentUserPreferenceCount = getChildPreferencesByparent(Auth::user()->id,$request->parrentid);
			if (intval($currentUserPreferenceCount) == 0) {
				if (isset($chilPare) && $chilPare > 0) {
					$chilPare = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid])->update(['is_delete'=>1]);
				}else{
					$chilPare = Userpreferance::insert(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid,'is_delete'=>1]);
				}
				$data['return'] = 0;
			}else{
				if (isset($chilPare) && $chilPare > 0) {
					$chilPare = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid])->update(['is_delete'=>0]);
				}else{
					$chilPare = Userpreferance::insert(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid,'is_delete'=>0]);
				}
				$data['return'] = 1;
			}
			
			$data['swstatus'] = 0;
			$data['sub_return'] = 0;
			$data['sub_swstatus'] = 0;
			$data['parrent_id'] = $request->parrentid;
		}else{
			$checkUP = Userpreferance::where('user_id', '=', Auth::user()->id)->where('preference_id', '=', $request->child_id)->count();
			if (isset($checkUP) &&  $checkUP > 0) {
				$chilP = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->child_id])->update(['is_delete'=>0]);
			}else{
				$chilP = Userpreferance::insert(['is_delete'=>0,'user_id'=>Auth::user()->id,'preference_id'=>$request->child_id]);
			}
		
			$currentUserPreferenceCount = getChildPreferencesByparent(Auth::user()->id,$request->parrentid);
			$currentPreferenceCount = count(getChildgenres($request->parrentid));
			$data['sub_return'] = 1;
			$data['sub_swstatus'] = 1;
			if (intval($currentUserPreferenceCount) > 0) {
				$chilPare = Userpreferance::where('user_id', '=', Auth::user()->id)->where('preference_id', '=', $request->parrentid)->count();
				if (isset($chilPare) &&  intval($chilPare) > 0) {
					$chilP = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid])->update(['is_delete'=>0]);
				}else{
					$chilPare = Userpreferance::insert(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid,'is_delete'=>0]);
				}
				$data['return'] = 1;
				$data['swstatus'] = 1;
				$data['parrent_id'] = $request->parrentid;
			}else{
				$chilPare = Userpreferance::where('user_id', '=', Auth::user()->id)->where('preference_id', '=', $request->parrentid)->count();
				if (isset($chilPare) &&  intval($chilPare) > 0) {
					$chilP = Userpreferance::where(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid])->update(['is_delete'=>1]);
				}else{
					$chilPare = Userpreferance::insert(['user_id'=>Auth::user()->id,'preference_id'=>$request->parrentid,'is_delete'=>1]);
				}
				$data['return'] = 0;
				$data['swstatus'] = 0;
				$data['parrent_id'] = $request->parrentid;
			}
		}
		return $data;
	}



	public function updateuNotification(Request $request) {

		$checkun = Usernotification::select('notification_status')->where('user_id', '=', Auth::user()->id)->where('notification_id', '=', $request->notification_id)->first();



		if ( $checkun==null) {

			$up = new Usernotification;

			$up->notification_id = $request->notification_id;

			$up->user_id = Auth::user()->id;

			$up->notification_status = '1';

			$up->save();

			return 1;

		} else {

			if ($checkun->notification_status == '0') {

				Usernotification::where('user_id', '=', Auth::user()->id)->where('notification_id', '=', $request->notification_id)->update(['notification_status' => '1']);

				return 1;

			} else {

				Usernotification::where('user_id', '=', Auth::user()->id)->where('notification_id', '=', $request->notification_id)->update(['notification_status' => '0']);

				return 0;

			}

		}

	}

	public function updateSocialstatus(Request $request){

		$checkustatus = User::select('social_icon_status')->where('id', '=', Auth::user()->id)->first();

		

		if ($checkustatus->social_icon_status==0) {

			User::where('id', '=', Auth::user()->id)->update(['social_icon_status'=>'1']);

			return 1;

		}else{

			User::where('id', '=', Auth::user()->id)->update(['social_icon_status'=>'0']);

			return 0;

		}

	}

	public function userProfile($username,Request $request){
		$userdetails=User::where("name","=",$username)->where('is_verified',1)->where('is_delete','0')->first();
		if (empty($userdetails)) {
			return Redirect::back();
		}
		$users=User::select("id","name")->get();

		foreach($users as $user)

		{
			$newusername=str_replace(" ","",$user->name); 

			User::where("id","=",$user->id)->update(["name"=>$newusername]);   

		}
		 if($userdetails!=null)
		 {
			$blogdetails=Blog::where("created_by",'=',$userdetails->id)->where("blog_status","=","1")->where('is_delete','=','0')->orderBy('id', 'DESC')->get();


			if ($request->ajax()) {

				$view = view('profile.viewblogloadmore',compact('userdetails','blogdetails'))->render();

				return response()->json(['html'=>$view]);

			}

		 }else{

			 $userdetails=[];

			 $blogdetails=[];

		 }
		return view('profile.usersdetails',compact('userdetails','blogdetails'));

	}

	public function getPeople(){


		$getLoginPrefid= Userpreferance::select('preference_id')->join("users","users.id","=","user_preferences.user_id")->where('user_id','=',Auth::user()->id)->where('user_preferences.is_delete','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')->get();                

		$userdetails=Userpreferance::join("users","users.id","=","user_preferences.user_id")->where('user_id','!=',Auth::user()->id)->where('users.is_verified','=',1)->where('users.is_delete','=','0')->wherein('user_preferences.preference_id',$getLoginPrefid)->get();

		$arrUid=array();

		foreach($userdetails as $userdetail)

		{

			$arrUid[]=$userdetail->user_id;

		}

		

		$final_arrUid=array_unique($arrUid);        

		$ouserdetails=User::where('is_verified','=',1)->where('is_delete','=','0')->wherein('id',$final_arrUid)->get();        

		return view('profile.people',compact('ouserdetails'));

	}

	public function connect($connection_id)

	{

		$connectiondata= Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$connection_id)->where('is_delete',"=",0)->first();
		

		if($connectiondata==null)

		{

			$conn=new Connection();

			$conn->user_id=Auth::user()->id;

			$conn->connect_user_id=$connection_id;

			$conn->is_delete=0;

			$conn->is_request=1;
			$conn->connection_date=date('Y-m-d H:i:s');

			$conn->save();


			$request_user = User::where('id',$connection_id)->first();
				
				$user_name = (isset($request_user->first_name)?ucfirst($request_user->first_name):'').' '.(isset($request_user->last_name)?ucfirst($request_user->last_name):'');
				$email = (isset($request_user->email)?$request_user->email:'');
				$sender_name = ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name);

				$to_u = $user_name . "<" . $email . ">";

				$subject_u = 'TrippyWords - New Connection Request';

				$message_u = view('emails.connect',['user_name'=>$user_name,'sender_name'=>$sender_name]);;//$body_u;

				$headers_u = "MIME-Version: 1.0\r\n";

				$headers_u .= "Content-type: text/html; charset: utf8\r\n";

				$headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";

				//end of user email code

				if (@mail($to_u, $subject_u, $message_u, $headers_u)) {



				}
				/*end*/

		}else{

			if($connectiondata->is_delete==0 && $connectiondata->is_request==0)

			{

				Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$connection_id)->update(["is_delete"=>0,"is_request"=>1,'connection_date'=>date('Y-m-d H:i:s')]);
				$request_user = User::where('id',$connection_id)->first();

				
				
				$user_name = (isset($request_user->first_name)?ucfirst($request_user->first_name):'').' '.(isset($request_user->last_name)?ucfirst($request_user->last_name):'');
				$email = (isset($request_user->email)?$request_user->email:'');
				$sender_name = ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name);

				$to_u = $user_name . "<" . $email . ">";

				$subject_u = 'TrippyWords - New Connection Request';

				$message_u = view('emails.connect',['user_name'=>$user_name,'sender_name'=>$sender_name]);;//$body_u;

				$headers_u = "MIME-Version: 1.0\r\n";

				$headers_u .= "Content-type: text/html; charset: utf8\r\n";

				$headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";

				//end of user email code

				if (@mail($to_u, $subject_u, $message_u, $headers_u)) {



				}
				/*end*/

			}else{

				Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$connection_id)->delete();
				Connection::where("connect_user_id",'=',Auth::user()->id)->where("user_id","=",$connection_id)->update(["is_request"=>1]);
			}

		}

		return Redirect::back();

	}

	public function acceptRequest($userid){        

		Connection::where("user_id",'=',$userid)->where("connect_user_id","=",Auth::user()->id)->update(["is_delete"=>0,"is_request"=>0]);

		$checkconn=Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$userid)->first();

		if($checkconn==null)
		{
			$conn=new Connection();
			$conn->user_id=Auth::user()->id;
			$conn->connect_user_id=$userid;
			$conn->is_delete=0;
			$conn->is_request=0;
			$conn->connection_date=date('Y-m-d H:i:s');
			$conn->save();
		}else{
			Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$userid)->update(["is_delete"=>0,"is_request"=>0,'connection_date'=>date('Y-m-d H:i:s')]);
		}
		return Redirect::back();

	}

	public function rejectRequest($userid){

		Connection::where("user_id",'=',$userid)->where("connect_user_id","=",Auth::user()->id)->delete();

		Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$userid)->delete();

		return Redirect::back();

	}

//    public function userRequest(Request $request){

//        $requserdata=Connection::where('connect_user_id','=',Auth::user()->id)->where("is_request",'=',1)->where('is_delete','=',0)->get();        

//        return view('profile.request',compact('requserdata'));

//    }



	public function follow($follower_id)

	{

		$followerdata= Followers::where("user_id",'=',Auth::user()->id)->where("follower_id","=",$follower_id)->first();

		if($followerdata==null)

		{

			$follower=new Followers();

			$follower->user_id=Auth::user()->id;

			$follower->follower_id=$follower_id;
			$follower->followed_at = date('Y-m-d H:i:s');
			$follower->is_delete=0;

			$follower->save();
		    $usernotification = Usernotification::where(['user_id'=>$follower_id,'notification_id'=>4,'notification_status'=>'1'])->first();
	        if($usernotification!=null) {
	            $receiver = User::where('id','=',$follower_id)->first();
	            $reciever_name = (isset($receiver->first_name)?$receiver->first_name:'').' '.(isset($receiver->last_name)?$receiver->last_name:'');
	            $sender_name = (isset(Auth::user()->first_name)?Auth::user()->first_name:'').' '.(isset(Auth::user()->last_name)?Auth::user()->last_name:'');
	            $to_u = $receiver->name . "<" .$receiver->email. ">";
	            $subject_u = 'TrippyWords - Follower Request';
	            $message_u = view('emails.follwer_request',['reciever_name'=>$reciever_name,'sender_name'=>$sender_name]);
	            $headers_u = "MIME-Version: 1.0\r\n";
	            $headers_u .= "Content-type: text/html; charset: utf8\r\n";
	            $headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";
	            //end of user email code
	            if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
	            }
	        }
		}else{

			if($followerdata->is_delete==1)

			{

				Followers::where("user_id",'=',Auth::user()->id)->where("follower_id","=",$follower_id)->update(["is_delete"=>0,'followed_at' => date('Y-m-d H:i:s')]);
				$usernotification = Usernotification::where(['user_id'=>$follower_id,'notification_id'=>4,'notification_status'=>'1'])->first();
		        if($usernotification!=null) {
		            $receiver = User::where('id','=',$follower_id)->first();
		            $reciever_name = (isset($receiver->first_name)?$receiver->first_name:'').' '.(isset($receiver->last_name)?$receiver->last_name:'');
		            $sender_name = (isset(Auth::user()->first_name)?Auth::user()->first_name:'').' '.(isset(Auth::user()->last_name)?Auth::user()->last_name:'');
		            $to_u = $receiver->name . "<" .$receiver->email. ">";
		            $subject_u = 'TrippyWords - Follower Request';
		            $message_u = view('emails.follwer_request',['reciever_name'=>$reciever_name,'sender_name'=>$sender_name]);
		            $headers_u = "MIME-Version: 1.0\r\n";
		            $headers_u .= "Content-type: text/html; charset: utf8\r\n";
		            $headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";
		            //end of user email code
		            if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
		            }
		        }

			}else{

				Followers::where("user_id",'=',Auth::user()->id)->where("follower_id","=",$follower_id)->update(["is_delete"=>1]);

			}

		}
		return Redirect::back();

	}

	public function blockUser(Request $request)
	{
		if (isset($request->user_id) && intval($request->user_id) > 0) {
			$connection = Connection::where(["is_delete"=>0,"user_id"=>Auth::user()->id,"connect_user_id"=>$request->user_id])->first();
			if (!empty($connection)) {
				if (isset($connection->is_block) && $connection->is_block==1) {
					Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$request->user_id)->update(["is_block"=>0,'blocked_date'=>date('Y-m-d H:i:s')]);
					return 1;
				}else{
					Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$request->user_id)->update(["is_block"=>1,'blocked_date'=>date('Y-m-d H:i:s')]);
					//Followers::where('user_id','=',Auth::user()->id)->where('follower_id','=',$request->user_id)->where('is_delete','=',0)->update(['is_delete'=>1]);
					return 0;
				}
			}else{
				Connection::insert(["is_block"=>1,"user_id"=>Auth::user()->id,"connect_user_id"=>$request->user_id,'blocked_date'=>date('Y-m-d H:i:s'),'connection_date'=>date('Y-m-d H:i:s')]);
				return 0;
			}
		}
	}

	public function reportUser(Request $request)
	{
		if (isset($request->user_id) && intval($request->user_id) > 0) {
			$connection = Connection::where(["is_delete"=>'0',"user_id"=>Auth::user()->id,"connect_user_id"=>$request->user_id])->first();
			if ($connection!=null) {
				if (isset($connection->is_report) && $connection->is_report==0) {
					Connection::where("user_id",'=',Auth::user()->id)->where("connect_user_id","=",$request->user_id)->update(["is_report"=>1]);
					$reported_to = User::where('id',$request->user_id)->first();
					$data=array('report_by'=>ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name),
								'report_by_email'=>Auth::user()->email,
								'report_to'=>ucfirst($reported_to->first_name).' '.ucfirst($reported_to->last_name),
								'report_to_email'=>$reported_to->email
								) ;

	                $to_u = Smtp::select('from_email')->first()->from_email;
	                $subject_u = 'Trippywords - Report User';
	                $message_u = view('emails.report_user',$data);//$body_u;
	                $headers_u = "MIME-Version: 1.0\r\n";
	                $headers_u .= "Content-type: text/html; charset: utf8\r\n";
	                $headers_u .= "From:TrippyWords";
	                //end of user email code
	                if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
	                }
					return 1;
				}else{
					return 0;
				}
			}else{
				Connection::insert(["is_report"=>1,"user_id"=>Auth::user()->id,"connect_user_id"=>$request->user_id,'blocked_date'=>date('Y-m-d H:i:s'),'connection_date'=>date('Y-m-d H:i:s')]);
				$reported_to = User::where('id',$request->user_id)->first();
				$data=array('report_by'=>ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name),
							'report_by_email'=>Auth::user()->email,
							'report_to'=>ucfirst($reported_to->first_name).' '.ucfirst($reported_to->last_name),
							'report_to_email'=>$reported_to->email
							) ;

                $to_u = Smtp::select('from_email')->first()->from_email;
                $subject_u = 'Trippywords - Report User';
                $message_u = view('emails.report_user',$data);//$body_u;
                $headers_u = "MIME-Version: 1.0\r\n";
                $headers_u .= "Content-type: text/html; charset: utf8\r\n";
                $headers_u .= "From:TrippyWords";
                //end of user email code
                if (@mail($to_u, $subject_u, $message_u, $headers_u)) {}
				return 1;
			}
		}	
	}

	public function removeConnection(Request $request){
        $exist= Connection::where('connect_user_id','=',$request->uid)->where('user_id','=',Auth::user()->id)->first();
        if($exist==null)
        {
        	Connection::where('connect_user_id','=',$request->uid)->where('user_id','=',Auth::user()->id)->update(['is_delete'=>1]);
            return 1;
        }else{
            Connection::where('connect_user_id','=',$request->uid)->where('user_id','=',Auth::user()->id)->update(['is_delete'=>1]);
            return 1;
        }
    }

 	public function removeFollowing(Request $request){
        $exist= Followers::where('follower_id','=',$request->fid)->where('user_id','=',Auth::user()->id)->first();
        if($exist!=null)
        {
        	Followers::where('follower_id','=',$request->fid)->where('user_id','=',Auth::user()->id)->delete();
            return 1;
        }
    }

    public function user_facebook_id(Request $request){
    	$facebook_id = $request->get('facebook_id');
    	$user_id = Auth::user()->id;
		DB::table('users')->where('id','=',$user_id)->update(['facebook_id'=>$facebook_id]);
    	return;
    }

    public function searchPeople(Request $request){

    	if (isset($request->searchpeople) && $request->searchpeople!='') {
    		$getLoginPrefid= Userpreferance::select('preference_id')->join("users","users.id","=","user_preferences.user_id")->where('user_id','=',Auth::user()->id)->where('user_preferences.is_delete','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')->get(); 		

	        $userdetails=Userpreferance::join("users","users.id","=","user_preferences.user_id")->where('user_id','!=',Auth::user()->id)->where('users.is_verified','=',1)->whereRaw("(CONCAT(users.first_name,' ',users.last_name) like '%".$request->searchpeople."%')")->where('users.is_delete','=','0')->wherein('user_preferences.preference_id',$getLoginPrefid)->get();   
	        
	        $arrUid=array();
	        foreach($userdetails as $userdetail)
	        {
	          $arrUid[]=$userdetail->user_id;
	        }
	        $final_arrUid=array_unique($arrUid); 
	        $ouserdetails=User::where('is_verified','=',1)->where('is_delete','=','0')->wherein('id',$final_arrUid)->get();         
	        return view('profile.search_people',compact('ouserdetails'));
    	}
    	else {
            $getLoginPrefid= Userpreferance::select('preference_id')->join("users","users.id","=","user_preferences.user_id")->where('user_id','=',Auth::user()->id)->where('user_preferences.is_delete','=','0')->where('users.is_verified','=',1)->where('users.is_delete','=','0')->get();                

            $userdetails=Userpreferance::join("users","users.id","=","user_preferences.user_id")->where('user_id','!=',Auth::user()->id)->where('users.is_verified','=',1)->where('users.is_delete','=','0')->wherein('user_preferences.preference_id',$getLoginPrefid)->get();
            $arrUid=array();
            foreach($userdetails as $userdetail)
            {

                $arrUid[]=$userdetail->user_id;

            }
            $final_arrUid=array_unique($arrUid);        
            $ouserdetails=User::where('is_verified','=',1)->where('is_delete','=','0')->wherein('id',$final_arrUid)->get();        
            return view('profile.search_people',compact('ouserdetails'));
        }
    }
}

