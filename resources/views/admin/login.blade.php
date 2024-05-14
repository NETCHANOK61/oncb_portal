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
    <title>NISPA-2024</title>
</head>

<body>

    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('../assets/login/images/oncb_build.jpg') }}');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('login.post') }}" id="loginForm">
                    @csrf

                    <span class="login100-form-logo">
                    </span>

                    <span class="login100-form-title p-b-20 p-t-20">
                        web portal
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input id="email" class="input100" type="text" name="email" placeholder="Username">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input id="password" class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            เข้าสู่ระบบ
                        </button>
                    </div>

                    <span class="d-block text-center my-4 text-muted">&mdash; หรือ &mdash;</span>
                    {{-- <div class="container-login100-form-btn">
                        <a class="login100-form-btn" href="{{ route('ldapLogin') }}">
                            เข้าสู่ระบบ AD
                        </a>
                    </div> --}}

                    <div class="container-login100-form-btn">
                        <button type="button" id="loginLDAP" class="login100-form-btn">Login LDAP</button>
                    </div>

                    <br>
                    <div class="container-login100-form-btn">
                        <!-- Update your blade template with the new route -->
                        <a href="https://imauthsbx.bora.dopa.go.th/api/v2/oauth2/auth/?response_type=code&client_id=STBBSUhoR2p1SlFBa2JtaVBCSnMxYlB2emZuRXdQd04&redirect_uri=https://nispa.oncb.go.th/login_with_thaiid&scope=pid%20name%20name_en%20address%20given_name%20family_name%20given_name_en%20family_name_en%20gender%20title%20ial&state="
                            class="login100-form-btn">เข้าสู่ระบบด้วย ThaiID</a>
                    </div>
                    <br>
                    <div class="container-login100-form-btn">
                        <a href="{{ route('register') }}" class="login100-form-btn">ลงทะเบียนขอใช้งาน</a>
                    </div>
                    <div class="text-center p-t-20">
                        <a class="txt1" href="#">
                            Forgot Password?
                        </a>
                    </div>
                </form>

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


    <script>
        document.getElementById('loginLDAP').addEventListener('click', function() {
            var form = document.getElementById('loginForm');
            form.action = "{{ route('submitlogin') }}"; // Set the action to the Laravel route for LDAP login
            form.method = "POST"; // Ensure the method is POST
            form.submit(); // Submit the form
        });
    </script>
    {{-- <script src="{{ asset('../assets/login/js/main.js') }}"></script> --}}

</body>

</html>
