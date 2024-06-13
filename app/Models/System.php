<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $table = 'portal_system';
    protected $guarded = [];

    /**
     * Define the many-to-many relationship with User model for administrators.
     */
    public function administrators()
    {
        return $this->belongsToMany(User::class, 'portal_system_admin', 'system_id', 'user_id')->withTimestamps();;
    }
}
