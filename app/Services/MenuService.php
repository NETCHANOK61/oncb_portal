<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public static function getMenuItems()
    {
        // Retrieve all menus with their nested children and permissions
        $menuData = Menu::where('status_menu', '1')
            ->with('children', 'children.children', 'permissions') // Eager load all levels of children and permissions
            ->whereNull('parent_id') // Start with the top-level menus
            ->get();

        $menuItems = [];

        foreach ($menuData as $menu) {
            $menuName = $menu->name;
            $menuIcon = $menu->icon;
            // Check permissions for the main menu item
            if ($menu->permissions->pluck('name')->some(fn($permission) => auth()->user()->can($permission))) {
                $menuItems[$menuName] = [
                    'menu_icon' => $menuIcon,
                    "status_menu" => $menu->status_menu, 
                    'secondary_menus' => self::mapChildren($menu->children)
                ];
            }
        }
        return $menuItems;
    }

    private static function mapChildren($children)
    {
        $result = [];

        foreach ($children as $child) {
            $secondaryMenuName = $child->name;

            // Check permissions for the secondary menu item
            if ($child->permissions->pluck('name')->some(fn($permission) => auth()->user()->can($permission))) {
                $result[$secondaryMenuName] = [
                    'sub_menu' => self::mapSubChildren($child->children)
                ];
            }
        }

        return $result;
    }

    private static function mapSubChildren($subChildren)
    {
        $result = [];

        foreach ($subChildren as $subChild) {
            // Check permissions for the sub-menu item
            if ($subChild->permissions->pluck('name')->some(fn($permission) => auth()->user()->can($permission))) {
                $result[] = [
                    'name' => $subChild->name,
                    'route_menu' => $subChild->route
                ];
            }
        }

        return $result;
    }
}
