@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">บริหารจัดการบทบาท
                    </a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">จัดการบทบาทของผู้ใช้งาน</a></li>
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
                                {{-- <li>สิทธิ์การเข้าใช้งาน</li> --}}
                            </ul>

                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <form id="roleForm" action="{{ route('admin.users.store') }}" method="POST">
                                        @csrf
                                        <div class="card-body" id="tab1">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="firstnameInput">ชื่อ</label>
                                                        <input type="text" class="form-control" id="firstname"
                                                            name="firstname" placeholder="ชื่อ" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="lastnameInput">นามสกุล</label>
                                                        <input type="text" class="form-control" id="lastname"
                                                            name="lastname" placeholder="นามสกุล" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="emailInput">อีเมล์</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="อีเมล์" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="passwordInput">รหัสผ่าน</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" placeholder="รหัสผ่าน" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="roleInput">บทบาท</label>
                                                        <span>
                                                            <div class="form-group">
                                                                <select name="roleGroup" class="single-select">
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->name }}">
                                                                            {{ $role->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h3>Permission</h3>
                                                            <label class="custom-control custom-checkbox"
                                                                for="checkDefaultmain">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="checkDefaultmain">
                                                                <span class="custom-control-label">Permission
                                                                    All</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    @foreach ($permission_group as $group)
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input"
                                                                        name="example-checkbox" value="option1">
                                                                    <span
                                                                        class="custom-control-label">{{ $group->group_name }}</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-9">
                                                                @foreach ($permissions as $permission)
                                                                    <label class="custom-control custom-checkbox"
                                                                        for="checkDefault{{ $permission->id }}">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input"
                                                                            name="permission[]"
                                                                            id="checkDefault{{ $permission->id }}"
                                                                            value="{{ $permission->name }}">
                                                                        <span
                                                                            class="custom-control-label">{{ $permission->name }}</span>
                                                                    </label>
                                                                @endforeach
                                                                <br>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div> --}}
                                            </div>

                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                <a href="{{ route('admin.users.index') }}"
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
@endsection
