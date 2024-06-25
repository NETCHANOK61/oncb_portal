@extends('admin.dashboard')

@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.all.menu') }}">All menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลเมนูรองหรือเมนูย่อย</li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="card">
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="tab_wrapper first_tab">
                            <ul class="tab_list">
                                <li class="active">ข้อมูลทั่วไป</li>
                            </ul>
                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <form id="roleForm" action="{{ route('admin.update.child', $currentMenu->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="menuNameInput">ชื่อเมนู</label>
                                                        <input type="text"
                                                            class="form-control @error('th_name') is-invalid @enderror"
                                                            id="th_name" name="th_name"
                                                            value="{{ $currentMenu->th_name }}" />
                                                        @error('th_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="urlInput">route/URL ของเมนู</label>
                                                        <input id="urlText" type="text"
                                                            class="form-control @error('urlText') is-invalid @enderror"
                                                            name="urlText" value="{{ $currentMenu->route }}" />
                                                        @error('urlText')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="statusMenu">สถานะ</label>
                                                    <div class="form-group">
                                                        <label class="switch">
                                                            <input type="checkbox" value="1"
                                                                {{ $currentMenu->status_menu ? 'checked' : '' }}
                                                                name="status_menu" id="status_menu">
                                                            <span class="slider round"></span>
                                                            <span class="status-text on-text">เปิด</span>
                                                            <span class="status-text off-text">ปิด</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12" id="menuSelector" style="display: none">
                                                    <label for="menuSelector">ย้ายเมนูไปที่</label>
                                                    <select class="move_to_select form-control mb-3" name="new_parent_id">
                                                        <option value="" selected>เลือกเมนูหลักหรือเมนูรองที่ต้องการ
                                                        </option>
                                                        @foreach ($filteredMenus as $menu)
                                                            @if ($menu->children->isNotEmpty())
                                                                <optgroup label="{{ $menu->th_name }}">
                                                                    <option value="{{ $menu->id }}">
                                                                        (เมนูหลัก)
                                                                        {{ $menu->th_name }}
                                                                    </option>
                                                                    @foreach ($menu->children as $child)
                                                                        @if ($currentMenu->id != $child->id && $currentMenu_level != 2)
                                                                            <option value="{{ $child->id }}">
                                                                                (เมนูรอง)
                                                                                {{ $child->th_name }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </optgroup>
                                                            @else
                                                                <optgroup label="{{ $menu->th_name }}">
                                                                    <option value="{{ $menu->id }}">
                                                                        (เมนูหลัก)
                                                                        {{ $menu->th_name }}
                                                                    </option>
                                                                </optgroup>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                <a href="{{ route('admin.all.menu') }}"
                                                    class="btn btn-danger-light mt-1">ยกเลิก</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // When status switch changes
            $('#status_menu').change(function() {
                const mainMenu = $('#menuSelector');
                if (!$(this).prop('checked')) {
                    Swal.fire({
                        title: 'ต้องการปิดเมนูหรือไม่?',
                        text: "คุณสามารถปิดเมนูนี้ หรือย้ายไปยังเมนูหลักอื่นได้",
                        icon: 'warning',
                        showCancelButton: true,
                        showDenyButton: true,
                        confirmButtonColor: '#3085d6',
                        denyButtonColor: '#d6aa30',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ปิดเมนู',
                        denyButtonText: 'ย้ายไปยังเมนูอื่น',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isDenied) {
                            mainMenu.show();
                        }
                    });
                }
            });
            $(`.move_to_select`).select2({
                tags: true,
                width: "100%",
            });
        });
    </script>
@endsection
