<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGenrePreference extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'user_genre_preferences';
    protected $fillable = [
        'id','user_id', 'parent_preference_id','parent_preference_id'
    ];
}
