@extends('admin.dashboard')
@section('admin')
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">สำหรับสถานศึกษา/ศูนย์พัฒนาเด็กเล็ก</li>
                <li class="breadcrumb-item active" aria-current="page">การบันทึกข้อมูล</li>
            </ol>
        </div>

        <!-- ROW-1 OPEN -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            {{-- <ol class="carousel-indicators">
                @foreach ($notice as $key => $item)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" @if ($key === 0) class="active" @endif></li>
                @endforeach
            </ol> --}}
            <div class="carousel-inner">
                <!-- Close button -->
                @foreach ($notice as $key => $item)
                    <div class="carousel-item @if ($key === 0) active @endif">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body" style="padding-top:5%">
                                        <div class="row">
                                            <div class="col-2" style="text-align: center; padding-top:5%">
                                                <i class="{{ $item->type_icon }} text-{{ $item->type }}"
                                                    style="font-size:100px"></i>
                                            </div>
                                            <div class="col-9" style="text-align: left;">
                                                <h2 class="text-{{ $item->type }}">ประกาศ: <span
                                                        style="text-decoration: underline;">{{ $item->type_name }}</span>
                                                </h2>
                                                <h4 class="text-{{ $item->type }}">{{ $item->description }}</h4>
                                                <br>
                                                <button class="btn btn-link text-light" onclick="closeCarousel()">
                                                    <span aria-hidden="true">ปิดป้ายประกาศ</span>
                                                </button>
                                                <p style="text-align: right; color: darkgrey">
                                                    ประกาศเมื่อวันที่:
                                                    {{ $item->created_at->locale('th')->isoFormat('lll') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                {{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                {{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- ROW-1 CLOSED -->

        <!-- ROW-2 OPEN -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">สำหรับสถานศึกษา/ศูนย์พัฒนาเด็กเล็ก</div>
                        <div class="btn-list">
                            {{-- @can('school.add')
                                <a href="#" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i>
                                    เพิ่มข้อมูล</a>
                            @endcan --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('getSchool') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <label for="provinceInput">จังหวัด</label>
                                    <div class="form-group">
                                        <select id="provinceSelect" name="provinceSelect" class="form-control">
                                            @foreach ($province as $key => $item)
                                                <option value="{{ $item->PROV_ID }}"
                                                    @if (isset($schools) && !empty($schools) && $item->PROV_ID == ($schools[0]->prov_id ?? 0)) selected @endif>
                                                    {{ $item->PROV_NAME }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="ampherInput">อำเภอ</label>
                                    <div class="form-group">
                                        <select id="ampherSelect" name="ampherSelect" class="form-control">
                                            @if (isset($schools) && !empty($amphers))
                                                @foreach ($amphers as $key => $item)
                                                    <option value="{{ $item->AMP_ID }}"
                                                        @if (isset($schools) && !empty($schools) && $item->AMP_ID == ($schools[0]->amp_id ?? 0)) selected @endif>
                                                        {{ $item->AMP_NAME }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="typeInput">ประเภท</label>
                                    <div class="form-group">
                                        <select id="type" name="type" class="form-control">
                                            <option value="school" <?php echo $type == 'school' ? 'selected' : ''; ?>>โรงเรียน</option>
                                            <option value="child" <?php echo $type == 'child' ? 'selected' : ''; ?>>ศูนย์พัฒนาเด็กเล็ก</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12" align="right">
                                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <h4>จำนวน<?php echo $type == 'school' ? 'โรงเรียน' : 'ศูนย์พัฒนาเด็กเล็ก'; ?>ทั้งหมด <span
                                id="amount_school">{{ isset($schools) && !empty($schools) ? count($schools) : 0 }}</span>
                            แห่ง
                        </h4>

                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                    <tr align="center">
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อโรงเรียน</th>
                                        <th class="text-center">สังกัด</th>
                                        <th class="text-center">ชื่อผู้บริหาร</th>
                                        <th class="text-center">การจัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="result_school" style="text-align: center">
                                    @if (isset($schools) && !empty($schools))
                                        @foreach ($schools as $key => $item)
                                            <tr align="center">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->Thai_Name }}</td>
                                                <td>{{ $item->affiliation == null ? '-' : $item->affiliation }}</td>
                                                <td>{{ $item->Director_Name }}</td>
                                                <td>
                                                    <a href="{{ route('admin.edit.school', $item->ID) }}"
                                                        class="btn btn-warning"><i class="fa fa-pencil"></i>
                                                        แก้ไขข้อมูลพื้นฐาน</a>
                                                    <a href="{{ route('admin.progress.school', $item->ID) }}"
                                                        class="btn btn-info"><i class="fa fa-save"></i>
                                                        บันทึกการดำเนินงาน</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- TABLE WRAPPER -->
                </div>
                <!-- SECTION WRAPPER -->
            </div>
        </div>
        <!-- ROW-2 CLOSED -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function closeCarousel() {
            $('#carouselExampleIndicators').hide();
        }
        document.addEventListener('DOMContentLoaded', function() {
            var provinceSelect = document.getElementById('provinceSelect');
            var ampherSelect = document.getElementById('ampherSelect');

            provinceSelect.addEventListener('change', function() {
                var provinceId = this.value;
                fetch('/get-amphurs/' + provinceId)
                    .then(response => response.json())
                    .then(data => {
                        ampherSelect.innerHTML = ''; // Clear previous options
                        data.forEach(function(amp) {
                            var option = document.createElement('option');
                            option.value = amp.AMP_ID;
                            option.textContent = amp.AMP_NAME;
                            ampherSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching amphurs:', error));
            });
        });
    </script>
@endsection
