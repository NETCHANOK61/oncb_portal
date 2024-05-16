<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class User_portal extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    protected $table = 'users_portal';
    protected $guarded = [];
}
