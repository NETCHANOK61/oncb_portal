@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">บริหารจัดการบทบาท
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    เพิ่มข้อมูล
                </li>
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
                                <li>สิทธิ์การเข้าใช้งาน</li>
                            </ul>

                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <form id="permissionForm" action="{{ route('admin.update.roles', $role->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">บทบาท</label>
                                                        <input type="text"
                                                            class="form-control @error('roleName') is-invalid @enderror"
                                                            id="roleName" name="roleName" placeholder="ชื่อบทบาท"
                                                            value="{{ $role->name }}" />
                                                        @error('roleName')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="subMenuNameInput">สถานะ</label>
                                                    <div class="form-group">
                                                        <label class="switch">
                                                            <input type="checkbox" name="status_menu"
                                                                {{ $role->status == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                            <span class="status-text on-text">เปิด</span>
                                                            <span class="status-text off-text">ปิด</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">หมายเหตุ</label>
                                                <textarea class="form-control" placeholder="หมายเหตุ" id="note" name="note" style="height: 100px">{{ $role->note }}</textarea>

                                            </div>
                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                <a href="{{ route('admin.roles.index') }}"
                                                    class="btn btn-danger-light mt-1">ยกเลิก</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- tab 2 --}}
                                <div class="tab_content">
                                    <form id="permissionForm" action="{{ route('admin.roles.permission', $role->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h3>Role Permission</h3>
                                                    <label class="custom-control custom-checkbox" for="checkDefaultmain">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="checkDefaultmain">
                                                        <span class="custom-control-label">Permission All</span>
                                                    </label>
                                                </div>
                                            </div>

                                            @foreach ($permission_group as $group)
                                                <div class="row">
                                                    <div class="col-3">
                                                        @php
                                                            $group_permissions = App\Models\User::getPermissionByGroupName(
                                                                $group->group_name,
                                                            );
                                                        @endphp
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="group_permissions[]" value="{{ $group->group_name }}"
                                                                {{ in_array($group->group_name, $rolePermissions) ? 'checked' : '' }}>
                                                            <span
                                                                class="custom-control-label">{{ $group->group_name }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-9">
                                                        @foreach ($group_permissions as $permission)
                                                            <label class="custom-control custom-checkbox"
                                                                for="checkDefault{{ $permission->id }}">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="permission[]"
                                                                    id="checkDefault{{ $permission->id }}"
                                                                    value="{{ $permission->name }}"
                                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                                <span
                                                                    class="custom-control-label">{{ $permission->name }}</span>
                                                            </label>
                                                        @endforeach
                                                        <br>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="card-footer" align="right">
                                                <button type="submit"
                                                    class="btn btn-success-light mt-1">บันทึกสิทธิ์</button>
                                                <a href="{{ route('admin.roles.index') }}"
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
    <script type="text/javascript">
        // checkDefaultmain
        $('#checkDefaultmain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        })
    </script>
@endsection
