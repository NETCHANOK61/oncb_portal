<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Ampher;
use App\Models\Province;
use App\Models\RequestedUser;
use App\Models\User;
use App\Models\Region;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $region = Region::orderBy('REG_ID')->get();

        $province = Province::orderBy('PROV_ID')->get();

        $ampher = Ampher::orderBy('AMP_ID')->get();

        $agencies = Agency::whereIn('div_code', [703, 720, 721])->get();

        return view('admin.register', compact('region', 'province', 'ampher', 'agencies'));
        // return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function checkEmail(Request $request)
    {
        $isAvailable = !User::where('email', $request->value)->exists();
        return response()->json(['isAvailable' => $isAvailable]);
    }

    public function checkCard_id(Request $request)
    {
        $isAvailable = !User::where('card_id', $request->value)->exists();
        return response()->json(['isAvailable' => $isAvailable]);
    }

    public function storeRequested(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'surname' => ['required', 'string', 'max:255'],
        //     'phone' => ['required', 'string', 'min:10', 'max:10'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        //     'card_id' => ['required', 'string', 'min:13', 'max:13']
        // ]);

        // Handle file upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        }

        $user = RequestedUser::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'card_id' => $request->card_id,
            'file' => $filePath ? '/storage/' . $filePath : null // Handle case where file is not uploaded
        ]);

        $user_id = $user->id;

        return redirect()->route('register.submit', ['id' => $user_id]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

    }
    // requestedSubmit
    public function requestedSubmit(Request $request, $id)
    {
        $data = RequestedUser::find($id);
        return view('admin.registerSubmit', compact('data'));
    }
}
