<?php

namespace App\Http\Controllers;

use App\Models\FormInput;
use App\Models\Menu;
use App\Models\Test;
use App\Services\MenuService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Expr\Cast\String_;
use Validator;

class MenuController extends Controller
{
    //
    private static $icon = [
        'typcn typcn-chart-pie-outline' => 'Chart Pie Outline',
        'typcn typcn-chart-pie' => 'Chart Pie',
        'typcn typcn-chevron-left-outline' => 'Chevron Left Outline',
        'typcn typcn-chevron-left' => 'Chevron Left',
        'typcn typcn-chevron-right-outline' => 'Chevron Right Outline',
        'typcn typcn-chevron-right' => 'Chevron Right',
        'typcn typcn-clipboard' => 'Clipboard',
        'typcn typcn-cloud-storage' => 'Cloud Storage',
        'typcn typcn-cloud-storage-outline' => 'Cloud Storage Outline',
        'typcn typcn-cog-outline' => 'Cog Outline',
        'typcn typcn-cog' => 'Cog',
        'typcn typcn-compass' => 'Compass',
        'typcn typcn-contacts' => 'Contacts',
        'typcn typcn-credit-card' => 'Credit Card',
        'typcn typcn-css3' => 'CSS3',
        'typcn typcn-database' => 'Database',
        'typcn typcn-delete-outline' => 'Delete Outline',
        'typcn typcn-delete' => 'Delete',
        'typcn typcn-device-desktop' => 'Desktop Device',
        'typcn typcn-device-laptop' => 'Laptop Device',
        'typcn typcn-device-phone' => 'Phone Device',
        'typcn typcn-device-tablet' => 'Tablet Device',
        'typcn typcn-directions' => 'Directions',
        'typcn typcn-divide-outline' => 'Divide Outline',
        'typcn typcn-divide' => 'Divide',
        'typcn typcn-document-add' => 'Document Add',
        'typcn typcn-document-delete' => 'Document Delete',
        'typcn typcn-document-text' => 'Document Text',
        'typcn typcn-document' => 'Document',
        'typcn typcn-download-outline' => 'Download Outline',
        'typcn typcn-download' => 'Download',
        'typcn typcn-dropbox' => 'Dropbox',
        'typcn typcn-edit' => 'Edit',
        'typcn typcn-eject-outline' => 'Eject Outline',
        'typcn typcn-eject' => 'Eject',
        'typcn typcn-equals-outline' => 'Equals Outline',
        'typcn typcn-equals' => 'Equals',
        'typcn typcn-export-outline' => 'Export Outline',
        'typcn typcn-export' => 'Export',
        'typcn typcn-eye-outline' => 'Eye Outline',
        'typcn typcn-eye' => 'Eye',
        'typcn typcn-feather' => 'Feather',
        'typcn typcn-film' => 'Film',
        'typcn typcn-filter' => 'Filter',
        'typcn typcn-flag-outline' => 'Flag Outline',
        'typcn typcn-flag' => 'Flag',
        'typcn typcn-flash-outline' => 'Flash Outline',
        'typcn typcn-flash' => 'Flash',
        'typcn typcn-flow-children' => 'Flow Children',
        'typcn typcn-flow-merge' => 'Flow Merge',
        'typcn typcn-flow-parallel' => 'Flow Parallel',
        'typcn typcn-flow-switch' => 'Flow Switch',
        'typcn typcn-folder-add' => 'Folder Add',
        'typcn typcn-folder-delete' => 'Folder Delete',
        'typcn typcn-folder-open' => 'Folder Open',
        'typcn typcn-folder' => 'Folder',
        'typcn typcn-gift' => 'Gift',
        'typcn typcn-globe-outline' => 'Globe Outline',
        'typcn typcn-globe' => 'Globe',
        'typcn typcn-group-outline' => 'Group Outline',
        'typcn typcn-group' => 'Group',
        'typcn typcn-headphones' => 'Headphones',
        'typcn typcn-heart-full-outline' => 'Heart Full Outline',
        'typcn typcn-heart-half-outline' => 'Heart Half Outline',
        'typcn typcn-heart-outline' => 'Heart Outline',
        'typcn typcn-heart' => 'Heart',
        'typcn typcn-home-outline' => 'Home Outline',
        'typcn typcn-home' => 'Home',
        'typcn typcn-html5' => 'HTML5',
        'typcn typcn-image-outline' => 'Image Outline',
        'typcn typcn-image' => 'Image',
        'typcn typcn-infinity-outline' => 'Infinity Outline',
        'typcn typcn-info-large-outline' => 'Info Large Outline',
        'typcn typcn-info-large' => 'Info Large',
        'typcn typcn-info-outline' => 'Info Outline',
        'typcn typcn-info' => 'Info',
        'typcn typcn-input-checked-outline' => 'Input Checked Outline',
        'typcn typcn-input-checked' => 'Input Checked',
        'typcn typcn-key-outline' => 'Key Outline',
        'typcn typcn-key' => 'Key',
        'typcn typcn-keyboard' => 'Keyboard',
        'typcn typcn-leaf' => 'Leaf',
        'typcn typcn-lightbulb' => 'Lightbulb',
        'typcn typcn-link-outline' => 'Link Outline',
        'typcn typcn-link' => 'Link',
        'typcn typcn-location-arrow-outline' => 'Location Arrow Outline',
        'typcn typcn-location-arrow' => 'Location Arrow',
        'typcn typcn-location-outline' => 'Location Outline',
        'typcn typcn-location' => 'Location',
        'typcn typcn-lock-closed-outline' => 'Lock Closed Outline',
        'typcn typcn-lock-closed' => 'Lock Closed',
        'typcn typcn-lock-open-outline' => 'Lock Open Outline',
        'typcn typcn-lock-open' => 'Lock Open',
        'typcn typcn-mail' => 'Mail',
        'typcn typcn-map' => 'Map',
        'typcn typcn-media-eject-outline' => 'Media Eject Outline',
        'typcn typcn-media-eject' => 'Media Eject',
        'typcn typcn-media-fast-forward-outline' => 'Media Fast Forward Outline',
        'typcn typcn-media-fast-forward' => 'Media Fast Forward',
        'typcn typcn-media-pause-outline' => 'Media Pause Outline',
        'typcn typcn-media-pause' => 'Media Pause',
        'typcn typcn-media-play-outline' => 'Media Play Outline',
        'typcn typcn-media-play-reverse-outline' => 'Media Play Reverse Outline',
        'typcn typcn-media-play-reverse' => 'Media Play Reverse',
        'typcn typcn-media-play' => 'Media Play',
        'typcn typcn-media-record-outline' => 'Media Record Outline',
        'typcn typcn-media-record' => 'Media Record',
        'typcn typcn-media-rewind-outline' => 'Media Rewind Outline',
        'typcn typcn-media-rewind' => 'Media Rewind',
        'typcn typcn-media-stop-outline' => 'Media Stop Outline',
        'typcn typcn-media-stop' => 'Media Stop',
        'typcn typcn-message-typing' => 'Message Typing',
        'typcn typcn-message' => 'Message',
        'typcn typcn-messages' => 'Messages',
        'typcn typcn-microphone-outline' => 'Microphone Outline',
        'typcn typcn-microphone' => 'Microphone',
        'typcn typcn-minus-outline' => 'Minus Outline',
        'typcn typcn-minus' => 'Minus',
        'typcn typcn-mortar-board' => 'Mortar Board',
        'typcn typcn-news' => 'News',
        'typcn typcn-notes-outline' => 'Notes Outline',
        'typcn typcn-notes' => 'Notes',
        'typcn typcn-pen' => 'Pen',
        'typcn typcn-pencil' => 'Pencil',
        'typcn typcn-phone-outline' => 'Phone Outline',
        'typcn typcn-phone' => 'Phone',
        'typcn typcn-pi-outline' => 'Pi Outline',
        'typcn typcn-pi' => 'Pi',
        'typcn typcn-pin-outline' => 'Pin Outline',
        'typcn typcn-pin' => 'Pin',
        'typcn typcn-pipette' => 'Pipette',
        'typcn typcn-plane-outline' => 'Plane Outline',
        'typcn typcn-plane' => 'Plane',
        'typcn typcn-plug' => 'Plug',
        'typcn typcn-plus-outline' => 'Plus Outline',
        'typcn typcn-plus' => 'Plus',
        'typcn typcn-point-of-interest-outline' => 'Point of Interest Outline',
        'typcn typcn-point-of-interest' => 'Point of Interest',
        'typcn typcn-power-outline' => 'Power Outline',
        'typcn typcn-power' => 'Power',
        'typcn typcn-printer' => 'Printer',
        'typcn typcn-puzzle-outline' => 'Puzzle Outline',
        'typcn typcn-puzzle' => 'Puzzle',
        'typcn typcn-radar-outline' => 'Radar Outline',
        'typcn typcn-radar' => 'Radar',
        'typcn typcn-refresh-outline' => 'Refresh Outline',
        'typcn typcn-refresh' => 'Refresh',
        'typcn typcn-rss-outline' => 'RSS Outline',
        'typcn typcn-rss' => 'RSS',
        'typcn typcn-scissors-outline' => 'Scissors Outline',
        'typcn typcn-scissors' => 'Scissors',
        'typcn typcn-shopping-bag' => 'Shopping Bag',
        'typcn typcn-shopping-cart' => 'Shopping Cart',
        'typcn typcn-social-at-circular' => 'Social At Circular',
        'typcn typcn-social-dribbble-circular' => 'Social Dribbble Circular',
        'typcn typcn-social-dribbble' => 'Social Dribbble',
        'typcn typcn-social-facebook-circular' => 'Social Facebook Circular',
        'typcn typcn-social-facebook' => 'Social Facebook',
        'typcn typcn-social-flickr-circular' => 'Social Flickr Circular',
        'typcn typcn-social-flickr' => 'Social Flickr',
        'typcn typcn-social-github-circular' => 'Social GitHub Circular',
        'typcn typcn-social-github' => 'Social GitHub',
        'typcn typcn-social-google-plus-circular' => 'Social Google Plus Circular',
        'typcn typcn-social-google-plus' => 'Social Google Plus',
        'typcn typcn-social-instagram-circular' => 'Social Instagram Circular',
        'typcn typcn-social-instagram' => 'Social Instagram',
        'typcn typcn-social-last-fm-circular' => 'Social Last FM Circular',
        'typcn typcn-social-last-fm' => 'Social Last FM',
        'typcn typcn-social-linkedin-circular' => 'Social LinkedIn Circular',
        'typcn typcn-social-linkedin' => 'Social LinkedIn',
        'typcn typcn-social-pinterest-circular' => 'Social Pinterest Circular',
        'typcn typcn-social-pinterest' => 'Social Pinterest',
        'typcn typcn-social-skype-outline' => 'Social Skype Outline',
        'typcn typcn-social-skype' => 'Social Skype',
        'typcn typcn-social-tumbler-circular' => 'Social Tumbler Circular',
        'typcn typcn-social-tumbler' => 'Social Tumbler',
        'typcn typcn-social-twitter-circular' => 'Social Twitter Circular',
        'typcn typcn-social-twitter' => 'Social Twitter',
        'typcn typcn-social-vimeo-circular' => 'Social Vimeo Circular',
        'typcn typcn-social-vimeo' => 'Social Vimeo',
        'typcn typcn-social-youtube-circular' => 'Social YouTube Circular',
        'typcn typcn-social-youtube' => 'Social YouTube',
        'typcn typcn-sort-alphabetically-outline' => 'Sort Alphabetically Outline',
        'typcn typcn-sort-alphabetically' => 'Sort Alphabetically',
        'typcn typcn-sort-numerically-outline' => 'Sort Numerically Outline',
        'typcn typcn-sort-numerically' => 'Sort Numerically',
        'typcn typcn-spanner-outline' => 'Spanner Outline',
        'typcn typcn-spanner' => 'Spanner',
        'typcn typcn-spiral' => 'Spiral',
        'typcn typcn-star-full-outline' => 'Star Full Outline',
        'typcn typcn-star-half-outline' => 'Star Half Outline',
        'typcn typcn-star-half' => 'Star Half',
        'typcn typcn-star-outline' => 'Star Outline',
        'typcn typcn-star' => 'Star',
        'typcn typcn-starburst-outline' => 'Starburst Outline',
        'typcn typcn-starburst' => 'Starburst',
        'typcn typcn-stopwatch' => 'Stopwatch',
        'typcn typcn-support' => 'Support',
        'typcn typcn-tabs-outline' => 'Tabs Outline',
    ];

    public function index()
    {
        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();
        $menus = Menu::with('children.children')->whereNull('parent_id')->get();
        return view('admin.menu.all_menu', compact('menus', 'menuItems'));
    }

    public function AddMenu()
    {
        // $menu = Menu::all();

        // menuTab
        // $menuItems = Menu::where('status_menu', 1)->get();
        $menuItems = MenuService::getMenuItems();
        $menus = Menu::with('children.children')->whereNull('parent_id')->get();
        $icon = self::$icon;
        return view('admin.menu.add_menu', compact('menus', 'menuItems', 'icon'));
    }

    public function StoreMenu(Request $request)
    {
        // Validate incoming requests
        $request->validate([
            'menu_name' => 'required',
            'menu_icon' => 'required',
            'secondary_menu.*.name' => 'nullable',
            'secondary_menu.*.url' => 'nullable',
            'secondary_menu.*.sub_menu.*.name' => 'nullable',
            'secondary_menu.*.sub_menu.*.url' => 'nullable',
        ]);

        // Create or retrieve the main menu
        $main = Menu::firstOrCreate(
            [
                'th_name' => $request->menu_name,
            ],
            [
                'th_name' => $request->menu_name,
                'name' => 'main_' . time(),
                'icon' => $request->menu_icon,
                'status_menu' => '1',
                'route' => '#'
            ]
        );

        // Handle secondary menus and their sub-menus
        if ($request->has('secondary_menu')) {
            foreach ($request->secondary_menu as $index_seccondary => $secondaryMenu) {
                if (!empty($secondaryMenu['name'])) {
                    $secondary = Menu::firstOrCreate(
                        [
                            'th_name' => $secondaryMenu['name'],
                            'parent_id' => $main->id,
                        ],
                        [
                            'th_name' => $secondaryMenu['name'],
                            'name' => 'secondary_' . time() . '_' . $index_seccondary,
                            'icon' => null,
                            'status_menu' => '1',
                            'route' => $secondaryMenu['url'],
                            'parent_id' => $main->id
                        ]
                    );

                    // Handle sub-menus for each secondary menu
                    if (isset($secondaryMenu['sub_menu'])) {
                        foreach ($secondaryMenu['sub_menu'] as $index_sub => $subMenu) {
                            if (!empty($subMenu['name'])) {
                                Menu::firstOrCreate(
                                    [
                                        'th_name' => $subMenu['name'],
                                        'parent_id' => $secondary->id,
                                    ],
                                    [
                                        'th_name' => $subMenu['name'],
                                        'name' => 'sub_' . time() . '_' . $index_sub,
                                        'icon' => null,
                                        'status_menu' => '1',
                                        'route' => $subMenu['url'],
                                        'parent_id' => $secondary->id
                                    ]
                                );
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('admin.all.menu')->with('success', 'Menu created successfully');
    }

    public function EditMenu($id)
    {
        //
        $menuItems = MenuService::getMenuItems();
        $data = Menu::findOrFail($id);
        $icon = self::$icon;

        return view('admin.menu.edit_menu', compact('menuItems', 'data', 'icon'));
    }

    public function UpdateMenu(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);
        // Define validation rules
        $rules = [
            'th_name' => 'required|max:200|unique:menus,th_name,' . $id,
        ];

        // Custom error messages
        $messages = [
            'th_name.required' => 'กรุณากรอกชื่อเมนูหลัก',
            'th_name.unique' => 'ชื่อ "' . $request->th_name . '" มีอยู่แล้วในระบบ',
        ];

        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $menu->update([
            'th_name' => $request->th_name,
            'icon' => $request->menu_icon,
            'status_menu' => $request->status_menu ? '1' : '0'
        ]);

        $notification = array(
            'message' => 'Menu Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.menu')->with($notification);
    }

    public function AddChildMenu($id)
    {
        //
        $menuItems = MenuService::getMenuItems();
        $data = Menu::findOrFail($id);
        $childMenus = Menu::where('parent_id', $id)->get();
        $icon = self::$icon;

        return view('admin.menu.add_child_menu', compact('menuItems', 'data', 'icon', 'childMenus'));
    }

    public function StoreChildMenu(Request $request, string $id)
    {
        // Validate incoming requests
        $request->validate([
            'secondary_menu.*.name' => 'nullable',
            'secondary_menu.*.url' => 'nullable',
            'secondary_menu.*.sub_menu.*.name' => 'nullable',
            'secondary_menu.*.sub_menu.*.url' => 'nullable',
        ]);

        // Create or retrieve the main menu
        $main = Menu::findOrFail($id);

        // Handle secondary menus and their sub-menus
        if ($request->has('secondary_menu')) {
            foreach ($request->secondary_menu as $index_seccondary => $secondaryMenu) {
                if (!empty($secondaryMenu['name'])) {
                    $secondary = Menu::firstOrCreate(
                        [
                            'th_name' => $secondaryMenu['name'],
                            'parent_id' => $main->id,
                        ],
                        [
                            'th_name' => $secondaryMenu['name'],
                            'name' => 'secondary_' . time() . '_' . $index_seccondary,
                            'icon' => null,
                            'status_menu' => '1',
                            'route' => $secondaryMenu['url'],
                            'parent_id' => $main->id
                        ]
                    );

                    // Handle sub-menus for each secondary menu
                    if (isset($secondaryMenu['sub_menu'])) {
                        foreach ($secondaryMenu['sub_menu'] as $index_sub => $subMenu) {
                            if (!empty($subMenu['name'])) {
                                Menu::firstOrCreate(
                                    [
                                        'th_name' => $subMenu['name'],
                                        'parent_id' => $secondary->id,
                                    ],
                                    [
                                        'th_name' => $subMenu['name'],
                                        'name' => 'sub_' . time() . '_' . $index_sub,
                                        'icon' => null,
                                        'status_menu' => '1',
                                        'route' => $subMenu['url'],
                                        'parent_id' => $secondary->id
                                    ]
                                );
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('admin.all.menu')->with('success', 'Menu created successfully');
    }

    // public function EditChildMenu($id)
    // {
    //     //
    //     $menuItems = MenuService::getMenuItems();
    //     $currentMenu = Menu::findOrFail($id);
    //     $mainMenus = Menu::whereNull('parent_id')->with('children')->get();

    //     // Determine the type of the current menu
    //     $currentMenuIsMain = $currentMenu->parent_id === null;
    //     $currentMenuIsSecondary = !$currentMenuIsMain && $mainMenus->contains('id', $currentMenu->parent_id);
    //     $currentMenuIsSub = !$currentMenuIsMain && !$currentMenuIsSecondary;

    //     // Filter menus based on the type of the current menu
    //     if ($currentMenuIsSecondary) {
    //         // If the current menu is secondary, we only need the main menus
    //         $filteredMenus = $mainMenus;
    //         $currentMenu_level = 2;
    //     } elseif ($currentMenuIsSub) {
    //         // If the current menu is sub, we need the secondary menus
    //         $filteredMenus = $mainMenus->flatMap->children;
    //         $currentMenu_level = 3;
    //     } else {
    //         $filteredMenus = collect(); // Empty collection if it's a main menu or unknown type
    //     }

    //     return view('admin.menu.edit_child_menu', compact('menuItems', 'mainMenus', 'currentMenu', 'filteredMenus', 'currentMenu_level'));
    // }
    public function EditChildMenu($id)
    {
        $menuItems = MenuService::getMenuItems();
        $currentMenu = Menu::findOrFail($id);

        // Fetch all menus with their children (secondary and sub-menus)
        $allMenus = Menu::with('children')->get();

        // Fetch all main menus
        $mainMenus = $allMenus->whereNull('parent_id');

        // Determine the type of the current menu
        $currentMenuIsMain = $currentMenu->parent_id === null;
        $currentMenuIsSecondary = !$currentMenuIsMain && $mainMenus->contains('id', $currentMenu->parent_id);
        $currentMenuIsSub = !$currentMenuIsMain && !$currentMenuIsSecondary;

        // Filter menus based on the type of the current menu
        $filteredMenus = collect();
        if ($currentMenuIsSecondary) {
            // If the current menu is secondary, we only need the main menus
            $filteredMenus = $mainMenus;
            $currentMenu_level = 2;
        } elseif ($currentMenuIsSub) {
            // If the current menu is sub, we need the secondary menus
            $filteredMenus = $allMenus->whereIn('parent_id', $mainMenus->pluck('id'));
            $currentMenu_level = 3;
        } else {
            // If the current menu is main, filteredMenus remains empty
            $currentMenu_level = 1;
        }

        return view('admin.menu.edit_child_menu', compact('menuItems', 'mainMenus', 'currentMenu', 'filteredMenus', 'currentMenu_level'));
    }


    public function UpdateChildMenu(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);
        // Define validation rules
        $rules = [
            'th_name' => 'required|max:200|',
            'urlText' => 'required|max:200|',
        ];

        // Custom error messages
        $messages = [
            'th_name.required' => 'กรุณากรอกชื่อเมนู',
            'urlText.required' => 'กรุณาระบุ route/URL ของเมนู'
        ];

        // Validate input
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $menu->update([
            'th_name' => $request->th_name,
            'route' => $request->urlText,
            'status_menu' => $request->new_parent_id ? '1' : ($request->status_menu ? '1' : '0'),
            'parent_id' => $request->new_parent_id ? $request->new_parent_id : $menu->parent_id
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
