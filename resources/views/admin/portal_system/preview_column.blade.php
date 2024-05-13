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
                                    <form id="roleForm" action="{{ route('admin.storeForm') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Input1">ชื่อ1</label>
                                                        <input type="text"
                                                            class="form-control @error('input_name1') is-invalid @enderror"
                                                            id="input_name1" name="input_name1" />
                                                    </div>
                                                </div>
                                                @foreach ($combinedData as $rowData)
                                                    @foreach ($rowData as $columnName => $columnInfo)
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="{{ $columnName }}">{{ $columnInfo['label_name'] }}</label>
                                                                @if ($columnInfo['data_type'] == 'int')
                                                                    <input type="number" class="form-control"
                                                                        id="{{ $columnName }}" name="{{ $columnName }}">
                                                                @elseif ($columnInfo['data_type'] == 'varchar' || $columnInfo['data_type'] == 'nvarchar')
                                                                    <input type="text" class="form-control"
                                                                        id="{{ $columnName }}" name="{{ $columnName }}">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                            <div class="card-footer" align="right">
                                                <button type="submit" class="btn btn-success-light mt-1">บันทึก</button>
                                                <a href="{{ route('admin.allColumn')}}" class="btn btn-danger-light mt-1">ยกเลิก</a>
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
