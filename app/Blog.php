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

    //Function for getting fetured blog for guest user as well as logged in user
     public static function getFeaturedBlog($user_id=null)
    {
        if(isset($user_id) && intval($user_id) > 0)
        {
                $featured_blog=DB::select("SELECT distinct `a`.`name` as `parentGenre`,`b`.`name` as `childGenre`,`c`.`blog_title` as `title`,
                `c`.`blog_image` as `blogImg` ,`c`.`blog_description` as `description`,`c`.`created_at` as `createdAt`
                ,`c`.`blog_genre` as `blogId`, `u`.`name` as `authorInfo` , c.is_featured
                from `genres` as `a`,`genres` as `b`,
                `blogs` as `c`,`users` as `u` , (SELECT distinct  g.parent_genre_id, max(h.id) as blogid
                from `blogs` as `h`, GENRES AS G
                where is_featured=1 
                AND H.blog_genre = g.id
                group by parent_genre_id) d 
                where `a`.`id` in 
                (select `gn`.`parent_genre_id` from genres gn, user_preferences up 
                where gn.id = up.preference_id and up.is_delete=0 and up.user_id = $user_id)
                and a.id = b.parent_genre_id
                and `a`.`parent_genre_id`= 0 
                and`c`.`blog_genre`= b.id 
                and `u`.`id`=`c`.`created_by` 
                and `c`.`is_featured`=1 
                and `d`.`blogid` = `c`.`id` 
                ORDER BY `b`.`name`");
                
            
            return $featured_blog;
        }
        else
        {
                $featured_blog=DB::select("SELECT distinct `a`.`name` as `parentGenre`,`b`.`name` as `childGenre`,`c`.`blog_title` as `title`,`c`.`blog_image` as `blogImg`,`c`.`blog_description` as `description`,`c`.`created_at` as `createdAt`,`c`.`id` as `blogId`,`u`.`name` as `authorInfo` 
                from `genres` as `a`,`genres` as `b`,`blogs` as `c`,`users` as `u` ,
                (SELECT distinct  g.parent_genre_id, max(h.id) as blogid
                from `blogs` as `h`, GENRES AS G
                where is_featured=1 
                AND H.blog_genre = g.id
                group by parent_genre_id) d
                where `a`.`id`=`b`.`parent_genre_id` 
                and `a`.`parent_genre_id`=0 
                and `c`.`blog_genre`=`b`.`id` 
                and `u`.`id`=`c`.`created_by` 
                and `c`.`is_featured`=1 
                and `d`.`parent_genre_id` = a.id
                and d.blogid = c.id
                ORDER BY `b`.`name`");
            
            return $featured_blog;
        }
    }

    //Function for getting parent genre for featured blogs details (guest user and logged in user)
    public static function getParentGenre($user_id=null)
    {
         if(isset($user_id) && intval($user_id) > 0)
         {
            $parent_genre=DB::select("select distinct a.id parentGenreId,a.name parentGenre
                    from genres a,genres b,users u,user_preferences up,blogs c
                    where up.preference_id=a.id
                    and a.parent_genre_id=0
                    and b.id=c.blog_genre
                    and c.is_featured=1
                    and up.user_id=$user_id
                    and up.is_delete=0");

            return $parent_genre;
         }else {
            $parent_genre=DB::select("select distinct a.id parentGenreId,a.name parentGenre from genres a,genres b,blogs c where a.id=b.parent_genre_id and a.parent_genre_id=0 and c.blog_genre=b.id and c.is_featured=1");

            return $parent_genre;
        }
    }

    //Function for getting child genre having at least 9 blogs
    public static function getChildGenre($parentGenreId='$row->parentGenreId')
    {
        $child_genre=DB::select("select b.blog_genre childgenreid,g.name childgenre from blogs b,genres g where b.blog_genre=g.id and b.blog_genre in (select id from genres where parent_genre_id in ($parentGenreId))
            group by blog_genre
            having count(1) >= 9");
        
        return $child_genre;
    }

    //Function for getting 9 blogs per child genre
    public static function getChildBlogs($childGenreId='$blogs->childgenreid')
    {
        $child_blogs=DB::select("select b.id blogId,b.blog_image blogImg,b.blog_title title,b.created_at createdAt,b.blog_description description,g.name childGenre,u.name authorInfo 
            from blogs b,genres g,users u where
            u.id=b.created_by 
            and b.blog_genre=g.id
            and b.blog_genre in (select  blog_genre
            from blogs where blog_genre in ($childGenreId)
            group by blog_genre
            having count(1) >= 9)
            order by b.created_at desc
            limit 9");

        return $child_blogs;
    }



    public static function getFeaturedBlogDetails()
    {
        $featured_blog_detail=DB::select("select a.blog_title,a.blog_genre, b.name child_name, c.name parent_name from blogs a, genres b, genres c
            where a.blog_genre = b.id
            and c.parent_genre_id=0
            and b.parent_genre_id = c.id
            and b.parent_genre_id in (
            SELECT a.id 
            from `genres` as `a`,`genres` as `b`,`blogs` as `c`,`users` as `u` ,
                (SELECT max(`h`.`created_at`) `created`, `blog_genre`
                from `blogs` as `h`
                where is_featured=1 
                group by  blog_genre) d
                    where `a`.`id`=`b`.`parent_genre_id` 
                    and `a`.`parent_genre_id`=0 
                    and `c`.`blog_genre`=`b`.`id` 
                    and `u`.`id`=`c`.`created_by` 
                    and `c`.`is_featured`=1 
                    and `d`.`blog_genre` = `c`.`blog_genre`
                    and `d`.`created` = `c`.`created_at`)
                    having (c.name) < 1
                    order by c.name,b.name");

        return $featured_blog_detail;

    }


   /* public static function getFeaturedBlogsDetails()
    {
        $featured_blog_detail=DB::select("SELECT `b`.`parent_genre_id`,`a`.`name` as `parentGenre`,`b`.`name` as `childGenre`,`c`.`blog_title` as `title`,`c`.`blog_image` as `blogImg`,`c`.`blog_description` as `description`,`c`.`created_at` as `createdAt`,`c`.`blog_genre` as `blogId`,`u`.`name` as `authorInfo` 
            from `genres` as `a`,`genres` as `b`,`blogs` as `c`,`users` as `u`,
        (SELECT D.Name AS Genre_name, E.blog_title AS b_title, e.id blog_id, E.created_at AS created, Count(E2.created_at) as count
        FROM blogs E 
        INNER JOIN genres D 
        ON E.blog_genre = D.Id 
        LEFT JOIN blogs E2 ON 
            e2.blog_genre = E.blog_genre
            AND E2.created_at > E.created_at
        GROUP BY  D.Name , 
              E.blog_title , 
              E.created_at) l
            where `a`.`id`=`b`.`parent_genre_id` 
            and `a`.`parent_genre_id`=0 
            and `c`.`blog_genre`=`b`.`id` 
            and `u`.`id`=`c`.`created_by` 
            
        and l.count < 2
        and l.blog_id = c.id
         ORDER BY a.name");
        
        return $featured_blog_detail;
    }*/
}