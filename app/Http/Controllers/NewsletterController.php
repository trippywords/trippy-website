<?php

namespace App\Http\Controllers;

use App\Newsletters;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Newsletter;

use DB;

use App\Smtp;

class NewsletterController extends Controller{ 

    public function sendNewsletter(Request $request){   
      if (isset($request->newsletter_email) && $request->newsletter_email!='') {
        $check_val=Newsletters::where('newsletter_email','=',$request->newsletter_email)->first();
        if(empty($check_val)) {

            $newsletter = new Newsletters;
            $newsletter->newsletter_email= $request->newsletter_email;

            $newsletter->is_delete= '0';

            $newsletter->save();

            Newsletter::subscribe($request->newsletter_email);

              $to_u = $request->newsletter_email;

              $subject_u = 'Thank you for subscribing!';

              $message_u = view('emails.subscribe',['email'=>$request->newsletter_email]);//$body_u;

              $headers_u = "MIME-Version: 1.0\r\n";

              $headers_u .= "Content-type: text/html; charset: utf8\r\n";

              $headers_u .= "From: TrippyWords"." <".Smtp::select('from_email')->first()->from_email.">\r\n";
                    //end of user email code
                    if (@mail($to_u, $subject_u, $message_u, $headers_u)) {
                    }
            return 1;
        }else{
          return 0;
        }
      }else{
          return 2;
      }  

    }

    public function index(Request $request)

    {       

        return view('admin.newsletter.index');

    }

    

    public function getAjaxData(Request $request){

        

    	//$this->user = Auth()->user();

    	//$userid = Auth()->user()->id;



        $newsletters = DB::table('newsletter')->where('newsletter.is_delete',"=","0")

            ->select('id', 'newsletter_email','is_delete','created_at')

            ->orderBy('id', 'desc')        

            ->get();

        $newsletters= collect($newsletters);



      return \DataTables::of($newsletters)

         ->addColumn('action', function($newsletter) {                           	

         	$del_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn btn-danger" href="'.route('admin.newsletter.destroy',$newsletter->id).'"><i class="fa fa-trash" aria-hidden="true"></i>

</a>';

                return $del_btn;

       	 })

         ->addColumn('id', function($newsletter) { return $newsletter->id; })         

          ->addColumn('newsletter_email', function($newsletter) { return $newsletter->newsletter_email; })

          ->addColumn('is_delete', function($newsletter) { 

              if($newsletter->is_delete==0)

              {

                return 'Subscribed'; 

              }else{

                return 'Unsubscribed';   

              }

              

          })

          ->addColumn('created_at', function($newsletter) {

                return date('d-m-Y H:i:s',strtotime($newsletter->created_at));                            

          })          

         ->rawColumns(['id','newsletter_email','created_at', 'is_delete ','action'])

         ->filter(function ($query) use ($request) {

            if ($request->has('newsletter_email')) {

                $query->where('newsletter_email', 'like', "%{$request->get('newsletter_email')}%");

            }

        	})

         ->make(true);

    }

    public function destroy($id){

        Newsletters::where('id',$id)->update(['is_delete'=>'1']);

        return redirect()->route('admin.newsletter')

                        ->with('success','Newsletter deleted successfully');

    }

    

}