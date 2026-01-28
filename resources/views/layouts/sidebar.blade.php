<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">لوحة التحكم</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>لوحة التحكم</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        الادارات
    </div>

    <!-- Nav Item - Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>إدارة المستخدمين</span></a>
    </li>

    {{-- <!-- Nav Item - Containers -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('containers.index') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>إدارة الحاويات</span></a>
    </li>

    <!-- Nav Item - Shipments -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shipments.index') }}">
            <i class="fas fa-fw fa-shipping-fast"></i>
            <span>إدارة الشحنات</span></a>
    </li>

    <!-- Nav Item - Locations -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('locations.index') }}">
            <i class="fas fa-fw fa-map"></i>
            <span>إدارة المواقع</span></a>
    </li>

    <!-- Nav Item - Shipment Tracking -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shipment_trackings.index') }}">
            <i class="fas fa-fw fa-pin"></i>
            <span>إدارة التتبع</span></a>
    </li>

    <!-- Nav Item - Sliders -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('sliders.index') }}">
            <i class="fas fa-fw fa-image"></i>
            <span>إدارة السلايدر</span></a>
    </li>

    <!-- Nav Item - Contact Us -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact-us') }}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>إدارة عروض الاسعار</span></a>
    </li>

    <!-- Nav Item - Notifications -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('notifications.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>إدارة الاشعارات</span></a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('web-ens.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>الموقع الالكتروني بالانجليزية</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('web-ars.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>الموقع الالكتروني بالعربية</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        تسعير الشحن
    </div>

    <!-- Nav Item - Countries -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.countries.index') }}">
            <i class="fas fa-fw fa-globe"></i>
            <span>إدارة الدول</span></a>
    </li>

    <!-- Nav Item - Shipping Zones -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.shipping-zones.index') }}">
            <i class="fas fa-fw fa-map-marked-alt"></i>
            <span>إدارة المناطق</span></a>
    </li>

    <!-- Nav Item - Rate Cards -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.shipping-rate-cards.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>جداول التسعير</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
