@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">จัดการผู้ใช้งาน</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">บริหารจัดการผู้ใช้งาน</div>
                        <div class="btn-list">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary ml-auto"><i
                                    class="fa fa-plus"></i>
                                เพิ่มข้อมูล</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr align="center">
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อ</th>
                                        <th class="text-center">อีเมล์</th>
                                        <th class="text-center">บทบาท</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            {{-- <td>{{ $item->status }}</td> --}}
                                            <td>
                                                @foreach ($item->roles as $prem)
                                                    <span class="badge badge-pill badge-default">{{ $prem->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $item) }}" class="btn btn-warning"><i
                                                        class="fa fa-pencil"></i>
                                                    แก้ไขข้อมูล</a>
                                                {{-- <a href="{{ route('admin.users.edit', $item) }}"
                                                class="btn btn-warning"><i class="fa fa-pencil"></i>
                                                แก้ไข</a> --}}
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
