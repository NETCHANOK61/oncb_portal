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
                        <div class="card-title">สำหรับสถานศึกษา/ศูนย์พัฒนาเด็กเล็ก</div>
                        <div class="btn-list">
                            {{-- @can('school.add')
                                <a href="#" class="btn btn-primary ml-auto"><i class="fa fa-plus"></i>
                                    เพิ่มข้อมูล</a>
                            @endcan --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Search Form -->
                        <form action="{{ route('admin.school_main') }}" method="GET">
                            <div class="row">
                                <div class="col-6">
                                    <label for="schoolName">ชื่อโรงเรียน</label>
                                    <input type="text" name="search" placeholder="Search by name"
                                        value="{{ request('search') }}" class="form-control">
                                </div>
                                <div class="col-6">
                                    <!-- Year Dropdown -->
                                    <label for="yearSelect">ปี</label>
                                    <select name="year" class="form-control">
                                        <option value="">ทุกปี</option>
                                        @for ($year = 2560; $year <= 2567; $year++)
                                            <option value="{{ $year }}"
                                                {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <!-- Ministry_id Dropdown -->
                                    <label for="ministrySelect">กระทรวง</label>
                                    <select name="ministry_id" class="form-control">
                                        <option value="">ทุกกระทรวง</option>
                                        @foreach($ministriesTable as $ministry)
                                            <option value="{{ $ministry['ministry_id'] }}" {{ request('ministry_id') == $ministry['ministry_id'] ? 'selected' : '' }}>{{ $ministry['ministry_name'] }}</option>
                                        @endforeach
                                        <option value="other" {{ request('ministry_id') == 'other' ? 'selected' : '' }}>ไม่ระบุ</option>
                                    </select>
                                </div>                                
                                <div class="col-6">
                                    <!-- Department_id Dropdown -->
                                    <label for="departmentSelect">สังกัด</label>
                                    <select name="department_id" class="form-control">
                                        <option value="">ทุกสังกัด</option>
                                        @foreach($departmentsTable as $department)
                                            <option value="{{ $department['department_id'] }}" {{ request('department_id') == $department['department_id'] ? 'selected' : '' }}>{{ $department['department_name'] }}</option>
                                        @endforeach
                                        <option value="other" {{ request('department_id') == 'other' ? 'selected' : '' }}>ไม่ระบุ</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <!-- prov_id Dropdown -->
                                    <label for="provinceSelect">จังหวัด</label>
                                    <select name="prov_id" class="form-control">
                                        <option value="">ทุกจังหวัด</option>
                                        @foreach($provincesTable as $provId => $provName)
                                            <option value="{{ $provId }}" {{ request('prov_id') == $provId ? 'selected' : '' }}>{{ $provName }}</option>
                                        @endforeach
                                        <option value="other" {{ request('prov_id') == 'other' ? 'selected' : '' }}>ไม่ระบุ</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="card-footer" align="right">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <br>

                        <div class="table-responsive">
                            <!-- Schools Table -->
                            <form id="toggle-active-form" action="{{ route('admin.school_toggleActive') }}" method="POST">
                                @csrf <!-- CSRF token is required for form submissions -->
                                <!-- Active Status Input -->
                                @foreach ($schools as $school)
                                    <input type="hidden" name="active_status[]" value="{{ $school->ID }}" />
                                @endforeach
                                <div class="card-footer" align="right">
                                    <button type="submit" id="save-toggle-active" class="btn btn-primary">Save</button>
                                </div>
                                <table id="example" class="table table-striped table-bordered text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>สลับสถานะ</th> <!-- Checkbox Column -->
                                            <th>สถานะใช้งาน</th>
                                            <th>ID</th>
                                            <th>ปี</th>
                                            <th>ชื่อ</th>
                                            <th>กระทรวง</th>
                                            <th>สังกัด</th>
                                            <th>ระดับ</th>
                                            <th>จังหวัด</th>
                                            <!-- Add other columns as needed -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schools as $school)
                                            <tr>
                                                <td>
                                                    <!-- Checkbox to toggle active status -->
                                                    <input type="checkbox" class="toggle-active" name="active_status[]"
                                                        value="{{ $school->ID }}"
                                                        {{ $school->active ? 'checked' : '' }}>
                                                </td>
                                                <td>{{ $school->active_status == 1 ? 'ใช้งาน' : 'X' }}</td>
                                                <td>{{ $school->ID }}</td>
                                                <td>{{ $school->Years }}</td>
                                                <td>{{ $school->Thai_Name }}</td>
                                                <td>{{ $ministriesTable[$school->ministry_id]['ministry_name'] ?? '' }}</td>
                                                <td>{{ $departmentsTable[$school->Department_id]['department_name'] ?? '' }}</td>
                                                <td>{{ $levelsTable[$school->level_id]['level_name'] ?? '' }}</td>
                                                <td>{{ $provincesTable[$school->prov_id] ?? '' }}</td>                             
                                                <!-- Display other fields as needed -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- TABLE WRAPPER -->
                </div>
                <!-- SECTION WRAPPER -->
            </div>
        </div>
        <!-- ROW-1 CLOSED -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // JavaScript for handling the toggling of active status when the "Save" button is clicked
        document.getElementById('save-toggle-active').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            
            // Collect the values of checked checkboxes
            var checkedCheckboxes = document.querySelectorAll('.toggle-active:checked');
            var activeStatusValues = [];
            checkedCheckboxes.forEach(function(checkbox) {
                activeStatusValues.push(checkbox.value);
            });

            // Set the collected values to a hidden input field in the form
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'active_status');
            hiddenInput.setAttribute('value', JSON.stringify(activeStatusValues));
            document.getElementById('toggle-active-form').appendChild(hiddenInput);

            // Submit the form
            document.getElementById('toggle-active-form').submit();
        });
    </script>
@endsection