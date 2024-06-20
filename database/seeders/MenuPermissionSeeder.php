<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get the menu IDs where you want to assign permissions
        $menuIds = [2, 3, 4, 5, 6, 7, 10, 11, 12, 13]; // Replace with your actual menu IDs

        // Find or create permissions
        // $manageUsersPermission = Permission::where('name', 'manage_users')->first();
        // if (!$manageUsersPermission) {
        //     $manageUsersPermission = Permission::create(['name' => 'manage_users']);
        // }

        // Attach permissions to each menu
        foreach ($menuIds as $menuId) {
            $menu = Menu::find($menuId);

            if ($menu) {
                $menu->permissions()->syncWithoutDetaching([1]);
            }
        }
    }
}
