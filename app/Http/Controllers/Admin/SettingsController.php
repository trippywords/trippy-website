<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\User;
use App\Settings;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class SettingsController extends Controller
{
  
    public function index(Request $request)
    {       
            $settings=Settings::select('*')->first();            
            return view('admin.settings.settings',compact('settings'));
    }

   
    public function update($id,Request $request)
    {
        $input = $request->all();     
        
        
            if ($file = $request->hasFile('site_logo')) {
                $file            = $request->file('site_logo');
                $customimagename_sitelogo  = "site_logo_".time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('settings_img/');
                $file->move($destinationPath, $customimagename_sitelogo);   
                $input['site_logo'] = $customimagename_sitelogo;
                
            }else{
                $input = array_except($input,array('site_logo'));
            }
                
            
            if ($file = $request->hasFile('site_fevicon')) {
                $file            = $request->file('site_fevicon');
                $customimagename  = "site_fevicon_".time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('settings_img/');
                $file->move($destinationPath, $customimagename);   
                $input['site_fevicon'] = $customimagename;
                
            }else{
                $input = array_except($input,array('site_fevicon'));
            }
            
        $settings = Settings::find($id);
        $settings->update($input);     
        
        return redirect()->route('admin.settings')->with('success','Settings updated successfully');
    }


}