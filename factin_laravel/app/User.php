<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = "users";

    protected $fillable = [
        'name', 'username','email', 'password','created_at','updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = true;

    //Spatie de la ruta Vendor/Spatie/laravel-permission/src/Models/Role
    protected $guard_name = 'web';
    
}
