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
                <span class="login100-form-logo">
                </span>

                <span class="login100-form-title p-b-20 p-t-20">
                    web portal
                    สวัสดีคุณ {{ $user->name }} {{ $user->surname }}
                </span>
                <hr style="background-color: #fff">
                <h5 style="color: #fff">กรุณาเลือกระบบที่คุณต้องการใช้งาน</h5>
                <br>

                @if ($user->role == 'superAdmin' || $user->role == 'admin')
                    <form class="login100-form validate-form" method="POST"
                        action="{{ route('login_to_portal_management') }}">
                        @csrf
                        <input type="hidden" name="email" id="email" value="{{ $user->email }}">
                        <input type="hidden" name="password" id="password" value="{{ $user->password }}">
                        <button type="submit" class="btn btn-danger w-full">
                            บริหารจัดการ Web Portal
                        </button>
                    </form>
                @endif
                <br>
                <div class="row">
                    @foreach ($system_all as $system)
                        @php
                            $column_name = $system->en_name;
                        @endphp
                        @if ($user->$column_name == '1')
                            <div class="col">
                                @if ($system->en_name == 'nispa')
                                    <form class="login100-form validate-form" method="POST"
                                        action="https://nispa.oncb.go.th/login_to_nispa" id="loginForm">
                                        @csrf
                                        <input type="hidden" name="email" id="email"
                                            value="{{ $user->email }}">
                                        <input type="hidden" name="password" id="password"
                                            value="{{ $user->password }}">
                                        <button type="submit" class="btn btn-light w-full">
                                            {{ $system->fullname }}
                                        </button>
                                    </form>
                                @else
                                    <a type="button" class="btn btn-light w-full">{{ $system->fullname }}</a>
                                @endif
                            </div>
                        @endif
                    @endforeach
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


</body>

</html>
