<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Smtp;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class SmtpController extends Controller
{
  
    public function index(Request $request)
    {       
            $smtp= Smtp::select('*')->first();            
            return view('admin.smtp.smtp',compact('smtp'));
    }

   
    public function update($id,Request $request)
    {
        $input = $request->all();     
        
        $smtp = Smtp::find($id);
        $smtp->update($input);     
        
        return redirect()->route('admin.smtp')->with('success','Smtp updated successfully');
    }


}