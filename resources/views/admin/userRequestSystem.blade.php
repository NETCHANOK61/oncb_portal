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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('../assets/login/images/oncb_build.jpg') }}');">
            <div class="wrap-system">
                <span class="login100-form-logo"></span>
                <form action="{{ route('storeReqSystem') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <span class="login100-form-title p-b-20 p-t-20">กรุณาเลือกระบบที่ต้องการขอใช้งานเพิ่ม</span>
                    @foreach ($system as $sys)
                        @if ($user[$sys->en_name] == 0 && !in_array($sys->id, $requested))
                            <div class="checkbox">
                                <label style="color: #fff">
                                    <input type="checkbox" class="system-checkbox" name="selected_systems[]"
                                        value="{{ $sys->id }}">
                                    {{ $sys->fullname }}
                                </label>
                                @if ($sys->en_name == 'NISPA')
                                    <div class="mb-3">
                                        <label for="file_upload_{{ $sys->id }}"
                                            class="form-label text-light">ไฟล์แนบ (.pdf, .doc, รูปภาพ)</label>
                                        <input type="file" class="form-control" id="file_upload_{{ $sys->id }}"
                                            name="file_upload" accept=".pdf,.doc,.docx,image/*">
                                        @error('file_upload')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <br>
                    <button type="submit" class="btn btn-primary w-full">ส่งคำขอ</button>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            let timerInterval;
            Swal.fire({
                title: 'Success!',
                html: '{{ session('success') }}<br>กำลังออกจากระบบในอีก <strong></strong> วินาที',
                icon: 'success',
                timer: 5000,
                timerProgressBar: true,
                didOpen: () => {
                    const content = Swal.getHtmlContainer();
                    const strong = content.querySelector('strong');
                    timerInterval = setInterval(() => {
                        Swal.getTimerLeft();
                        strong.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                @if (session('logout'))
                    window.location.href = "{{ route('logout') }}";
                @endif
            });
        </script>
    @endif

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
