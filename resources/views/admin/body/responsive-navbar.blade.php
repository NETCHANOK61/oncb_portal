<div class="header header-fixed ">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand d-md-none" href="index.html">
                <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img desktop-logo"
                    alt="Arox logo">
                <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img mobile-view-logo"
                    alt="Arox logo">
            </a>
            <!-- LOGO -->
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-0" data-toggle="sidebar" href="#"></a>
            <div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon">
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i
                        class="ion ion-search"></i></a>
                <div class="dropdown d-sm-flex d-none">
                    <a class="nav-link icon full-screen-link nav-link-bg">
                        <i class="ti-arrows-corner" id="fullscreen-button"></i>
                    </a>
                </div>
                <!-- FULL-SCREEN -->
                {{-- <div class="dropdown d-sm-flex d-none notifications">
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
                </div> --}}
                <!-- NOTIFICATIONS -->

                <div class="dropdown text-center selector profile-1 d-sm-flex d-none">
                    <a href="#" data-toggle="dropdown" class="nav-link leading-none d-flex">
                        <span><img src="{{ asset('assets/images/faces/female/mock.png') }}" alt="profile-user"
                                class="avatar brround cover-image mb-1 ml-0"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <div class="text-center bg-image p-4">
                            <a href="#" class="dropdown-item text-center font-weight-sembold user pt-0"
                                data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <span class="text-center user-semi-title ">{{ Auth::user()->role }}</span>
                        </div>
                        <!-- <div class="dropdown-divider"></div> -->
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> ออกจากระบบ
                        </a> --}}
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('auth.logout') }}"
                                onclick="event.preventDefault();
                            this.closest('form').submit();">
                                <i class="dropdown-icon mdi  mdi-logout-variant"></i> ออกจากระบบ
                            </a>
                        </form>
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
</div>
