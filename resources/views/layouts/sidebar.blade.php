<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('users.index') }}">
            <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">{{ config('app.name') }}</span>
        </a>
    </div>
    <hr class="horizontal light mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('home') }}">
                    <i class="fas fa-home me-2"></i>
                    <span class="nav-link-text ms-1">الرئيسية</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('users.index') }}">
                    <i class="fas fa-user me-2"></i>
                    <span class="nav-link-text ms-1">إدارة المستخدمين</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('containers.index') }}">
                    <i class="fas fa-boxes me-2"></i>
                    <span class="nav-link-text ms-1">إدارة الحاويات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('shipments.index') }}">
                    <i class="fas fa-shipping-fast me-2"></i>
                    <span class="nav-link-text ms-1">إدارة الشحنات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('locations.index') }}">
                    <i class="fas fa-map me-2"></i>
                    <span class="nav-link-text ms-1">إدارة المواقع</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('shipment_trackings.index') }}">
                    <i class="fas fa-pin me-2"></i>
                    <span class="nav-link-text ms-1">إدارة التتبع</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('sliders.index') }}">
                    <i class="fas fa-image me-2"></i>
                    <span class="nav-link-text ms-1">إدارة السلايدر</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- CSS لتنسيق الشريط الجانبي -->
<style>
    .sidenav {
        background-color: #2c3e50;
        padding: 0;
    }

    .sidenav .navbar-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .sidenav .navbar-brand-img {
        max-height: 2.5rem;
        margin-right: 0.5rem;
    }

    .sidenav .navbar-nav .nav-item {
        margin: 0.5rem 0;
    }

    .sidenav .nav-link {
        font-size: 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        transition: background-color 0.2s ease-in-out;
    }

    .sidenav .nav-link:hover {
        background-color: #34495e;
    }

    .sidenav .nav-link i {
        font-size: 1.25rem;
    }

    .sidenav .nav-link-text {
        margin-left: 0.5rem;
    }

    .sidenav .horizontal {
        border-color: rgba(255, 255, 255, 0.2);
    }
</style>
