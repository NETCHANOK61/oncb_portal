@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.allColumn') }}">จัดการฟอร์มกรอกข้อมูล
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
                                    <form id="roleForm" action="{{ route('admin.storeColumn') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="fieldInput">ชื่อฟีลด์ข้อมูล</label>
                                                        <input type="text"
                                                            class="form-control @error('field_name') is-invalid @enderror"
                                                            id="field_name" name="field_name" />
                                                    </div>
                                                    @error('field_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="fieldTypeInput">ประเภทข้อมูล</label>
                                                        <select id="dataType" name="dataType" class="select2-icon">
                                                            @foreach ($columnTypes as $type)
                                                                <option value="{{ $type }}">{{ $type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('dataType')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="fieldSizeInput">ขนาดข้อมูล</label>
                                                        <input type="text"
                                                            class="form-control @error('field_size') is-invalid @enderror"
                                                            id="field_size" name="field_size" />
                                                    </div>
                                                    @error('field_size')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="labelInput">ป้ายฟีลด์ข้อมูล (label)</label>
                                                        <input type="text"
                                                            class="form-control @error('label_name') is-invalid @enderror"
                                                            id="label_name" name="label_name" />
                                                    </div>
                                                    @error('label_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="tableInput">ตารางฐานข้อมูล</label>
                                                        <select id="table_name" name="table_name" class="select2-icon">
                                                            <option value="tbl_Pr_school_test">tbl_Pr_school_test</option>
                                                        </select>
                                                    </div>
                                                    @error('table_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="commentInput">หมายเหตุ</label>
                                                        <input type="text"
                                                            class="form-control @error('comment') is-invalid @enderror"
                                                            id="comment" name="comment" />
                                                    </div>
                                                    @error('comment')
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
                                                <a href="{{ route('admin.allColumn') }}"
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
