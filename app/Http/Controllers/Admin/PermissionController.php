<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        // Define validation rules
        $rules = [
            'permissionName' => 'required|string|max:255|unique:permissions,name',
            'permissionGroup' => 'required|string|max:255'
        ];

        // Custom error messages
        $messages = [
            'permissionName.required' => 'กรุณากรอกชื่อสิทธิ์',
            'permissionName.unique' => 'ชื่อสิทธิ์นี้มีอยู่แล้วในระบบ',
            'permissionGroup.required' => 'กรุณาเลือกกลุ่มสิทธิ์',
        ];

        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        Permission::create(['name' => $request->permissionName, 'group_name' => $request->permissionGroup, 'note' => $request->note, 'status' => $request->status_menu ? 1 : 0]);

        // return to_route('admin.permissions.index');
        $notification = array(
            'message' => 'Permission Created Successfully!',
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
    public function update(Request $request, $id)
    {
        // Find the permission by ID
        $permission = Permission::findOrFail($id);

        // Define validation rules
        $rules = [
            'permissionName' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ];

        // Custom error messages
        $messages = [
            'permissionName.required' => 'กรุณากรอกชื่อสิทธิ์',
            'permissionName.unique' => 'ชื่อสิทธิ์นี้มีอยู่แล้วในระบบ',
        ];

        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the permission
        $permission->update([
            'name' => $request->permissionName,
            'group_name' => $request->permissionGroup,
            'note' => $request->note,
            'status' => $request->status ? 1 : 0
        ]);

        // Reload the permission
        $permission = Permission::findOrFail($id);

        // Set notification message
        $notification = [
            'message' => 'Permission Updated Informations Successfully!',
            'alert-type' => 'success'
        ];

        // Redirect to the edit page with notification
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
