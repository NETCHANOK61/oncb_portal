<?php

namespace App\Http\Controllers;

use App\Models\FormInput;
use App\Models\Menu;
use App\Models\Test;
use App\Services\MenuService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Expr\Cast\String_;

class MenuController extends Controller
{
    //
    public function index()
    {
        $menu = Menu::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.menu.all_menu', compact('menu', 'menuItems'));
    }

    public function AddMenu()
    {
        $menu = Menu::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();

        return view('admin.menu.add_menu', compact('menu', 'menuItems'));
    }

    public function StoreMenu(Request $request)
    {
        // Validation
        $validatedData = $request->validate(['menu_name' => 'required|max:200', 'menu_icon' => 'required', 'secondary_menu' => 'max:200', 'sub_menu' => 'max:200']);

        Menu::create([
            'menu_name' => $validatedData['menu_name'],
            'menu_icon' => $validatedData['menu_icon'],
            'secondary_menu' => $validatedData['secondary_menu'],
            'sub_menu' => $validatedData['sub_menu'],
            'url_menu' => $request->url_menu
        ]);

        $notification = array(
            'message' => 'Menu Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.menu')->with($notification);
    }

    public function EditMenu($id)
    {
        //
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();
        $data = Menu::findOrFail($id);

        return view('admin.menu.edit_menu', compact('menu', 'menuItems', 'data'));
    }

    public function UpdateMenu(Request $request, string $id)
    {
        // Validation
        $validatedData = $request->validate(['menu_name' => 'required|max:200', 'menu_icon' => 'required', 'secondary_menu' => 'max:200', 'sub_menu' => 'max:200', 'url_menu' => 'max:200']);

        Menu::findOrFail($id)->update([
            'menu_name' => $validatedData['menu_name'],
            'menu_icon' => $validatedData['menu_icon'],
            'secondary_menu' => $validatedData['secondary_menu'],
            'sub_menu' => $validatedData['sub_menu'],
            'status_menu' => $request->status_menu ? '1' : '0',
            'url_menu' => $validatedData['url_menu']
        ]);

        $notification = array(
            'message' => 'Menu Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.menu')->with($notification);
    }

    public function addColumn()
    {
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();

        $columnTypes = [
            'string',
            'integer'
        ];

        $displayTypes = [
            ['th' => 'แบบถามตอบ ใช่/ไม่ใช่', 'en' => 'choosable'],
            ['th' => 'แบบกรอกข้อมูล', 'en' => 'fillable']
        ];

        return view('admin.form.add_column', compact('menu', 'menuItems', 'columnTypes', 'displayTypes'));
    }

    public function storeColumn(Request $request)
    {
        $columnName = $request->field_name;
        $dataType = $request->dataType;
        $size = $request->field_size;
        $tableName = $request->table_name;
        $comment = $request->comment;
        $displayType = $request->displayType;

        FormInput::create([
            'field_name' => $columnName,
            'label_name' => $request->label_name,
            'field_type' => $dataType,
            'field_size' => $size,
            'table_name' => $tableName,
            'comment' => $comment,
            'displayFormat' => $displayType
        ]);

        Schema::table('tbl_Pr_school_test', function ($table) use ($columnName, $dataType, $size, $comment) {
            $table->{$dataType}($columnName, $size)->nullable()->comment($comment);
        });

        // return $this->allColumn();
        return redirect()->route('admin.allColumn');
    }

    public function deleteColumn(string $id)
    {
        $form = FormInput::findOrFail($id);
        $form->update([
            'status' => '0'
        ]);

        // Schema::table('tbl_Pr_school_test', function ($table) use ($form) {
        //     $table->dropColumn($form->field_name);
        // });

        // return $this->allColumn();
        return redirect()->route('admin.allColumn');
    }

    public function returnColumn(string $id)
    {
        $form = FormInput::findOrFail($id);
        $form->update([
            'status' => '1'
        ]);

        // Schema::table('tbl_Pr_school_test', function ($table) use ($form) {
        //     // $table->text($form->field_name)->nullable();
        //     $table->{$form->field_type}($form->field_name, $form->field_size)->nullable()->comment($form->comment);
        // });

        // return $this->allColumn();
        return redirect()->route('admin.allColumn');
    }

    public function allColumn()
    {
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();
        $data = FormInput::all();

        return view('admin.form.all_column', compact('menu', 'menuItems', 'data'));
    }

    public function allData()
    {
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();
        $data = Test::all();
        $columns = Schema::getColumnListing((new Test())->getTable());

        return view('admin.form.all_data', compact('menu', 'menuItems', 'data', 'columns'));
    }

    public function showForm()
    {
        $menu = Menu::all();
        $menuItems = MenuService::getMenuItems();

        $columns = Schema::getColumnListing('test');
        $columnTypes = [];

        foreach ($columns as $column) {
            $columnTypes[$column] = Schema::getColumnType('test', $column);
        }

        $data = FormInput::whereIn('field_name', $columns)->get();

        $combinedData = [];

        foreach ($data as $item) {
            $rowData = [];
            foreach ($columns as $column) {
                if ($item->field_name == $column) {
                    $rowData[$column] = [
                        'label_name' => $item->label_name,
                        'data_type' => $columnTypes[$column],
                        'data' => $item->{$column}
                    ];
                }
            }
            $combinedData[] = $rowData;
        }

        return view('admin.form.preview_column', compact('menu', 'menuItems', 'combinedData'));
    }

    public function storeForm(Request $request)
    {
        $columns = Schema::getColumnListing('test');

        $data = [];

        // ฟีลด์ข้อมูลใหม่
        foreach ($columns as $column) {
            if ($request->has($column)) {
                $data[$column] = $request->input($column);
            }
        }

        // ฟีลด์ข้อมูลเดิม
        $data["data1"] = $request->input('input_name1');

        Test::create($data);

        return redirect()->route('admin.allData');
        // return $this->allColumn();
    }
}
