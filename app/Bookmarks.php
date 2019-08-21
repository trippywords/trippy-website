<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model

{    

    protected $table = 'bookmarks';

    protected $fillable = [

        'user_id', 'blog_id','is_delete','created_at','updated_at','bookmark_at'

    ];

}