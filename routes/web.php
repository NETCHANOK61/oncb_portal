<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\Usercontroller;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserRequestcontroller;
use App\Models\Province;
use App\Services\MenuService;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/school', [SchoolController::class, 'index'])->name('school.index');
Route::post('/school/create', [SchoolController::class, 'create'])->name('school.create');
Route::put('/school/{id}/update', [SchoolController::class, 'update'])->name('school.update');
Route::delete('/school/{id}/delete', [SchoolController::class, 'destroy'])->name('school.delete');
Route::get('/school/{id}', [SchoolController::class, 'getById'])->name('school.getById');
Route::get('/testing', [SchoolController::class, 'testing'])->name('school.testing');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Default Laravel Breeze login route
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/', [IndexController::class, 'login'])->name('login_screen');

Route::get('/login_with_thaiid', [IndexController::class, 'login_with_thaiid'])->name('login_with_thaiid');
// Route::post('login', [AuthenticateSession::class, 'store'])->name('login.post');

// Route::get('/login/thai_id_callback', [IndexController::class, 'handleThaiIdCallback'])->name('handleThaiIdCallback');

Route::get('/check_callback', [IndexController::class, 'check_callback'])->name('check_callback');

Route::post('/login_to_nispa', [IndexController::class, 'login_to_nispa'])->name('loginToNispa');
Route::post('/redirect_to_nispa', [IndexController::class, 'redirect_to_nispa'])->name('redirectToNispa');

// Route to initiate challenge
Route::post('/initiate-challenge', [IndexController::class, 'initiateChallenge']);
Route::post('/receive-data', [IndexController::class, 'receiveData']);

Route::get('/ldap_login', [IndexController::class, 'ldapLogin'])->name('ldapLogin');

Route::get('/get-provinces/{region}', [RegionController::class, 'getProvinces'])->name('getProvinces');
Route::get('/get-amphurs/{province}', [RegionController::class, 'getAmpher'])->name('getAmpher');
Route::get('/get-school', [RegionController::class, 'getSchool'])->name('getSchool');
Route::post('/get-school', [RegionController::class, 'getSchool']);

Route::get('/get-edu_area/{province}', [RegionController::class, 'getEduArea'])->name('getEduArea');
Route::get('/get-school_with_edu/{province}/{edu}', [RegionController::class, 'getSchoolEdu'])->name('getSchoolEdu');

Route::post('request-user', [RegisteredUserController::class, 'storeRequested'])->name('register.request');
Route::get('request-submit/{id}', [RegisteredUserController::class, 'requestedSubmit'])->name('register.submit');
Route::post('/check-email', [RegisteredUserController::class, 'checkEmail'])->name('check.email');
Route::post('/check-card_id', [RegisteredUserController::class, 'checkCard_id'])->name('check.card_id');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [IndexController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['auth'])->name('admin.')->prefix('admin')->group(function () {
    $nispa_url = 'http://192.168.200.101';

    Route::post('/check-username', [RegisteredUserController::class, 'checkUsername'])->name('check.username');
    Route::get('/index', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class)->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/update_roles/{id}', [RoleController::class, 'update'])->name('update.roles')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permission')->middleware(['auth', 'role:admin|superAdmin']);

    Route::resource('/permissions', PermissionController::class)->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/update_permissions/{id}', [PermissionController::class, 'update'])->name('update.permissions')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles')->middleware(['auth', 'role:admin|superAdmin']);

    Route::get('/users', [Usercontroller::class, 'index'])->name('users.index')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/add_user', [Usercontroller::class, 'addUser'])->name('users.create')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/store_user', [Usercontroller::class, 'storeUser'])->name('users.store')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/users/{user}', [Usercontroller::class, 'show'])->name('users.show')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/users/{user}/edit', [Usercontroller::class, 'editUser'])->name('users.edit')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/users/{user}/update', [Usercontroller::class, 'updateUser'])->name('users.update')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/users/{user}/roles', [Usercontroller::class, 'assignRole'])->name('users.roles')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/users/{user}/permissions', [Usercontroller::class, 'givePermission'])->name('users.permission')->middleware(['auth', 'role:admin|superAdmin']);

    Route::get('/users_request', [UserRequestcontroller::class, 'index'])->name('users_request.index')->middleware(['auth', 'role:admin|superAdmin']);

    Route::post('/users_approve/{id}', [UserRequestcontroller::class, 'approve'])->name('users_request.approve')->middleware(['auth', 'role:admin|superAdmin']);

    Route::get('/all_column', [MenuController::class, 'allColumn'])->name('allColumn')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/add_column', [MenuController::class, 'addColumn'])->name('addColumn')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/store_column', [MenuController::class, 'storeColumn'])->name('storeColumn')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/delete_column/{id}', [MenuController::class, 'deleteColumn'])->name('deleteColumn')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/return_column/{id}', [MenuController::class, 'returnColumn'])->name('returnColumn')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/show_form', [MenuController::class, 'showForm'])->name('showForm')->middleware(['auth', 'role:admin|superAdmin']);
    Route::post('/store_form', [MenuController::class, 'storeForm'])->name('storeForm')->middleware(['auth', 'role:admin|superAdmin']);
    Route::get('/all_data', [MenuController::class, 'allData'])->name('allData')->middleware(['auth', 'role:admin|superAdmin']);

    // Route::get('/preview-pdf/{path}', function ($path) {
    //     $pdf = PDF::loadView('pdf.preview', ['path' => $path]);
    //     return $pdf->stream('preview.pdf');
    // });

    // Property Type All Route
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all_type', 'AllType')->name('all.type')->middleware(['auth', 'role:admin|superAdmin']);
        Route::get('/add_type', 'AddType')->name('add.type')->middleware(['auth', 'role:admin|superAdmin']);
        Route::post('/store_type', 'StoreType')->name('store.type')->middleware(['auth', 'role:admin|superAdmin']);
        Route::get('/edit_type/{id}', 'EditType')->name('edit.type')->middleware(['auth', 'role:admin|superAdmin']);
        Route::post('/update_type/{id}', 'UpdateType')->name('update.type')->middleware(['auth', 'role:admin|superAdmin']);
        Route::get('/delete_type/{id}', 'DeleteType')->name('delete.type')->middleware(['auth', 'role:admin|superAdmin']);
        Route::get('/return_type/{id}', 'returnType')->name('return.type')->middleware(['auth', 'role:admin|superAdmin']);
        Route::get('/show_type', 'ShowType')->name('show.type');
    });

    // Menu All Route
    Route::controller(MenuController::class)->group(function () {
        Route::get('/all_menu', 'index')->name('all.menu');
        Route::get('/add_menu', 'AddMenu')->name('add.menu');
        Route::post('/store_menu', 'StoreMenu')->name('store.menu');
        Route::get('/edit_menu/{id}', 'EditMenu')->name('edit.menu');
        Route::post('/update_menu/{id}', 'UpdateMenu')->name('update.menu');
    });

    // เป้าหมายโรงเรียน
    Route::get('/input_school_target', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_school_target', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/school_police_target.php');
    })->name('input.school_target');

    // ตำรวจประสานโรงเรียน
    Route::get('/input_police', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_police', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/School_police.php');
    })->name('input.police');

    // เยาวชนนอกสถานศึกษา
    Route::get('/input_youth', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_youth', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/plan3_gang.php');
    })->name('input.youth');

    // การอบรมเครือข่ายหมู่บ้าน/ชุมชนร่วมใจต้านภัยยาเสพติด
    Route::get('/input_village', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_village', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/plan3_YOS.php');
    })->name('input.village');

    // สถานประกอบกิจการ
    Route::get('/input_enterprise', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_enterprise', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/plan3_company.php');
    })->name('input.enterprise');

    // การมีส่วนร่วมภาคประชาชน
    Route::get('/input_people', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_people', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/mc.php');
    })->name('input.people');

    // ศาสนสถาน
    Route::get('/input_religious', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_religious', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/temple.php');
    })->name('input.religious');

    // พื้นที่เสี่ยง
    Route::get('/input_riskArea', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_riskArea', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/plan3_risk.php');
    })->name('input.riskArea');

    // ความร่วมมือระหว่างประเทศ
    Route::get('/input_coperation', function ()  use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_coperation', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/result/plan5_1.php');
    })->name('input.coperation');

    // การบันทึกข้อมูลของสถานศึกษา/ศูนย์พัฒนาเด็กเล็ก
    Route::get('/input_school', [SchoolController::class, 'inputSchool'])->name('input.school');

    Route::get('/edit_school/{ID}', [SchoolController::class, 'editSchool'])->name('edit.school');

    Route::get('/progress_school/{ID}', [SchoolController::class, 'progressSchool'])->name('progress.school');

    Route::get('/main', [SchoolController::class, 'index'])->name('school_main');
    Route::post('/toggle-active', [SchoolController::class, 'toggleActive'])->name('school_toggleActive');

    // การบันทึกข้อมูลบุคลากร
    Route::get('/input_staff_info', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.input_staff_info', compact('menuItems'));
    })->name('input.staff_info');

    // กรณีต่อสัญญาใหม่
    Route::get('/input_staff_continue', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.input_staff_info', compact('menuItems'));
    })->name('input.staff_continue');

    // รายงานสรุปผลการปฏิบัติงาน
    Route::get('/input_staff_sum', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.input_staff_sum', compact('menuItems'));
    })->name('input.staff_sum');

    // รายงานสรุปจำนวน
    Route::get('/input_staff_amount', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.input_staff_amount', compact('menuItems'));
    })->name('input.staff_amount');

    // รายงานรายชื่อลูกจ้าง
    Route::get('/input_staff_namelist', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.input_staff_namelist', compact('menuItems'));
    })->name('input.staff_namelist');

    // รายงานรายละเอียดผลการปฏิบัติงาน
    Route::get('/input_staff_sum_details', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.input_staff_sum_details', compact('menuItems'));
    })->name('input.staff_sum_details');

    // รายงานสถิตินำเข้าผลการปฏิบัติงาน
    Route::get('/input_staff_sum_stat', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.input_staff_sum_stat', compact('menuItems'));
    })->name('input.staff_sum_stat');

    //
    // *****
    //
    // สถานะการนำเข้าข้อมูล รายเดือน
    Route::get('/input_status_month', function () use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_status_month', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/status/status_bymth.php');
    })->name('status.month');

    // สถานะการนำเข้าข้อมูล รายวัน
    Route::get('/input_status_day', function () use ($nispa_url) {
        // $menuItems = MenuService::getMenuItems();
        // return view('admin.page_menu.input_status_day', compact('menuItems'));
        return Redirect::to($nispa_url . '/strategy67/status/status_byday.php');
    })->name('status.day');

    //
    // *****
    //
    // ผลการดำเนิงานรายวัน
    Route::get('/report_day', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.report_day', compact('menuItems'));
    })->name('report.day');

    // ผลการดำเนิงานรายเดือน
    Route::get('/report_month', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.report_month', compact('menuItems'));
    })->name('report.month');

    // ผลแบบสำรวจสถาพปัญหายาเสพติดในระดับหมู่บ้าน/ชุมชน
    Route::get('/report_village', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.report_village', compact('menuItems'));
    })->name('report.village');

    // ผลการดำเนินงานในสถานศึกษา
    Route::get('/report_school', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.report_school', compact('menuItems'));
    })->name('report.school');

    //
    // *****
    //
    // ระบบการเฝ้าระวังการแพร่ระบาดยาเสพติดจังหวัด
    Route::get('/other_nispa_province', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.other_nispa_province', compact('menuItems'));
    })->name('other.nispa_province');

    // ระบบทะเบียนกำลังพล
    Route::get('/other_nispa_power', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.other_nispa_power', compact('menuItems'));
    })->name('other.nispa_power');

    // ติดต่อเรา
    Route::get('/other_nispa_contact', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.other_nispa_contact', compact('menuItems'));
    })->name('other.nispa_contact');

    // ช่วยเหลือ
    Route::get('/other_nispa_help', function () {
        $menuItems = MenuService::getMenuItems();
        return view('admin.page_menu.other_nispa_help', compact('menuItems'));
    })->name('other.nispa_help');
});

require __DIR__ . '/auth.php';
