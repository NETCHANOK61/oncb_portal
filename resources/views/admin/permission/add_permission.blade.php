@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">บริหารจัดการบทบาท
                    </a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">จัดการสิทธิ์ต่าง ๆ ในระบบ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    เพิ่มข้อมูล
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
                                    <form id="permissionForm" action="{{ route('admin.permissions.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">สิทธิ์</label>
                                                        <input type="text" class="form-control" id="roleName"
                                                            name="roleName" placeholder="ชื่อสิทธิ์" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputname1">กลุ่มสิทธิ์</label>
                                                        <span>
                                                            <div class="form-group">
                                                                <select name="roleGroup" multiple="multiple"
                                                                    class="single-select">
                                                                    <option value="data_recording">การบันทึกข้อมูล</option>
                                                                    <option value="data_status">สถานะการนำเข้าข้อมูล</option>
                                                                    <option value="data_report">รายงาน</option>
                                                                    <option value="other_system">เชื่อมโยงระบบอื่น ๆ</option>
                                                                </select>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="subMenuNameInput">สถานะ</label>
                                                    <div class="form-group">
                                                        <label class="switch">
                                                            <input type="checkbox" checked name="status_menu">
                                                            <span class="slider round"></span>
                                                            <span class="status-text on-text">เปิด</span>
                                                            <span class="status-text off-text">ปิด</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">หมายเหตุ</label>
                                                <textarea class="form-control" placeholder="หมายเหตุ" id="note" name="note" style="height: 100px"></textarea>

                                            </div>

                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                {{-- <a href="#" class="btn btn-success-light mt-1">บันทึก</a> --}}
                                                <a href="{{ route('admin.permissions.index') }}"
                                                    class="btn btn-danger-light mt-1">ยกเลิก</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
