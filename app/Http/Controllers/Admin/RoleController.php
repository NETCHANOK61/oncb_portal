<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.role.all_role', compact('roles', 'menuItems'));
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

        return view('admin.role.add_role', compact('menuItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'roleName' => 'required|string|max:255|unique:roles,name'
        ];

        // Custom error messages
        $messages = [
            'roleName.required' => 'กรุณากรอกชื่อบทบาท',
            'roleName.unique' => 'ชื่อบทบาทนี้มีอยู่แล้วในระบบ',
        ];

        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the role
        Role::create(['name' => $request->roleName, 'note' => $request->note, 'status' => $request->status_menu ? 1 : 0]);

        // Prepare the notification message
        $notification = array(
            'message' => 'Role Created Successfully!',
            'alert-type' => 'success'
        );

        // Redirect to the roles index page with the notification
        return redirect()->route('admin.roles.index')->with($notification);
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
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $permission_group = User::getPermissionGroups();

        // Fetch role permissions
        $rolePermissions = $role->permissions()->pluck('id')->toArray();

        // menuTab
        $menuItems = MenuService::getMenuItems();

        return view('admin.role.edit_role', compact('role', 'permissions', 'permission_group', 'menuItems', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the role by ID
        $role = Role::findOrFail($id);

        // Define validation rules
        $rules = [
            'roleName' => 'required|string|max:255|unique:roles,name,' . $role->id
        ];

        // Custom error messages
        $messages = [
            'roleName.required' => 'กรุณากรอกชื่อบทบาท',
            'roleName.unique' => 'ชื่อบทบาทนี้มีอยู่แล้วในระบบ',
        ];

        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the role
        $role->update([
            'name' => $request->roleName,
            'note' => $request->note,
            'status' => $request->status_menu ? 1 : 0
        ]);

        // Prepare the success notification
        $notification = [
            'message' => 'Role Updated Successfully!',
            'alert-type' => 'success'
        ];

        // Redirect to the roles index page with the success notification
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function givePermission(Request $request, Role $role)
    {
        //
        // foreach ($request->permission as $promise) {
        //     if (!$role->hasPermissionTo($promise)) {
        //         $role->givePermissionTo($promise);
        //     }
        // }

        $permissions = $request->input('permission', []);

        foreach ($permissions as $permission) {
            // Check if the role already has the permission
            if (!$role->hasPermissionTo($permission)) {
                // Add the permission to the role
                $role->givePermissionTo($permission);
            }
        }

        // Sync role permissions with the selected permissions
        $role->syncPermissions($permissions);

        // return to_route('admin.roles.index');
        $notification = array(
            'message' => 'Role Updated Permissions Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.roles.edit', ['role' => $role])->with($notification);
    }
}
