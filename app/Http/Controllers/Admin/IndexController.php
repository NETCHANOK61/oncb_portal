<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Ampher;
use App\Models\oncbAD;
use App\Models\FuncByRole;
use App\Models\bud_dpis;
use App\Models\Province;
use App\Models\Region;
use App\Models\School48;
use App\Http\Controllers\Controller;
use App\Models\System;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $menuItems = MenuService::getMenuItems();

        return view('admin.dashboard', compact('menuItems'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function req_system($systemId, $userId)
    {
        $system = System::find($systemId);
        $user = User::find($userId);
        //
        dd($user);
        return view('admin.systemForUser', compact('data'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function login_with_thaiid(Request $request)
    {
        $code = $request->input('code');
        $state = $request->input('state');

        if ($code) {
            // Hardcoded configuration values
            // $tokenUrl = 'https://imauthsbx.bora.dopa.go.th/api/v2/oauth2/token/';
            // $redirectUri = 'https://nispatest.oncb.go.th/login_with_thaiid';
            // $clientId = 'a1B3VUlkRXRJWnhpNWl3N0JOWFBzWTBhNExGRzRzYUE';
            // $clientSecret = 'N1h6WU5TNnlDUm44OFhQZ3RWV2w5N0h3aW1qRDk0c0h3SVZJemw3OQ';
            $tokenUrl = 'https://imauthsbx.bora.dopa.go.th/api/v2/oauth2/token/';
            $redirectUri = 'https://portal.oncb.go.th/login_with_thaiid';
            $clientId = 'N1BHQUJTZjh2dm9GMGRxZjk1MUVtSnFDSm1SaU0yWDQ';
            $clientSecret = 'WXVRdlI4elI1Qm9OY25GbHNpeTdzejFsYWFIVHNsSUh1S1R4U29Tag';
            // Base64 encode the client ID and secret
            $authorization = 'Basic ' . base64_encode("{$clientId}:{$clientSecret}");

            $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => $authorization,
                ])
                ->asForm()
                ->post('https://imauthsbx.bora.dopa.go.th/api/v2/oauth2/token/', [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => 'https://portal.oncb.go.th/login_with_thaiid',
                ]);
            // // Process response
            if ($response->successful()) {

                $responseData = $response->json(); // Get the response data as an array
                $pid = $responseData['pid'] ?? null; // Access the pid value, use null as a default if it's not set
                $given_name = $responseData['given_name'] ?? null;
                $family_name = $responseData['family_name'] ?? null;

                $responseData = array('pid' => $pid, "given_name" => $given_name, "family_name" => $family_name);

                if ($state == 'register') {

                    $region = Region::orderBy('REG_ID')->get();

                    $province = Province::orderBy('PROV_ID')->get();

                    $ampher = Ampher::orderBy('AMP_ID')->get();

                    $agencies = Agency::whereIn('div_code', [703, 720, 721])->get();
                    //$responseData = $req->query('responseData');

                    return view('admin.register', compact('region', 'province', 'ampher', 'agencies', 'pid', 'responseData'));
                }

                if ($state == 'login') {
                    // return response()->json($response->json(), 200);
                    // check_callback($response->pid);
                    $user = User::where('card_id', $pid)->first();
                    $userObject = $responseData;
                    if ($user) {
                        $system_all = System::where('status', 1)->get();
                        return view('admin.systemForUser', compact('userObject', 'user', 'system_all'));
                    } else {
                        return redirect('/');
                    }
                }
            } else {
                return response()->json($response->json(), $response->status());
            }
        } else {
            // Handle the case where 'code' is not provided in the request
            abort(400, 'Authorization code is required.');
        }
    }

    public function callApi(Request $req)
    {
        $token = 'TZyirc31YL';
        $key = '9YXXlYhOvy0sBjSAcPQFIllvNUF4E8NC';
        $username = $req->input('username');
        $password = $req->input('password');
        $authen = false;
        $userprofile = null;

        $userprofile = null;
        /*ตรวจสอบการ*/
        if (trim($username) == "" || trim($password) == "") {
            return back()->with('error', 'ข้อมูลไม่ครบถ้วน กรุณากรอกชื่อผู้ใช้และรหัสผ่าน');
        }
        $msg = $this->ONCBPack($username, $password, $key, $token);
        $url = "https://nccdor.nccd.go.th/warroom/api/wsloginns/" . $msg;
        $client = curl_init($url);
        //echo $client;
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($client, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($client);
        //echo $response;
        if ($error_number = curl_errno($client)) {
            if (in_array($error_number, array(CURLE_OPERATION_TIMEDOUT, CURLE_OPERATION_TIMEOUTED))) {
                $result = array('status' => '500', 'status_message' => 'timed out.', 'data' => NULL);
                $userprofile['login'] = false;
            }
        } else {
            $result = json_decode($response, true);
            if ($result !== null && is_array($result) && array_key_exists('status', $result)) {
                if ($result['status'] == 200) {

                    $user = $result['data'];

                    $userprofile['login'] = true;
                    $userprofile['userid'] = $user[0]['userid'];
                    $userprofile['enname'] = $user[1]['ENname'];
                    $userprofile['thname'] = $user[2]['THname'];
                    $userprofile['mail'] = $user[3]['mail'];
                    $userprofile['depart_id'] = $user[4]['depart_id'];
                    $userprofile['department'] = $user[5]['department'];
                    $userprofile['logintime'] = $user[6]['logintime'];
                    //$userprofile['role'] = $user[7]['role']['rolebsp'];
                    $userprofile['rolebsp'] = $user[7]['role']['rolebsp'];
                    $userprofile['role_name'] = 'สิทธิ์ ' . $user[5]['department'];
                    $userprofile['employeeid'] = $user[8]['employeeid'];
                    $userprofile['employeenumber'] = $user[9]['employeenumber'];
                    $userprofile['division'] = $user[10]['division'];

                    if ($userprofile['rolebsp'] == '') {
                        $userprofile['login'] = false;
                    }
                } else {
                    $userprofile['login'] = false;
                }
            }
            // close
            curl_close($client);
            return $userprofile;
        }
    }

    public function submitlogin(Request $req)
    {
        $adldap = new oncbAD();
        $username = $req->input('username');
        $password = $req->input('password');
        $authen = false;
        $userprofile = null;

        if (trim($username) == "" || trim($password) == "") {
            return back()->with('error', 'ข้อมูลไม่ครบถ้วน กรุณากรอกชื่อผู้ใช้และรหัสผ่าน');
        }

        // $storedPasswordHash = 'Usertest2019'; // รหัสผ่านที่ถูกเก็บไว้ในฐานข้อมูล

        // if (!password_verify($password, $storedPasswordHash)) {
        //     return back()->with('error', 'รหัสผ่านไม่ถูกต้อง กรุณาลองอีกครั้ง');
        // }

        $userapi = $this->callApi($req);
        $userObject = $userapi;

        if (!is_null($userapi) && isset($userapi['login'])) {
            $authen = $userapi['login'];
            if ($authen) {
                $user = User::where('userid', $username)->first();

                if ($user) {
                    $system_all = System::where('status', 1)->get();
                    return view('admin.systemForUser', compact('userObject', 'user', 'system_all'));
                } else {
                    return back()->with('error', 'ไม่พบบัญชีผู้ใช้งาน');
                }
            }
        } else {
            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                $user = Auth::user();
                $system_all = System::where('status', 1)->get();
                return view('admin.systemForUser', compact('userObject', 'user', 'system_all'));
            } 
            else {
                return back()->with('error', 'ไม่พบบัญชีผู้ใช้งาน');
            }
        }
    }

    function encrypt_decrypt($action, $string, $secret_key, $secret_iv)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    function ONCBPack($name, $pass, $key, $iv)
    {
        return $iv . $this->encrypt_decrypt('encrypt', $pass . "|#|" . $name, $key, $iv);
    }

    function check_callback(Request $request)
    {
        // dd($request->username_input);
        $uid = $request->pid;
        $user = User::where('card_id', $uid)->first();

        if ($user) {
            $system_all = System::where('status', 1)->get();
            // dd($user);
            // Auth::login($user);
            // return $this->index();
            return view('admin.systemForUser', compact('userObject', 'user', 'system_all'));
        } else {
            return redirect('/');
        }

        // if ($user) {
        //     // dd($user);
        //     Auth::login($user);
        //     return $this->index();
        // } else {
        //     return redirect('/');
        // }
    }

    function login_to_portal_management(Request $request)
    {
        // dd($request);
        // exit;
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            // dd($user);
            Auth::login($user);
            return $this->index();
        } else {
            return redirect('/');
        }
    }

    public function submitLoginForm(Request $request)
    {
        $apiUrl = $request->input('api_url');
        $system = System::where('url', $apiUrl)->first();
        $apiKey = $system ? $system->API_KEY : null;
        $token = bin2hex(random_bytes(16));
    
        if (!$apiKey) {
            // In case of an error in submitLoginForm
            return redirect('/');
        }
    
        $encodedUrl = md5($apiUrl . ':' . $token);  // Encode or hash the URL to use as a key
        if (!$request->session()->get('verified_' . $encodedUrl, false)) {
            $authorization = base64_encode($apiKey . ':' . $token);
    
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])->post($apiUrl, [
                'status' => 'authorization'
            ]);
    
            if ($response->successful() && $response->json()['authorization'] === $authorization) {
                $request->session()->put('verified_' . $encodedUrl, true);
                $redirectUrl = $response->json()['redirect_url'];
                $data = $request->input('data');
    
                // Redirect to a new URL with the data packed for POST submission
                return view('redirect', [
                    'redirectUrl' => $redirectUrl,
                    'data' => $data
                ]);
            } else {
                // In case of an error in submitLoginForm
                return redirect()->route('formView')->withInput()->withErrors(['authorization' => 'Failed to verify authorization.']);
            }
        }
        // In case of an error in submitLoginForm
        return redirect()->route('formView')->withInput()->withErrors(['authorization' => 'Failed to verify authorization.']);
    }    
    
    public function showForm(Request $request)
    {
        return view('yourFormView', [
            'oldInput' => $request->old(),
            'errors' => $request->session()->get('errors')
        ]);
    }
}
