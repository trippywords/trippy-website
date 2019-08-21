<?php





namespace App;





use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;





class Genre extends Model

{

    /**

     * The attributes that are mass assignable.

     *	

     * @var array

     */

    protected $fillable = [

        'name', 'parent_genre_id'

    ];

    public static function getGenres($user_id=null){

    	if (isset($user_id) && intval($user_id) > 0) {
    		$user = DB::select("SELECT DISTINCT `genres`.*,`user_preferences`.`preference_id` FROM `genres`
inner join `user_preferences` on `user_preferences`.`preference_id` = `genres`.`id`
WHERE `genres`.id in (SELECT CASE `genres`.parent_genre_id WHEN 0 THEN `genres`.id ELSE `genres`.`parent_genre_id` END as new_parent
FROM `genres` inner join `blogs` on `genres`.`id` = `blogs`.`blog_genre` inner join `users` on `blogs`.`created_by` = `users`.`id`  where `blogs`.`is_delete` = '0'  and `blogs`.`blog_status` = 1 and `blogs`.`created_by`= $user_id and `users`.`id`=$user_id and `users`.`is_verified` = 1 and `users`.`is_delete` = '0' group BY new_parent) and `genres`.`is_deleted` = 'N' and `genres`.`is_published` = 'Y' and `parent_genre_id` = 0 and `user_preferences`.`is_delete` = 0 ");
    		return $user;
    	}else{
    		$user = DB::select("SELECT DISTINCT `genres`.*,`user_preferences`.`preference_id` FROM `genres`
inner join `user_preferences` on `user_preferences`.`preference_id` = `genres`.`id`
WHERE `genres`.id in (SELECT CASE `genres`.parent_genre_id WHEN 0 THEN `genres`.id ELSE `genres`.`parent_genre_id` END as new_parent
FROM `genres` inner join `blogs` on `genres`.`id` = `blogs`.`blog_genre` inner join `users` on `blogs`.`created_by` = `users`.`id`  where `blogs`.`is_delete` = '0'  and `blogs`.`blog_status` = 1 and `users`.`is_verified` = 1 and `users`.`is_delete` = '0' group BY new_parent) and `genres`.`is_deleted` = 'N' and `genres`.`is_published` = 'Y' and `parent_genre_id` = 0 and `user_preferences`.`is_delete` = 0 ");
    	return $user;
    }
     //    $user->select('user_preferences.preference_id','genres.*');
     //    $user->join('user_preferences','user_preferences.preference_id','=','genres.id');
     //    $user->join('blogs','genres.id','=','blogs.blog_genre');
     //    $user->join('users','blogs.created_by','=','users.id');
     //    if (isset($user_id) && intval($user_id) > 0) {
     //    	$user->where('user_preferences.user_id','=',$user_id);
     //    	$user->where('blogs.created_by','=',$user_id);
     //    }
     //    $user->where('genres.is_deleted','=','N');
    	// $user->where('genres.is_published','=','Y');
    	// //$user->where('parent_genre_id','=',0);
    	// $user->where('user_preferences.is_delete','=',0);
    	// //$user->distinct('preference_id');
     //    $user->where('blogs.is_delete',"=",'0');
     //    $user->where('blogs.blog_status',"=",1);
     //    $user->where('users.is_verified','=',1);
     //    $user->where('users.is_delete','=','0');
     //    return $user->get();
    }

    public static function getLatestGenres(){


    	$user = DB::select("SELECT DISTINCT `genres`.*,`user_preferences`.`preference_id` FROM `genres`
inner join `user_preferences` on `user_preferences`.`preference_id` = `genres`.`id`
WHERE `genres`.id in (SELECT CASE `genres`.parent_genre_id WHEN 0 THEN `genres`.id ELSE `genres`.`parent_genre_id` END as new_parent
FROM `genres` inner join `blogs` on `genres`.`id` = `blogs`.`blog_genre` inner join `users` on `blogs`.`created_by` = `users`.`id`  where `blogs`.`is_delete` = '0'  and `blogs`.`blog_status` = 1 and `users`.`is_verified` = 1 and `users`.`is_delete` = '0' group BY new_parent) and `genres`.`is_deleted` = 'N' and `genres`.`is_published` = 'Y' and `parent_genre_id` = 0 and `user_preferences`.`is_delete` = 0 ");
    	return $user;

    	// $user = DB::table('genres');
     //    $user->select('user_preferences.preference_id','genres.*');
     //    $user->join('user_preferences','user_preferences.preference_id','=','genres.id');
     //    $user->join('blogs','genres.id','=','blogs.blog_genre');
     //    $user->join('users','blogs.created_by','=','users.id');
     //    $user->where('genres.is_deleted','=','N');
    	// $user->where('genres.is_published','=','Y');
    	// $user->where('parent_genre_id','=',0);
    	// $user->where('user_preferences.is_delete','=',0);
    	// $user->distinct('preference_id');
     //    $user->where('blogs.is_delete',"=",'0');
     //    $user->where('blogs.blog_status',"=",1);
     //    $user->where('users.is_verified','=',1);
     //    $user->where('users.is_delete','=','0');
     //    return $user->paginate(3);
    }

    public static function getSubcategoryByParent($id=null,$user_id=null){

    if (isset($user_id) && intval($user_id) > 0) {
    		$user = DB::select("SELECT DISTINCT `genres`.*,`user_preferences`.`preference_id` FROM `genres`
inner join `user_preferences` on `user_preferences`.`preference_id` = `genres`.`id`
inner join `blogs` on `genres`.`id` = `blogs`.`blog_genre` 
inner join `users` on `blogs`.`created_by` = `users`.`id`
WHERE `genres`.`parent_genre_id`= $id and `blogs`.`is_delete` = '0'  and `blogs`.`blog_status` = 1 and `blogs`.`created_by`= $user_id and `users`.`id`=$user_id and `users`.`is_verified` = 1 and `users`.`is_delete` = '0' and `genres`.`is_deleted` = 'N' and `genres`.`is_published` = 'Y' and `parent_genre_id` = 0 and `user_preferences`.`is_delete` = 0 ");
    		return $user;
    	}else{
    		$user = DB::select("SELECT DISTINCT `genres`.*,`user_preferences`.`preference_id` FROM `genres`
inner join `user_preferences` on `user_preferences`.`preference_id` = `genres`.`id`
inner join `blogs` on `genres`.`id` = `blogs`.`blog_genre` 
inner join `users` on `blogs`.`created_by` = `users`.`id`
WHERE `genres`.`parent_genre_id`= $id  and `blogs`.`is_delete` = '0'  and `blogs`.`blog_status` = 1 and `users`.`is_verified` = 1 and `users`.`is_delete` = '0' and `genres`.`is_deleted` = 'N' and `genres`.`is_published` = 'Y' and `parent_genre_id` = 0 and `user_preferences`.`is_delete` = 0 ");
    		return $user;
    }
}


        public static function getParentGenre()
        {
           $selectParentGenre=DB::select("select `id`,`name` from `genres` 
           where `id`=1");
           return $selectParentGenre; 
        }

        public static function getChildGenre($parent)
        {

            $childGenre = DB::select("select `id`,`name` from `genres`
                where `parent_genre_id`='$parent' limit 3");
            return $childGenre;

        }

        public static function getNextChild($parent)
        {
            $nextChild = DB::select("select `id`,`name` from `genres`
                where `parent_genre_id`='$parent' limit 3,30");
            return $nextChild;
        }

       

}