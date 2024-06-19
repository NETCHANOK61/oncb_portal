@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">จัดการผู้ใช้งาน (เดิม) ที่ต้องการใช้งานระบบเพิ่ม</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">คำขอที่ต้องการใช้งานระบบเพิ่ม:
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="padding-bottom: 2%">
                            @if ($systemNames->isNotEmpty())
                                @foreach ($systemNames as $name)
                                    <span class="badge badge-pill badge-default"><span></span>
                                        {{ $name }}</span>
                                @endforeach
                            @else
                                <p>ไม่มีระบบที่อยู่ภายใต้การดูแลของคุณ</p>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <!-- In admin/portal_user/request_user.blade.php -->
                            <!-- In admin/portal_user/request_user.blade.php -->
                            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr align="center">
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อ-นามสกุล</th>
                                        <th class="text-center">อีเมล์</th>
                                        <th class="text-center">ระบบที่ต้องการ</th>
                                        <th class="text-center">วันเวลาที่ลงทะเบียน</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request_user as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->name . ' ' . $item->user->surname }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->portalSystem->fullname }}</td>
                                            <td>{{ $item->created_at->setTimezone('Asia/Bangkok')->format('d/m/Y เวลา H:i:s') }}
                                            </td>
                                            <td>
                                                <button class="btn btn-info" onclick="showPDF('{{ $item->file }}')">
                                                    <i class="fa fa-eye"></i> ดูเอกสารแนบ
                                                </button>
                                                <button class="btn btn-warning"
                                                    onclick="approved({{ $item->user->id }}, '{{ $item->portalSystem->id }}')">
                                                    <i class="fa fa-pencil"></i> อนุมัติผู้ใช้งาน
                                                </button>
                                                {{-- <button class="btn btn-danger"
                                                    onclick="rejected({{ $item->id }}, '{{ $item->user->userid }}', '{{ $item->user->password }}')">
                                                    <i class="fa fa-pencil"></i> ปฏิเสธผู้ใช้งาน
                                                </button> --}}
                                            </td>
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
        // function approved(id, userid, password) {
        //     Swal.fire({
        //         title: 'ต้องการอนุมัติ?',
        //         text: "คุณต้องการอนุมัติคำขอนี้",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'อนุมัติ',
        //         cancelButtonText: 'ยกเลิก'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             var formAction = "{{ route('portal.approveUserPortal', ':user') }}";
        //             formAction = formAction.replace(':user', id);

        //             var isReadOnly = userid !== 'null' && userid !== '';

        //             Swal.fire({
        //                 title: isReadOnly ?
        //                     'ผู้ใช้งานนี้มีบัญชีกับ AD ของส่วนกลางแล้ว' : 'กรุณากำหนดชื่อผู้ใช้และรหัสผ่าน',
        //                 html: '<form id="myForm" action="' + formAction + '" method="POST">' +
        //                     '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
        //                     '<input type="hidden" name="userid" value="' + userid + '">' +
        //                     '<div style="text-align: center;">' +
        //                     '<div style="margin-bottom: 10px;">' +
        //                     '<label style="display: inline-block; width: 100px; text-align: right; margin-right: 10px;">Username</label>' +
        //                     '<input id="username" name="username" class="swal2-input" style="width: 200px;" placeholder="ชื่อผู้ใช้" value="' +
        //                     (isReadOnly ? userid : '') + '" ' + (isReadOnly ? 'readonly' : '') + '>' +
        //                     '</div>' +
        //                     '<div>' +
        //                     '<label style="display: inline-block; width: 100px; text-align: right; margin-right: 10px;">รหัสผ่าน</label>' +
        //                     '<input type="password" id="password" name="password" class="swal2-input" style="width: 200px;" placeholder="รหัสผ่าน" value="' +
        //                     (isReadOnly ? password : '') + '" ' + (isReadOnly ? 'readonly' : '') + '>' +
        //                     '</div>' +
        //                     '</div><br>' +
        //                     (isReadOnly ? '' :
        //                         '<div style="padding-left: 50%">' +
        //                         '<div id="generatePasswordButton"><img src="{{ asset('assets/images/password.png') }}" width="50"></div>' +
        //                         '</div>') +
        //                     '</form>',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 confirmButtonText: 'บันทึก',
        //                 cancelButtonText: 'ยกเลิก',
        //                 preConfirm: () => {
        //                     document.getElementById('myForm').submit(); // Submit the form
        //                 }
        //             });

        //             // Attach event listener to the button after it's created, only if it's visible
        //             if (!isReadOnly) {
        //                 document.getElementById("generatePasswordButton").addEventListener("click",
        //                     setGeneratedPassword);
        //             }
        //         }
        //     });
        // }

        function rejected(id) {
            Swal.fire({
                title: 'ต้องการปฏิเสธ?',
                text: "คุณต้องการปฏิเสธคำขอนี้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ปฏิเสธ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formAction = "{{ route('portal.rejectUserPortal', ':user') }}";
                    formAction = formAction.replace(':user', id);

                    // Create a form element
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = formAction;

                    // Add CSRF token input
                    var csrfTokenInput = document.createElement('input');
                    csrfTokenInput.type = 'hidden';
                    csrfTokenInput.name = '_token';
                    csrfTokenInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfTokenInput);

                    // Append the form to the body and submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function approved(id, sys_id) {
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
                    var formAction = "{{ route('portal.approveNewSystem', [':id', ':sys_id']) }}";
                    formAction = formAction.replace(':id', id);
                    formAction = formAction.replace(':sys_id', sys_id);

                    // Create a form element
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = formAction;

                    // Add CSRF token input
                    var csrfTokenInput = document.createElement('input');
                    csrfTokenInput.type = 'hidden';
                    csrfTokenInput.name = '_token';
                    csrfTokenInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfTokenInput);

                    // Append the form to the body and submit
                    document.body.appendChild(form);
                    form.submit();
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