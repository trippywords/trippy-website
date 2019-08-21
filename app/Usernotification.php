<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Usernotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'user_notification_status';
    protected $fillable = [
        'id','user_id','notification_id','notification_status','created_at','updated_at'
    ];
}