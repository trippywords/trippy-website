<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Validator;

use Redirect;

use App\Smtp;

use  App\Contactus;

use Laravel\Socialite\Facades\Socialite;

use App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use DB;

use Illuminate\Support\Facades\Mail;

use App\Userpreferance;

use App\Blog;

use App\Genre;
use session;


class HomeController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		//$this->middleware('auth');

		session()->put('facebook_redirect_url','profile/#');

	}



	/**

	 * Show the application dashboard.

	 *

	 * @return \Illuminate\Http\Response

	 */

	public function index(Request $request) { 

		
		$is_first_login = $request->session()->get('is_first_login');
		if (isset($is_first_login) && $is_first_login==1) {
			return redirect('preference'); 
		}
        
		Blog::where('id','!=',null)->update(['tags'=>'city,design,image,pople,work,color']);

			//        $user=User::select('id')->where("email","=","test2.cosmonautgroup@gmail.com")->first();

			//        Userpreferance::where('user_id','=',$user->id)->delete();

			//        exit;

		if($request->error_reason=='user_denied')

		{

			return redirect('/');

		}else{

		

		}

		if(isset(Auth::guard('web')->user()->id))

		{

		 if($request->state!='')

			 {

				$fbuser = \Socialite::driver('facebook')->user();                     

				$user = User::find(Auth::guard('web')->user()->id);                

				$user->facebook_id = $fbuser->id;

				$user->save();

			 }

			 if($request->oauth_verifier!='')

			 {

				$twuser = \Socialite::driver('twitter')->user();                

				$user = User::find(Auth::guard('web')->user()->id);

				$user->twitter_id = $twuser->nickname;

				$user->save();

			 }

				return redirect('account-details');


		}else{

			if($request->state!='')

			 {

				//                User::where('email','=','hr@cosmonautgroup.com')->delete();

				//                User::where('email','=','nileshpurabiya921@gmail.com')->delete();

				//                exit;

				$fbuser = \Socialite::driver('facebook')->user();            

				$checkIsexist=User::where('email','=',$fbuser->email)->count();

				if($checkIsexist==1)

				{
					$user = User::where('email', $fbuser->email)->where('is_verified',1)->first();                    

					if($user==null) {     

						$request->session()->flash('facebooksigninerr', 'Invalid Login Credentials Or Your Account is Disabled');

						return redirect('/');

					}else{

						Auth::login($user);
						
						return redirect('/dashboard');

					}

				}else{

					$length=8;

					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";

					$password = substr( str_shuffle( $chars ), 0, $length );

					

						$user=new User;

						$user->name=$fbuser->name;

						$user->email=$fbuser->email;

						$user->facebook_id=$fbuser->id;

						$user->password=Hash::make($password);

						$user->remember_token=$user->facebook_id;

						$user->role_id=0;

						$user->is_delete='0';

						$user->is_verified=0;

						$user->save();



						$user_name = $fbuser->name;

						$email = $fbuser->email;//'mayur.cosmonautgroup@gmail.com'

						$token_key = $user->facebook_id;

						$password = $password;

						//$link = "<a href='" . url("accountactivate/$token_key") . "' target='_blank'>click here</a>";

						//$body_u = "Hi $user_name,\n\n click here to verify your account $link <br/>Username: $fbuser->email <br/>Password: $password";

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

						$subject_u = 'Trippywords facebook verify account email';

						$message_u = view('emails.facebooksignup',['user_name'=>$user_name,'token_key'=>$token_key]);;//$body_u;

						$headers_u = "MIME-Version: 1.0\r\n";

						$headers_u .= "Content-type: text/html; charset: utf8\r\n";

						$headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";

						//end of user email code

						if (@mail($to_u, $subject_u, $message_u, $headers_u)) {



						}

						$request->session()->flash('facebooksignupmsg', 'Facebook Signup Successfully please verify your account by your email');

						
						return redirect('/');

					
				}

			 }

			 else

			 {


			 }

			 

			 if($request->oauth_verifier!='')

			 {

				 return redirect('/home');

			 }else{

				 

			 }

		}

		return view('home');

	}


	public function about() {

		return view('about-us');

	}


	public function contact() {

		return view('contact-us');

	} 

	public function contactussend(Request $request){

            $contactus=new Contactus;

        	$contactus->name= $request->fullname;

            $contactus->email= $request->email;

            $contactus->message= $request->message;

            $contactus->is_deleted= '0'; 

            $contactus->save();


		$messsages = array(

			'g-recaptcha-response.required' => 'Google Captcha rquired',

			 'email.required' => 'Email is required.',

			 'email.email' => 'Email is not valid.',

			 'message.required' => 'Message is required.',

			 'fullname.required' => 'Fullname is required.',

		);

	   	$rules = [

		   'fullname' => 'required',                   

		   'email' => 'required|email',                   

		   'message' => 'required'     

		];

		$validator = Validator::make($request->all(), $rules, $messsages);

		if ($validator->passes()) {

			
			$body="<table border='1'> ";

			$body.=" <tr> ";

				$body.=" <td>Fullname</td> ";

				$body.=" <td>$request->fullname</td> ";

			$body.=" </tr> ";

			

			$body.=" <tr> ";

				$body.=" <td>Email</td> ";

				$body.=" <td>$request->email</td> ";

			$body.=" </tr> ";

			$body.=" <tr> ";

				$body.=" <td>Message</td> ";

				$body.=" <td>$request->message</td> ";

			$body.=" </tr> ";

			$body.=" </table> ";

			

			$body_admin='<!DOCTYPE html><html><head><title>TrippyWords</title></head>

				<body style="font-family: arial; background-color: #f4f4f4; margin: 0px; padding: 0px;">

				<div style="text-align: center; margin: 30px 0px;">					

					<img src="'.asset("assets/email-template/image/logo.png").'" style="width:300px" />

			   	</div>

				<div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">

					<div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">			

						<div style="font-size: 30px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">				

							CONTACT US EMAIL

						</div>

					</div>

					<div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">

						<div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">				

							Hey <span style="color: #2e2e2e;">Admin</span>,You have received new inquiry.<br/><br/>

						</div>

						<div style="width:290px; margin: auto;">				

							'.$body.'

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

			$smtp=Smtp::select('from_name','from_email')->first();

			

			$to = $smtp->from_name."<".$smtp->from_email.">";

			$subject = 'Trippyword New Inquiry';

			$message = view('emails.contact_us_admin',['fromname'=>$smtp->from_name,'fullname'=>$request->fullname,'email'=>$request->email,'message'=>$request->message]);//$body_admin;

			

			$headers = "MIME-Version: 1.0\r\n";

			$headers .= "Content-type: text/html; charset: utf8\r\n";

			$headers .= "From: $request->fullname<$request->email>" . "\r\n".

						"Reply-To: $request->email" . "\r\n" .

						'X-Mailer: PHP/' . phpversion();

					
     

			$body_u='<!DOCTYPE html><html><head><title>TrippyWords</title></head>

				<body style="font-family: arial; background-color: #f4f4f4; margin: 0px; padding: 0px;">

				<div style="text-align: center; margin: 30px 0px;">					

					<img src="'.asset("assets/email-template/image/logo.png").'" style="width:300px" />

			   	</div>

				<div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">

					<div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">			

						<div style="font-size: 30px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">				

							CONTACT US EMAIL

						</div>

					</div>

					<div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">

						<div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">				

							Hey <span style="color: #2e2e2e;">'.$request->fullname.'</span>,Your inquiry sent to admin.will reply back to you soon<br/><br/>

						</div>

						<div style="width:290px; margin: auto;">				

							

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

			$to_u = $request->fullname."<".$request->email.">";

			$subject_u = 'Trippyword Inquiry';

			$message_u = view('emails.contact_us_requested',['fullname'=>$request->fullname]);//$body_u;

			$headers_u = "MIME-Version: 1.0\r\n";

			$headers_u .= "Content-type: text/html; charset: utf8\r\n";

			$headers_u .= "From: $smtp->from_name<$smtp->from_email>" . "\r\n" .

					"Reply-To: $smtp->from_email" . "\r\n" .

					'X-Mailer: PHP/' . phpversion();

			//end of user email code

			
			return redirect('thankyou');

		}else{

			return redirect::back()->withErrors($validator)->withInput();    

		}

	}

	public function thankyou(){

		return view('thankyou');

	}

	public function showSingleBlog($id)
	{
		// print_r($id);
		$single_blog=Blog::getSingleBlog($id);
		echo "<pre>";
		print_r($single_blog);
	}

	public function showMultiBlog($id)
	{
		$multi_blog=Blog::getGenreBlog($id);
		echo "<pre>";
		print_r($multi_blog);
	}

	public function Home(Request $request){

		if(isset(Auth()->user()->id) && intval(Auth()->user()->id) > 0)
		{
			$user_id=Auth()->user()->id;

		}
		else{
			$user_id=null;

		}

		//For getting featured blogs with one blog as per timestamp 
		$getFeaturedBlog = Blog::getFeaturedBlog($user_id);

		//For getting parent genre for featured blog details
		$parentGenreResult=Blog::getParentGenre($user_id);

		foreach ($parentGenreResult as $row) {
			//for getting child genre for featured blogs details	
			$childGenreResult=Blog::getChildGenre($row->parentGenreId,$user_id);
			
			$row->childGenres=$childGenreResult;
			$blogResult=array();

			foreach ($childGenreResult as $blogs) {
				//for getting multiple blogs per child genre for featured blog details		
				$blogResult=Blog::getChildBlogs($blogs->childgenreid);
				
				$blogs->blogs=$blogResult;		

			}
			$finalsResult[]=$row;
		}

		
		//JSON for featuredBlogs
		$featuredBlogs = json_encode(['featuredBlogs'=>$getFeaturedBlog],JSON_PRETTY_PRINT);
		//JSON for FeaturedBlogDetails
		$featuredBlogsDetails = json_encode(['featuredBlogsDetails' => $finalsResult],JSON_PRETTY_PRINT);
		/*echo "<pre>";
		print_r($featuredBlogsDetails);
		*/
		//dd();
		return view('home',compact('featuredBlogs','featuredBlogsDetails'));
	}

}

