<div class="sticky">
    <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
        <div class="main-sidebar-header main-container-1 active">
            <div class="sidemenu-logo">
                <a class="main-logo" href="{{route('dashboard')}}">
                    <img src="{{asset('assets/img/brand/logo-light.png')}}" class="header-brand-img desktop-logo" alt="logo">
                    <img src="{{asset('assets/img/brand/icon-light.png')}}" class="header-brand-img icon-logo" alt="logo">
                    <img src="{{asset('assets/img/brand/logo.png')}}" class="header-brand-img desktop-logo theme-logo" alt="logo">
                    <img src="{{asset('assets/img/brand/icon.png')}}" class="header-brand-img icon-logo theme-logo" alt="logo">
                </a>
            </div>
            <div class="main-sidebar-body main-body-1">
                <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                <ul class="menu-nav nav">
                    <li class="nav-header {{ @$activeHome }}"><span class="nav-label">Dashboard</span></li>
                    <li class="nav-item {{ @$activeHome }}">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item {{@$activeChart}}">
                        <a class="nav-link" href="{{route('chart.index')}}">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-bar-chart-alt sidemenu-icon menu-icon"></i>
                            <span class="sidemenu-label">Chart</span>
                        </a>
                    </li>
                </ul>
                <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
