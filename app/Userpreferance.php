<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Userpreferance extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'user_preferences';
    protected $fillable = [
        'id','user_id', 'preference_id','is_delete'
    ];
}