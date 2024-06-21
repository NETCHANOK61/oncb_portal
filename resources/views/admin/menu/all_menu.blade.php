@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
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
                            <a href="{{ route('admin.add.menu') }}" class="btn btn-primary ml-auto">
                                <i class="fa fa-plus"></i> เพิ่มข้อมูล
                            </a>
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
                                        <th class="text-center">ระดับของเมนู</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($menus as $menu)
                                        @php
                                            $level = 1;
                                        @endphp
                                        <tr align="center">
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $menu->th_name }}</td>
                                            <td><i class="{{ $menu->icon }}" style="font-size: 25px"></i></td>
                                            <td>ระดับ {{ $level }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-default">
                                                    <span
                                                        class="{{ $menu->status_menu ? 'able_animation' : 'unable_animation' }}"></span>
                                                    {{ $menu->status_menu ? 'เปิด' : 'ปิด' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info"><i class="fa fa-eye"></i>
                                                    รายละเอียด</a>
                                                <a href="{{ route('admin.edit.menu', $menu->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-pencil"></i> แก้ไข</a>
                                            </td>
                                        </tr>

                                        @foreach ($menu->children as $child)
                                            @php
                                                $level = 2;
                                            @endphp
                                            <tr align="center">
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $child->th_name }}</td>
                                                <td><i class="{{ $child->icon }}" style="font-size: 25px"></i></td>
                                                <td>ระดับ {{ $level }}</td>
                                                <td>
                                                    <span class="badge badge-pill badge-default">
                                                        <span
                                                            class="{{ $child->status_menu ? 'able_animation' : 'unable_animation' }}"></span>
                                                        {{ $child->status_menu ? 'เปิด' : 'ปิด' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-info"><i class="fa fa-eye"></i>
                                                        รายละเอียด</a>
                                                    <a href="{{ route('admin.edit.menu', $child->id) }}"
                                                        class="btn btn-warning"><i class="fa fa-pencil"></i> แก้ไข</a>
                                                </td>
                                            </tr>

                                            @foreach ($child->children as $subChild)
                                                @php
                                                    $level = 3;
                                                @endphp
                                                <tr align="center">
                                                    <td>{{ $counter++ }}</td>
                                                    <td>{{ $subChild->th_name }}</td>
                                                    <td><i class="{{ $subChild->icon }}" style="font-size: 25px"></i></td>
                                                    <td>ระดับ {{ $level }}</td>
                                                    <td>
                                                        <span class="badge badge-pill badge-default">
                                                            <span
                                                                class="{{ $subChild->status_menu ? 'able_animation' : 'unable_animation' }}"></span>
                                                            {{ $subChild->status_menu ? 'เปิด' : 'ปิด' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-info"><i class="fa fa-eye"></i>
                                                            รายละเอียด</a>
                                                        <a href="{{ route('admin.edit.menu', $subChild->id) }}"
                                                            class="btn btn-warning"><i class="fa fa-pencil"></i> แก้ไข</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
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
