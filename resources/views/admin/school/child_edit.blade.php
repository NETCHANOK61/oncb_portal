@extends('admin.dashboard')
@section('admin')
    <div class="side-app">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('getSchool') }}">สำหรับสถานศึกษา/ศูนย์พัฒนาเด็กเล็ก
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    การบันทึกข้อมูล
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
                                <li>ข้อมูลจำนวนนักเรียน</li>
                            </ul>

                            <div class="content_wrapper">
                                {{-- tab 1 --}}
                                <div class="tab_content">
                                    <form id="roleForm" action="" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="ThaiNameInput">สถานศึกษา</label>
                                                        <input type="text"
                                                            class="form-control @error('Thai_Name') is-invalid @enderror"
                                                            id="Thai_Name" name="Thai_Name" />
                                                    </div>
                                                    @error('Thai_Name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="codeSchoolInput">รหัสสถานศึกษา</label>
                                                        <input type="text"
                                                            class="form-control @error('code_school') is-invalid @enderror"
                                                            id="code_school" name="code_school" />
                                                    </div>
                                                    @error('code_school')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="schoolLevelSelect">ระดับที่เปิดสอน</label>
                                                        <select id="level_id" name="level_id" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('level_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="departmentSelect">กรม</label>
                                                        <select id="Department_id" name="Department_id"
                                                            class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('Department_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="ministrySelect">กระทรวง</label>
                                                        <input type="text"
                                                            class="form-control @error('ministry_id') is-invalid @enderror"
                                                            id="ministry_id" name="ministry_id" />
                                                    </div>
                                                    @error('ministry_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="AddressInput">เลขที่</label>
                                                        <input type="text"
                                                            class="form-control @error('Address') is-invalid @enderror"
                                                            id="Address" name="Address" />
                                                    </div>
                                                    @error('Address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="StreetInput">ถนน</label>
                                                        <input type="text"
                                                            class="form-control @error('Street') is-invalid @enderror"
                                                            id="Street" name="Street" />
                                                    </div>
                                                    @error('Street')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="provinceSelect">จังหวัด</label>
                                                        <select id="prov_id" name="prov_id" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('prov_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="ampherSelect">อำเภอ/เขต</label>
                                                        <select id="amp_id" name="amp_id" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('amp_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="tumbolSelect">ตำบล</label>
                                                        <select id="tmb_id" name="tmb_id" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('tmb_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="muchumSelect">หมู่บ้าน/ชุมชน</label>
                                                        <select id="" name="" class="select2-icon">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12" style="padding-bottom: 1%">
                                                    <button class="btn btn-primary">ค้นหาพิกัด</button>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="latInput">ละติจูด</label>
                                                        <input type="text"
                                                            class="form-control @error('lat') is-invalid @enderror"
                                                            id="lat" name="lat" />
                                                    </div>
                                                    @error('lat')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="longInput">ลองจิจูด</label>
                                                        <input type="text"
                                                            class="form-control @error('long') is-invalid @enderror"
                                                            id="long" name="long" />
                                                    </div>
                                                    @error('long')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="telephoneInput">เบอร์โทรศัพท์</label>
                                                        <input type="text"
                                                            class="form-control @error('Tel') is-invalid @enderror"
                                                            id="Tel" name="Tel" />
                                                    </div>
                                                    @error('Tel')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="websiteInput">เว็บไซต์ (URL)</label>
                                                        <input type="text"
                                                            class="form-control @error('Website') is-invalid @enderror"
                                                            id="Website" name="Website" />
                                                    </div>
                                                    @error('Website')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="card-footer" align="right">
                                                <button type="submit"
                                                    class="btn btn-success-light mt-1">บันทึกข้อมูลพื้นฐาน</button>
                                                <a href="{{ route('getSchool') }}"
                                                    class="btn btn-danger-light mt-1">ยกเลิก</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- tab 2 --}}
                                <div class="tab_content">
                                    <form id="roleForm" action="" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="year_termBSelect">ปีการศึกษา</label>
                                                        <select id="year_termB" name="year_termB" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('year_termB')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="startMonthSelect">ห้วงเวลา</label>
                                                        <select id="start_month" name="start_month" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('start_month')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="startYearSelect">ปี</label>
                                                        <select id="start_year" name="start_year" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('start_year')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="endMonthSelect">ถึง</label>
                                                        <select id="end_month" name="end_month" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('end_month')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="endYearSelect">ปี</label>
                                                        <select id="end_year" name="end_year" class="select2-icon">
                                                        </select>
                                                    </div>
                                                    @error('end_year')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="inputStudent_amt">จำนวนเด็กปฐมวัยทั้งหมด</label>
                                                        <input type="text"
                                                            class="form-control @error('Student_amt') is-invalid @enderror"
                                                            id="Student_amt" name="Student_amt" />
                                                    </div>
                                                    @error('Student_amt')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="inputLevel_teacher">จำนวนครูผู้ดูแลเด็ก/ผู้ดูแลเด็ก
                                                            ทั้งหมด</label>
                                                        <input type="text"
                                                            class="form-control @error('level_teacher') is-invalid @enderror"
                                                            id="level_teacher" name="level_teacher" />
                                                    </div>
                                                    @error('level_teacher')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="inputNum_trainingEF">จำนวนครูผู้ดูแลเด็ก/ผู้ดูแลเด็ก
                                                            ที่ผ่านการอบรม EF ทั้งหมด</label>
                                                        <input type="text"
                                                            class="form-control @error('num_trainingEF') is-invalid @enderror"
                                                            id="num_trainingEF" name="num_trainingEF" />
                                                    </div>
                                                    @error('num_trainingEF')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" align="right">
                                            <button type="submit"
                                                class="btn btn-success-light mt-1">บันทึกข้อมูลพื้นฐาน</button>
                                            <a href="{{ route('getSchool') }}"
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
