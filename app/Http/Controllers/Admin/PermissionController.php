<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permissions = Permission::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.permission.all_permission', compact('permissions', 'menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.permission.add_permission', compact('menuItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $validate = $request->validate(['roleName'=>'required']);
        Permission::create(['name' => $request->roleName, 'group_name' => $request->roleGroup]);

        // return to_route('admin.permissions.index');
        $notification = array(
            'message' => 'Role Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.permissions.index')->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
        $roles = Role::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.permission.edit_permission', compact('permission', 'roles', 'menuItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        Permission::findOrFail($request->id)->update([
            'name' => $request->roleName,
            'group_name' => $request->roleGroup
        ]);

        $permission = Permission::findOrFail($request->id);

        // return to_route('admin.permissions.index');
        $notification = array(
            'message' => 'Permission Updated Informations Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.permissions.edit', ['permission' => $permission])->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assignRole(Request $request, Permission $permission)
    {
        //
        if (!$permission->hasRole($request->roleGroup)) {
            $permission->syncRoles($request->roleGroup);
        }
        // return to_route('admin.permissions.index');
        $notification = array(
            'message' => 'Permission Assigned To Role Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.permissions.edit', ['permission' => $permission])->with($notification);
    }
}
