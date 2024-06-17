<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Usercontroller extends Controller
{
    //
    public function index()
    {
        //
        $users = User::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.user.all_user', compact('users', 'menuItems'));
    }

    public function show(User $user)
    {
        //
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_group = User::getPermissionGroups();

        $userRoles = $user->roles;
        $firstUserRole = $userRoles->first();

        $firstUserRoleId = $firstUserRole ? $firstUserRole->id : 0;

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.user.role', compact('user', 'roles', 'firstUserRoleId', 'firstUserRole', 'permissions', 'permission_group', 'menuItems'));
    }

    // public function assignRole(Request $request, User $user)
    // {
    //     //
    //     if (!$user->hasRole($request->roleGroup)) {
    //         $user->syncRoles($request->roleGroup);
    //     }
    //     // return to_route('admin.users.index');
    //     $notification = array(
    //         'message' => 'User Assigned Role Successfully!',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('admin.users.show', ['user' => $user])->with($notification);
    // }

    public function assignRole(Request $request, User $user)
    {
        // Assuming $request->roleGroup is the role name/id you want to assign
        $role = Role::findByName($request->roleGroup); // Assuming Role model is imported

        if (!$user->hasRole($role->name)) {
            $user->syncRoles([$role->name]);
            // Sync permissions associated with the role
            $user->syncPermissions($role->permissions->pluck('name')->toArray());
        }

        $notification = [
            'message' => 'User Assigned Role Successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.users.show', ['user' => $user])->with($notification);
    }


    public function givePermission(Request $request, User $user)
    {
        //
        // foreach ($request->permission as $promise) {
        //     if (!$role->hasPermissionTo($promise)) {
        //         $role->givePermissionTo($promise);
        //     }
        // }

        $permissions = $request->input('permission', []);

        // Sync role permissions with the selected permissions
        $user->syncPermissions($permissions);

        // return to_route('admin.users.index');
        $notification = array(
            'message' => 'User Assigned Permission Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users.show', ['user' => $user])->with($notification);
    }

    public function addUser()
    {
        //
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_group = User::getPermissionGroups();

        // $menuItems = Menu::all();
        $menuItems = MenuService::getMenuItems();

        return view('admin.user.add_user', compact('roles', 'permissions', 'permission_group', 'menuItems'));
    }

    public function storeUser(Request $request)
    {
        $mergedName = $request->input('firstname') . ' ' . $request->input('lastname');

        // $validatedData = $request->validate(['name' => 'required|unique:users|max:200', 'email' => 'required|unique:users', 'password' => 'required']);

        // $validatedData['name'] = $mergedName;

        $user = User::create([
            'name' => $mergedName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roleGroup);

        $notification = array(
            'message' => 'New User Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users.index')->with($notification);
    }

    public function editUser(User $user)
    {
        //
        $roles = Role::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.user.edit_user', compact('user', 'roles', 'menuItems'));
    }

    public function updateUser(Request $request, User $user)
    {

        $user->update([
            'name' => $request->firstname,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->roleGroup);

        $notification = array(
            'message' => 'User Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users.index')->with($notification);
    }
}
