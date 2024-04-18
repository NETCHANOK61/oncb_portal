<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public static function getMenuItems()
    {
        $menuData = Menu::where('status_menu', 1)->get();
        $menuItems = [];

        foreach ($menuData as $i) {
            $menuName = $i->menu_name;
            $secondaryMenu = $i->secondary_menu;
            $subMenu = $i->sub_menu;
            $menuIcon = $i->menu_icon;
            $urlMenu = $i->url_menu;

            if (!isset($menuItems[$menuName])) {
                $menuItems[$menuName] = [
                    'menu_icon' => $menuIcon,
                    'secondary_menus' => [
                        $secondaryMenu => ['sub_menu' => [['name' => $subMenu, 'url_menu' => $urlMenu]]],
                    ],
                ];
            } else {
                if (!isset($menuItems[$menuName]['secondary_menus'][$secondaryMenu])) {
                    $menuItems[$menuName]['secondary_menus'][$secondaryMenu] = [
                        'sub_menu' => [['name' => $subMenu, 'url_menu' => $urlMenu]],
                    ];
                } else {
                    $menuItems[$menuName]['secondary_menus'][$secondaryMenu]['sub_menu'] = array_merge(
                        $menuItems[$menuName]['secondary_menus'][$secondaryMenu]['sub_menu'],
                        [['name' => $subMenu, 'url_menu' => $urlMenu]]
                    );
                }
            }
        }

        return $menuItems;
    }
}
