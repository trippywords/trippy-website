<?php



namespace App;



use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\DB;


class Followers extends Authenticatable

{

    use HasApiTokens, Notifiable;

    use HasRoles;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $table = 'user_following';

    protected $fillable = [

        'user_id','follower_id','is_delete','followed_at','created_at','updated_at'

    ];


    public static function getFollowers($user_id=null,$count=false, $whereArr = array(),$orderBy='ASC',$offset=0,$limit=4){
        $query = DB::table('users');
        if (isset($count) && $count==false) {
            $query->join('user_following','user_following.user_id' , '=' ,'users.id');
            $query->where("user_following.follower_id","=",$user_id);
            $query->where('user_following.is_delete',"=",0);
            $query->where('users.is_verified',1);
            $query->where('users.is_delete','0');
            if (isset($whereArr['search_follower']) && $whereArr['search_follower']!='') {
                $query->whereRaw('( users.first_name like "%'.$whereArr['search_follower'].'%" OR users.last_name like "%'.$whereArr['search_follower'].'%" )');
                //$query->where('users.first_name','like',"%".$whereArr['search_follower']."%");
                //$query->orwhere('users.last_name','like',"%".$whereArr['search_follower']."%");
            }
            $query->orderBy('users.first_name', $orderBy);
            //$query->orderBy('user_following.id', 'DESC');
            $query->offset($offset)->limit($limit);
            return $query->get();
        }else{
            $query->join('user_following','user_following.user_id','=','users.id');
            $query->where('user_following.follower_id',"=",$user_id);
            $query->where('user_following.is_delete',"=",0);
            $query->where('users.is_verified',1);
            $query->where('users.is_delete','0');
            if (isset($whereArr['search_follower']) && $whereArr['search_follower']!='') {
                $query->whereRaw('( users.first_name like "%'.$whereArr['search_follower'].'%" OR users.last_name like "%'.$whereArr['search_follower'].'%" )');
                //$query->where('users.first_name','like',"%".$whereArr['search_follower']."%");
                //$query->orwhere('users.last_name','like',"%".$whereArr['search_follower']."%");
            }    
            if (isset($offset) && intval($offset) > 0) {
                $query->offset($offset)->limit($limit);
            }
            return $query->get();
        }
    }


    public static function getFollowings($user_id=null,$count=false, $whereArr = array(),$orderBy='ASC',$offset=0,$limit=4){
        $query = DB::table('users');
        if (isset($count) && $count==false) {
            $query->join('user_following','user_following.follower_id' , '=' ,'users.id');
            $query->where("user_following.user_id","=",$user_id);
            $query->where('user_following.is_delete',"=",0);
            $query->where('users.is_verified',1);
            $query->where('users.is_delete','0');
            if (isset($whereArr['search_following']) && $whereArr['search_following']!='') {
                $query->whereRaw('( users.first_name like "%'.$whereArr['search_following'].'%" OR users.last_name like "%'.$whereArr['search_following'].'%" )');
                //$query->where('users.first_name','like',"%".$whereArr['search_following']."%");
                //$query->orwhere('users.last_name','like',"%".$whereArr['search_following']."%");
            }
            $query->orderBy('users.first_name', $orderBy);
            //$query->orderBy('user_following.id', 'DESC');
            $query->offset($offset)->limit($limit);
            return $query->get();
        }else{
            $query->join('user_following','user_following.follower_id','=','users.id');
            $query->where('user_following.user_id',"=",$user_id);
            $query->where('user_following.is_delete',"=",0);
            $query->where('users.is_verified',1);
            $query->where('users.is_delete','0');
            if (isset($whereArr['search_following']) && $whereArr['search_following']!='') {
                $query->whereRaw('( users.first_name like "%'.$whereArr['search_following'].'%" OR users.last_name like "%'.$whereArr['search_following'].'%" )');
                //$query->where('users.first_name','like',"%".$whereArr['search_following']."%");
                //$query->orwhere('users.last_name','like',"%".$whereArr['search_following']."%");
            }    
            if (isset($offset) && intval($offset) > 0) {
                $query->offset($offset)->limit($limit);
            }
            return $query->get();
        }
    }
   

}

