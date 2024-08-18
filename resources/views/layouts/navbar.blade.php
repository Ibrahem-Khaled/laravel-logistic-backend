<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3 d-flex align-items-center justify-content-between">
        <!-- Breadcrumbs and Title -->
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">الصفحات</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">لوحة التحكم</li>
                </ol>
            </nav>
            <h6 class="font-weight-bolder mb-0">لوحة التحكم</h6>
        </div>
        <!-- User Info and Actions -->
        <ul class="navbar-nav align-items-center">
            @auth
                <li class="nav-item">
                    <span class="nav-link btn btn-outline-secondary">{{ Auth::user()->name }}</span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">تسجيل الخروج</button>
                    </form>
                </li>
            @endauth
            <!-- Sidenav Toggle for Mobile -->
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
    .breadcrumb-item a {
        color: rgba(0, 0, 0, 0.6);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: rgba(0, 0, 0, 0.8);
    }

    .navbar-nav .nav-item {
        margin-left: 1rem;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .sidenav-toggler-inner {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .sidenav-toggler-line {
        width: 20px;
        height: 2px;
        background-color: #333;
        margin: 3px 0;
    }
</style>
