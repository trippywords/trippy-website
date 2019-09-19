<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ParentGenres extends Model
{
    //


    public static function 	
    {
    	 $ParentGenres = DB::table('parent_genres')->where('is_deleted','=',0)

		      ->select('id', 'name', 'is_published','is_published', 'created_at')

              ->orderBy('id', 'desc')         

		      ->get();
		      dd($ParentGenres);
		  return $ParentGenres;
    }
}
