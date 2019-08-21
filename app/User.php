<?php
namespace App;

use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable

{
    use HasApiTokens, Notifiable;

    use HasRoles;
    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name','first_name','last_name', 'email', 'password','profile_image','description','remember_token','role_id','is_delete','is_verified','remember_primary_token','is_primary_verified','last_login'

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password' 

    ];

}

