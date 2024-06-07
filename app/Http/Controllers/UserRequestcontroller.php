<?php

namespace App\Http\Controllers;

use App\Models\RequestedUser;
use App\Models\User;
use App\Models\User_portal;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRequestcontroller extends Controller
{
    public function index()
    {
        //
        $menuItems = MenuService::getMenuItems();
        $request_user = RequestedUser::where('approved', 0)->get();
        return view('admin.user.request_user', compact('menuItems', 'request_user'));
    }

    public function approve(Request $request, $id)
    {
        $request_user = RequestedUser::find($id);

        $user = User::create([
            'name' => $request_user->name,
            'email' => $request_user->email,
            'password' => Hash::make($request->input('password')),
            'card_id' => $request_user->card_id,
            'file' => $request_user->file,
            'username' => $request->input('username'),
            'surname' => $request_user->surname,
            'phone' => $request->phone
        ]);

        $portal = User_portal::create([
            'name' => $request_user->name,
            'surname' => $request_user->surname,
            'email' => $request_user->email,
            'card_id' => $request_user->card_id,
            'file' => $request_user->file,
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request_user->phone,
            'NISPA' => 1
        ]);

        $request_user->update([
            'approved' => 1
        ]);

        return redirect()->route('admin.users.edit', $user);

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
}
