<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Response;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Smtp;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        ini_set('memory_limit', '-1');
    }

    protected function username() {
        return 'email';
    }

    public function login(Request $request)
    {
        
        $userExist = User::whereRaw("(`email` = '".$request->email."' OR `primary_email` = '".$request->email."') AND `is_delete`='0'")->first();
        
        if (isset($userExist) && $userExist!=null) {
            if (isset($userExist->email) && $userExist->email == $request->email && $userExist->is_verified!=1) {
                return '2';
            }elseif (isset($userExist->primary_email) && $userExist->primary_email == $request->email && ($userExist->is_primary_verified!=1 || $userExist->is_verified!=1)) {
                return '2';
            }else{
                if ($userExist->email == $request->email) {
                    $credentials = array('email'=>$request->email,'password'=>$request->password);
                    $authSuccess = Auth::attempt($credentials, $request->has('remember'));
                    if($authSuccess) {           
                       
                        date_default_timezone_set('Asia/Kolkata');     
                        $date=date("Y-m-d H:i:s");
                        //User::where("email","=",$request->email)->update(['last_login'=>$date]);
                        return '1';
                    }else{
                        return '3';
                    }
                }else{
                    $credentials = array('primary_email'=>$request->email,'password'=>$request->password);
                    $authSuccess = Auth::attempt($credentials, $request->has('remember'));
                    if($authSuccess) {           
                       
                        date_default_timezone_set('Asia/Kolkata');     
                        $date=date("Y-m-d H:i:s");
                        //User::where("primary_email","=",$request->email)->update(['last_login'=>$date]);
                        return '1';
                    }else{
                        return '3';
                    }
                }
            }
        }else{
            return '0';
        }
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
    public function showLoginForm(){
        return redirect("/");
    }
    public function forgetPassword(Request $request){
        $userexist=User::where("email","=",$request->email)->first();
        if($userexist!=null)
        {
                    $user_name = $userexist->name;
                    $email = $userexist->email;//'mayur.cosmonautgroup@gmail.com'
                    $token_key = str_random(50);                    
                    User::where("email","=",$email)->update(["remember_token"=>$token_key]);
                    //$link = "<a href='" . url("resetpassword/$token_key") . "' target='_blank'>click here</a>";
                    
                    $body_u = '<!DOCTYPE html><html><head><title>TrippyWords</title></head>
                            <body style="font-family: arial; background-color: #f4f4f4; margin: 0px; padding: 0px;">
                            <div style="text-align: center; margin: 30px 0px;">					
                                <img src="';
                    $body_u .= asset("assets/email-template/image/logo.png");
                    $body_u .= '" style="width:300px" />
                           </div>
                <div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">
		<div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">			
			<div style="font-size: 30px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">				
				Forget Password Email
			</div>
		</div>
		<div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">
			<div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">				
				Hey <span style="color: #2e2e2e;">'.$user_name.'</span>, <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.Simply click the button to Reset your password.
			</div>
			<div style="width:290px; margin: auto;">				
				<a href="';
        $body_u .= url("resetpassword/$token_key");
        $body_u .= '" style="font-size: 18px;text-transform: uppercase;letter-spacing: 1px;padding: 10px 0px;background: #58ba47;color: #fff;border-radius: 5px;cursor: pointer;display: block;">					
					Reset Password
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
                    
                    //$body_u = "Hi $user_name,\n\n click here to reset your password $link";
                    $smtp=Smtp::select('from_name','from_email')->first();            
                    $from = "<".$smtp->from_email.">";
                    $to_u = $user_name . "<" . $email . ">";
                    $subject_u = 'TrippyWords - Forgot password?';
                    $message_u = view('emails.forgetpassword',['user_name'=>$user_name,'token_key'=>$token_key]);//$body_u;
                    $headers_u = "MIME-Version: 1.0\r\n";
                    $headers_u .= "Content-type: text/html; charset: utf8\r\n";
                    $headers_u .= "From:TrippyWords ".$from."\r\n";
                    
                    //end of user email code
                    if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
                        
                    }
                    
                     /*
                     $data['email']=$email;                                      
                     Mail::send( 'emails.forgetpassword', ['user_name'=>$user_name,'token_key'=>$token_key], function( $message ) use ($data)
                    {
                        $message->to($data['email'])->from(Smtp::select('from_email')->first()->from_email,Smtp::select('from_email')->first()->from_name)->subject('Trippywords forget password email');
                    });*/
                    //return view('emails.signup',['user_name'=>$user_name,'token_key'=>$token_key]);
                    
                    return 1;
            
        }else{
            return 0;
        }
    }
    public function resetPassword($key){
        $userexist=User::where("remember_token","=",$key)->first();
        //$userexist=User::where("email","=",'support@cosmonautgroup.com')->first();
        
        if($userexist!=null)
        {
            return redirect('/')->with('forget_status', '1')->with('user_email',$userexist->email)->with('key_code',$key);
        }else{
            return redirect('/')->with('forget_status', '0')->with('key_code',$key);
        }
    }
    public function updatePassword(Request $request){
        
         $userexist=User::where("email","=",$request->email)->where("remember_token","=",$request->key_code)->first();
        if($request->newpass!=$request->confirm)
        {           
            return 2;            
        }else if($request->newpass==$request->confirm && $userexist!=null){            
            $password=Hash::make($request->newpass);           
            User::where("remember_token","=",$request->key_code)->where("email","=",$request->email)->update(['password'=>$password,'remember_token'=>null]);            
            return 1;
        }else{
            return 0;
        }
    }
}