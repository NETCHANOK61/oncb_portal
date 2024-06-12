@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">ผู้ใช้งานที่ถูกยกเลิกคำขอ</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">รายการผู้ใช้งานที่ถูกยกเลิกคำขอลงทะเบียน</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr align="center">
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อ-นามสกุล</th>
                                        <th class="text-center">หมายเลขบัตร</th>
                                        <th class="text-center">อีเมล์</th>
                                        <th class="text-center">วันเวลาที่ลงทะเบียน</th>
                                        <th class="text-center">การจัดการ</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($request_user as $key => $item)
                                        <tr align="center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name . ' ' . $item->surname }}</td>
                                            <td>{{ $item->card_id }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->created_at->setTimezone('Asia/Bangkok')->format('d/m/Y เวลา H:i:s') }}
                                            </td>
                                            <td>
                                                <button class="btn btn-info" onclick="showPDF('{{ $item->file }}')">
                                                    <i class="fa fa-eye"></i> ดูเอกสารแนบ
                                                </button>
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
