<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Top-level menus
        $systemManagement = Menu::create([
            'name' => 'สถานะการนำเข้าข้อมูล',
            'icon' => 'typcn-arrow-move-outline',
            'route' => '#',
            'type' => 'named',
            'status_menu' => '1',
            'parent_id' => null
        ]);

        // Secondary menus under 'บริหารจัดการระบบ'
        $userManagement = Menu::create([
            'name' => 'สถานะการนำเข้าข้อมูล',
            'icon' => null,
            'route' => "#",
            'type' => 'named',
            'status_menu' => '1',
            'parent_id' => $systemManagement->id
        ]);

        // Sub-menus under 'บริหารจัดการผู้ใช้งาน'
        Menu::create([
            'name' => 'รายวัน',
            'icon' => null,
            'route' => 'admin.status.day',
            'type' => 'named',
            'status_menu' => '1',
            'parent_id' => $userManagement->id
        ]);

        Menu::create([
            'name' => 'รายเดือน',
            'icon' => null,
            'route' => 'admin.status.month',
            'type' => 'named',
            'status_menu' => '1',
            'parent_id' => $userManagement->id
        ]);

    }
}
