@extends('layouts.web.web')

@section('title', __('messages.login'))

@section('content')
<section id="auth-login" class="auth-section section">
    <div class="container section-title" data-aos="fade-up">
        <span>{{ __('messages.login') }}<br></span>
        <h2>{{ __('messages.login') }}</h2>
    </div>
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        @if (session('success'))
                            <div class="alert alert-success border-0">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger border-0">{{ session('error') }}</div>
                        @endif
                        <form method="POST" action="{{ route('customLogin') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-2"></i>{{ __('messages.email') }}
                                </label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="{{ __('messages.enter_email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock me-2"></i>{{ __('messages.password') }}
                                </label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="{{ __('messages.enter_password') }}" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">{{ __('messages.remember_me') }}</label>
                                </div>
                                <a href="{{ route('forgetPassword') }}" class="text-decoration-none">{{ __('messages.forgot_password_link') }}</a>
                            </div>
                            <button type="submit" class="btn btn-auth-primary w-100 py-3 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('messages.submit_login') }}
                            </button>
                            <p class="text-center mb-0 small">
                                {{ __('messages.no_account') }} <a href="{{ route('register') }}" class="fw-semibold">{{ __('messages.register_here') }}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.auth-section { padding: 60px 0; background-color: var(--background-color, #f8f9fa); }
.auth-section .card { border-radius: 10px; transition: all 0.3s ease; }
.auth-section .form-label { color: var(--heading-color, #212529); font-weight: 500; }
.auth-section .form-label i { color: var(--accent-color, #bc1523); }
.auth-section .form-control { border-radius: 6px; padding: 12px 15px; height: 48px; }
.auth-section .form-control:focus { border-color: var(--accent-color, #bc1523); box-shadow: 0 0 0 0.2rem rgba(188, 21, 35, 0.15); }
.btn-auth-primary { background-color: var(--accent-color, #bc1523); border-color: var(--accent-color, #bc1523); color: #fff; font-weight: 600; border-radius: 8px; }
.btn-auth-primary:hover { background-color: #9a111c; border-color: #9a111c; color: #fff; }
.auth-section a:not(.btn) { color: var(--accent-color, #bc1523); }
.auth-section a:not(.btn):hover { color: #9a111c; }
@media (max-width: 768px) { .auth-section { padding: 40px 0; } }
</style>
@endsection
