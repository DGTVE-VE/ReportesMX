<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auth_user extends Model
{

    public $timestamps = false;
    
    protected $table = 'edxapp.auth_user';

    protected $fillable = ['id', 'username', 'first_name', 'last_name', 'email', 'password', 'is_staff', 'is_active', 'is_superuser', 'last_login', 'date_joined'];
}
