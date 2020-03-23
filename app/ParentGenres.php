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

    Public static function getComposeGenre()
        {
            
        $genres=DB::select("select p.id,p.parent_name,d.child_genre_image 
                    from parent_genres as p,child_genres as d
                    where EXISTS(SELECT c.id
                    FROM child_genres AS c
                    WHERE c.parent_genre_id = p.id) and p.is_published = 1 
                    and p.is_deleted=0 
                    and p.id=d.parent_genre_id
                    and d.is_published=1
                    and d.is_deleted=0
                    group by d.parent_genre_id
                     ");

             return $genres;
        } 
}
