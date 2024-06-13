<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReqSys extends Model
{
    use HasFactory;
    protected $table = 'users_request_sys';
    protected $fillable = [
        'users_id',
        'portal_system_id',
    ];
}
