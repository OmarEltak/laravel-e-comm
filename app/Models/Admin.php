<?php

//  GUARD FILE
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

 

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'admin';
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'type', 'mobile','email', 'password', 'image', 'status', 
    ];
    protected $hidden = [
        'password','remember_token',
    ];

}
