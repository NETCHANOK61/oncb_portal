@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">All Property Type</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">All Property Type</div>
                        <div class="btn-list">
                            <a href="{{ route('admin.show.type') }}" class="btn btn-info ml-auto"><i class="fa fa-play"></i>
                                Preview</a>
                            <a href="{{ route('admin.add.type') }}" class="btn btn-primary ml-auto"><i
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
                                        <th class="text-center">ไอคอน</th>
                                        <th class="text-center">ชื่อ</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td><i class="{{ $item->type_icon }}" style="font-size: 28px"></i></td>
                                            <td>{{ $item->type_name }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-default"><span
                                                        class="{{ $item->status ? 'able_animation' : 'unable_animation' }}"></span>
                                                    {{ $item->status ? 'เปิด' : 'ปิด' }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit.type', $item->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-pencil"></i>
                                                    แก้ไข</a>
                                                @if ($item->status == 0)
                                                    <a href="{{ route('admin.return.type', $item->id) }}"
                                                        class="btn btn-light"><i class="fa fa-undo"></i>
                                                        เรียกคืน</a>
                                                @else
                                                    <a href="{{ route('admin.delete.type', $item->id) }}"
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
