<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class User extends Model
{

    //

    use HasApiTokens, AuthenticableTrait;

    protected $fillable = ['username', 'email', 'password'];

    protected $hidden = [

        'password',

    ];

    /*

     * Get Todo of User

     *

     */

    public function todo()
    {

        return $this->hasMany('App\Todo', 'user_id');

    }

}
