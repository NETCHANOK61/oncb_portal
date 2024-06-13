<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\System;
use App\Models\Test;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class PortalSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();
        $data = System::all();
        // $columns = Schema::getColumnListing((new Test())->getTable());

        return view('admin.portal_system.all_system', compact('menu', 'menuItems', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addSystem()
    {
        //
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();
        $data = System::all();
        $admin_from_users = User::whereIn('role', ['admin'])->get();
        $superAdmin_from_users = User::whereIn('role', ['superAdmin'])->get();
        // $columns = Schema::getColumnListing((new Test())->getTable());

        return view('admin.portal_system.add_system', compact('menu', 'menuItems', 'data', 'admin_from_users', 'superAdmin_from_users'));
    }

    public function allUser()
    {
        //
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();
        $users = User::all();
        $data = System::all();
        // $columns = Schema::getColumnListing((new Test())->getTable());

        return view('admin.portal_user.all_user', compact('menu', 'menuItems', 'users', 'data'));
    }

    public function editUser(string $id)
    {
        //
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();
        $user = User::find($id);
        $data = System::where('status', '1')->get();
        // $columns = Schema::getColumnListing((new Test())->getTable());

        return view('admin.portal_user.edit_user', compact('menu', 'menuItems', 'user', 'data'));
    }

    public function updateUser(string $id, Request $request)
    {
        $user = User::findOrFail($id);

        // Get all field names of the user model
        $allFields = System::pluck('en_name')->toArray();

        // Initialize an array to store field-value pairs for update
        $updates = [];

        // Loop through each field name
        foreach ($allFields as $fieldName) {
            // Check if the field name is present in systemGroup
            if ($request->has('systemGroup') && in_array($fieldName, $request->systemGroup)) {
                // If present, set the value to 1
                $updates[$fieldName] = 1;
            } else {
                // If not present, set the value to 0
                $updates[$fieldName] = 0;
            }
        }

        // Update the user with the field-value pairs
        $user->update($updates);

        return redirect()->route('portal.allUser');
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $en_name = $request->en_name;
    //     //
    //     System::create([
    //         'fullname' => $request->fullname,
    //         'en_name' => $request->en_name,
    //         'status' => $request->status ? '1' : '0',
    //         'url' => $request->url,
    //         'API_KEY' => Str::random(43)
    //     ]);

    //     Schema::table('users', function ($table) use ($en_name) {
    //         $table->integer($en_name)->default(0);
    //     });
    //     // return $this->allColumn();
    //     return redirect()->route('portal.allSystem');
    // }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'fullname' => 'required|string|max:255',
            'en_name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'adminGroup' => 'nullable|array',
            'adminGroup.*' => 'exists:users,id',
            'superAdminGroup' => 'nullable|array',
            'superAdminGroup.*' => 'exists:users,id'
        ];

        // Custom error messages
        $messages = [
            'fullname.required' => 'กรุณากรอกชื่อระบบเต็ม (ภาษาไทย)',
            'en_name.required' => 'กรุณากรอกชื่อย่อ (ภาษาอังกฤษ)',
            'url.required' => 'กรุณากรอก URL',
            'adminGroup.*.exists' => 'ผู้ใช้ที่เลือกไม่มีอยู่ในระบบ',
            'superAdminGroup.*.exists' => 'ผู้ใช้ที่เลือกไม่มีอยู่ในระบบ'
        ];

        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for existing record
        $existingSystem = System::where('fullname', $request->fullname)
            ->orWhere('en_name', $request->en_name)
            ->orWhere('url', $request->url)
            ->first();

        if ($existingSystem) {
            return redirect()->back()
                ->withErrors(['duplicate' => 'ระบบนี้มีอยู่แล้วในฐานข้อมูล'])
                ->withInput();
        }

        // Create a new system instance and save it to the database
        $system = new System();
        $system->fullname = $request->fullname;
        $system->en_name = $request->en_name;
        $system->url = $request->url;
        $system->status = $request->status ? 1 : 0;
        $system->API_KEY = Str::random(43);
        $system->save();

        Schema::table('users', function ($table) use ($system) {
            $table->integer($system->en_name)->default(0);
        });

        // Attach administrators
        if ($request->has('adminGroup')) {
            $system->administrators()->attach($request->adminGroup, ['role' => 'admin']);
        }

        // Attach super administrators
        if ($request->has('superAdminGroup')) {
            $system->administrators()->attach($request->superAdminGroup, ['role' => 'super_admin']);
        }

        return redirect()->route('portal.allSystem')->with('success', 'System created successfully.');
    }

    public function deleteSystem(string $id)
    {
        $form = System::findOrFail($id);
        $form->update([
            'status' => '0'
        ]);

        // return $this->allColumn();
        return redirect()->route('portal.allSystem');
    }

    public function returnSystem(string $id)
    {
        $form = System::findOrFail($id);
        $form->update([
            'status' => '1'
        ]);

        // return $this->allColumn();
        return redirect()->route('portal.allSystem');
    }

    public function editSystem(string $id)
    {
        $system = System::findOrFail($id);
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();

        $admin_from_users = User::whereIn('role', ['admin'])->get();
        $superAdmin_from_users = User::whereIn('role', ['superAdmin'])->get();

        // Get current admins and super admins
        $current_admins = $system->administrators()->wherePivot('role', 'admin')->pluck('user_id')->toArray();
        $current_super_admins = $system->administrators()->wherePivot('role', 'super_admin')->pluck('user_id')->toArray();

        return view('admin.portal_system.edit_system', compact('system', 'menuItems', 'menu', 'admin_from_users', 'superAdmin_from_users', 'current_admins', 'current_super_admins'));
    }

    public function updateSystem(Request $request, $id)
    {
        $system = System::findOrFail($id);
    
        // Define validation rules
        $rules = [
            'fullname' => 'required|string|max:255',
            'en_name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'adminGroup' => 'nullable|array',
            'adminGroup.*' => 'exists:users,id',
            'superAdminGroup' => 'nullable|array',
            'superAdminGroup.*' => 'exists:users,id'
        ];
    
        // Custom error messages
        $messages = [
            'fullname.required' => 'กรุณากรอกชื่อระบบเต็ม (ภาษาไทย)',
            'en_name.required' => 'กรุณากรอกชื่อย่อ (ภาษาอังกฤษ)',
            'url.required' => 'กรุณากรอก URL',
            'adminGroup.*.exists' => 'ผู้ใช้ที่เลือกไม่มีอยู่ในระบบ',
            'superAdminGroup.*.exists' => 'ผู้ใช้ที่เลือกไม่มีอยู่ในระบบ'
        ];
    
        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Check for existing record with the same fullname, en_name, or url but different id
        $existingSystem = System::where(function ($query) use ($request) {
            $query->where('fullname', $request->fullname)
                  ->orWhere('en_name', $request->en_name)
                  ->orWhere('url', $request->url);
        })->where('id', '<>', $id)->first();
    
        if ($existingSystem) {
            return redirect()->back()
                ->withErrors(['duplicate' => 'ระบบนี้มีอยู่แล้วในฐานข้อมูล'])
                ->withInput();
        }
    
        // Update the existing system
        $system->update([
            'fullname' => $request->fullname,
            'en_name' => $request->en_name,
            'url' => $request->url,
            'status' => $request->status ? 1 : 0,
        ]);
    
        // Sync administrators
        $adminGroup = $request->input('adminGroup', []);
        $superAdminGroup = $request->input('superAdminGroup', []);
    
        // Detach all current admins and super admins
        $system->administrators()->detach();
    
        // Attach new admins
        if (!empty($adminGroup)) {
            foreach ($adminGroup as $adminId) {
                $system->administrators()->attach($adminId, ['role' => 'admin']);
            }
        }
    
        // Attach new super admins
        if (!empty($superAdminGroup)) {
            foreach ($superAdminGroup as $superAdminId) {
                $system->administrators()->attach($superAdminId, ['role' => 'super_admin']);
            }
        }
    
        return redirect()->route('portal.allSystem')->with('success', 'System updated successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
