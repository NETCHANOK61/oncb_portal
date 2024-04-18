@extends('admin.dashboard')
@section('admin')
@php
    $user = Auth::user();
    if ($user) {
        // User is authenticated, check roles
        dd($user->hasRole('admin'));
    } else {
        // User is not authenticated
        dd('User is not authenticated.');
    }
@endphp
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Manage Admin User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card-header">
                    <h3 class="card-title">เพิ่มข้อมูล</h3>
                </div>
                <div class="col-md-12">
                    <form id="permissionForm" action="{{ route('store.admin') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body p-6">
                                <div class="panel panel-primary">
                                    <div class="tab_wrapper first_tab">
                                        <ul class="tab_list">
                                            <li class="active">ข้อมูลทั่วไป</li>
                                            <li>กำหนดสิทธิ์</li>
                                        </ul>

                                        <div class="content_wrapper">
                                            <div class="tab_content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname">รหัสผู้ใช้งาน</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputname" placeholder="123">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname">เลขบัตรประชาชน</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputname" placeholder="1234567891012">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="firstName">ชื่อ</label>
                                                                <input type="text" class="form-control" id="firstName"
                                                                    name="firstName" placeholder="ชื่อ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="lastName">นามสกุล</label>
                                                                <input type="text" class="form-control" id="lasttName"
                                                                    name="lastName" placeholder="นามสกุล">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname">โทรศัพท์</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputname" placeholder="0643144591">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="text" class="form-control" id="email"
                                                                    name="email" placeholder="Email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <label for="exampleInputname1">USERNAME</label>
                                                            <div class="row gutters-xs">
                                                                <div class="col">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="USERNAME">
                                                                </div>
                                                                <span class="col-auto">
                                                                    <button class="btn btn-success-light"
                                                                        type="button">generate
                                                                        username</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <label for="password">PASSWORD</label>
                                                            <div class="row gutters-xs">
                                                                <div class="col">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="password" id="password"
                                                                        name="password">
                                                                </div>
                                                                <span class="col-auto">
                                                                    <button class="btn btn-success-light"
                                                                        type="button">generate
                                                                        password</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <h4>ประเภทผู้ใช้งาน</h4>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">กลุ่มบทบาท</label>
                                                                <span>
                                                                    <div class="form-group">
                                                                        <select name="roleGroup" multiple="multiple"
                                                                            class="single-select">
                                                                            @foreach ($roles as $role)
                                                                                <option value="{{ $role->id }}">
                                                                                    {{ $role->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <h5>ปปส. ส่วนกลาง</h5>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">เพิ่มกลุ่ม</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="10" selected>
                                                                            กลุ่ม1</option>
                                                                        <option value="20">กลุ่ม2
                                                                        </option>
                                                                        <option value="30">กลุ่ม3
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">เพื่มแผนก</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="10" selected>
                                                                            แผนก1</option>
                                                                        <option value="20">แผนก2
                                                                        </option>
                                                                        <option value="30">แผนก3
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">Login
                                                                    Type</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select"
                                                                        disabled="disabled">
                                                                        <option value="10" selected>
                                                                            AD</option>
                                                                        <option value="20">
                                                                            AD</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <h5>ปปส. ภูมิภาค</h5>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">เพิ่มจังหวัด</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="10" selected>
                                                                            ชลบุรี</option>
                                                                        <option value="20">ระยอง
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">เพื่มอำเภอ</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="10" selected>
                                                                            สัตหีบ</option>
                                                                        <option value="20">บางเสร่
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">Login
                                                                    Type</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="10" selected>ThaiD
                                                                        </option>
                                                                        <option value="20">DigitalID
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <h5>สถานศึกษา</h5>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputname1">สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="01" selected>
                                                                            เขตการศึกษา1</option>
                                                                        <option value="02">
                                                                            เขตการศึกษา2</option>
                                                                        <option value="03">
                                                                            เขตการศึกษา3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">เทศบาล</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="01" selected>
                                                                            เทศบาล1</option>
                                                                        <option value="02">
                                                                            เทศบาล2</option>
                                                                        <option value="03">
                                                                            เทศบาล3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleInputname1">โรงเรียน</label>
                                                                <div class="form-group">
                                                                    <select multiple="multiple" class="single-select">
                                                                        <option value="01" selected>
                                                                            โรงเรียน1</option>
                                                                        <option value="02">
                                                                            โรงเรียน2</option>
                                                                        <option value="03">
                                                                            โรงเรียน3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <h4>ไฟล์แนบขออนุญาติใช้ระบบ</h4>

                                                    <div class="mb-3">
                                                        <input class="form-control" type="file" id="formFile">
                                                    </div>

                                                    <div class="" align="right">
                                                        <button type="submit"
                                                            class="btn btn-success-light mt-1">บันทึก</button>
                                                        {{-- <a href="#" class="btn btn-success-light mt-1">บันทึก</a> --}}
                                                        <a href="#" class="btn btn-danger-light mt-1">ยกเลิก</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab_content">

                                                <h4>รูปแบบการกำหนดสิทธิ์</h4>

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <label class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"
                                                                        name="example-radios" value="option1" checked>
                                                                    <span class="custom-control-label">กำหนดเอง</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"
                                                                        name="example-radios" value="option1" checked>
                                                                    <span class="custom-control-label">กำหนดตาม
                                                                        Role</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12">
                                                        <div class="form-group">
                                                            <h5>Role</h5>
                                                            <div class="form-group">
                                                                <select multiple="multiple" class="single-select">
                                                                    <option value="10" selected>
                                                                        ปปส. ส่วนกลาง</option>
                                                                    <option value="20">ปปส. ภูมิภาค
                                                                    </option>
                                                                    <option value="30">สถานศึกษา
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <h4>กรณีกำหนดเอง</h4>

                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <div class="card text-white"
                                                                style="background-color: #276cccd0;">
                                                                <div class="card-body">

                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-12">
                                                                            <p>เมนู 1</p>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12"
                                                                            style="align-items:end;">
                                                                            <label class="custom-control custom-checkbox ">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-radio" value="option4">
                                                                                <span
                                                                                    class="custom-control-label">ทั้งหมด</span>
                                                                            </label>
                                                                        </div>


                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">เพิ่ม</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">ดู</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option3">
                                                                                <span
                                                                                    class="custom-control-label">แก้ไข</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">ลบ</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">รายงาน</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <div class="card text-white"
                                                                style="background-color: #276cccd0;">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-12">
                                                                            <p>เมนู 2</p>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12"
                                                                            style="align-items:end;">
                                                                            <label class="custom-control custom-checkbox ">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-radio" value="option4">
                                                                                <span
                                                                                    class="custom-control-label">ทั้งหมด</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">เพิ่ม</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">ดู</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option3">
                                                                                <span
                                                                                    class="custom-control-label">แก้ไข</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">ลบ</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">รายงาน</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <div class="card text-white"
                                                                style="background-color: #276cccd0;">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-12">
                                                                            <p>เมนู 3</p>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12"
                                                                            style="align-items:end;">
                                                                            <label class="custom-control custom-checkbox ">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-radio" value="option4">
                                                                                <span
                                                                                    class="custom-control-label">ทั้งหมด</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">เพิ่ม</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">ดู</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option3">
                                                                                <span
                                                                                    class="custom-control-label">แก้ไข</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">ลบ</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">รายงาน</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <div class="card text-white"
                                                                style="background-color: #276cccd0;">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-12">
                                                                            <p>เมนู 4</p>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12"
                                                                            style="align-items:end;">
                                                                            <label class="custom-control custom-checkbox ">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-radio" value="option4">
                                                                                <span
                                                                                    class="custom-control-label">ทั้งหมด</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">เพิ่ม</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">ดู</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option3">
                                                                                <span
                                                                                    class="custom-control-label">แก้ไข</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option1">
                                                                                <span
                                                                                    class="custom-control-label">ลบ</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    name="example-checkbox"
                                                                                    value="option2">
                                                                                <span
                                                                                    class="custom-control-label">รายงาน</span>
                                                                            </label>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="" align="right">
                                                                <button type="submit"
                                                                    class="btn btn-success-light mt-1">บันทึก</button>
                                                                {{-- <a href="#"
                                                                    class="btn btn-success-light mt-1">ตกลง</a> --}}
                                                                <a href="#"
                                                                    class="btn btn-danger-light mt-1">ยกเลิก</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ROW-1 CLOSED -->
            </div>
            <!--CONTAINER CLOSED -->
        </div>
        <!-- ROW-1 CLOSED -->
    </div>
@endsection
