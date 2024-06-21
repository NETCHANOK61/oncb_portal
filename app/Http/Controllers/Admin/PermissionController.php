<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuHasPermission;
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
        $menus = Menu::where('status_menu', '1')->get();

        return view('admin.permission.add_permission', compact('menuItems', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $abilityTitles = [
            'view' => 'ดูรายการข้อมูลทั้งหมด',
            'create' => 'สร้าง / เพิ่มข้อมูล',
            'edit' => 'แก้ไข / ปรับปรุงข้อมูล',
            'delete' => 'ลบข้อมูล',
            'download' => 'ดาวน์โหลด',
        ];

        $selected_menu = Menu::find($request->menu);
        $en_name = $selected_menu->name . '.' . $request->ability;
        $th_name = $selected_menu->th_name . '.' . $abilityTitles[$request->ability];

        // Define validation rules
        $rules = [
            'menu' => 'required|exists:menus,id',
            'ability' => 'required|in:view,create,edit,delete,download',
            'permissionGroup' => 'required',
        ];

        // // Custom error messages
        $messages = [
            'menu.required' => 'กรุณาเลือกเมนู',
            'ability.required' => 'กรุณาเลือกความสามารถ',
            'permissionGroup.required' => 'กรุณาเลือกกลุ่มสิทธิ์',
        ];

        // // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $check_existing = Permission::where('name', $en_name)->where('group_name', $request->permissionGroup)->get();
        if ($check_existing) {
            $validator->errors()->add('ability', 'การผูกเมนูกับสิทธิ์นี้มีในระบบแล้ว');
        }

        $new_permission = Permission::create(['th_name' => $th_name, 'name' => $en_name, 'group_name' => $request->permissionGroup, 'note' => $request->note, 'status' => $request->status ? '1' : '0', 'operations' => $request->ability]);
        $selected_menu->permissions()->attach($new_permission->id);

        // // return to_route('admin.permissions.index');
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
        // $roles = Role::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $abilities = [
            'view' => 'ดูรายการข้อมูลทั้งหมด',
            'create' => 'สร้าง / เพิ่มข้อมูล',
            'edit' => 'แก้ไข / ปรับปรุงข้อมูล',
            'delete' => 'ลบข้อมูล',
            'download' => 'ดาวน์โหลด'
        ];

        $menuItems = MenuService::getMenuItems();
        $menus = Menu::where('status_menu', '1')->get();
        $menu_of_permission = MenuHasPermission::where('permission_id', $permission->id)->first();

        return view('admin.permission.edit_permission', compact('permission', 'menus', 'menuItems', 'menu_of_permission', 'abilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $abilityTitles = [
            'view' => 'ดูรายการข้อมูลทั้งหมด',
            'create' => 'สร้าง / เพิ่มข้อมูล',
            'edit' => 'แก้ไข / ปรับปรุงข้อมูล',
            'delete' => 'ลบข้อมูล',
            'download' => 'ดาวน์โหลด',
        ];

        $selected_menu = Menu::find($request->menu);
        $en_name = $selected_menu->name . '.' . $request->ability;
        $th_name = $selected_menu->th_name . '.' . $abilityTitles[$request->ability];

        // Find the permission by ID
        $permission = Permission::findOrFail($id);

        // Update the permission
        $permission->update([
            'th_name' => $th_name,
            'name' => $en_name,
            'group_name' => $request->permissionGroup,
            'note' => $request->note,
            'status' => $request->status ? '1' : '0',
            'operations' => $request->ability
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
