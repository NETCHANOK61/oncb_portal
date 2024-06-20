<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MenuHasPermission; // Import the MenuHasPermission model
use Spatie\Permission\Models\Permission; // Import the Permission model

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Define the many-to-many relationship with permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'menu_has_permission', 'menu_id', 'permission_id');
    }
    
    /**
     * Define the one-to-many relationship for children menus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
