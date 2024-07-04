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
        // Validate input
        $request->validate([
            'ability' => 'required|in:view,create,edit,delete,download',
            'permissionGroup' => 'required|string|max:255',
            'permissionName' => 'required|string|max:255 ',
        ], [
            'ability.required' => 'กรุณาเลือกความสามารถ',
            'permissionGroup.required' => 'กรุณาระบุกลุ่มสิทธิ์',
            'permissionName.required' => 'กรุณาระบุชื่อสิทธิ์',
        ]);

        // Construct names
        $selected_menu = Menu::find($request->permissionName);
        $en_name = $selected_menu->name . '.' . $request->ability;
        $th_name = $selected_menu->th_name . '.' . $this->getAbilityTitle($request->ability);

        // Check if en_name or group_name already exists
        $check_existing = Permission::where('name', $en_name)->exists();

        if ($check_existing) {
            return redirect()->back()->withErrors(['permissionName' => 'พบข้อมูลการผูกเมนูกับสิทธิ์ "' . $selected_menu->th_name . ' ในระบบแล้ว.']);
        }

        // Create new permission
        $new_permission = Permission::create([
            'th_name' => $th_name,
            'name' => $en_name,
            'group_name' => $request->permissionGroup,
            'note' => $request->note,
            'status' => $request->status ? '1' : '0',
            'operations' => $request->ability
        ]);

        // Attach permission to menu
        $selected_menu->permissions()->attach($new_permission->id);

        // Set notification message
        $notification = [
            'message' => 'Permission Created Successfully!',
            'alert-type' => 'success'
        ];

        // Redirect to the index page with notification
        return redirect()->route('admin.permissions.index')->with($notification);
    }

    /**
     * Helper function to get ability title based on key
     *
     * @param string $abilityKey
     * @return string
     */
    private function getAbilityTitle($abilityKey)
    {
        $abilityTitles = [
            'view' => 'ดูรายการข้อมูลทั้งหมด',
            'create' => 'สร้าง / เพิ่มข้อมูล',
            'edit' => 'แก้ไข / ปรับปรุงข้อมูล',
            'delete' => 'ลบข้อมูล',
            'download' => 'ดาวน์โหลด',
        ];

        return $abilityTitles[$abilityKey] ?? '';
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
        $dataGroup = [
            'data_recording' => 'การบันทึกข้อมูล',
            'data_status' => 'สถานะการนำเข้าข้อมูล',
            'data_report' => 'รายงาน',
            'other_system' => 'เชื่อมโยงระบบอื่น ๆ',
            'data_management' => 'บริหารจัดการ',
        ];

        $menuItems = MenuService::getMenuItems();
        $menus = Menu::where('status_menu', '1')->get();
        $menu_of_permission = MenuHasPermission::where('permission_id', $permission->id)->first();
        $permission_name_parts = explode('.', $permission->th_name);
        $permission_name_display = $permission_name_parts[0];

        return view('admin.permission.edit_permission', compact('permission', 'permission_name_display', 'menuItems', 'menu_of_permission', 'abilities', 'dataGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $request->validate([
            'ability' => 'required|in:view,create,edit,delete,download',
            'permissionGroup' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            'permissionName' => 'string|max:255|not_regex:/\./', // Ensure th_name does not contain a dot
        ], [
            'permissionName.not_regex' => 'ชื่อสิทธิ์ห้ามมีเครื่องหมาย . ',
            'permissionGroup.required' => 'กรุณาระบุกลุ่มสิทธิ์',
            'ability.required' => 'กรุณาระบุความสามารถของสิทธิ์',
        ]);

        $menu_of_permission = MenuHasPermission::where('permission_id', $id)->first();
        $selected_menu = Menu::find($menu_of_permission->menu_id);
        $en_name = $selected_menu->name . '.' . $request->ability;
        $th_name = $request->permissionName . '.' . $this->getAbilityTitle($request->ability);
        // Find the permission by ID
        $permission = Permission::findOrFail($id);

        // Check if en_name is already used by another permission
        $existingPermission = Permission::where('name', $en_name)->first();
        if ($existingPermission) {
            return redirect()->back()->withErrors(['permissionName' => 'พบข้อมูลการผูกเมนูกับสิทธิ์ "' . $request->permissionName . ' ในระบบแล้ว.']);
        }

        // Update the permission
        $permission->update([
            'th_name' => $th_name,
            'name' => $en_name,
            'group_name' => $request->permissionGroup,
            'note' => $request->note,
            'status' => $request->status ? '1' : '0',
            'operations' => $request->ability
        ]);

        // Set notification message
        $notification = [
            'message' => 'Permission Updated Informations Successfully!',
            'alert-type' => 'success'
        ];

        // Redirect to the edit page with notification
        return redirect()->route('admin.permissions.index')->with($notification);
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
