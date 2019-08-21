<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Message extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;
    protected $fillable = [
        'from_user_id', 'to_user_id', 'message','created_at','updated_at'
    ];
}
