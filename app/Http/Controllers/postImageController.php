<?php

namespace App\Http\Controllers;
use App\Actions\CreatePostFileAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;
//use App\Actions\CreatePostFileAction;

class postImageController extends Controller
{
    //
    public function store(Request $request,CreatePostFileAction $CreatePostFileAction)
    {
    	//dd($CreatePostFileAction);
    	$image=$CreatePostFileAction->run($request->image);
    	//$link = asset('/').'public/'.$image;
    	return response()->json([
    		"url"=>$image
    	]);
    	//dd($image);
    }
}
