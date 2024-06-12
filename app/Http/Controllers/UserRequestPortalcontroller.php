<?php

namespace App\Http\Controllers;

use App\Models\RequestedUser;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRequestPortalcontroller extends Controller
{
    public function index()
    {
        //
        $menuItems = MenuService::getMenuItems();
        $request_user = RequestedUser::where('approved', '0')->get();
        return view('admin.portal_user.request_user', compact('menuItems', 'request_user'));
    }

    // rejectList
    public function rejectList()
    {
        //
        $menuItems = MenuService::getMenuItems();
        $request_user = RequestedUser::where('approved', '2')->get();
        return view('admin.portal_user.reject_user', compact('menuItems', 'request_user'));
    }

    public function approve($id, Request $request)
    {
        $request_user = RequestedUser::find($id);

        $user = User::create([
            'name' => $request_user->name,
            'email' => $request_user->email,
            'userid' => $request_user->userid ?  $request_user->userid : null,
            'phone' => $request_user->phone ? $request_user->phone : null,
            'card_id' => $request_user->card_id,
            'file' => $request_user->file,
            'surname' => $request_user->surname,
            'agency' => $request_user->agency ? $request_user->agency : null,
            'PROV_ID' => $request_user->PROV_ID ? $request_user->PROV_ID : null,
            'AMP_ID' => $request_user->AMP_ID ? $request_user->AMP_ID : null,
            'edu_area_id' => $request_user->edu_area_id ? $request_user->edu_area_id : null,
        ]);

        $request_user->update([
            'approved' => '1'
        ]);

        return redirect()->route('portal.editUser', $user);

        // $menuItems = MenuService::getMenuItems();
        // $request_user = RequestedUser::all();
        // return view('admin.user.request_user', compact('menuItems', 'request_user'));
        // Retrieve the username and password from the form submission
        // $username = $request->input('username');
        // $password = $request->input('password');

        // dd($request);

        // Process the approval logic here

        // Redirect back or return a response
        // return redirect()->back()->with('success', 'User request approved successfully.');
    }

    public function reject($id, Request $request)
    {
        $request_user = RequestedUser::find($id);

        $request_user->update([
            'approved' => '2'
        ]);

        return redirect()->route('portal.rejectUserList');
    }
}
