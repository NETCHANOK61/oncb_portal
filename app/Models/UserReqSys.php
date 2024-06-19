<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReqSys extends Model
{
    protected $table = 'users_request_sys';

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // 'user_id' is the foreign key in user_req_sys table
    }

    // Define relationship with PortalSystem model
    public function portalSystem()
    {
        return $this->belongsTo(System::class, 'portal_system_id'); // 'portal_system_id' is the foreign key in user_req_sys table
    }
}
