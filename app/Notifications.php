<?php





namespace App;





use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;





class Notifications extends Model

{

    /**

     * The attributes that are mass assignable.

     *	

     * @var array

     */

    protected $table = 'notifications';

    protected $fillable = [

        'id','notification_title','is_delete','created_at','updated_at'

    ];

    public static function getNotifications($offset=0,$orderBy='DESC',$limit=10){
        $user = DB::table('notifications');
        $user->where('notifications.is_delete',"=",'0');
        $user->orderBy('notifications.id', $orderBy);
        $user->offset($offset)->limit($limit);
        return $user->get();
    }

}