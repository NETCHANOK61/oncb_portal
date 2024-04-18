@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li>
                <li class="breadcrumb-item"><a href="{{ route('all.role.permission') }}">All Role in Permission</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูล</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">บริหารจัดการบทบาท</div>
                        <div class="btn-list">
                            <a href="{{ route('add.role.permission') }}" class="btn btn-primary ml-auto"><i
                                    class="fa fa-plus"></i>
                                เพิ่มข้อมูล</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <table id="example" class="table table-striped table-bordered text-nowrap w-100"> --}}
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr align="center">
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อบทบาท</th>
                                        <th class="text-center">สิทธิ์</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @foreach ($item->permissions as $prem)
                                                    <span class="badge badge-pill badge-default">{{ $prem->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a href="#" class="btn btn-success"><i class="fa fa-eye"></i>
                                                    ดู</a>
                                                <a href="{{ route('admin.edit.role', $item->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-pencil"></i>
                                                    แก้ไข</a>
                                                <a href="{{ route('admin.roles.delete', $item->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i>
                                                    ลบ</a>
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
