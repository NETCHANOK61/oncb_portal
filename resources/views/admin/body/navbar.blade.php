<aside class="app-sidebar">
    <a class="header-brand left-meu-header-brand left-meu-header-style1 left-meu-header-brand-desktop" href="#">
        <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img desktop-logo"
            alt="user management">
        <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img mobile-view-logo"
            alt="user management">
    </a>
    {{-- <div class="input-group p-2  bg-white border-bottom">
        <input type="text" placeholder="user management" class="form-control search">
        <div class="input-group-prepend mr-0">
            <span class="input-group-text border-right search_btn btn-primary-default"></span>
        </div>
    </div> --}}
    <div class="side-tab-body p-0 border-0" id="parentVerticalTab">
        <div class="first-sidemenu">
            <!-- left menu #1 -->
            <ul class="resp-tabs-list hor_1">
                <li role="tab" aria-controls="tab1" data-toggle="tooltip" data-placement="right" title="หน้าหลัก"><i
                        class="side-menu__icon typcn typcn-device-desktop"></i>
                    <div class="slider-text">หน้าหลัก</div>
                </li>
            </ul>
            <div class="second-sidemenu">
                <div class="resp-tabs-container hor_1">
                    <div role="sec_tab" aria-controls="sec_tab1">
                        <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                            การบริหารจัดการ
                        </h4>
                        <a href="{{ route('portal.allSystem') }}" class="slide-item">ระบบของหน่วยงาน</a>
                        <a href="{{ route('portal.allUser') }}" class="slide-item">ผู้ใช้งานทั้งหมด</a>
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
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="side-menu">
                                    <li class="slide">
                                        <a class="side-menu__item" data-toggle="slide" href="#"><i
                                                class="side-menu__icon typcn typcn-device-desktop"></i><span
                                                class="side-menu__label">มาตรการความร่วมมือ<br>ระหว่างประเทศ</span><i
                                                class="angle fa fa-angle-right"></i></a>
                                    </li>
                                </ul>
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    สำหรับสถานศึกษา/ <br>ศูนย์พัฒนาเด็กเล็ก
                                </h4>
                                <h4>แบบสำรวจสภาพปัญหา<br>ยาเสพติดในระดับหมู่บ้าน/ชุมชน</h4>
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    ข้อมูลบุคลากรที่ปฏิบัติภารกิจด้านยาเสพติด
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    สถานะการนำเข้าข้อมูล
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab4">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i> รายงาน
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab5">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    ระบบอื่น ๆ
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div role="sec_tab" aria-controls="sec_tab6">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                    </div>

                    <div role="sec_tab" aria-controls="sec_tab7">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-normal"><i class="typcn typcn-arrow-move-outline"></i>
                                    การบริหารจัดการ
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
