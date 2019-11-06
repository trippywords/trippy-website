<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Validator;

use App\User;

use App\Blog;

//use App\Genre;

use App\ChildGenres;
use App\Comments;

use Auth;

class AdminController extends Controller
{
    function comingSoonFeed()
    {
        return view('coming_soon');
    }

    function comingSoon()
    {
        return view('coming_soon');
    }

    function admin(){

        //return view('admin.login');

        

        return redirect('/login');

    }

    function checkLogin(Request $request){

         
        $messsages = array(

            'email.required'    => 'Email is required. zsda,df,',

            'email.email'       => 'Email is not valid.',

            'password.required' => 'Password is required.',

        );

               $rules = [

            'email'        => 'required|email',

            'email.exists' => 'Email not registered',

            'password'     => 'required',

        ];

        $validator = Validator::make($request->all(), $rules, $messsages);

        if ($validator->passes()) {

            $remember      = isset($request->remember) ? true : false;

            $userActivated = User::where(['email' => $request->email, 'role_id' => '4'])->first();           

            

            if ($userActivated) 

            {

                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) 

                {

                    $request->session()->flash('success', 'You are successfully logged in.');

                    return redirect()->route('admin_dashboard');

                } else {



                    $exitsUserEmail    = User::where('email', '=', $request->email)->first();

                    $exitsUserPassword = User::where('password', '=', $request->password)->first();

                    if (empty($exitsUserEmail)) {

                        return redirect()->route('admin')->withErrors($validator)->withInput()->withErrors(['email' => "The email address that you've entered doesn't match any records."]);

                    }

                    if (empty($exitsUserPassword)) 

                    {

                        return redirect()->route('admin')->withErrors($validator)->withInput()->withErrors(['password' => "The password that you've entered is incorrect."]);

                    }

                }



            } else {

                return redirect()->route('admin')->withErrors($validator)->withInput()->withErrors(['email' => "Please confirm your email your address."]);

            }

            return redirect()->intended($this->redirectPath());

        }else{

             return redirect('/admin')->withErrors($validator)->withInput();

        }

    }

    function Dashboard(){

        $user_count=User::where('is_delete','=','0')->count();       //where('is_delete','=','0')->              
       // $genre = Genre::where('is_deleted','N')->count();
        $genre = ChildGenres::where('is_deleted','0')->count();
        $blogs_count = Blog::where('is_deleted','0')->count();
        $publish_blog_count=Blog::where('blog_status','=','1')->where('is_deleted','0')->count();
        $draft_blog_count=Blog::where('blog_status','=','2')->where('is_deleted','0')->count();

        $users=User::where('is_delete','=','0')->where('role_id','!=',4)->orderBy('id')->limit(5)->get();
        $blogs=Blog::where('is_deleted','0')->orderBy('updated_at')->limit(5)->get();
        $comments=Comments::getComments(5);
        $comments_count=Comments::getComments(null,true);

        return view('admin.dashboard',compact('user_count','genre','publish_blog_count','draft_blog_count','users','blogs','blogs_count','comments','comments_count'));        

    }

    function Logout(){

         Auth::guard('web')->logout();         

         return redirect('/');

    }

}

