<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChildGenres extends Model
{
    public static function getChildGenres()
    {
    	
    	 $ChildGenres = DB::table('child_genres as c')
    	 ->join('parent_genres as p','p.id','=','c.parent_genre_id')
    	 ->select('c.id','c.child_genre_image','c.child_genre_name','p.parent_name','c.created_at','c.is_published')
    	 ->where('c.is_deleted','=','0')
    	 ->orderBy('c.id','DESC');

    	 return $ChildGenres->get();

    } 


}
