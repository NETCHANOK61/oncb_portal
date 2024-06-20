<aside class="app-sidebar">
    <a class="header-brand left-meu-header-brand left-meu-header-style1 left-meu-header-brand-desktop" href="#">
        <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img desktop-logo"
            alt="user management">
        <img src="{{ asset('assets/images/brand/logo3.png') }}" class="header-brand-img mobile-view-logo"
            alt="user management">
    </a>
    <div class="input-group p-2 bg-white border-bottom">
        <input type="text" placeholder="user management" class="form-control search">
        <div class="input-group-prepend mr-0">
            <span class="input-group-text border-right search_btn btn-primary-default"></span>
        </div>
    </div>
    <div class="side-tab-body p-0 border-0" id="parentVerticalTab">
        <div class="first-sidemenu">
            <ul class="resp-tabs-list hor_1">
                @foreach ($menuItems as $menuName => $menuData)
                    <li role="tab" aria-controls="tab{{ Str::slug($menuName) }}" data-toggle="tooltip"
                        data-placement="right" title="{{ $menuName }}">
                        <i class="side-menu__icon typcn {{ $menuData['menu_icon'] }}"></i>
                        <div class="slider-text">{{ $menuName }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="second-sidemenu">
            <div class="resp-tabs-container hor_1">
                @foreach ($menuItems as $index => $menuData)
                    <div role="sec_tab" aria-controls="sec_tab{{ $index }}">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($menuData['secondary_menus'] as $secondaryMenu => $secondaryData)
                                    <h4 class="font-weight-normal">
                                        <i class="typcn {{ $menuData['menu_icon'] }}"></i>
                                        {{ $secondaryMenu }}
                                    </h4>
                                    @foreach ($secondaryData['sub_menu'] as $subMenu)
                                        <a href="{{ route($subMenu['route_menu']) }}"
                                            class="slide-item">{{ $subMenu['name'] }}</a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</aside>
