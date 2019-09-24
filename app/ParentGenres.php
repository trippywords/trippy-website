<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ParentGenres extends Model
{
    //


    public static function getParentGenres()
    {
    	 $ParentGenres = DB::table('parent_genres')->where('is_deleted','=',0)

		      ->select('id', 'parent_name', 'is_published', 'created_at')

              ->orderBy('id', 'desc')         

		      ->get();


		  return $ParentGenres;
    }
}
