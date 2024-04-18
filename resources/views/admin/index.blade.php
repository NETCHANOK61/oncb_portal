@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW OPEN -->
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ค้นหาผู้ใช้งาน</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-separated">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputname1">จังหวัด</label>
                                        <span>
                                            <select multiple="multiple" class="single-select" disabled>
                                                <option value="00" disabled>เลือกจังหวัด</option>
                                                <option value="01" selected>ราชบุรี</option>
                                                <option value="02">จังหวัด</option>
                                                <option value="03">จังหวัด</option>
                                            </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputname1">อำเภอ</label>
                                        <span>
                                            <div class="form-group">
                                                <select multiple="multiple" class="single-select">
                                                    <option value="00" disabled>เลือกอำเภอ</option>
                                                    <option value="01">อำเภอ</option>
                                                    <option value="02">อำเภอ</option>
                                                    <option value="03">อำเภอ</option>
                                                </select>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><span class="able_animation"></span>
                            ผู้ใช้งานที่รอตรวจสอบคุณสมบัติ</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">หมายเลขบัตร</th>
                                        <th class="text-center">ชื่อ-สกุล</th>
                                        <th class="text-center">อำเภอ</th>
                                        <th class="text-center">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        <td class="text-nowrap align-middle">1</td>
                                        <td class="text-nowrap align-middle">9876543212345</td>
                                        <td class="text-nowrap align-middle">นายทดสอบ ใจกล้า</td>
                                        <td class="text-nowrap align-middle">Admin</td>
                                        <td>
                                            <button class="btn btn-pill"><i class="fa fa-clock-o"></i>
                                                กำลังดำเนินการ...</button>
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td class="text-nowrap align-middle">2</td>
                                        <td class="text-nowrap align-middle">1234567891234</td>
                                        <td class="text-nowrap align-middle">นางสวยใส ดีดี</td>
                                        <td class="text-nowrap align-middle">User</td>
                                        <td>
                                            <button class="btn btn-pill"><i class="fa fa-clock-o"></i>
                                                กำลังดำเนินการ...</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><span class="unable_animation"></span>
                            ผู้ใช้งานที่ยืนยันคุณสมบัติ</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">หมายเลขบัตร</th>
                                        <th class="text-center">ชื่อ-สกุล</th>
                                        <th class="text-center">อำเภอ</th>
                                        <th class="text-center">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr align="center">
                                        <td class="text-nowrap align-middle">1</td>
                                        <td class="text-nowrap align-middle">2223212345678</td>
                                        <td class="text-nowrap align-middle">นางสาวหวานใจ ที่สุด</td>
                                        <td class="text-nowrap align-middle">User</td>
                                        <td>
                                            <button class="btn btn-success btn-pill"><i class="fa fa-check-circle"></i>
                                                สำเร็จ</button>
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td class="text-nowrap align-middle">2</td>
                                        <td class="text-nowrap align-middle">1234567891234</td>
                                        <td class="text-nowrap align-middle">นายสุดฟ้า สะเทือนดิน</td>
                                        <td class="text-nowrap align-middle">User</td>
                                        <td>
                                            <button class="btn btn-success btn-pill"><i class="fa fa-check-circle"></i>
                                                สำเร็จ</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>
        <!-- ROW CLOSED -->
    </div>
@endsection
