<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\System;
use App\Models\Test;
use App\Services\MenuService;
use Illuminate\Http\Request;
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
            'url' => $request->url
        ]);

        Schema::table('users_portal', function ($table) use ($en_name) {
            $table->enum($en_name, [1, 0]);
        });
        // return $this->allColumn();
        return redirect()->route('portal.allSystem');
    }

    public function deleteSystem(String $id)
    {
        $form = System::findOrFail($id);
        $form->update([
            'status' => '0'
        ]);

        // return $this->allColumn();
        return redirect()->route('portal.allSystem');
    }

    public function returnSystem(String $id)
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
