<?php



namespace App;



use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;



class Connection extends Authenticatable

{

    use HasApiTokens, Notifiable;

    use HasRoles;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $table = 'user_connection';

    protected $fillable = [

        'id','user_id','connect_user_id','is_delete','created_at','updated_at','connection_date','blocked_date'

    ];



    public static function getConnections($user_id=null,$count=false, $whereArr = array(),$orderBy='ASC',$offset=0,$limit=4){
        $user = DB::table('users');
        if (isset($count) && $count==false) {
            $user->join('user_connection','user_connection.connect_user_id','=','users.id');
            $user->where('user_connection.user_id',"=",$user_id);
            $user->where('user_connection.is_delete',"=",0);
            $user->where('user_connection.is_request',"=",0);
            $user->where('users.is_verified',1);
            $user->where('users.is_delete','0');
            if (isset($whereArr['search_connection']) && $whereArr['search_connection']!='') {
                $user->whereRaw('( users.first_name like "%'.$whereArr['search_connection'].'%" OR users.last_name like "%'.$whereArr['search_connection'].'%" )');
                //$user->where('users.first_name','like',"%".$whereArr['search_connection']."%");
                //$user->orwhere('users.last_name','like',"%".$whereArr['search_connection']."%");
            }
            $user->orderBy('users.first_name', $orderBy);
            //$user->orderBy('user_connection.id', 'DESC');
            $user->offset($offset)->limit($limit);
            return $user->get();
        }else{
            $user->join('user_connection','user_connection.connect_user_id','=','users.id');
            $user->where('user_connection.user_id',"=",$user_id);
            $user->where('user_connection.is_delete',"=",0);
            $user->where('user_connection.is_request',"=",0);
            $user->where('users.is_verified',1);
            $user->where('users.is_delete','0');
            if (isset($whereArr['search_connection']) && $whereArr['search_connection']!='') {
                $user->whereRaw('( users.first_name like "%'.$whereArr['search_connection'].'%" OR users.last_name like "%'.$whereArr['search_connection'].'%" )');
                //$user->where('users.first_name','like',"%".$whereArr['search_connection']."%");
                //$user->orwhere('users.last_name','like',"%".$whereArr['search_connection']."%");
            }    
            if (isset($offset) && intval($offset) > 0) {
                $user->offset($offset)->limit($limit);
            }
            return $user->get();
        }
    }

    public static function getBlockUsers($user_id=null,$count=false, $whereArr = array(),$orderBy='ASC',$offset=0,$limit=4){
        $user = DB::table('users');
        if (isset($count) && $count==false) {
            $user->join('user_connection','user_connection.connect_user_id','=','users.id');
            $user->where('user_connection.user_id',"=",$user_id);
            $user->where('user_connection.is_delete',"=",0);
            $user->where('user_connection.is_block',"=",1);
            $user->where('users.is_verified',1);
            $user->where('users.is_delete','0');
            if (isset($whereArr['search_connection']) && $whereArr['search_connection']!='') {
                $user->whereRaw('( users.first_name like "%'.$whereArr['search_connection'].'%" OR users.last_name like "%'.$whereArr['search_connection'].'%" )');
                //$user->where('users.first_name','like',"%".$whereArr['search_connection']."%");
                //$user->orwhere('users.last_name','like',"%".$whereArr['search_connection']."%");
            }
            $user->orderBy('users.first_name', $orderBy);
            //if (isset($offset) && intval($offset) > 0) {
                $user->offset($offset)->limit($limit);
            //}     
            return $user->get();
        }else{
            $user->join('user_connection','user_connection.connect_user_id','=','users.id');
            $user->where('user_connection.user_id',"=",$user_id);
            $user->where('user_connection.is_delete',"=",0);
            $user->where('user_connection.is_block',"=",0);
            $user->where('users.is_verified',1);
            $user->where('users.is_delete','0');
            if (isset($whereArr['search_connection']) && $whereArr['search_connection']!='') {
                $user->whereRaw('( users.first_name like "%'.$whereArr['search_connection'].'%" OR users.last_name like "%'.$whereArr['search_connection'].'%" )');
                //$user->where('users.first_name','like',"%".$whereArr['search_connection']."%");
                //$user->orwhere('users.last_name','like',"%".$whereArr['search_connection']."%");
            }    
            //if (isset($offset) && intval($offset) > 0) {
                $user->offset($offset)->limit($limit);
            //}
            return $user->get();
        }
    }

    public static function getConnectionRequest($user_id=null,$offset=0, $whereArr = array(),$orderBy='ASC',$limit=4){
        $user = DB::table('users');
        $user->join('user_connection','user_connection.user_id','=','users.id');
        $user->where('user_connection.connect_user_id',"=",$user_id);
        $user->where('user_connection.is_delete',"=",0);
        $user->where('user_connection.is_request',"=",1);
        $user->where('users.is_verified',1);
        $user->where('users.is_delete','0');
        $user->orderBy('users.first_name', $orderBy);
        $user->offset($offset)->limit($limit);
        return $user->get();
    }

}