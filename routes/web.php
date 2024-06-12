<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\Usercontroller;
use App\Http\Controllers\Auth\RegisteredPortalUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\PortalSystemController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserRequestPortalcontroller;
use App\Models\Province;
use App\Services\MenuService;
use Illuminate\Session\Middleware\AuthenticateSession;
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

Route::post('/login_to_portal_management', [IndexController::class, 'login_to_portal_management'])->name('login_to_portal_management');
Route::get('/login_with_thaiid', [IndexController::class, 'login_with_thaiid'])->name('login_with_thaiid');
// Route::post('login', [AuthenticateSession::class, 'store'])->name('login.post');

// Route::get('/login/thai_id_callback', [IndexController::class, 'handleThaiIdCallback'])->name('handleThaiIdCallback');

Route::get('/check_callback', [IndexController::class, 'check_callback'])->name('check_callback');
// Route::post('/ldap_login', [IndexController::class, 'ldapLogin'])->name('ldap_login');
Route::get('/ldap_login', [IndexController::class, 'ldapLogin'])->name('ldapLogin');
Route::post('/submitlogin', [IndexController::class, 'submitlogin'])->name('submitlogin');
Route::get('/req_system/{system}/{user}', [IndexController::class, 'req_system'])->name('req_system');

Route::post('/authorization', [IndexController::class, 'submitLoginForm'])->name('submitLoginForm');
Route::get('/form', [IndexController::class, 'showForm'])->name('formView');

Route::get('/get-provinces/{region}', [RegionController::class, 'getProvinces'])->name('getProvinces');
Route::get('/get-amphurs/{province}', [RegionController::class, 'getAmpher'])->name('getAmpher');
Route::get('/get-school', [RegionController::class, 'getSchool'])->name('getSchool');
Route::post('/get-school', [RegionController::class, 'getSchool']);

Route::get('/get-edu_area/{province}', [RegionController::class, 'getEduArea'])->name('getEduArea');
Route::get('/get-school_with_edu/{province}/{edu}', [RegionController::class, 'getSchoolEdu'])->name('getSchoolEdu');

Route::post('request-user', [RegisteredPortalUserController::class, 'storeRequested'])->name('register.request');
Route::get('request-submit/{id}', [RegisteredPortalUserController::class, 'requestedSubmit'])->name('register.submit');
Route::post('/check-email', [RegisteredPortalUserController::class, 'checkEmail'])->name('check.email');
Route::post('/check-card_id', [RegisteredPortalUserController::class, 'checkCard_id'])->name('check.card_id');
Route::post('/check-user_id', [RegisteredPortalUserController::class, 'checkUser_id'])->name('check.user_id');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [IndexController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['auth'])->name('portal.')->prefix('portal')->group(function () {

    // Route::get('/index', [IndexController::class, 'index'])->name('index');

    Route::get('/all_system', [PortalSystemController::class, 'index'])->name('allSystem');
    Route::get('/add_system', [PortalSystemController::class, 'addSystem'])->name('addSystem');
    Route::post('/store_system', [PortalSystemController::class, 'store'])->name('storeSystem');
    Route::get('/delete_system/{id}', [PortalSystemController::class, 'deleteSystem'])->name('deleteSystem');
    Route::get('/return_system/{id}', [PortalSystemController::class, 'returnSystem'])->name('returnSystem');
    Route::get('/edit_system/{id}', [PortalSystemController::class, 'editSystem'])->name('editSystem');
    Route::get('/update_system/{id}', [PortalSystemController::class, 'updateSystem'])->name('updateSystem');

    Route::get('/all_user', [PortalSystemController::class, 'allUser'])->name('allUser');
    Route::get('/edit_user/{id}', [PortalSystemController::class, 'editUser'])->name('editUser');
    Route::post('/update_user/{id}', [PortalSystemController::class, 'updateUser'])->name('updateUser');

    Route::get('/request_user_portal', [UserRequestPortalcontroller::class, 'index'])->name('requestUserPortal');
    Route::post('/approve_user_portal/{id}', [UserRequestPortalcontroller::class, 'approve'])->name('approveUserPortal');
    Route::get('/reject_user_list', [UserRequestPortalcontroller::class, 'rejectList'])->name('rejectUserList');
    Route::post('/reject_user_portal/{id}', [UserRequestPortalcontroller::class, 'reject'])->name('rejectUserPortal');

    // Route::get('/add_system', [PortalSystemController::class, 'addSystem'])->name('addSystem')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::post('/store_system', [PortalSystemController::class, 'store'])->name('storeSystem')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::get('/delete_system/{id}', [PortalSystemController::class, 'deleteSystem'])->name('deleteSystem')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::get('/return_system/{id}', [PortalSystemController::class, 'returnSystem'])->name('returnSystem')->middleware(['auth', 'role:admin|superAdmin']);

    // Route::get('/all_column', [MenuController::class, 'allColumn'])->name('allColumn')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::get('/add_column', [MenuController::class, 'addColumn'])->name('addColumn')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::post('/store_column', [MenuController::class, 'storeColumn'])->name('storeColumn')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::get('/delete_column/{id}', [MenuController::class, 'deleteColumn'])->name('deleteColumn')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::get('/return_column/{id}', [MenuController::class, 'returnColumn'])->name('returnColumn')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::get('/show_form', [MenuController::class, 'showForm'])->name('showForm')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::post('/store_form', [MenuController::class, 'storeForm'])->name('storeForm')->middleware(['auth', 'role:admin|superAdmin']);
    // Route::get('/all_data', [MenuController::class, 'allData'])->name('allData')->middleware(['auth', 'role:admin|superAdmin']);

    // Property Type All Route
    // Route::controller(PropertyTypeController::class)->group(function () {
    //     Route::get('/all_type', 'AllType')->name('all.type')->middleware(['auth', 'role:admin|superAdmin']);
    //     Route::get('/add_type', 'AddType')->name('add.type')->middleware(['auth', 'role:admin|superAdmin']);
    //     Route::post('/store_type', 'StoreType')->name('store.type')->middleware(['auth', 'role:admin|superAdmin']);
    //     Route::get('/edit_type/{id}', 'EditType')->name('edit.type')->middleware(['auth', 'role:admin|superAdmin']);
    //     Route::post('/update_type/{id}', 'UpdateType')->name('update.type')->middleware(['auth', 'role:admin|superAdmin']);
    //     Route::get('/delete_type/{id}', 'DeleteType')->name('delete.type')->middleware(['auth', 'role:admin|superAdmin']);
    //     Route::get('/return_type/{id}', 'returnType')->name('return.type')->middleware(['auth', 'role:admin|superAdmin']);
    //     Route::get('/show_type', 'ShowType')->name('show.type');
    // });

    // Menu All Route
    // Route::controller(MenuController::class)->group(function () {
    //     Route::get('/all_menu', 'index')->name('all.menu');
    //     Route::get('/add_menu', 'AddMenu')->name('add.menu');
    //     Route::post('/store_menu', 'StoreMenu')->name('store.menu');
    //     Route::get('/edit_menu/{id}', 'EditMenu')->name('edit.menu');
    //     Route::post('/update_menu/{id}', 'UpdateMenu')->name('update.menu');
    // });
});

require __DIR__ . '/auth.php';
