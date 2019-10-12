<?php

namespace App\Http\Controllers\Admin;


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
    
}
