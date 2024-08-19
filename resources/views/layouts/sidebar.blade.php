<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-2 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('users.index') }}">
            <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="me-1 font-weight-bold text-white">{{ config('app.name') }}</span>
        </a>
    </div>
    <hr class="horizontal light mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('home') }}">
                    <span class="nav-link-text me-1">الرئيسية</span>
                    <i class="fas fa-home ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('users.index') }}">
                    <span class="nav-link-text me-1">إدارة المستخدمين</span>
                    <i class="fas fa-user ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('containers.index') }}">
                    <span class="nav-link-text me-1">إدارة الحاويات</span>
                    <i class="fas fa-boxes ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('shipments.index') }}">
                    <span class="nav-link-text me-1">إدارة الشحنات</span>
                    <i class="fas fa-shipping-fast ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('locations.index') }}">
                    <span class="nav-link-text me-1">إدارة المواقع</span>
                    <i class="fas fa-map ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('shipment_trackings.index') }}">
                    <span class="nav-link-text me-1">إدارة التتبع</span>
                    <i class="fas fa-pin ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('sliders.index') }}">
                    <span class="nav-link-text me-1">إدارة السلايدر</span>
                    <i class="fas fa-image ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('contact-us') }}">
                    <span class="nav-link-text me-1">إدارة عروض الاسعار</span>
                    <i class="fas fa-envelope ms-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('notifications.index') }}">
                    <span class="nav-link-text me-1">إدارة الاشعارات</span>
                    <i class="fas fa-bell ms-2"></i>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- CSS لتنسيق الشريط الجانبي -->
<style>
    .sidenav {
        background-color: #2c3e50;
    }

    .sidenav .navbar-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem;
    }

    .sidenav .navbar-brand-img {
        max-height: 2rem;
        margin-left: 0.25rem;
    }

    .sidenav .navbar-nav .nav-item {
        margin: 0.25rem 0;
    }

    .sidenav .nav-link {
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        transition: background-color 0.2s ease-in-out;
        padding: 0.5rem;
        text-align: right;
    }

    .sidenav .nav-link:hover {
        background-color: #34495e;
    }

    .sidenav .nav-link i {
        font-size: 1rem;
        margin-left: 0.5rem;
        /* ترك مسافة بين الأيقونة والنص */
    }

    .sidenav .nav-link-text {
        margin-right: 0.25rem;
    }

    .sidenav .horizontal {
        border-color: rgba(255, 255, 255, 0.2);
        margin: 0.5rem 0;
    }
</style>
