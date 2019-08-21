<?php
namespace App\Http\Controllers;
use App\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DB;
use App\Smtp;
class ContactusController extends Controller
{ 
	public function sendContactus(Request $request)
	{        
		
		return Redirect::back()->with("news_success_msg","Contactus Subscribed");
	}
	public function index(Request $request)
	{       
		return view('admin.contactus.index');
	}
	public function getAjaxData(Request $request){
		$contactus = DB::table('contactus')
			->select('id', 'email','name','message','is_deleted','created_at')
			->orderBy('id', 'desc')        
			->get();
		$contactus= collect($contactus);
	return \DataTables::of($contactus)
		 ->addColumn('id', function($contactus) { return $contactus->id; }) 
		 ->addColumn('name', function($contactus) { return $contactus->name; })        
		 ->addColumn('email', function($contactus) { return $contactus->email; })
		 ->addColumn('message', function($contactus) { return $contactus->message; })
		 ->addColumn('created_at', function($contactus) { return $contactus->created_at; })
		 ->addColumn('is_deleted', function($contactus) { 
		 	if($contactus->is_deleted==0)
              {
                return ''; 
              }else{
                return 'deleted';   
              }
          })
		 ->addColumn('action', function($contactus) {                           	
         	$del_btn = '<a onclick=\'return confirm("Delete this record?")\' class="btn btn btn-danger" href="'.route('admin.contactus.destroy',$contactus->id).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                return $del_btn;
       	 })
		 ->make(true);
	}
	public function destroy($id){
		Contactus::where('id',$id)->update(['is_deleted'=>'1']);
		return redirect()->route('admin.contactus')
						->with('success','Contactus deleted successfully ');
	}
	
}