@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            {{-- <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('all.permission') }}">บริหารจัดการผู้ใช้งาน</a></li>
                <li class="breadcrumb-item active" aria-current="page">จัดการสิทธิ์ต่าง ๆ ในระบบ</li>
            </ol> --}}
        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">ข้อมูลบุคลากรที่ปฏิบัติภารกิจด้านยาเสพติด</div>
                        <div class="btn-list">
                            {{-- @can('school.add') --}}
                                <a href="#" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i>
                                    เพิ่มข้อมูล</a>
                            {{-- @endcan --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>รายงานสถิตินำเข้าผลการปฏิบัติงาน</h3>
                    </div>
                    <!-- TABLE WRAPPER -->
                </div>
                <!-- SECTION WRAPPER -->
            </div>
        </div>
        <!-- ROW-1 CLOSED -->

    </div>
@endsection
