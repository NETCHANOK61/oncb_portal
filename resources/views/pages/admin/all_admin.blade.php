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
                        <div class="card-title">All Admin User</div>
                        <div class="btn-list">
                            <a href="{{ route('add.admin') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i>
                                เพิ่มข้อมูล</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
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
                                    @foreach ($allAdmin as $key => $admin)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>แผนกทดสอบ</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>AD</td>
                                            <td>
                                                {{-- @foreach ($admin->roles as $role)
                                                    <span class="badge badge-pill badge-default">{{ $role }}</span>
                                                @endforeach --}}
                                                {{-- <span class="badge badge-pill badge-default">{{ $admin->role }}</span> --}}
                                            </td>
                                            <td>
                                                <a href="#"
                                                    class="{{ $admin->status == 'active' ? 'btn btn-secondary-light' : 'btn btn-danger-light' }}">
                                                    {{ $admin->status == 'active' ? 'อนุมัติ' : 'ไม่อนุมัติ' }}
                                                </a>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="" class="btn btn-success"><i class="fa fa-eye"></i> ดู</a>
                                                <a href="" class="btn btn-warning"><i class="fa fa-pencil"></i>
                                                    แก้ไข</a>
                                                <a href="" class="btn btn-info"><i class="fa fa-tag"></i>
                                                    กำหนดสิทธิ์</a>
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
@endsection
