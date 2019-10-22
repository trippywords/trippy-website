<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\ChildGenres;



class DropdownController extends Controller
{
   public function ajaxChild(Request $request)
    {
      
        $child=ChildGenres::where('parent_genre_id',$request->id)->pluck('child_genre_name','id');

        return json_encode($child);

    }


    public function parentselection()
    {
    	$parent=array(1,2,3);
    	foreach ($parent as $p) 
    	{
    		$childlist = ChildGenres::where('parent_genre_id',$p)->get(); 
    		$wordCount = $childlist->count();
    		echo $wordCount;
    		for($i=0;$i<=$wordCount;$i++)
    		{
    			$child=ChildGenres::where('parent_genre_id',$p)->get();
    			echo "<pre>";
    			print_r($child);
    			//break;
    		}
    	}
    }
    
}
