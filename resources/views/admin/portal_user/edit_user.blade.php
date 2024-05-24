@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('portal.allUser') }}">จัดการผู้ใช้งานทั้งหมด
                    </a></li>
                <li class="breadcrumb-item active"><a>แก้ไขข้อมูล</a></li>
            </ol>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 OPEN -->
        <div class="row">

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="col-md-12">
                        {{-- {{ route('admin.users.update', $user) }} --}}
                        <form id="roleForm" action="{{ route('portal.updateUser', $user->id) }}" method="POST">
                            @csrf
                            <div class="card-body p-6">
                                <div class="panel panel-primary">
                                    <div class="tab_wrapper first_tab">
                                        <ul class="nav panel-tabs">
                                            <li><a href="#tab1" data-toggle="tab">ข้อมูลทั่วไป</a></li>
                                            {{-- <li><a href="#tab2"class="active" data-toggle="tab">สิทธิ์การเข้าถึง</a></li> --}}
                                        </ul>

                                        <div class="content_wrapper">
                                            <div class="tab_content">
                                                <div class="card-body" id="tab1">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="firstnameInput">ชื่อ</label>
                                                                <input type="text" class="form-control" id="firstname"
                                                                    name="firstname" placeholder="ชื่อ"
                                                                    value="{{ $user->name }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="lastnameInput">นามสกุล</label>
                                                                <input type="text" class="form-control" id="lastname"
                                                                    name="lastname" placeholder="นามสกุล"
                                                                    value="{{ $user->surname }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="systemGroup">ระบบที่มีสิทธิ์เข้าถึงได้</label>
                                                                <select name="systemGroup[]" class="multi-select" multiple>
                                                                    @foreach ($data as $item)
                                                                        @php
                                                                            $system_name = $item->en_name;
                                                                        @endphp
                                                                        <option value="{{ $item->en_name }}"
                                                                            @if ($user->$system_name == '1') selected @endif>
                                                                            {{ $item->fullname }} ({{ $item->en_name }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer" align="right">
                                                        <button type="submit"
                                                            class="btn btn-success-light mt-1">บันทึก</button>
                                                        <a href="{{ route('portal.allUser') }}"
                                                            class="btn btn-danger-light mt-1">ยกเลิก</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
