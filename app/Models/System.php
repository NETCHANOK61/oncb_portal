<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $table = 'portal_system';
    protected $guarded = [];

    public function administrators()
    {
        return $this->belongsToMany(User::class, 'portal_system_admin', 'system_id', 'user_id');
    }

    public function portalSystemAdmin()
    {
        return $this->hasMany(AdminSystem::class, 'system_id');
    }

    public function userReqSys()
    {
        return $this->hasMany(UserReqSys::class, 'portal_system_id');
    }
}
