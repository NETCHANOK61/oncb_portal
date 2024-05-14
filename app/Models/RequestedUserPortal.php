<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedUserPortal extends Model
{
    use HasFactory;
    protected $table = 'requested_user_portal';
    protected $guarded = [];
}
