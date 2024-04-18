@extends('admin.dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('all.role') }}">บริหารจัดการบทบาท
                    </a></li>
                <li class="breadcrumb-item"><a href="{{ route('all.role') }}">จัดการบทบาทของผู้ใช้งาน</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Add Roles in Permission
                </li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="col-md-12">
                        <form id="roleForm" action="{{ route('role.permission.store') }}" method="POST">
                            @csrf
                            <div class="card-body p-6">
                                <div class="panel panel-primary">
                                    <div class="tab_wrapper first_tab">
                                        <ul class="nav panel-tabs">
                                            <li><a href="#tab1" data-toggle="tab">สิทธิ์การเข้าถึง</a></li>
                                            <li><a href="#tab2"class="active" data-toggle="tab">สิทธิ์การเข้าถึง (x)</a>
                                            </li>
                                        </ul>

                                        <div class="content_wrapper">
                                            <div class="tab_content">
                                                <div class="card-body" id="tab1">
                                                    <div class="row">
                                                        {{-- <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">บทบาท</label>
                                                                <input type="text" class="form-control" id="roleName"
                                                                    name="roleName" placeholder="ชื่อบทบาท" />
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-12">
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
                                                        <div class="col-4">
                                                            <label class="custom-control custom-checkbox"
                                                                for="checkDefaultmain">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="checkDefaultmain">
                                                                <span class="custom-control-label">Permission All</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @foreach ($permission_group as $group)
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        name="example-checkbox" value="option1">
                                                                    <span
                                                                        class="custom-control-label">{{ $group->group_name }}</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-9">
                                                                @php
                                                                    $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                                                @endphp
                                                                @foreach ($permissions as $permission)
                                                                    <label class="custom-control custom-checkbox"
                                                                        for="checkDefault{{ $permission->id }}">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                            name="permission[]"
                                                                            id="checkDefault{{ $permission->id }}"
                                                                            value="{{ $permission->id }}">
                                                                        <span
                                                                            class="custom-control-label">{{ $permission->name }}</span>
                                                                    </label>
                                                                @endforeach
                                                                <br>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    {{-- <div class="form-group">
                                                        <label for="exampleInputEmail1">หมายเหตุ</label>
                                                        <textarea class="form-control" placeholder="หมายเหตุ" id="note" name="note" style="height: 100px"></textarea>

                                                    </div> --}}

                                                    <div class="card-footer" align="right">
                                                        <button type="submit"
                                                            class="btn btn-success-light mt-1">บันทึก</button>
                                                        {{-- <a href="#" class="btn btn-success-light mt-1">บันทึก</a> --}}
                                                        <a href="{{ route('all.role') }}"
                                                            class="btn btn-danger-light mt-1">ยกเลิก</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab_content">
                                                <div class="card-body" id="tab2">
                                                    <div class="page-header">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a
                                                                    href="#">สิทธิ์การเข้าถึงทุกเมนูย่อย</a></li>
                                                        </ol>
                                                        <div>
                                                            <a href="#" class="btn btn-sm btn-primary">ทั้งหมด</a>
                                                            <a href="#" class="btn btn-sm btn-secondary">บางส่วน</a>
                                                        </div>
                                                    </div>
                                                    <p>- กรณีเลือกทั้งหมด</p>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="example-checkbox" value="option1">
                                                                <span class="custom-control-label">เพิ่ม</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-3">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="example-checkbox" value="option2">
                                                                <span class="custom-control-label">ดู</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-3">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="example-checkbox" value="option3">
                                                                <span class="custom-control-label">แก้ไข</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-3">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="example-checkbox" value="option4">
                                                                <span class="custom-control-label">รายการ</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <p>- กรณีเลือกบางส่วน</p>
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox ">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-radio"
                                                                                        value="option4">
                                                                                    <span
                                                                                        class="custom-control-label">ทั้งหมด</span>
                                                                                </label>
                                                                            </div>


                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">เพิ่ม</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option2">
                                                                                    <span
                                                                                        class="custom-control-label">ดู</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">ลบ</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox ">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-radio"
                                                                                        value="option4">
                                                                                    <span
                                                                                        class="custom-control-label">ทั้งหมด</span>
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">เพิ่ม</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option2">
                                                                                    <span
                                                                                        class="custom-control-label">ดู</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">ลบ</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                    </div>

                                                    <div class="row">
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox ">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-radio"
                                                                                        value="option4">
                                                                                    <span
                                                                                        class="custom-control-label">ทั้งหมด</span>
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">เพิ่ม</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option2">
                                                                                    <span
                                                                                        class="custom-control-label">ดู</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">ลบ</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox ">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-radio"
                                                                                        value="option4">
                                                                                    <span
                                                                                        class="custom-control-label">ทั้งหมด</span>
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">เพิ่ม</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option2">
                                                                                    <span
                                                                                        class="custom-control-label">ดู</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        name="example-checkbox"
                                                                                        value="option1">
                                                                                    <span
                                                                                        class="custom-control-label">ลบ</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <label
                                                                                    class="custom-control custom-checkbox">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // checkDefaultmain
        $('#checkDefaultmain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        })
    </script>
@endsection
