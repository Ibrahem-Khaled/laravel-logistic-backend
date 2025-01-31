<header id="header" class="header d-flex align-items-center fixed-top" style="direction: ltr;">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <!-- الشعار -->
        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets/img/logo-white.png') }}" alt="logo" class="img-fluid" height="200">
        </a>

        <!-- القائمة الرئيسية -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#home" class="nav-link">{{ __('messages.home') }}</a></li>
                <li><a href="#about" class="nav-link">{{ __('messages.about') }}</a></li>
                <li><a href="#services" class="nav-link">{{ __('messages.services') }}</a></li>
                <li><a href="#contact" class="nav-link">{{ __('messages.contact') }}</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="language" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-translate me-1"></i> {{ __('messages.select_language') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="language">
                        <li><a class="dropdown-item" href="{{ route('locale', 'en') }}"><i class="bi bi-globe me-2"></i>
                                English</a></li>
                        <li><a class="dropdown-item" href="{{ route('locale', 'ar') }}"><i class="bi bi-globe me-2"></i>
                                Arabic</a></li>
                    </ul>
                </li>
            </ul>
            <!-- زر القائمة المتنقلة -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- زر تسجيل الدخول وصورة المستخدم -->
        <div class="user-section ms-auto">
            @if (Auth::check())
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle d-flex align-items-center" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar ?? asset('assets/img/undraw_profile_2.svg') }}"
                            alt="User Avatar" class="rounded-circle" width="40" height="40">
                        <span class="ms-2 fw-bold text-white">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <li><a class="dropdown-item" href="{{ route('home.dashboard') }}"><i
                                        class="bi bi-speedometer2 me-2"></i> {{ __('messages.admin_dashboard') }}</a>
                            </li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                    class="bi bi-person-circle me-2"></i> {{ __('messages.profile') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('messages.logout') }}
                            </a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right me-2"></i> {{ __('messages.login') }}
                </a>
            @endif
        </div>
    </div>
</header>
