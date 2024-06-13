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
    <title>WEB-PORTAL</title>
</head>

<body>

    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('../assets/login/images/oncb_build.jpg') }}');">
            <div class="wrap-login100">
                <span class="login100-form-logo">
                </span>

                <span class="login100-form-title p-b-20 p-t-20">
                    web portal
                </span>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                {{-- <form class="login100-form validate-form" method="POST" action="{{ route('login.post') }}"
                    id="loginForm"> --}}
                <form class="login100-form validate-form" method="POST" action="{{ route('submitlogin') }}"
                    id="loginForm">
                    <span class="d-block text-center mb-2" style="color: #fff">&mdash; เข้าสู่ระบบด้วย AD &mdash;</span>
                    @csrf

                    <div class="wrap-input100">
                        <input id="username" class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100">
                        <input id="password" class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <br>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>

                @if ($errors->get('email') || $errors->get('username'))
                    <div class="alert alert-danger">กรุณากรอกอีเมล์หรือ username ให้ถูกต้อง</div>
                @elseif ($errors->get('password'))
                    <div class="alert alert-danger">กรุณากรอกรหัสผ่านให้ถูกต้อง</div>
                @endif
                <br>
                <span class="d-block text-center my-4 text-muted">&mdash; หรือ &mdash;</span>
                <div class="container-login100-form-btn">
                    <!-- Update your blade template with the new route -->
                    <a href="https://imauthsbx.bora.dopa.go.th/api/v2/oauth2/auth/?response_type=code&client_id=N1BHQUJTZjh2dm9GMGRxZjk1MUVtSnFDSm1SaU0yWDQ&redirect_uri=https://portal.oncb.go.th/login_with_thaiid&scope=pid%20name%20name_en%20address%20given_name%20family_name%20given_name_en%20family_name_en%20gender%20title%20ial&state=login"
                        class="login100-form-btn">เข้าสู่ระบบด้วย ThaiID</a>
                </div>
                <br>
                <div class="container-login100-form-btn">
                    <a href="{{ route('register_screen') }}" class="login100-form-btn">ลงทะเบียนขอใช้งาน (ระบบอื่น
                        ๆ)</a>
                </div>
                <br>
                <div class="container-login100-form-btn">
                    <a href="https://nispa.oncb.go.th/register" class="login100-form-btn">ลงทะเบียนขอใช้งาน (ระบบ
                        NISPA)</a>
                </div>
                <div class="text-center p-t-20">
                    <a class="txt1" href="#">
                        Forgot Password?
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="{{ asset('../assets/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('../assets/login/vendor/countdowntime/countdowntime.js') }}"></script>

</body>

</html>
