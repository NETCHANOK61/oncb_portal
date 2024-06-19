@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">บริหารจัดการสิทธิ์
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    แก้ไขข้อมูลสิทธิ์
                </li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="card">
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li class="active">ข้อมูลทั่วไป</li>
                                {{-- <li>สิทธิ์การเข้าใช้งาน</li> --}}
                            </ul>

                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <form id="permissionForm"
                                        action="{{ route('admin.update.permissions', $permission->id) }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">สิทธิ์</label>
                                                        <input type="text"
                                                            class="form-control @error('permissionName') is-invalid @enderror"
                                                            id="permissionName" name="permissionName"
                                                            value="{{ $permission->name }}" />
                                                    </div>
                                                    @error('permissionName')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputname1">กลุ่มสิทธิ์</label>
                                                        <span>
                                                            <div class="form-group">
                                                                <select name="permissionGroup" multiple="multiple"
                                                                    class="single-select">
                                                                    @foreach (['data_recording', 'data_status', 'data_report', 'other_system'] as $group)
                                                                        <option value="{{ $group }}"
                                                                            {{ $permission->group_name == $group ? 'selected' : '' }}>
                                                                            @switch($group)
                                                                                @case('data_recording')
                                                                                    การบันทึกข้อมูล
                                                                                @break

                                                                                @case('data_status')
                                                                                    สถานะการนำเข้าข้อมูล
                                                                                @break

                                                                                @case('data_report')
                                                                                    รายงาน
                                                                                @break

                                                                                @case('other_system')
                                                                                    เชื่อมโยงระบบอื่น ๆ
                                                                                @break
                                                                            @endswitch
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="subMenuNameInput">สถานะ</label>
                                                    <div class="form-group">
                                                        <label class="switch">
                                                            <input type="checkbox"
                                                                {{ $permission->status == 1 ? 'checked' : '' }}
                                                                name="status">
                                                            <span class="slider round"></span>
                                                            <span class="status-text on-text">เปิด</span>
                                                            <span class="status-text off-text">ปิด</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">หมายเหตุ</label>
                                                <textarea class="form-control" placeholder="หมายเหตุ" id="note" name="note" style="height: 100px">{{ $permission->note }}</textarea>

                                            </div>

                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                {{-- <a href="#" class="btn btn-success-light mt-1">บันทึก</a> --}}
                                                <a href="{{ route('admin.permissions.index') }}"
                                                    class="btn btn-danger-light mt-1">ยกเลิก</a>
                                            </div>
                                        </div>
                                </div>

                                {{-- <div class="tab_content">
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
                                    </div> --}}
                                </form>
                            </div>
                        </div>
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
