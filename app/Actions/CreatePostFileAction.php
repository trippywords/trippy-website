<?php 

namespace App\Actions;
use Image;

class CreatePostFileAction
{
	public function __construct()
	{

	}

	public function run($file,$width=1280)
	{
		//dd($file);
		
		//$fileName = $file->getClientOriginalName();

		$customimagename = time() .'.'. $file->getClientOriginalExtension();
	    
	    $destinationPath = public_path('blog_description_img/');
	    $file->move($destinationPath, $customimagename);
	    $fileName = asset('/').'public/blog_description_img/'.$customimagename;
		//dd($link);
		//Image::make($file)->resize($width,null)->save($fileName);

		return $fileName;
	}
}