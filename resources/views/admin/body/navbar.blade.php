<aside class="app-sidebar">
    <a class="header-brand left-meu-header-brand left-meu-header-style1 left-meu-header-brand-desktop" href="#">
        <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img desktop-logo"
            alt="user management">
        <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img mobile-view-logo"
            alt="user management">
    </a>
    <div class="input-group p-2  bg-white border-bottom">
        <input type="text" placeholder="user management" class="form-control search">
        <div class="input-group-prepend mr-0">
            <span class="input-group-text border-right search_btn btn-primary-default"></span>
        </div>
    </div>
    <div class="side-tab-body p-0 border-0" id="parentVerticalTab">
        <div class="first-sidemenu">
            <!-- left menu #1 -->
            <ul class="resp-tabs-list hor_1">
                <li role="tab" aria-controls="tab1" data-toggle="tooltip" data-placement="right" title="หน้าหลัก"><i
                        class="side-menu__icon typcn typcn-device-desktop"></i>
                    <div class="slider-text">หน้าหลัก</div>
                </li>
                <li role="tab" aria-controls="tab2" data-toggle="tooltip" data-placement="right"
                    title="การบันทึกข้อมูล"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                    <div class="slider-text">การบันทึกข้อมูล</div>
                </li>
                <li role="tab" aria-controls="tab3" data-toggle="tooltip" data-placement="right"
                    title="สถานะการนำเข้าข้อมูล"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                    <div class="slider-text">สถานะการนำเข้าข้อมูล</div>
                </li>
                <li role="tab" aria-controls="tab4" data-toggle="tooltip" data-placement="right" title="รายงาน"><i
                        class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                    <div class="slider-text">รายงาน</div>
                </li>
                <li role="tab" aria-controls="tab5" data-toggle="tooltip" data-placement="right"
                    title="เชื่อมโยงระบบอื่น ๆ"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                    <div class="slider-text">เชื่อมโยงระบบอื่น ๆ</div>
                </li>
                @role('admin|superAdmin')
                    <li role="tab" aria-controls="tab6" data-toggle="tooltip" data-placement="right"
                        title="บริหารจัดการระบบ"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                        <div class="slider-text">บริหารจัดการระบบ</div>
                    </li>
                @endrole
                {{-- @foreach ($menuItems as $menuItem)
                    <li role="tab" aria-controls="tab{{ $menuItem }}" data-toggle="tooltip"
                        data-placement="right" title="{{ $menuItem }}">
                        <i class="side-menu__icon typcn {{ $menuItem }}"></i>
                        <div class="slider-text">{{ $menuItem }}</div>
                    </li>
                @endforeach --}}
                <li role="tab" aria-controls="tab7" data-toggle="tooltip" data-placement="right" title="สถานศึกษา">
                    <i class="side-menu__icon typcn typcn-mortar-board"></i>
                    <div class="slider-text">สถานศึกษา</div>
                </li>
                @foreach ($menuItems as $menuName => $menuData)
                    <li role="tab" aria-controls="tab{{ $menuName }}" data-toggle="tooltip"
                        data-placement="right" title="{{ $menuName }}">
                        {{-- Display the icon for the primary menu --}}
                        <i class="side-menu__icon typcn {{ $menuData['menu_icon'] }}"></i>
                        {{-- Display the primary menu name --}}
                        <div class="slider-text">{{ $menuName }}</div>
                    </li>
                @endforeach
            </ul>
            <div class="second-sidemenu">
                <div class="resp-tabs-container hor_1">
                    <div role="sec_tab" aria-controls="sec_tab1">
                        <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                            ตัวอย่าง
                        </h4>
                        <a href="{{ route('admin.show.type') }}" class="slide-item">All Type</a>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab2">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>สำหรับจังหวัด/อำเภอ/เขต</h4>
                                <ul class="side-menu">
                                    <li class="slide">
                                        <a class="side-menu__item" data-toggle="slide" href="#"><i
                                                class="side-menu__icon typcn typcn-device-desktop"></i><span
                                                class="side-menu__label">มาตรการป้องกันยาเสพติด</span><i
                                                class="angle fa fa-angle-right"></i></a>
                                        <ul class="slide-menu">
                                            @can('school_target.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.school_target') }}">เป้าหมายโรงเรียน</a>
                                                </li>
                                            @endcan
                                            @can('police.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.police') }}">ตำรวจประสานโรงเรียน</a>
                                                </li>
                                            @endcan
                                            @can('youth.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.youth') }}">เยาวชนนอกสถานศึกษา</a>
                                                </li>
                                            @endcan
                                            @can('village.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.village') }}">การอบรมเครือข่ายหมู่บ้าน/ชุมชนร่วมใจต้านภัยยาเสพติด</a>
                                                </li>
                                            @endcan
                                            @can('enterprise.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.enterprise') }}">สถานประกอบกิจการ</a>
                                                </li>
                                            @endcan
                                            @can('people.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.people') }}">การมีส่วนร่วมภาคประชาชน</a>
                                                </li>
                                            @endcan
                                            @can('religious.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.religious') }}">ศาสนสถาน</a>
                                                </li>
                                            @endcan
                                            @can('riskArea.view')
                                                <li>
                                                    <a class="slide-item"
                                                        href="{{ route('admin.input.riskArea') }}">พื้นที่เสี่ยง</a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="side-menu">
                                    <li class="slide">
                                        <a class="side-menu__item" data-toggle="slide" href="#"><i
                                                class="side-menu__icon typcn typcn-device-desktop"></i><span
                                                class="side-menu__label">มาตรการความร่วมมือ<br>ระหว่างประเทศ</span><i
                                                class="angle fa fa-angle-right"></i></a>
                                        <ul class="slide-menu">
                                            <li>
                                                <a href="{{ route('admin.input.coperation') }}" class="slide-item"
                                                    href="#">ความร่วมมือระหว่างประเทศ</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <br>

                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    สำหรับสถานศึกษา/ <br>ศูนย์พัฒนาเด็กเล็ก
                                </h4>
                                {{-- @can('school.view') --}}
                                <a href="{{ route('admin.input.school') }}" class="slide-item">การบันทึกข้อมูล</a>
                                {{-- @endcan --}}
                                <br>

                                <h4>แบบสำรวจสภาพปัญหา<br>ยาเสพติดในระดับหมู่บ้าน/ชุมชน</h4>

                                <br>
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    ข้อมูลบุคลากรที่ปฏิบัติภารกิจด้านยาเสพติด
                                </h4>
                                <a href="{{ route('admin.input.staff_info') }}"
                                    class="slide-item">การบันทึกข้อมูลบุคลากร</a>
                                <a href="{{ route('admin.input.staff_continue') }}"
                                    class="slide-item">กรณีต่อสัญญาฉบับใหม่</a>
                                <a href="{{ route('admin.input.staff_sum') }}"
                                    class="slide-item">รายงานสรุปผลการปฏิบัติงาน</a>
                                <a href="{{ route('admin.input.staff_amount') }}"
                                    class="slide-item">รายงานสรุปจำนวน</a>
                                <a href="{{ route('admin.input.staff_namelist') }}"
                                    class="slide-item">รายงานรายชื่อลูกจ้าง</a>
                                <a href="{{ route('admin.input.staff_sum_details') }}"
                                    class="slide-item">รายงานรายละเอียดผลการปฏิบัติงาน</a>
                                <a href="{{ route('admin.input.staff_sum_stat') }}"
                                    class="slide-item">รายงานสถิตินำเข้าผลการปฏิบัติงาน</a>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    สถานะการนำเข้าข้อมูล
                                </h4>
                                <a href="{{ route('admin.status.day') }}" class="slide-item">รายวัน</a>
                                <a href="{{ route('admin.status.month') }}" class="slide-item">รายเดือน</a>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab4">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i> รายงาน
                                </h4>
                                <a href="{{ route('admin.report.day') }}" class="slide-item">ผลการดำเนินงานรายวัน</a>
                                <a href="{{ route('admin.report.month') }}"
                                    class="slide-item">ผลการดำเนินงานรายเดือน</a>
                                <a href="{{ route('admin.report.village') }}"
                                    class="slide-item">ผลแบบสำรวจสภาพปัญหายาเสพติดในระดับหมู่บ้าน/ชุมชน</a>
                                <a href="{{ route('admin.report.school') }}"
                                    class="slide-item">ผลการดำเนินงานในสถานศึกษา</a>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab5">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    ระบบอื่น ๆ
                                </h4>
                                <a href="{{ route('admin.other.nispa_province') }}"
                                    class="slide-item">ระบบเฝ้าระวังการแพร่ระบาดยาเสพติดจังหวัด</a>
                                <a href="{{ route('admin.other.nispa_power') }}"
                                    class="slide-item">ระบบทะเบียนกำลังพล</a>
                                <a href="{{ route('admin.other.nispa_contact') }}" class="slide-item">ติดต่อเรา</a>
                                <a href="{{ route('admin.other.nispa_help') }}" class="slide-item">ช่วยเหลือ</a>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab6">
                        <div class="row">
                            <div class="col-md-12">
                                @role('admin|superAdmin')
                                    <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                        บริหารจัดการผู้ใช้งาน
                                    </h4>
                                    {{-- <a href="user_superadmin_dashboard.html" class="slide-item">Dashboard-super</a> --}}
                                    <a href="{{ route('admin.users_request.index') }}"
                                        class="slide-item">จัดการคำขอสร้างผู้ใช้งาน</a>
                                    <a href="{{ route('admin.users.index') }}" class="slide-item">จัดการผู้ใช้งาน</a>
                                    <a href="{{ route('admin.permissions.index') }}" class="slide-item">จัดการสิทธิ์</a>
                                    <a href="{{ route('admin.roles.index') }}" class="slide-item">จัดการบทบาท</a>
                                    {{-- <a href="{{ route('all.admin') }}" class="slide-item">All Admin</a> --}}
                                    {{-- <a href="{{ route('add.admin') }}"class="slide-item">Add Admin</a> --}}

                                    <br>
                                    <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                        บริหารจัดการเมนู
                                    </h4>
                                    <a href="{{ route('admin.all.menu') }}" class="slide-item">จัดการเมนู</a>

                                    {{-- 
                                    <br>
                                    <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                        บริหารจัดการข้อมูล
                                    </h4>
                                    <a href="{{ route('admin.school_main') }}" class="slide-item">ข้อมูลโรงเรียน</a> --}}
                                @endrole

                                <!-- <br>
                                    <h4 class="font-weight-normal"><i
                                            class="typcn typcn-arrow-move-outline"></i>
                                        บริหารจัดการบทบาท
                                    </h4> -->
                            </div>
                        </div>
                    </div>

                    <div role="sec_tab" aria-controls="sec_tab7">
                        <div class="row">
                            <div class="col-md-12">
                                @role('admin|superAdmin')
                                <h4 class="font-weight-normal"><i class="typcn typcn-mortar-board"></i>
                                    สำหรับสถานศึกษา/ศูนย์พัฒนาเด็กเล็ก
                                </h4>

                                <a href="{{ route('admin.school_main') }}" class="slide-item">การแก้ปัญหาชื่อโรงเรียนซ้ำ</a>
                                <a href="{{ route('admin.input.school') }}"
                                    class="slide-item">ตัวอย่างฟอร์มที่มีการเพิ่ม/ลบ ฟีลด์</a>
                                @endrole
                                <br>
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    การบริหารจัดการ
                                </h4>
                                <a href="{{ route('admin.all.type') }}" class="slide-item">ป้ายประกาศ</a>
                                <a href="{{ route('admin.allColumn') }}" class="slide-item">เพิ่ม/ลบ ฟีลด์ของฟอร์ม</a>
                                {{-- <a href="{{ route('admin.allData') }}" class="slide-item">ตาราง test</a> --}}
                            </div>
                        </div>
                    </div>
                    @foreach ($menuItems as $menuName => $menuData)
                        <div>
                            @foreach ($menuData['secondary_menus'] as $secondaryMenu => $secondaryData)
                                @if ($loop->index + 1 > 1)
                                    <br>
                                @endif
                                <div role="sec_tab" aria-controls="sec_tab{{ $loop->index + 1 }}">
                                    @if ($secondaryMenu)
                                        <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                            {{ $secondaryMenu }}
                                        </h4>
                                    @endif

                                    @foreach ($secondaryData['sub_menu'] as $subMenu)
                                        <a href="{{ $subMenu['url_menu'] }}" target="_blank" class="slide-item">
                                            {{ $subMenu['name'] }}
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</aside>
