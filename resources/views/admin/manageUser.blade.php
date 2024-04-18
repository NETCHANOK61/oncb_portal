@extends('admin.dashboard')
@section('admin')
<div class="side-app">

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li>
            <li class="breadcrumb-item active" aria-current="page">จัดการผู้ใช้งาน</li>
        </ol>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">หน้าหลัก</div>
                    <div class="btn-list">
                        <!-- <a href="batt_manage.html" class="btn btn-primary ml-auto">เพิ่มข้อมูล</a> -->
                        <!-- <a href="batt_add.html" class="btn btn-primary ml-auto">เพิ่มข้อมูล</a> -->
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example"
                            class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                                <tr align="center">
                                    <th class="text-center">ลำดับ</th>
                                    <th class="text-center">แผนก</th>
                                    <th class="text-center">ชื่อ - สกุล</th>
                                    <th class="text-center">Login Type</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">ผลการอนุมัติ</th>
                                    <th class="text-center">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center">
                                    <td>1</td>
                                    <td>ศทส.</td>
                                    <td>สมรัก คำสิงห์</td>
                                    <td>80</td>
                                    <td>1</td>
                                    <td><a href="#" class="btn btn-secondary-light ">อนุมัติ</a></td>
                                    <td class="text-center align-middle">
                                        <a href="user_management_view.html" class="btn btn-success"><i
                                            class="fa fa-eye"></i> ดู</a>
                                        <a href="user_management_edit.html" class="btn btn-warning"><i
                                            class="fa fa-pencil"></i> แก้ไข</a>
                                        <a href="user_management_permission.html" class="btn btn-info"><i
                                            class="fa fa-tag"></i> กำหนดสิทธิ์</a>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>2</td>
                                    <td>ปปส. ภาค 2</td>
                                    <td>กรณ์ บุหรั่นฉาย</td>
                                    <td>80</td>
                                    <td>1</td>
                                    <td><a href="#" class="btn btn-danger-light ">ไม่อนุมัติ</a></td>
                                    <td class="text-center align-middle">
                                        <a href="user_management_view.html" class="btn btn-success"><i
                                            class="fa fa-eye"></i> ดู</a>
                                        <a href="user_management_edit.html" class="btn btn-warning"><i
                                            class="fa fa-pencil"></i> แก้ไข</a>
                                        <a href="user_management_permission.html" class="btn btn-info"><i
                                            class="fa fa-tag"></i> กำหนดสิทธิ์</a>
                                    </td>
                                </tr>
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
@endsection
