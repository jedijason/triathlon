<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

//class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail

{   use Notifiable;
    use LaratrustUserTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*// original
     protected $fillable = [
        'name', 'email', 'password',
    ];//*/


    protected $fillable = [
        'first_name', 'last_name', 'dob', 'sex', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
 