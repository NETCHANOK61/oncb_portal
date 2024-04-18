<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\PropertyType;
use App\Services\MenuService;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //
    public function AllType()
    {

        $types = PropertyType::all();
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.type.all_type', compact('types', 'menuItems'));

    } // end method

    public function AddType()
    {

        // $types = PropertyType::all();
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.type.add_type', compact('menuItems'));

    } // end method

    public function StoreType(Request $request)
    {
        // Validation
        $validatedData = $request->validate(['type_name' => 'required|max:200', 'type_icon' => 'required']);

        PropertyType::create([
            'type_name' => $validatedData['type_name'],
            'type_icon' => $validatedData['type_icon'],
            'type' => $request->typeInput,
            'description' => $request->description
        ]);

        $notification = array(
            'message'=>'Notice Created Successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.all.type')->with($notification);

    } // end method

    public function EditType($id)
    {

        $data = PropertyType::findOrFail($id);
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.type.edit_type', compact('data', 'menuItems'));

    } // end method

    public function UpdateType(Request $request, String $id)
    {
        // Validation
        $validatedData = $request->validate(['type_name' => 'required|max:200', 'type_icon' => 'required']);

        PropertyType::findOrFail($id)->update([
            'type_name' => $validatedData['type_name'],
            'type_icon' => $validatedData['type_icon'],
            'type' => $request->typeInput,
            'description' => $request->description
        ]);

        $notification = array(
            'message'=>'Notice Updated Successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.all.type')->with($notification);

    } // end method

    public function DeleteType(String $id){
        PropertyType::findOrFail($id)->update([
            'status' => '0'
        ]);

        $notification = array(
            'message'=>'Notice Updated Successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.all.type')->with($notification);

    }

    public function returnType(String $id){
        PropertyType::findOrFail($id)->update([
            'status' => '1'
        ]);

        $notification = array(
            'message'=>'Notice Updated Successfully!',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.all.type')->with($notification);

    }

    public function ShowType()
    {

        // $data = PropertyType::all();
        $data = PropertyType::where('status', 1)->get();
        $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.type.show_type', compact('data', 'menuItems'));

    } // end method
}
