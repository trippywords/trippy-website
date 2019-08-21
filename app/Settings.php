<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Settings extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_logo','site_fevicon','site_tagline','site_phonenumber','site_email','site_facebook',
        	'site_twitter','site_linkedin','site_instagram','site_google','site_copyright','summerylength'
    ];

   
}
