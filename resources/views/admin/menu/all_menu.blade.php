@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">บริหารจัดการเมนู</li>
            </ol>
        </div>

        <!-- SEARCH FORM -->
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="menuSelect" class="form-label">เลือกเมนู:</label>
                        <select id="menuSelect" class="form-control">
                            <option value="">ทั้งหมด</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->th_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="searchInput" class="form-label">ค้นหา:</label>
                        <input type="text" id="searchInput" class="form-control" placeholder="ค้นหา...">
                    </div>
                    <div class="col-md-auto d-flex align-items-end">
                        <a href="{{ route('admin.add.menu') }}" class="btn btn-primary w-full">
                            <i class="fa fa-plus"></i> สร้างเมนูใหม่
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN MENU SECTIONS -->
        @foreach ($menus as $menu)
            <div class="card" id="menuSection_{{ $menu->id }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title"><i class="{{ $menu->icon }}" style="font-size: 30px"></i> {{ $menu->th_name }}
                            <span class="badge badge-pill badge-default">
                                <span class="{{ $menu->status_menu ? 'able_animation' : 'unable_animation' }}"></span>
                                {{ $menu->status_menu ? 'เปิด' : 'ปิด' }}
                            </span>
                        </h5>
                    </div>
                    <div class="btn-list">
                        <a href="{{ route('admin.edit.menu', $menu->id) }}" class="btn btn-warning">
                            <i class="fa fa-pencil"></i> แก้ไข
                        </a>
                        <a href="{{ route('admin.add.child', $menu->id) }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> เพิ่มเมนูรอง / เมนูย่อย
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <p>รายการเมนู</p>
                        <table id="menuTable_{{ $menu->id }}" class="table table-striped table-bordered text-nowrap">
                            <thead>
                                <tr align="center">
                                    <th class="text-center">ลำดับ</th>
                                    <th class="text-center">ชื่อเมนู</th>
                                    <th class="text-center">ระดับของเมนู</th>
                                    <th class="text-center">สถานะ</th>
                                    <th class="text-center">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($menu->children as $child)
                                    @php
                                        $level = 2;
                                    @endphp
                                    <tr align="center">
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $child->th_name }}</td>
                                        <td>ระดับ {{ $level }}</td>
                                        <td>
                                            <span class="badge badge-pill badge-default">
                                                <span
                                                    class="{{ $child->status_menu ? 'able_animation' : 'unable_animation' }}"></span>
                                                {{ $child->status_menu ? 'เปิด' : 'ปิด' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.edit.child', $child->id) }}" class="btn btn-warning"><i
                                                    class="fa fa-pencil"></i> แก้ไข</a>
                                        </td>
                                    </tr>

                                    @foreach ($child->children as $subChild)
                                        @php
                                            $level = 3;
                                        @endphp
                                        <tr align="center">
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $subChild->th_name }}</td>
                                            <td>ระดับ {{ $level }}</td>
                                            <td>
                                                <span class="badge badge-pill badge-default">
                                                    <span
                                                        class="{{ $subChild->status_menu ? 'able_animation' : 'unable_animation' }}"></span>
                                                    {{ $subChild->status_menu ? 'เปิด' : 'ปิด' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit.child', $subChild->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-pencil"></i> แก้ไข</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        <script>
            $(document).ready(function() {
                var tables = [];
                @foreach ($menus as $menu)
                    var tableId = 'menuTable_{{ $menu->id }}';
                    tables.push($('#' + tableId).DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                        "language": {
                            "paginate": {
                                "next": '<i class="fa fa-angle-right"></i>',
                                "previous": '<i class="fa fa-angle-left"></i>'
                            }
                        }
                    }));
                @endforeach

                // Global search across all tables
                $('#searchInput').on('keyup', function() {
                    var searchText = $(this).val().toLowerCase();
                    var selectedMenuId = $('#menuSelect').val();
                    $('.card').each(function() {
                        var cardId = $(this).attr('id');
                        var menuId = cardId.split('_')[1];
                        var cardTitle = $(this).find('.card-title').text().toLowerCase();
                        var showCard = true;
                        if (selectedMenuId && selectedMenuId !== menuId) {
                            showCard = false;
                        }
                        if (showCard && cardTitle.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>

    </div>
@endsection
