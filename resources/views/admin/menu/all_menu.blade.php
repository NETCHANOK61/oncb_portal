@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">บริหารจัดการเมนู</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">บริหารจัดการเมนู</div>
                        <div class="btn-list">
                            <a href="{{ route('admin.add.menu') }}" class="btn btn-primary ml-auto"><i
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
                                        <th class="text-center">ชื่อเมนู</th>
                                        <th class="text-center">ไอคอน</th>
                                        <th class="text-center">เมนูรอง</th>
                                        <th class="text-center">เมนูย่อย</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->menu_name }}</td>
                                            <td><i class="{{ $item->menu_icon }}" style="font-size: 25px"></i></td>
                                            <td>{{ $item->secondary_menu == null ? '-' : $item->secondary_menu }}</td>
                                            <td>{{ $item->sub_menu == null ? '-' : $item->sub_menu }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-default"><span
                                                        class="{{ $item->status_menu ? 'able_animation' : 'unable_animation' }}"></span>
                                                    {{ $item->status_menu ? 'เปิด' : 'ปิด' }}</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info"><i class="fa fa-eye"></i>
                                                    รายละเอียด</a>
                                                <a href="{{ route('admin.edit.menu', $item->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-pencil"></i>
                                                    แก้ไข</a>
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
