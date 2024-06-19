@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="{{ route('all.permission') }}">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">จัดการสิทธิ์ต่าง ๆ ในระบบ</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">บริหารจัดการสิทธิ์</div>
                        <div class="btn-list">
                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary ml-auto"><i
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
                                        <th class="text-center">ชื่อสิทธิ์</th>
                                        <th class="text-center">กลุ่มสิทธิ์</th>
                                        {{-- <th class="text-center">บทบาท</th> --}}
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @switch($item->group_name)
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

                                                    @default
                                                        {{ $item->group_name }}
                                                @endswitch
                                            </td>
                                            {{-- <td>
                                                @foreach ($item->roles as $prem)
                                                    <span class="badge badge-pill badge-default">{{ $prem->name }}</span>
                                                @endforeach
                                            </td> --}}
                                            <td>
                                                <span class="badge badge-pill badge-default">
                                                    <span
                                                        class="{{ $item->status ? 'able_animation' : 'unable_animation' }}"></span>
                                                    {{ $item->status ? 'เปิด' : 'ปิด' }}
                                                </span>
                                            </td>
                                            <td>
                                                {{-- <a href="#" class="btn btn-success"><i class="fa fa-eye"></i> ดู</a> --}}
                                                <a href="{{ route('admin.permissions.edit', $item->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-pencil"></i> แก้ไข</a>
                                                {{-- <a href="{{ route('delete.permission', $item->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a> --}}
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
