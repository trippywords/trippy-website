<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use App\Message;
use App\Connection;
use App\User;
use Auth;
use Session;
use App\Usernotification;
use App\Smtp;

class MessageController extends Controller {
	public function __construct() {
		$this->middleware('auth'); 
	}

	public function userMessages() {
		$tousers = Message::Select('to_user_id','created_at')->where('from_user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
		$fromusers = Message::Select('from_user_id','created_at')->where('to_user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
		$to_users = [];
		$from_users = [];
		foreach ($fromusers as $value) {
			$to_user['id'] = $value->from_user_id;
			$to_user['created_at'] = $value->created_at->format('d-m-Y h:i:s');
			$to_users[] = $to_user;
		}
		foreach ($tousers as $value) {
			$from_user['id'] = $value->to_user_id;
			$from_user['created_at'] = $value->created_at->format('d-m-Y h:i:s');
			$from_users[] = $from_user;
		}
		$users = array_merge($to_users,$from_users);
		$user_id = collect($users)->sortBy('created_at')->reverse()->toArray();
		$temp_array = [];
		$key = 'id';
       	foreach ($user_id as &$v) {
           	if (!isset($temp_array[$v[$key]]))
           	$temp_array[$v[$key]] =& $v;
       	}
       	$user_unique = array_values($temp_array);
		/*
		echo '<pre>';
		print_r($user_unique);
		exit();*/
		return view('profile.messages', compact('user_unique'));
	}

	public function getMessages(Request $req) {
		$tousers = Message::Select()
			->where('from_user_id', Auth::user()->id)
			->where('to_user_id', $req->userid)
			->orderBy('created_at', 'desc')
			->get();
		$fromusers = Message::Select()
			->where('from_user_id', $req->userid)
			->where('to_user_id', Auth::user()->id)
			->orderBy('created_at', 'desc')
			->get();
		$to_users = array();
		$from_users = array();
		foreach ($fromusers as $value) {
			$to_user['from_user_id'] = $value->from_user_id;
			$to_user['to_user_id'] = $value->to_user_id;
			$to_user['read_flag'] = $value->read_flag;
			$to_user['message'] = $value->message;
			$to_user['created_at'] = $value->created_at->format('d-m-Y h:i:s');
			$to_users[] = $to_user;
		}
		foreach ($tousers as $value) {
			$from_user['from_user_id'] = $value->from_user_id;
			$from_user['to_user_id'] = $value->to_user_id;
			$from_user['read_flag'] = $value->read_flag;
			$from_user['message'] = $value->message;
			$from_user['created_at'] = $value->created_at->format('d-m-Y h:i:s');
			$from_users[] = $from_user;
		}
		$users = array_merge($to_users,$from_users);
		/*$user_chat = collect($users)->sortBy('created_at')->toArray();
		$user_msg1 = array_values($user_chat);*/
		$to_user = $req->userid;
		$user_msg = $users;
		usort($user_msg, function($a1, $a2) {
			$v1 = strtotime($a1['created_at']);
			$v2 = strtotime($a2['created_at']);
			return $v1 - $v2; // $v2 - $v1 to reverse direction
		});
		/*print_r($user_msg);*/
		return view('profile.ajax_messages', compact('user_msg','to_user'));
	}

	public function sendMessage(Request $req){
		$message_to_send = $req->get('txt_message');
		$to_user_id 	 = $req->get('to_user_id');

		$message = new Message;
		$message->from_user_id = Auth::user()->id;
		$message->to_user_id = $to_user_id;
		$message->read_flag = 0;
		$message->message = $message_to_send;
		$message->created_at = date('Y-m-d H:i:s');
		$message->updated_at = date('Y-m-d H:i:s');
		$message->save();

		$usernotification = Usernotification::where(['user_id'=>$to_user_id,'notification_id'=>9,'notification_status'=>'1'])->first();
        if($usernotification!=null) {
            $receiver = User::where('id','=',$to_user_id)->first();
            $reciever_name = (isset($receiver->first_name)?$receiver->first_name:'').' '.(isset($receiver->last_name)?$receiver->last_name:'');
            $sender_name = (isset(Auth::user()->first_name)?Auth::user()->first_name:'').' '.(isset(Auth::user()->last_name)?Auth::user()->last_name:'');
            $to_u = $receiver->name . "<" .$receiver->email. ">";
            $subject_u = 'TrippyWords - Message Request';
            $message_u = view('emails.message_request',['reciever_name'=>$reciever_name,'sender_name'=>$sender_name,'message'=>$message_to_send]);
            $headers_u = "MIME-Version: 1.0\r\n";
            $headers_u .= "Content-type: text/html; charset: utf8\r\n";
            $headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";
            //end of user email code
            if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
            }
        }
		Session::flash('message', 'Message Sent'); 
		return redirect('/connections');
	}

	public function storeMessage(Request $req) {
		$message_to_send = $req->get('message');
		if (isset($message_to_send) && trim($message_to_send)!='' && trim($message_to_send)!=null) {
			$to_user_id 	 = $req->get('touserid');
			$connection = Connection::where(["is_delete"=>0,"user_id"=>Auth::user()->id,"connect_user_id"=>$to_user_id ,'is_block'=>1])->first();
			if ($connection!=null) {
				return 0;
			}
			$message = new Message;
			$message->from_user_id = Auth::user()->id;
			$message->to_user_id = $to_user_id;
			$message->read_flag = 0;
			$message->message = $message_to_send;
			$message->created_at = date('Y-m-d H:i:s');
			$message->updated_at = date('Y-m-d H:i:s');
			$message->save();

			$usernotification = Usernotification::where(['user_id'=>$to_user_id,'notification_id'=>9,'notification_status'=>'1'])->first();
	        if($usernotification!=null) {
	            $receiver = User::where('id','=',$to_user_id)->first();
	            $reciever_name = (isset($receiver->first_name)?$receiver->first_name:'').' '.(isset($receiver->last_name)?$receiver->last_name:'');
	            $sender_name = (isset(Auth::user()->first_name)?Auth::user()->first_name:'').' '.(isset(Auth::user()->last_name)?Auth::user()->last_name:'');
	            $to_u = $receiver->name . "<" .$receiver->email. ">";
	            $subject_u = 'TrippyWords - Message Request';
	            $message_u = view('emails.message_request',['reciever_name'=>$reciever_name,'sender_name'=>$sender_name,'message'=>$message_to_send]);
	            $headers_u = "MIME-Version: 1.0\r\n";
	            $headers_u .= "Content-type: text/html; charset: utf8\r\n";
	            $headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";
	            //end of user email code
	            if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
	            }
	        }
			return view('profile.ajax_from_message', compact('message_to_send'));
		}else{
			return 2;
		}	
	}
	public function autoRefresh(Request $req){
		$tousers = Message::Select()
			->where('from_user_id', Auth::user()->id)
			->where('to_user_id', $req->userid)
			->orderBy('created_at', 'desc')
			->get();
		$fromusers = Message::Select()
			->where('from_user_id', $req->userid)
			->where('to_user_id', Auth::user()->id)
			->orderBy('created_at', 'desc')
			->get();
		$to_users = array();
		$from_users = array();
		foreach ($fromusers as $value) {
			$to_user['from_user_id'] = $value->from_user_id;
			$to_user['to_user_id'] = $value->to_user_id;
			$to_user['read_flag'] = $value->read_flag;
			$to_user['message'] = $value->message;
			$to_user['created_at'] = $value->created_at->format('d-m-Y h:i:s');
			$to_users[] = $to_user;
		}
		foreach ($tousers as $value) {
			$from_user['from_user_id'] = $value->from_user_id;
			$from_user['to_user_id'] = $value->to_user_id;
			$from_user['read_flag'] = $value->read_flag;
			$from_user['message'] = $value->message;
			$from_user['created_at'] = $value->created_at->format('d-m-Y h:i:s');
			$from_users[] = $from_user;
		}
		$users = array_merge($to_users,$from_users);
		/*$user_chat = collect($users)->sortBy('created_at')->toArray();
		$user_msg1 = array_values($user_chat);*/
		$to_user = $req->userid;
		$user_msg = $users;
		usort($user_msg, function($a1, $a2) {
			$v1 = strtotime($a1['created_at']);
			$v2 = strtotime($a2['created_at']);
			return $v1 - $v2; // $v2 - $v1 to reverse direction
		});
		/*print_r($user_msg);*/
		return view('profile.ajax_refresh', compact('user_msg','to_user'));
	}
}
