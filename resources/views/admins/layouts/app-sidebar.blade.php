<!--APP-SIDEBAR-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{ url('/' . $page='index') }}">
            <img src="{{URL::asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
            <img src="{{URL::asset('assets/images/brand/logo-1.png')}}" class="header-brand-img toggle-logo" alt="logo">
            <img src="{{URL::asset('assets/images/brand/logo-2.png')}}" class="header-brand-img light-logo" alt="logo">
            <img src="{{URL::asset('assets/images/brand/logo-3.png')}}" class="header-brand-img light-logo1" alt="logo">
        </a><!-- LOGO -->
        <a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-auto" data-toggle="sidebar" href="#"></a>
        <!-- sidebar-toggle-->
    </div>
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
            <div class="user-pic">
                <img src="{{URL::asset('assets/images/users/10.jpg')}}" alt="user-img" class="avatar-xl rounded-circle">
            </div>
            <div class="user-info">
                <h6 class=" mb-0 text-dark">Elizabeth Dyer</h6>
                <span class="text-muted app-sidebar__user-name text-sm">Administrator</span>
            </div>
        </div>
    </div>
    <div class="sidebar-navs">
        <ul class="nav  nav-pills-circle">
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Settings">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-settings"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Chat">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-mail"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Followers">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-user"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Logout">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-power"></i>
                </a>
            </li>
        </ul>
    </div>
    <ul class="side-menu">

        <li class="slide">
            <a class="side-menu__item" href="{{route('sell.getIndex')}}">
                <i class="side-menu__icon ti-shopping-cart"></i>
                <span class="side-menu__label">Bán hàng</span>
            </a>
        </li>
        {{--Quản lý kho--}}
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="side-menu__icon ti-home"></i>
                <span class="side-menu__label">Quản lý kho</span>
                <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{route('admin.medicine.getIndex')}}"><span>Thuốc</span></a></li>
                <li><a class="slide-item" href="{{route('admin.import_medicine.getIndex')}}"><span>Nhập Hàng</span></a></li>
                <li><a class="slide-item" href="{{route('admin.export_medicine.getIndex')}}"><span>Xuất Hàng</span></a></li>
            </ul>
        </li>
        {{--Quản Lý Hóa Đơn--}}

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="side-menu__icon ti-home"></i>
                <span class="side-menu__label">Quản lý hóa đơn</span>
                <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{route('admin.bill.getIndex')}}"><span>Đơn bán</span></a></li>
                <li><a class="slide-item" href="{{route('admin.refund.getIndex')}}"><span>Đơn trả lại</span></a></li>
            </ul>
        </li>
        {{--Quản Lý Nhân viên--}}
        <li class="slide">
            <a class="side-menu__item" href="/nhan-vien">
                <i class="side-menu__icon ti-home"></i>
                <span class="side-menu__label">Quản lý nhân viên</span>
            </a>
        </li>
    </ul>
</aside>
<!--/APP-SIDEBAR-->
