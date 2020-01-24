<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;

use App\Followers;

use Spatie\Permission\Models\Role;

use DB;

use Hash;

use URL;

use App\Smtp;

class UserController extends Controller

{

     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)
    {        
        $data = User::orderBy('id','DESC')->paginate(5);

        return view('admin.users.index',compact('data'))

            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $roles = Role::pluck('name','name')->all();

        return view('admin.users.create',compact('roles'));

    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {      


        $this->validate($request, [

            'first_name' => 'required',
            'last_name' => 'required',
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password'
            //'roles' => 'required'
        ]);

        $input = $request->all();

            /*Upload,rename image*/

            if ($file = $request->hasFile('profile_image')) {

                $file            = $request->file('profile_image');
                $allowed =  array('jpg', 'jpeg' ,'png', 'gif' ,'tif');
                $path = $_FILES['profile_image']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if(!in_array($ext,$allowed) ) {
                    return back()->with("error_message", "Image type not allowed");
                }

                $customimagename  = time() . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('user_img/');

                $file->move($destinationPath, $customimagename);

                $input['profile_image'] = $customimagename;                
    }       

        $input['password'] = Hash::make($input['password']);

        //dd($input);

        if($request->is_verified=='on')

        {

            $input['is_verified']=1;

        }else{

            $input['is_verified']=0;

        }

        $input['remember_token'] = str_random(50);

        if(User::create($input)){

        //$user->assignRole($request->input('roles'));

             //User Email

                    $user_name = $input['name'];

                    $email = $input['email'];

                    $token_key = $input['remember_token'];

                    //$link = "<a href='" . url("accountactivate/$token_key") . "' target='_blank'>click here</a>";

                    //$body_u = "Hi $user_name,\n\n click here to verify your account $link";

                    

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

				Hey <span style="color: #2e2e2e;">'.$user_name.'</span>, thanks for registration <br/> with <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.<br/>Simply click the button to verify your email address.

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

                    $subject_u = 'Trippywords verify account email';

                    $message_u = view('emails.admin_user_create',['user_name'=>$user_name,'token_key'=>$token_key]);//$body_u;

                    $headers_u = "MIME-Version: 1.0\r\n";

                    $headers_u .= "Content-type: text/html; charset: utf8\r\n";

                    $headers_u .= "From: ".Smtp::select('from_email')->first()->from_name." <".Smtp::select('from_email')->first()->from_email.">\r\n";

                    //end of user email code

                    if (@mail($to_u, $subject_u, $message_u, $headers_u)) {

                        

                    }

                    /*

                     $data['email']=$email;                                      

                     Mail::send( 'emails.admin_user_create', ['user_name'=>$user_name,'token_key'=>$token_key], function( $message ) use ($data)

                    {

                        $message->to($data['email'])->from(Smtp::select('from_email')->first()->from_email,Smtp::select('from_email')->first()->from_name)->subject('Trippywords verify account email');

                    });*/

                    //return view('emails.admin_user_create',['user_name'=>$user_name,'token_key'=>$token_key]);

                    //exit;

        }   

        return redirect()->route('admin.users')

                        ->with('success','User created successfully');

    }





    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $user = User::find($id);

        return view('admin.users.show',compact('user'));

    }





    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $user = User::find($id);

        $roles = Role::pluck('name','name')->all();

        $userRole = $user->roles->pluck('name','name')->all();

       // $user->description = nl2br($user->description);

        return view('admin.users.edit',compact('user','roles','userRole'));

    }





    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {        

        $this->validate($request, [

            'first_name' => 'required',
            'last_name' => 'required',
            'name' => 'required|unique:users,name,'.$id,

            'email' => 'required|email|unique:users,email,'.$id,

            'password' => 'same:confirm-password'

            //'roles' => 'required'

        ]);

        $input = $request->all();

            if ($file = $request->hasFile('profile_image')) {


                $file            = $request->file('profile_image');
                $allowed =  array('jpg', 'jpeg' ,'png', 'gif' ,'tif');
                $path = $_FILES['profile_image']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if(!in_array($ext,$allowed) ) {
                    return back()->with("error_message", "Image type not allowed");
                }

                $customimagename  = time() . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('user_img/');

                $file->move($destinationPath, $customimagename);   

                $input['profile_image'] = $customimagename;

                

            }else{

                $input = array_except($input,array('profile_image'));

            }            

        if(!empty($input['password'])){ 

            $input['password'] = Hash::make($input['password']);

        }else{

            $input = array_except($input,array('password'));    

        }

        

        

        $user = User::find($id);

        if($request->is_verified=='on')

        {

            $input['is_verified']=1;

        }else{

            $input['is_verified']=0;

        }

        $user->update($input);

        //DB::table('model_has_roles')->where('model_id',$id)->delete();





        //$user->assignRole($request->input('roles'));





        return redirect()->route('admin.users')

                        ->with('success','User updated successfully');

    }





    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        User::where('id',$id)->update(['is_delete'=>'1']);


        //updating followers model with deleted user
        Followers::where('follower_id',$id)->update(['is_delete'=>'1']);

        return redirect()->route('admin.users')

                        ->with('success','User deleted successfully');

    }

    

    public function getAjaxData(Request $request){

        

    	//$this->user = Auth()->user();

    	//$userid = Auth()->user()->id;



		  $users = DB::table('users')->where('is_delete','=','0')->where('role_id','!=',4)

		      ->select('id', 'name','first_name','last_name', 'profile_image','email','is_verified','last_login','created_at')

                      ->orderBy('id', 'desc')        

		      ->get();

		  $users= collect($users);



      return \DataTables::of($users)

         ->addColumn('action', function($user) {                  

         	$show_btn = '<a class="btn btn-info" href="'.route('admin.users.show',$user->id).'"><i class="fa fa-eye" aria-hidden="true"></i></a>';

        	$edit_btn = '<a class="btn btn-primary" href="'.route('admin.users.edit',$user->id).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

         	$del_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn btn-danger" href="'.route('admin.users.destroy',$user->id).'"><i class="fa fa-trash" aria-hidden="true"></i>

        </a>';

    



         	return $show_btn.$edit_btn.$del_btn;

       	 })

         ->addColumn('id', function($user) { return $user->id; })

         ->addColumn('profile_image', function($user) { 
            if ($user->profile_image != null && file_exists(public_path().'/user_img/'.$user->profile_image)) {
                return "<img src='".asset("/public/user_img/".$user->profile_image)."' height='100' width='100'>";
            } else {
                return '<img src="'.asset('/').'public/assets/image/profile.png" alt="Profile" height="100" width="100">';
            }
        })

         ->addColumn('name', function($user) {                  
            return '<a href="'.route('admin.users.show',$user->id).'">'.$user->first_name.' '.$user->last_name.'</a>';

         })

          ->addColumn('email', function($user) { return $user->email; })

          

          ->addColumn('created_at', function($user) {                     

                

                return date('d-m-Y H:i:s',strtotime($user->created_at));                            

          })

          ->addColumn('last_login', function($user) {   

                if($user->last_login!=null)

                {

                    return date('d-m-Y H:i:s',strtotime($user->last_login));                            

                }

                    

          })

          ->addColumn('is_verified', function($user) { 

              if($user->is_verified==0)

              {

                return 'Inactive'; 

              }else{

                return 'Active';   

              }

              

          })

         ->rawColumns(['action','id','profile_image','name','email','created_at','last_login','is_verified'])

         ->filter(function ($query) use ($request) {

            if ($request->has('name')) {

                $query->where('name', 'like', "%{$request->get('name')}%");

            }

        	})

         ->make(true);

    }

}