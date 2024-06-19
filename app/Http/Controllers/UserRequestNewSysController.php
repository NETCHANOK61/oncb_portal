<?php

namespace App\Http\Controllers;

use App\Models\AdminSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\System;
use App\Models\UserReqSys;
use App\Services\MenuService;
use Dotenv\Util\Str;

class UserRequestNewSysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $menuItems = MenuService::getMenuItems();

        // Retrieve managed systems for the authenticated user
        $managedSystems = AdminSystem::where('user_id', $user->id)->get();

        // Extract the system IDs from the managed systems
        $systemIds = $managedSystems->pluck('system_id');

        // Retrieve request_user records with related user and portal system details
        $request_user = UserReqSys::where('approved', '0')
            ->whereIn('portal_system_id', $systemIds)
            ->with(['user', 'portalSystem']) // Eager load the related user and portal system
            ->get();
        dd($request_user);

        return view('admin.portal_user.user_request_sys', compact('menuItems', 'request_user', 'managedSystems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function approve(string $id, string $sys_id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $system = System::find($sys_id);

        if (!$system) {
            return response()->json(['message' => 'System not found'], 404);
        }

        $user->update([
            $system->en_name => 1
        ]);

        UserReqSys::where('portal_system_id', $sys_id)
            ->where('users_id', $id)
            ->update(['approved' => 1]);

        return redirect()->route('portal.allUser')->with('success', 'User approval updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}