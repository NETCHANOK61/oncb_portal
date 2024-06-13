<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="login/images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('../assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('../assets/login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/login/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('../assets/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('../assets/login/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/login/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('../assets/login/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../assets/login/css/main.css') }}">
    <title>PORTAL-2024</title>
</head>

<body>
    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('../assets/login/images/oncb_build.jpg') }}');">
            <div class="wrap-system">
                <span class="login100-form-logo"></span>
                <span class="login100-form-title p-b-20 p-t-20">
                    web portal
                    สวัสดีคุณ {{ $user->name }} {{ $user->surname }}
                </span>
                <div style="display: flex; justify-content: center;">
                    <button type="button" class="btn btn-info">
                        <a class="login100-form-title" href="{{ route('showReqSystem') }}">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> ร้องขอใช้ระบบเพิ่ม
                        </a>
                    </button>
                    <div style="padding-right: 5%"></div>
                    <button type="button" class="btn btn-secondary">
                        <a class="login100-form-title" href="{{ route('auth.logout') }}">
                            <i class="fa fa-sign-out logout-icon" aria-hidden="true"></i> ออกจากระบบ
                        </a>
                    </button>
                </div>
                <hr style="background-color: #fff">
                <h5 style="color: #fff">กรุณาเลือกระบบที่คุณต้องการใช้งาน</h5>
                <br>
                @if ($user->role == 'superAdmin' || $user->role == 'admin')
                    <form class="validate-form" method="POST" action="{{ route('login_to_portal_management') }}">
                        @csrf
                        <input type="hidden" name="email" id="email" value="{{ $user->email }}">
                        <input type="hidden" name="password" id="password" value="{{ $user->password }}">
                        <button type="submit" class="btn btn-primary w-full">
                            บริหารจัดการ Web Portal
                        </button>
                    </form>
                @endif
                <br>
                <div style="padding: 10px; max-height: 150px; overflow-x: hidden; overflow-x: hidden;">
                    <div class="row">
                        @php $counter = 1; @endphp
                        @foreach ($system_all as $system)
                            @php $column_name = $system->en_name; @endphp
                            @if ($user->$column_name == '1')
                                <div class="col-md-6 mb-3">
                                    <form class="validate-form" method="POST" action="{{ route('submitLoginForm') }}">
                                        @csrf
                                        <input type="hidden" name="api_url" value="{{ $system->url }}">
                                        {{-- <input type="hidden" name="password" id="password" value="{{ $user->password }}"> --}}
                                        <input type="hidden" name="data" value="{{ $user }}">
                                        <button type="submit" class="btn btn-light w-100" style="white-space: normal">
                                            {{ $counter }}. <br> {{ $system->fullname }}
                                        </button>
                                    </form>
                                </div>
                                @php $counter++; @endphp
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('../assets/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/countdowntime/countdowntime.js') }}"></script>

    {{-- <script>
        function submitLoginForm(username, password) {
            document.getElementById('email').value = username;
            document.getElementById('password').value = password;
            document.getElementById('loginForm').submit();
        }
    </script> --}}
    {{-- <script>
        function submitLoginForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const apiKey = document.getElementById('api_key').value;
            const apiToken = document.getElementById('api_token').value;
            const authorization = btoa(apiKey + ':' + apiToken);

            fetch('http://127.0.0.1:8002/login_to_nispa', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: 'authorization',
                        api_token: apiToken
                    })
                })
                .then(response => {
                    console.log(response);
                    if (response.ok && response.headers.get('Content-Type').includes('application/json')) {
                        return response.json();
                    } else {
                        console.error('Non-JSON response received:', response.statusText);
                        return Promise.reject('Non-JSON response received');
                    }
                })
                .then(data => {
                    console.log(data.authorization);
                    if (data.authorization === authorization) {
                        console.error('Authentication A:');
                    } else {
                        console.error('Authentication failed:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script> --}}


</body>

</html>
