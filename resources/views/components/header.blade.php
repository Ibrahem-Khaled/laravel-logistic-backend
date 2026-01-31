<header id="header" class="header fixed-top">
    <div class="header-container container-fluid container-xl">
        <a href="{{ route('home') }}" class="header-logo logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo-white.png') }}" alt="Logo" class="logo-img">
        </a>

        <nav id="navmenu" class="navmenu" aria-label="Main navigation">
            <ul class="nav-list">
                <li><a href="{{ route('home') }}" class="nav-link">{{ __('messages.home') }}</a></li>
                <li><a href="{{ route('home') }}#about" class="nav-link">{{ __('messages.about') }}</a></li>
                <li><a href="{{ route('home') }}#services" class="nav-link">{{ __('messages.services') }}</a></li>
                <li><a href="{{ route('shipping.rates.page') }}" class="nav-link">{{ __('messages.shipping_rates') }}</a></li>
                <li><a href="{{ route('home') }}#contact" class="nav-link">{{ __('messages.contact') }}</a></li>
                <li class="dropdown nav-dropdown">
                    <a href="#" class="nav-link toggle-dropdown" id="language-toggle" aria-expanded="false" aria-haspopup="true">
                        <i class="bi bi-translate me-1"></i>
                        <span>{{ __('messages.select_language') }}</span>
                        <i class="bi bi-chevron-down dropdown-arrow dropdown-arrow-spacing" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu lang-dropdown" aria-labelledby="language-toggle">
                        <li><a class="dropdown-item" href="{{ route('locale', 'en') }}"><i class="bi bi-globe me-2"></i> English</a></li>
                        <li><a class="dropdown-item" href="{{ route('locale', 'ar') }}"><i class="bi bi-globe me-2"></i> Arabic</a></li>
                    </ul>
                </li>
                {{-- زر تسجيل الدخول / المستخدم داخل القائمة (موبايل فقط) --}}
                <li class="nav-item-mobile-actions d-xl-none">
                    @if (Auth::check())
                        <a href="{{ route('profile') }}" class="nav-link d-flex align-items-center">
                            <img src="{{ Auth::user()->avatar ?? asset('assets/img/undraw_profile_2.svg') }}" alt="" class="rounded-circle me-2" width="32" height="32">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> {{ __('messages.logout') }}
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login w-100 mt-2">
                            <i class="bi bi-box-arrow-in-right me-2"></i> {{ __('messages.login') }}
                        </a>
                    @endif
                </li>
            </ul>
            <button type="button" class="mobile-nav-toggle d-xl-none" aria-label="Open menu" aria-expanded="false">
                <i class="bi bi-list"></i>
            </button>
        </nav>

        <div class="header-actions d-none d-xl-flex">
            @if (Auth::check())
                <div class="dropdown user-dropdown">
                    <a href="#" class="user-trigger dropdown-toggle d-flex align-items-center " id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar ?? asset('assets/img/undraw_profile_2.svg') }}" alt="" class="rounded-circle user-avatar" width="36" height="36"
                        style="margin: 0 10px;">
                        <span class="user-name ms-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <li><a class="dropdown-item" href="{{ route('home.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> {{ __('messages.admin_dashboard') }}</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person-circle me-2"></i> {{ __('messages.profile') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('messages.logout') }}
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    <span>{{ __('messages.login') }}</span>
                </a>
            @endif
        </div>
    </div>
</header>
