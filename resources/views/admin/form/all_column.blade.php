@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">บริหารจัดการฟีลด์ข้อมูลในฟอร์ม</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">บริหารจัดการฟีลด์ข้อมูลในฟอร์ม</div>
                        <div class="btn-list">
                            {{-- <a href="{{ route('admin.showForm') }}" class="btn btn-info ml-auto"><i class="fa fa-play"></i>
                                Preview</a> --}}
                            <a href="{{ route('admin.addColumn') }}" class="btn btn-primary ml-auto"><i
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
                                        <th class="text-center">ชื่อฟีลด์ข้อมูล</th>
                                        <th class="text-center">ป้ายฟีลด์ข้อมูล</th>
                                        <th class="text-center">ตาราง</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->field_name }}</td>
                                            <td>{{ $item->label_name }}</td>
                                            <td>{{ $item->table_name == null ? '-' : $item->table_name }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-default"><span
                                                        class="{{ $item->status ? 'able_animation' : 'unable_animation' }}"></span>
                                                    {{ $item->status ? 'เปิด' : 'ปิด' }}</span>
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('admin.edit.column', $item->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-pencil"></i>
                                                    แก้ไข</a> --}}
                                                @if ($item->status == 0)
                                                <a href="{{ route('admin.returnColumn', $item->id) }}"
                                                    class="btn btn-light"><i class="fa fa-undo"></i>
                                                    เรียกคืน</a>
                                                @else
                                                <a href="{{ route('admin.deleteColumn', $item->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i>
                                                    ลบ</a>
                                                @endif
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
