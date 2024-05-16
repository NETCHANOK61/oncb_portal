@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">จัดการผู้ใช้งานที่ลงทะเบียน</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">คำขอสร้างบัญชีใหม่</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr align="center">
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อ-นามสกุล</th>
                                        <th class="text-center">หมายเลขบัตร</th>
                                        <th class="text-center">อีเมล์</th>
                                        <th class="text-center">วันเวลาที่ลงทะเบียน</th>
                                        <th class="text-center">การจัดการ</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request_user as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name . ' ' . $item->surname }}</td>
                                            <td>{{ $item->card_id }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->created_at->setTimezone('Asia/Bangkok')->format('d/m/Y เวลา H:i:s') }}
                                            </td>

                                            <td>
                                                <button class="btn btn-info" onclick="showPDF('{{ $item->file }}')"><i
                                                        class="fa fa-eye"></i>
                                                    ดูเอกสารแนบ</button>
                                                <button class="btn btn-warning" onclick="approved({{ $item->id }})"><i
                                                        class="fa fa-pencil"></i>
                                                    อนุมัติผู้ใช้งาน</button>
                                                <button class="btn btn-danger">
                                                    ปฎิเสธคำขอ</button>
                                            </td>
                                            {{-- <td>
                                                <iframe src="{{ asset($item->file) }}" frameborder="0"></iframe>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- TABLE WRAPPER -->
                </div>
                <!-- SECTION WRAPPER -->
            </div>
        </div>
        <!-- ROW-1 CLOSED -->
    </div>
    <script>
        function approved(id) {
            var data_id = id;
            Swal.fire({
                title: 'ต้องการอนุมัติ?',
                text: "คุณต้องการอนุมัติคำขอนี้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'อนุมัติ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formAction = "{{ route('portal.approveUserPortal', ':user') }}";
                    formAction = formAction.replace(':user', data_id);

                    Swal.fire({
                        title: 'กรุณาใส่ชื่อผู้ใช้และรหัสผ่าน',
                        html: '<form id="myForm" action="' + formAction + '" method="POST">' +
                            '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                            '<div style="text-align: center;">' +
                            '<div style="margin-bottom: 10px;">' +
                            '<label style="display: inline-block; width: 100px; text-align: right; margin-right: 10px;">Username</label>' +
                            '<input id="username" name="username" class="swal2-input" style="width: 200px;" placeholder="ชื่อผู้ใช้">' +
                            '</div>' +
                            '<div>' +
                            '<label style="display: inline-block; width: 100px; text-align: right; margin-right: 10px;">รหัสผ่าน</label>' +
                            '<input type="text" id="password" name="password" class="swal2-input" style="width: 200px;" placeholder="รหัสผ่าน">' +
                            '</div>' +
                            '</div><br>' +
                            '<div style="padding-left: 50%">' +
                            '<div id="generatePasswordButton"><img src="{{ asset('assets/images/password.png') }}" width="50"></div>' +
                            '</div>' +
                            '</form>',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'บันทึก',
                        cancelButtonText: 'ยกเลิก',
                        preConfirm: () => {
                            document.getElementById('myForm').submit(); // Submit the form
                        }
                    });

                    // Attach event listener to the button after it's created
                    document.getElementById("generatePasswordButton").addEventListener("click",
                        setGeneratedPassword);
                }
            });
        }

        function showPDF(path_file) {
            Swal.fire({
                html: `<iframe src="{{ asset('${path_file}') }}" frameborder="0" width="95%" height="500"></iframe>`, // Use the path_file to set the src attribute of the iframe
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false, // Hide the "OK" button
                focusConfirm: false,
            });
        }

        // Function to generate a random password
        function generateRandomPassword(length) {
            var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-+=";
            var password = "";
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }
            return password;
        }

        // Function to set the generated password into the password input field
        function setGeneratedPassword() {
            var generatedPassword = generateRandomPassword(8); // You can specify the length of the password here
            document.getElementById("password").value = generatedPassword;
        }
    </script>
@endsection
