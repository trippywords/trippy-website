<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
        'blog_title','blog_genre' ,'created_by','blog_description','blog_meta_description','blog_keywords','blog_image','blog_status','blog_slug','tags','is_featured','is_trending','is_recommended','parent_genre_id'
    ];

    //function for getting table data for recommended as well as blogs for adminpanel 
    public static function getDataTableBlogs()
    {
        if(str_contains(url()->current(), '/adminpanel/recommended-blog/getdata'))
        {
        $blogs = DB::table('blogs as b')
          ->join('users as u','b.created_by','=','u.id')
          ->join('child_genres as c','b.blog_genre','=','c.id')
          ->where('b.is_deleted',"=","0")->where('b.is_recommended',"=",1)
          ->select('b.id','b.blog_title','b.blog_genre','b.blog_image', 'b.created_at','b.created_by','b.blog_slug','b.blog_status','b.is_trending','b.is_featured','c.child_genre_name as child','u.first_name as first_name','u.last_name as last_name','b.blog_status')       
          ->orderBy('b.created_at', 'desc')     

              ->get();

              return $blogs;
          }
          else
           {
             $blogs = DB::table('blogs as b')
          ->join('users as u','b.created_by','=','u.id')
          ->join('child_genres as c','b.blog_genre','=','c.id')
          ->where('b.is_deleted',"=","0")->where('b.is_recommended',"=",0)
          ->select('b.id','b.blog_title','b.blog_genre','b.blog_image', 'b.created_at','b.created_by','b.blog_slug','b.blog_status','b.is_trending','b.is_featured','c.child_genre_name as child','u.first_name as first_name','u.last_name as last_name','b.blog_status')       
          ->orderBy('b.created_at', 'desc')     

              ->get();

              return $blogs;
          }
    } 

   
    public static function showBlogDetail($id)
    {
        $blog=DB::table('blogs as b')
        ->join('users as u','b.created_by','=','u.id')
        ->where('b.id','=',$id)
        ->where('b.is_deleted',"=","0")
        ->select('b.id','b.blog_title as blog_title','b.blog_description','b.blog_meta_description','b.blog_keywords','b.blog_image','b.created_by','b.is_trending','b.is_featured','b.is_recommended','u.first_name as first_name','u.last_name as last_name')
        ->get();


        return $blog;

    } 



    public static function getBlogs($user_id=null,$offset=0, $whereArr = array(),$orderBy='DESC',$limit=5){

       /* $user = DB::table('blogs');
        $user->join('users','blogs.created_by','=','users.id');
        $user->where('blogs.created_by',"=",$user_id);
        $user->where('blogs.is_deleted',"=",'0');
        $user->where('users.is_verified','=',1);
        $user->where('users.is_delete','=','0');
        
        if (isset($whereArr['blogs.blog_status']) && intval($whereArr['blogs.blog_status']) > 0) {
            $user->where('blogs.blog_status',"=",$whereArr['blogs.blog_status']);
        }
        $user->orderBy('blogs.id', $orderBy);
        $user->offset($offset)->limit($limit);
        return $user->get();*/
        $user = DB::table('blogs as b');
        $user->join('users as u','b.created_by','=','u.id');
        $user->join('parent_genres as p','b.parent_genre_id','=','p.id');
        $user->join('child_genres as c','b.blog_genre','=','c.id');
        $user->where('b.created_by',"=",$user_id);
        $user->where('b.is_deleted',"=",'0');
        $user->where('u.is_verified','=',1);
        $user->where('u.is_delete','=','0');
        $user->where('b.blog_status','!=',2);
        $user->select('b.id as blogid','u.id as userid','u.name as name','b.blog_title','b.blog_status as blog_status','b.blog_description','b.blog_image','b.blog_slug','c.child_genre_name','b.is_deleted','b.created_at','p.parent_name');
        /*if (isset($whereArr['blog_status']) && intval($whereArr['blog_status']) > 0) {
            $user->where('blog_status',"=",$whereArr['blog_status']);
        }*/
        $user->orderBy('b.id', $orderBy);
        $user->offset($offset)->limit($limit);
        return $user->get();
    }
    //chaitrali
    //Function for getting fetured blog for guest user as well as logged in user
     public static function getFeaturedBlog($user_id=null)
    {
        if(isset($user_id) && intval($user_id) > 0)
        {
            //using old genre table
                /*$featured_blog=DB::select("SELECT distinct `a`.`name` as `parentGenre`,`b`.`name` as `childGenre`,`c`.`blog_title` as `title`,
                `c`.`blog_image` as `blogImg` ,`c`.`blog_description` as `description`,`c`.`created_at` as `createdAt`
                ,`c`.`blog_genre` as `blogId`, `u`.`name` as `authorInfo` , c.is_featured
                from `genres` as `a`,`genres` as `b`,
                `blogs` as `c`,`users` as `u` , (SELECT distinct  g.parent_genre_id, max(h.id) as blogid
                from `blogs` as `h`, genres as g
                where is_featured=1 
                AND h.blog_genre = g.id
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
                ORDER BY `b`.`name`");*/
                
                $featured_blog=DB::select("SELECT distinct `a`.`parent_name` as `parentGenre`,`b`.`child_genre_name` as `childGenre`,`c`.`blog_title` as `title`,
                `c`.`blog_image` as `blogImg` ,`c`.`blog_description` as `description`,`c`.`created_at` as `createdAt`
                ,`c`.`id` as `blogId`, `u`.`name` as `authorInfo` , `c`.`is_featured`
                from `parent_genres` as `a`,`child_genres` as `b`,
                `blogs` as `c`,`users` as `u` , 
                (SELECT distinct  g.id, max(h.id) as blogid
                from `blogs` as `h`, parent_genres as g
                where h.is_featured=1 
                and  h.parent_genre_id = g.id
                group by parent_genre_id) d 
                where `a`.`id` in 
                (select `gn`.`parent_genre_id` from child_genres gn, user_genre_preferences up 
                where gn.id = up.child_preference_id and up.is_deleted=0 and up.user_id=$user_id )
                and a.id = b.parent_genre_id
                and `c`.`is_deleted` = '0'
                and`c`.`blog_genre`= b.id 
                and `u`.`id`=`c`.`created_by` 
                and `c`.`is_featured`=1 
                and `c`.`blog_status`=1
                and `d`.`blogid` = `c`.`id` 
                ORDER BY `b`.`child_genre_name`");
            return $featured_blog;
        }
        else
        {
            //using old genre table
                /*$featured_blog=DB::select("SELECT distinct `a`.`name` as `parentGenre`,`b`.`name` as `childGenre`,`c`.`blog_title` as `title`,`c`.`blog_image` as `blogImg`,`c`.`blog_description` as `description`,`c`.`created_at` as `createdAt`,`c`.`id` as `blogId`,`u`.`name` as `authorInfo` 
                from `genres` as `a`,`genres` as `b`,`blogs` as `c`,`users` as `u` ,
                (SELECT distinct  g.parent_genre_id, max(h.id) as blogid
                from `blogs` as `h`, genres as g
                where is_featured=1 
                and  h.blog_genre = g.id
                group by parent_genre_id) d
                where `a`.`id`=`b`.`parent_genre_id` 
                and `a`.`parent_genre_id`=0 
                and `c`.`blog_genre`=`b`.`id` 
                and `u`.`id`=`c`.`created_by` 
                and `c`.`is_featured`=1 
                and `d`.`parent_genre_id` = a.id
                and d.blogid = c.id
                ORDER BY `b`.`name`");*/

                $featured_blog=DB::select("SELECT distinct `a`.`parent_name` as `parentGenre`,`b`.`child_genre_name` as `childGenre`,`c`.`blog_title` as `title`,`c`.`blog_image` as `blogImg`,`c`.`blog_description` as `description`,`c`.`created_at` as `createdAt`,`c`.`id` as `blogId`,`u`.`name` as `authorInfo` 
                from `parent_genres` as `a`,`child_genres` as `b`,`blogs` as `c`,`users` as `u` ,
                (SELECT distinct  g.id, max(h.id) as blogid
                from `blogs` as `h`, parent_genres as g
                where h.is_featured=1 
                and  h.parent_genre_id = g.id
                group by parent_genre_id) d
                where `a`.`id`=`b`.`parent_genre_id` 
                and `c`.`is_deleted` = '0'
                and `c`.`blog_genre`=`b`.`id` 
                and `u`.`id`=`c`.`created_by` 
                and `c`.`is_featured`=1 
                and `c`.`blog_status`=1
                and `d`.`id` = a.id
                and d.blogid = c.id
                ORDER BY `b`.`child_genre_name`");
            
            return $featured_blog;
        }
    }
    //chaitrali
    //Function for getting parent genre for featured blogs details (guest user and logged in user)
    public static function getParentGenre($user_id=null)
    {
         if(isset($user_id) && intval($user_id) > 0)
         {
            
            //Using new genre table
            $parent_genre=DB::select("select distinct a.id parentGenreId,a.parent_name  parentGenre
                    from parent_genres a,child_genres b,users u,user_genre_preferences up,blogs c
                    where up.parent_preference_id=a.id                    
                    and b.id=c.blog_genre
                    and c.is_featured=1
                    and c.blog_status=1
                    and up.user_id=$user_id
                    and up.is_deleted=0");

            return $parent_genre;
         }else {
            
            //using New genre tables
            $parent_genre=DB::select("select distinct a.id parentGenreId,a.parent_name      parentGenre from parent_genres a,child_genres b,blogs c 
                    where a.id=b.parent_genre_id
                    and c.blog_status=1 
                    and c.blog_genre=b.id 
                    and c.is_featured=1");

            return $parent_genre;
        }
    }
    //chaitrali
    //Function for getting child genre having at least 9 blogs
    public static function getChildGenre($parentGenreId='$row->parentGenreId',$user_id=null)
    {
        
          //using New genre tables  
        if(isset($user_id) && intval($user_id) > 0)
         {
            //dd($user_id);
            $child_genre=DB::select("select b.blog_genre childgenreid,g.child_genre_name childgenre from blogs b,child_genres g ,user_genre_preferences up ,users u
            where b.blog_genre=g.id 
            and b.blog_genre in (select id from child_genres where parent_genre_id in($parentGenreId))
            and u.id=$user_id
            and b.blog_genre=up.child_preference_id
            and up.is_deleted=0
            and b.blog_status=1
            and b.is_deleted='0'
            group by blog_genre
            having count(1) >= 9");

            $result=array();
            foreach($child_genre as $child_blog)
            {
                
            $countBlog=DB::select("select count(id) as count from blogs where blog_genre=$child_blog->childgenreid and is_deleted='0'");
            foreach ($countBlog as $value) {

                        if(!empty($child_blog) && $value->count >= 9)
                    {
                        //print_r($value->count);
                        $result[]=$child_blog;
                    }
                }
            
                
            }
            /*echo "<pre>";
            print_r($result);
            dd();*/
            return $result;

        }else{
        
            $child_genre=DB::select("select b.blog_genre childgenreid,g.child_genre_name childgenre from blogs b,child_genres g 
            where b.blog_genre=g.id
            and b.blog_status=1
            and b.is_deleted='0' 
            and b.blog_genre in (select id from child_genres where parent_genre_id in($parentGenreId))
            group by blog_genre
            having count(1) >= 9");
        
        return $child_genre;
        }
    }
    //chaitrali
    //Function for getting 9 blogs per child genre
    public static function getChildBlogs($childGenreId='$blogs->childgenreid')
    {
       
        //Using New genre table
        $child_blogs=DB::select("select b.id blogId,b.blog_image blogImg,b.blog_title title,b.created_at createdAt,b.blog_description description,g.child_genre_name childGenre,u.name authorInfo 
            from blogs b,child_genres g,users u 
            where u.id=b.created_by 
            and b.blog_status=1
            and b.is_deleted='0'
            and b.blog_genre=g.id
            and b.blog_genre in (select blog_genre
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