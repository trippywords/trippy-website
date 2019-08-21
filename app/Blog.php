<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class Blog extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blog_title','blog_genre' ,'created_by','blog_description','blog_meta_description','blog_keywords','blog_image','blog_status','blog_slug','tags','is_featured','is_tranding','is_recommended'
    ];


    public static function getBlogs($user_id=null,$offset=0, $whereArr = array(),$orderBy='DESC',$limit=4){
        $user = DB::table('blogs');
        $user->join('users','blogs.created_by','=','users.id');
        $user->where('blogs.created_by',"=",$user_id);
        $user->where('blogs.is_delete',"=",'0');
        $user->where('users.is_verified','=',1);
        $user->where('users.is_delete','=','0');
        if (isset($whereArr['blog_status']) && intval($whereArr['blog_status']) > 0) {
            $user->where('blogs.blog_status',"=",$whereArr['blog_status']);
        }
        $user->orderBy('blogs.id', $orderBy);
        $user->offset($offset)->limit($limit);
        return $user->get();
    }

    public static function getGenreBlog($genre_id)
    {
        $blog=DB::select("select `id`,`blog_title`,`blog_heading`,`blog_image`,`blog_genre`,`blog_description`,`created_at`
            from `blogs` where `blog_genre` = $genre_id ORDER BY `id` limit 5 ");
        return $blog;
    }

    public static function getSingleBlog($blog_id)
    {
        $blog=DB::select("select `id`,`blog_title`,`blog_heading`,`blog_description`,`blog_image`,`blog_genre`,`created_at`
            from `blogs` where `id` = $blog_id");
        return $blog;
    }
}