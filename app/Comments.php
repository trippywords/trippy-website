<?php



namespace App;



use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

use DB;

class Comments extends Authenticatable

{

    use HasApiTokens, Notifiable;

    use HasRoles;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $table = 'comments';

    protected $fillable = [

        'id','name','email','website','comments','blog_id','is_delete','created_at','updated_at'

    ];


    public static function getComments($limit=null,$count=false){
        $user = DB::table('comments');
        $user->select('comments.*','users.first_name','users.last_name','users.name','users.profile_image','blogs.blog_title','blogs.blog_slug','blogs.blog_image');
        $user->join('users','comments.user_id','=','users.id');
        $user->join('blogs','comments.blog_id','=','blogs.id');
        $user->where('blogs.is_delete',"=",'0');
        $user->where('users.is_verified','=',1);
        $user->where('users.is_delete','=','0');
        $user->orderBy('comments.id', 'desc');
        if (isset($limit) && $limit!=null) {
            $user->limit($limit);
        }
        if (isset($count) && $count==true) {
            return $user->count();
        }else{
            return $user->get();
        }
        
    }
   

}

