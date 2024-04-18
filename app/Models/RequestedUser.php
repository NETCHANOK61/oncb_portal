<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedUser extends Model
{
    use HasFactory;
    protected $table = 'requested_user';
    protected $guarded = [];
}
