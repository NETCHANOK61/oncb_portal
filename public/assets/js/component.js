class NavBar extends HTMLElement {
    constructor() {
        super();
    }
    connectedCallback() {
        this.innerHTML = 
        `
            <aside class="app-sidebar">
            <a class="header-brand left-meu-header-brand left-meu-header-style1 left-meu-header-brand-desktop"
                href="user_superadmin_dashboard.html">
                <img src="../assets/images/brand/logo3.png" class="header-brand-img desktop-logo"
                    alt="user management">
                <img src="../assets/images/brand/logo3.png" class="header-brand-img mobile-view-logo"
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
                        <li role="tab" aria-controls="tab1" data-toggle="tooltip" data-placement="right"
                            title="หน้าหลัก"><i class="side-menu__icon typcn typcn-device-desktop"></i>
                            <div class="slider-text">หน้าหลัก</div>
                        </li>
                        <li role="tab" aria-controls="tab2" data-toggle="tooltip" data-placement="right"
                            title="บริหารจัดการ"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                            <div class="slider-text">การบันทึกข้อมูล</div>
                        </li>
                        <li role="tab" aria-controls="tab3" data-toggle="tooltip" data-placement="right"
                            title="บริหารจัดการ"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                            <div class="slider-text">สถานะการนำเข้าข้อมูล</div>
                        </li>
                        <li role="tab" aria-controls="tab4" data-toggle="tooltip" data-placement="right"
                            title="บริหารจัดการ"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                            <div class="slider-text">รายงาน</div>
                        </li>
                        <li role="tab" aria-controls="tab5" data-toggle="tooltip" data-placement="right"
                            title="บริหารจัดการ"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                            <div class="slider-text">เชื่อมโยงระบบอื่น ๆ</div>
                        </li>
                        <li role="tab" aria-controls="tab6" data-toggle="tooltip" data-placement="right"
                            title="บริหารจัดการ"><i class="side-menu__icon typcn typcn-arrow-move-outline"></i>
                            <div class="slider-text">บริหารจัดการระบบ</div>
                        </li>
                    </ul>
                    <div class="second-sidemenu">
                        <div class="resp-tabs-container hor_1">
                            <div role="sec_tab" aria-controls="sec_tab1">
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
                                                    <li>
                                                        <a class="slide-item" href="#">เยาวชนนอกสถานศึกษา</a>
                                                    </li>
                                                    <li>
                                                        <a class="slide-item"
                                                            href="#">การอบรมเครือข่ายหมู่บ้าน/ชุมชนร่วมใจต้านภัยยาเสพติด</a>
                                                    </li>
                                                    <li>
                                                        <a class="slide-item" href="#">สถานประกอบกิจการ</a>
                                                    </li>
                                                    <li>
                                                        <a class="slide-item" href="#">การมีส่วนร่วมภาคประชาชน</a>
                                                    </li>
                                                    <li>
                                                        <a class="slide-item" href="#">ศาสนสถาน</a>
                                                    </li>
                                                    <li>
                                                        <a class="slide-item" href="#">พื้นที่เสี่ยง</a>
                                                    </li>
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
                                                        <a class="slide-item" href="#">ความร่วมมือระหว่างประเทศ</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <br>

                                        <h4 class="font-weight-normal"><i
                                                class="typcn typcn-arrow-move-outline"></i>
                                            สำหรับสถานศึกษา/ <br>ศูนย์พัฒนาเด็กเล็ก
                                        </h4>
                                        <a href="#" class="slide-item">การบันทึกข้อมูล</a>
                                        <br>

                                        <h4>แบบสำรวจสภาพปัญหา<br>ยาเสพติดในระดับหมู่บ้าน/ชุมชน</h4>

                                        <br>
                                        <h4 class="font-weight-normal"><i
                                                class="typcn typcn-arrow-move-outline"></i>
                                            ข้อมูลบุคลากรที่ปฏิบัติภารกิจด้านยาเสพติด
                                        </h4>
                                        <a href="#" class="slide-item">การบันทึกข้อมูลบุคลากร</a>
                                        <a href="#" class="slide-item">กรณีต่อสัญญาฉบับใหม่</a>
                                        <a href="#" class="slide-item">รายงานสรุปผลการปฏิบัติงาน</a>
                                        <a href="#" class="slide-item">รายงานสรุปจำนวน</a>
                                        <a href="#" class="slide-item">รายงานรายชื่อลูกจ้าง</a>
                                        <a href="#" class="slide-item">รายงานรายละเอียดผลการปฏิบัติงาน</a>
                                        <a href="#" class="slide-item">รายงานสถิตินำเข้าผลการปฏิบัติงาน</a>
                                    </div>
                                </div>
                            </div>
                            <div role="sec_tab" aria-controls="sec_tab3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="font-weight-normal"><i
                                                class="typcn typcn-arrow-move-outline"></i> สถานะการนำเข้าข้อมูล
                                        </h4>
                                        <a href="#" class="slide-item">รายวัน</a>
                                        <a href="#" class="slide-item">รายเดือน</a>
                                    </div>
                                </div>
                            </div>
                            <div role="sec_tab" aria-controls="sec_tab4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="font-weight-normal"><i
                                                class="typcn typcn-arrow-move-outline"></i> รายงาน
                                        </h4>
                                        <a href="#" class="slide-item">ผลการดำเนินงานรายวัน</a>
                                        <a href="#" class="slide-item">ผลการดำเนินงานรายเดือน</a>
                                        <a href="#"
                                            class="slide-item">ผลแบบสำรวจสถาพปัญหายาเสพติดในระดับหมู่บ้าน/ชุมชน</a>
                                        <a href="#" class="slide-item">ผลการดำเนินงานในสถานศึกษา</a>
                                    </div>
                                </div>
                            </div>
                            <div role="sec_tab" aria-controls="sec_tab5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="font-weight-normal"><i
                                                class="typcn typcn-arrow-move-outline"></i>
                                            ระบบอื่น ๆ
                                        </h4>
                                        <a href="#" class="slide-item">ระบบเฝ้าระวังการแพร่ระบาดยาเสพติดจังหวัด</a>
                                        <a href="#" class="slide-item">ระบบทะเบียนกำลังพล</a>
                                        <a href="#" class="slide-item">ติดต่อเรา</a>
                                        <a href="#" class="slide-item">ช่วยเหลือ</a>
                                    </div>
                                </div>
                            </div>
                            <div role="sec_tab" aria-controls="sec_tab6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="font-weight-normal"><i
                                                class="typcn typcn-arrow-move-outline"></i>
                                            บริหารจัดการผู้ใช้งาน
                                        </h4>
                                        <a href="user_superadmin_dashboard.html"
                                            class="slide-item">Dashboard-super</a>
                                        <a href="user_admin_dashboard.html" class="slide-item">Dashboard-admin</a>
                                        <a href="user_management.html" class="slide-item">จัดการผู้ใช้งาน</a>
                                        <a href="role_management.html"
                                            class="slide-item">จัดการบทบาทของผู้ใช้งาน</a>

                                        <br>
                                        <h4 class="font-weight-normal"><i
                                                class="typcn typcn-arrow-move-outline"></i>
                                            บริหารจัดการเมนู
                                        </h4>
                                        <a href="menu_management.html" class="slide-item">จัดการเมนู</a>

                                        <!-- <br>
                                            <h4 class="font-weight-normal"><i
                                                    class="typcn typcn-arrow-move-outline"></i>
                                                บริหารจัดการบทบาท
                                            </h4> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        `;
        }
    }
    customElements.define('navbar-component', NavBar);

    class Header extends HTMLElement {
        constructor() {
            super();
        }
        connectedCallback() {
            this.innerHTML = `
                    <div class="header header-fixed ">
                        <div class="container-fluid">
                            <div class="d-flex">
                                <a class="header-brand d-md-none" href="index.html">
                                    <img src="../assets/images/brand/logo3.png" class="header-brand-img desktop-logo"
                                        alt="Arox logo">
                                    <img src="../assets/images/brand/logo3.png" class="header-brand-img mobile-view-logo"
                                        alt="Arox logo">
                                </a>
                                <!-- LOGO -->
                                <a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-0" data-toggle="sidebar"
                                    href="#"></a>
                                <div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
                                    <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i
                                            class="ion ion-search"></i></a>
                                    <div class="dropdown d-sm-flex d-none">
                                        <a class="nav-link icon full-screen-link nav-link-bg">
                                            <i class="ti-arrows-corner" id="fullscreen-button"></i>
                                        </a>
                                    </div><!-- FULL-SCREEN -->
                                    <div class="dropdown d-sm-flex d-none notifications">
                                        <a class="nav-link icon" data-toggle="dropdown">
                                            <i class="ti-bell"></i>
                                            <span class="nav-unread bg-warning-1 pulse"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right  dropdown-menu-arrow">

                                            <a href="#" class="dropdown-item mt-2 d-flex pb-3">
                                                <div class="notifyimg bg-success">
                                                    <i class="fa fa-thumbs-o-up"></i>
                                                </div>
                                                <div>
                                                    <strong>Someone likes our posts.</strong>
                                                    <div class="small">3 hours ago</div>
                                                </div>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex pb-3">
                                                <div class="notifyimg bg-warning">
                                                    <i class="fa fa-commenting-o"></i>
                                                </div>
                                                <div>
                                                    <strong> 3 New Comments</strong>
                                                    <div class="small">5 hour ago</div>
                                                </div>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex pb-3">
                                                <div class="notifyimg bg-danger">
                                                    <i class="fa fa-cogs"></i>
                                                </div>
                                                <div>
                                                    <strong> Server Rebooted.</strong>
                                                    <div class="small">45 mintues ago</div>
                                                </div>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item text-center">View all Notification</a>
                                        </div>
                                    </div><!-- NOTIFICATIONS -->

                                    <div class="dropdown text-center selector profile-1 d-sm-flex d-none">
                                        <a href="#" data-toggle="dropdown" class="nav-link leading-none d-flex">
                                            <span><img src="../assets/images/faces/female/mock.png" alt="profile-user"
                                                    class="avatar brround cover-image mb-1 ml-0"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <div class="text-center bg-image p-4">
                                                <a href="#" class="dropdown-item text-center font-weight-sembold user pt-0"
                                                    data-toggle="dropdown">สาธุ มีสุข</a>
                                                <span class="text-center user-semi-title ">Super Admin</span>
                                            </div>
                                            <!-- <div class="dropdown-divider"></div> -->
                                            <a class="dropdown-item" href="login.html">
                                                <i class="dropdown-icon mdi  mdi-logout-variant"></i> ออกจากระบบ
                                            </a>
                                        </div>
                                    </div><!-- PROFILE -->
                                    <!-- SIDE-MENU -->
                                </div>
                                <a href="#" class="header-toggler d-lg-none ml-lg-0" data-toggle="collapse"
                                    data-target="#headerMenuCollapse">
                                    <span class="header-toggler-icon"></span>
                                </a>
                            </div>
                        </div>
                    </div>`;
    }
}

customElements.define('header-component', Header);

class ResponsiveNavbar extends HTMLElement {
    constructor() {
        super();
    }
    connectedCallback() {
        this.innerHTML = `
                <div class="header header-fixed ">
                    <div class="container-fluid">
                        <div class="d-flex">
                            <a class="header-brand d-md-none" href="index.html">
                                <img src="../assets/images/brand/logo3.png" class="header-brand-img desktop-logo"
                                    alt="Arox logo">
                                <img src="../assets/images/brand/logo3.png" class="header-brand-img mobile-view-logo"
                                    alt="Arox logo">
                            </a>
                            <!-- LOGO -->
                            <a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-0" data-toggle="sidebar"
                                href="#"></a>
                            <div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
                                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i
                                        class="ion ion-search"></i></a>
                                <div class="dropdown d-sm-flex d-none">
                                    <a class="nav-link icon full-screen-link nav-link-bg">
                                        <i class="ti-arrows-corner" id="fullscreen-button"></i>
                                    </a>
                                </div><!-- FULL-SCREEN -->
                                <div class="dropdown d-sm-flex d-none notifications">
                                    <a class="nav-link icon" data-toggle="dropdown">
                                        <i class="ti-bell"></i>
                                        <span class="nav-unread bg-warning-1 pulse"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right  dropdown-menu-arrow">

                                        <a href="#" class="dropdown-item mt-2 d-flex pb-3">
                                            <div class="notifyimg bg-success">
                                                <i class="fa fa-thumbs-o-up"></i>
                                            </div>
                                            <div>
                                                <strong>Someone likes our posts.</strong>
                                                <div class="small">3 hours ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex pb-3">
                                            <div class="notifyimg bg-warning">
                                                <i class="fa fa-commenting-o"></i>
                                            </div>
                                            <div>
                                                <strong> 3 New Comments</strong>
                                                <div class="small">5 hour ago</div>
                                            </div>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex pb-3">
                                            <div class="notifyimg bg-danger">
                                                <i class="fa fa-cogs"></i>
                                            </div>
                                            <div>
                                                <strong> Server Rebooted.</strong>
                                                <div class="small">45 mintues ago</div>
                                            </div>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item text-center">View all Notification</a>
                                    </div>
                                </div><!-- NOTIFICATIONS -->

                                <div class="dropdown text-center selector profile-1 d-sm-flex d-none">
                                    <a href="#" data-toggle="dropdown" class="nav-link leading-none d-flex">
                                        <span><img src="../assets/images/faces/female/mock.png" alt="profile-user"
                                                class="avatar brround cover-image mb-1 ml-0"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <div class="text-center bg-image p-4">
                                            <a href="#" class="dropdown-item text-center font-weight-sembold user pt-0"
                                                data-toggle="dropdown">สาธุ มีสุข</a>
                                            <span class="text-center user-semi-title ">Super Admin</span>
                                        </div>
                                        <!-- <div class="dropdown-divider"></div> -->
                                        <a class="dropdown-item" href="login.html">
                                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> ออกจากระบบ
                                        </a>
                                    </div>
                                </div><!-- PROFILE -->
                                <!-- SIDE-MENU -->
                            </div>
                            <a href="#" class="header-toggler d-lg-none ml-lg-0" data-toggle="collapse"
                                data-target="#headerMenuCollapse">
                                <span class="header-toggler-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>`;
    }
}

customElements.define('responsive-navbar', ResponsiveNavbar);