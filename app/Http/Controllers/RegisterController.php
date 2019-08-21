<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Smtp;
use Session;
class RegisterController extends Controller
{

    protected function signup(Request $request) {
        
        //User::where('email','=','mayur.cosmonautgroup@gmail.com')->delete();
        $user_exist = User::where('email', '=', $request->email)->where('is_delete', '=','0')->first();
        $username_exist = User::where('name', '=', $request->name)->where('is_delete', '=','0')->first();
        if ($user_exist != null) {
            echo 2;
            exit;
        }elseif ($username_exist != null) {
            echo 3;
            exit;
        }else {
            if ($user_exist == null) {
                $input = $request->all();
                $input['primary_email'] =$request->email;
                $input['role_id'] = '2';
                $input['is_delete'] = '0';
                $input['password'] = Hash::make($input['password']);
                $input['remember_token'] = str_random(50);
                date_default_timezone_set('Asia/Kolkata');
                $date=date("Y-m-d H:i:s");
                $input['created_at'] =$date;
                $input['updated_at'] =$date;
                $input['last_login'] =$date;
                unset($input['_token']);        
                $insrtID = User::create($input);    
                if ($insrtID) {
                    
                    
                    //User Email
                    $user_name = $input['first_name'].' '.$input['last_name'];
                    $email = $input['email'];
                    $token_key = $input['remember_token'];

                    $to_u = $user_name . "<" . $email . ">";
                    $subject_u = 'Trippywords - Account Verification';
                    $message_u = view('emails.signup',['user_name'=>$user_name,'token_key'=>$token_key,'user_id'=>$insrtID->id]);//$body_u;
                    $headers_u = "MIME-Version: 1.0\r\n";
                    $headers_u .= "Content-type: text/html; charset: utf8\r\n";
                    $headers_u .= "From:TrippyWords <".Smtp::select('from_email')->first()->from_email.">\r\n";
                    //end of user email code
                    if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
                        
                    }
                   
                    echo 1;
                    exit;
                } else {
                    echo 0;
                    exit;
                }
            }
        }
    }
    public function email (Request $request) {
        $user_exist = User::whereRaw("(`email` = '".$request->get('email')."' OR `primary_email` = '".$request->get('email')."')")->where('is_delete', '=','0')->first();
        $delete_user_exist = User::whereRaw("(`email` = '".$request->get('email')."' OR `primary_email` = '".$request->get('email')."')")->where('is_delete', '=','1')->first();
        if (isset($delete_user_exist->id) && intval($delete_user_exist->id) > 0) {
            DB::table('messages')->where('from_user_id', '=', $delete_user_exist->id)->delete();
            DB::table('messages')->where('to_user_id', '=', $delete_user_exist->id)->delete();
            User::where('id', '=', $delete_user_exist->id)->delete();
        }
        if ($user_exist != null) {
            return 0;
        } else {
            return 1;
        }
    }

    public function username (Request $request) {
        $user_exist = User::where('name', '=', $request->get('username'))->where('is_delete', '=','0')->first();
        $delete_user_exist = User::where('name', '=', $request->get('username'))->where('is_delete', '=','1')->first();
        if (isset($delete_user_exist->id) && intval($delete_user_exist->id) > 0) {
            DB::table('messages')->where('from_user_id', '=', $delete_user_exist->id)->delete();
            DB::table('messages')->where('to_user_id', '=', $delete_user_exist->id)->delete();
            User::where('id', '=', $delete_user_exist->id)->delete();
        }
        if ($user_exist != null) {
            return 0;
        } else {
            return 1;
        }
    }

    public function verifyUser($user_id,$key){
        $users=User::select('*')->where('id','=',$user_id)->first();
        $error_type = 'error';
        if(!empty($users))
        {
            if (isset($users->is_verified) && trim($users->is_verified) == 1) {
                Auth::logout();
                $status='Token has been expired';
            }elseif (isset($users->remember_token) && trim($users->remember_token) == trim($key)) {
                User::where('id','=',$user_id)->update(['remember_token'=>'','is_verified'=>1,'is_primary_verified'=>1]);
                Auth::logout();
                $error_type = 'success';
                $status='Account verified successfuly';
            }else{
                Auth::logout();
                $status='Token has been expired';
            }
        }else{
            Auth::logout();
            $status='Token has been expired';
        }
        return redirect("successverify/$status/$error_type");
    }

    public function verifyProfile($user_id,$key){
        $users=User::select('*')->where('id','=',$user_id)->first();
        $error_type = 'error';
        if(!empty($users))
        {
            if (isset($users->is_primary_verified) && trim($users->is_primary_verified) == 1&& trim($users->is_verified) == 1) {
                $status='Token has been expired';
            }elseif (isset($users->remember_primary_token) && trim($users->remember_primary_token) == trim($key)) {
                User::where('id','=',$user_id)->update(['remember_primary_token'=>'','is_primary_verified'=>1,'is_verified'=>1]);
                $status='Account verified successfuly';
                $error_type = 'success';
            }else{
                $status='Token has been expired';
            }
            if (Auth::user()->id == $user_id) {
                session()->flash('verify_primary_email', 'Secondary Email is verified successfuly');
                return redirect('/account-details');
            }else{
                Auth::logout();
            }
        }else{
            $status='Token has been expired';
            if (Auth::user()->id == $user_id) {
                session()->flash('token_expired', 'Token has been expired');
                return redirect('/account-details');
            }else{
                Auth::logout();
            }
        }
        return redirect("successverify/$status/$error_type");
    }
    
    public function successVerify($status,$error_type){
        if ($error_type=='success') {
            Session::flash('verification_message',$status);
        }else{
            Session::flash('verification_error',$status);
        }
        return redirect('/');
        //return view('home',compact('status'));
    }   
    
    public function emailvalidate(Request $request){
        $validator = Validator::make(
            array(
                'email' => 'required|email|unique:users'
            )
        );
    }  
}