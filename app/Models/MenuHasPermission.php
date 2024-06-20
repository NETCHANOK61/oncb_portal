<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuHasPermission extends Model
{
    use HasFactory;
    protected $table = 'menu_has_permission';

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_has_permission', 'permission_id', 'menu_id');
    }
}
