<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\System;
use App\Models\Test;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Schema;

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
        // $columns = Schema::getColumnListing((new Test())->getTable());

        return view('admin.portal_system.add_system', compact('menu', 'menuItems', 'data'));
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
        $data = System::where('status', '1');
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
    public function store(Request $request)
    {
        $en_name = $request->en_name;
        //
        System::create([
            'fullname' => $request->fullname,
            'en_name' => $request->en_name,
            'status' => $request->status ? '1' : '0',
            'url' => $request->url,
            'API_KEY' => Str::random(43)
        ]);

        Schema::table('users', function ($table) use ($en_name) {
            $table->integer($en_name)->default(0);
        });
        // return $this->allColumn();
        return redirect()->route('portal.allSystem');
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
