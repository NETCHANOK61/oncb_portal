@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('portal.allSystem') }}">ระบบของหน่วยงาน
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
                                {{-- <li>สิทธิ์การเข้าใช้งาน</li> --}}
                            </ul>

                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <form id="roleForm" action="{{ route('portal.storeSystem') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="fieldInput">ชื่อระบบเต็ม (ภาษาไทย)</label>
                                                        <input type="text"
                                                            class="form-control @error('fullname') is-invalid @enderror"
                                                            id="fullname" name="fullname" />
                                                    </div>
                                                    @error('fullname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="fieldSizeInput">ชื่อย่อ (ภาษาอังกฤษ)</label>
                                                        <input type="text"
                                                            class="form-control @error('en_name') is-invalid @enderror"
                                                            id="en_name" name="en_name" />
                                                    </div>
                                                    @error('en_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="labelInput">URL</label>
                                                        <input type="text"
                                                            class="form-control @error('url') is-invalid @enderror"
                                                            id="url" name="url" />
                                                    </div>
                                                    @error('url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="status">สถานะ</label>
                                                    <div class="form-group">
                                                        <label class="switch">
                                                            <input type="checkbox" checked name="status">
                                                            <span class="slider round"></span>
                                                            <span class="status-text on-text">เปิด</span>
                                                            <span class="status-text off-text">ปิด</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                <a href="{{ route('portal.allSystem') }}"
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