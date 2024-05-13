<?php

namespace App\Http\Controllers\Admin;

use App\Models\oncbAD;
use App\Models\FuncByRole;
use App\Models\bud_dpis;
use App\Models\School48;
use App\Http\Controllers\Controller;
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

    public function login()
    {
        return view('admin.login');
    }

    // public function login_with_thaiid(Request $request)
    // {
    //     $code = $request->input('code');
    //     if ($code) {
    //         $state = $request->input('state');

    //         // dd($code);
    //         $response = Http::withOptions(['verify' => false])->asForm()->post('https://imauth.bora.dopa.go.th/api/v2/oauth2/token/', [
    //             'grant_type' => 'authorization_code',
    //             'code' => $code,
    //             'redirect_uri' => 'https://nispatest.oncb.go.th/login_with_thaiid',
    //         ], [
    //             'Content-type' => 'application/x-www-form-urlencoded',
    //             'Authorization' => 'Basic authorization'
    //         ]);
    //     } else {
    //         dd($request);
    //     }

    //     // $client_id = "";
    //     // $redirect_url = "https://rp.example.org/api/callback";
    //     // $scope = "pid%20name%20family_name%20birthdate";
    //     // // เลขบัตรปชช ชื่อ นามสกุล วันเกิด
    //     // $state = "UserManagementceijerijveoqijqr";

    //     // $response = Http::withHeaders([
    //     //     'Content-Type' => 'application/x-www-form-urlencoded'
    //     // ])->get('https://imauth.bora.dopa.go.th/api/v2/oauth2/auth/?response_type=code
    //     // &client_id='.$client_id.'&redirect_uri='.$redirect_url.'
    //     // &scope='.$scope.'&state='.$state);

    //     // $data = $response->json();

    //     // return view('admin.callback');
    // }

    public function login_with_thaiid(Request $request)
    {
        $code = $request->input('code');
        if ($code) {
            // Hardcoded configuration values
            $tokenUrl = 'https://imauth.bora.dopa.go.th/api/v2/oauth2/token/';
            $redirectUri = 'https://nispatest.oncb.go.th/login_with_thaiid';
            $clientId = 'Y21aMG14V0lEbEV2eDdFQnltUThmZnpYMTA3Ymt3czk';
            $clientSecret = 'dXhMRTVRTlJlSzV4eFgxT05KQTB2b01rUHVPdGthY1MycDUzWnVhbw';
            // Base64 encode the client ID and secret
            $authorization = 'Basic ' . base64_encode("{$clientId}:{$clientSecret}");

            // $response = Http::withOptions(['verify' => false])->asForm()->post($tokenUrl, [
            //     'grant_type' => 'authorization_code',
            //     'code' => $code,
            //     'redirect_uri' => $redirectUri,
            // ], [
            //     'Content-Type' => 'application/x-www-form-urlencoded',
            //     'Authorization' => $authorization,
            // ]);

            $response = Http::withOptions(['verify' => false]) // Note: 'verify' => false is for development purposes only
                ->withHeaders([
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => "Basic {$authorization}",
                ])
                ->asForm()
                ->post('https://imauthsbx.bora.dopa.go.th/api/v2/oauth2/token/', [
                    'grant_type' => 'authorization_code',
                    'code' => 'code',
                    'redirect_uri' => 'https://nispatest.oncb.go.th/login_with_thaiid',
                ]);
            // // Process response
            // if ($response->successful()) {
            //     return response()->json($response->json(), 200);
            //     dd($response->json());
            // } else {
            //     return response()->json($response->json(), $response->status());
            // }
        } else {
            // Handle the case where 'code' is not provided in the request
            abort(400, 'Authorization code is required.');
        }
    }

    public function callApi(Request $req)
    {
        $token = 'TZyirc31YL';
        $key = '9YXXlYhOvy0sBjSAcPQFIllvNUF4E8NC';
        $username = $req->username_input;
        $password = $req->password;
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

    public function ldapLogin(Request $request)
    {
        // Get the IP address of the user
        $ipAddress = $request->ip();

        // Check if the IP address exists in LoginData
        $foundIP = User::where('ipAddress', $ipAddress)->exists();
        $user_request = User::where('ipAddress', $ipAddress)->first();

        if ($foundIP) {
            // IP found, redirect to admin page
            Auth::login($user_request);
            return $this->index();
        } else {
            // IP not found, return to homepage with popup message
            // return response()->json(['message' => 'Your custom message here']);

            return redirect('/');
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
            // dd($user);
            Auth::login($user);
            return $this->index();
        } else {
            return redirect('/');
        }
    }
}