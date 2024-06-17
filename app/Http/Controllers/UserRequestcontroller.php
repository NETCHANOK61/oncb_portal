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
        // Find the requested user
        $request_user = RequestedUser::findOrFail($id);

        // Check if a user with the same email or card_id already exists
        $existingUser = User::where('email', $request_user->email)
            ->orWhere('card_id', $request_user->card_id)
            ->first();

        if ($existingUser) {
            return redirect()->back()
                ->withErrors(['duplicate' => 'ไม่สามารถบันทึกช้อมูลผู้ใช้งานนี้ได้ เนื่องจากมีข้อมูลซ้ำกับผู้ใช้งานเดิม', 'id' => $request_user->id]);
        }
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

        $request_user->update(['approved' => 1]);

        $portal = User_portal::where('email', $request_user->email)->first();

        if ($portal) {
            // Update existing record
            $portal->NISPA = 1;
            $portal->save();
        } else {
            // Create a new record
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
        }

        return redirect()->route('admin.users.edit', $user);
    }

    public function reject($id)
    {
        $request_user = RequestedUser::find($id);

        $request_user->update([
            'approved' => 2
        ]);

        return redirect()->route('admin.users_request.index');
    }
}
