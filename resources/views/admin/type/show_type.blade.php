@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">บริหารจัดการผู้ใช้งาน</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">ตัวอย่างป้ายประกาศ</li>
            </ol>

        </div>

        <!-- COL END -->
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="row row-cards">
                    @foreach ($data as $key => $item)
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="card">
                                <div class="card-body bg-light">
                                    <div class="row">
                                        <div class="col-2" style="text-align: center">
                                            <i class="{{ $item->type_icon }} text-{{ $item->type }}"
                                                style="font-size:80px"></i>
                                        </div>
                                        <div class="col-10" style="text-align: left">
                                            <h2 class="text-{{ $item->type }}">ประกาศ: <span
                                                    style="text-decoration: underline;">{{ $item->type_name }}</span>
                                            </h2>
                                            <h4 class="text-{{ $item->type }}">{{ $item->description }}
                                            </h4>
                                            <br>
                                            <p style="text-align: right; color: darkgrey">
                                                ประกาศเมื่อวันที่: {{ $item->created_at->locale('th')->isoFormat('lll') }}
                                            </p>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- COL END -->
                    @endforeach
                    <!-- TABLE WRAPPER -->
                </div>
                <!-- SECTION WRAPPER -->
            </div>
        </div>
        <!-- ROW-1 CLOSED -->
    </div>
@endsection
