@extends('layouts.web.web')

@section('title', __('messages.profile'))

@section('content')
<section id="auth-profile" class="auth-section section">
    <div class="container section-title" data-aos="fade-up">
        <span>{{ __('messages.profile') }}<br></span>
        <h2>{{ __('messages.profile') }}</h2>
    </div>
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        @if (session('success'))
                            <div class="alert alert-success border-0">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger border-0">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">
                                        <i class="bi bi-person me-2"></i>{{ __('messages.full_name') }}
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name ?? '') }}" placeholder="{{ __('messages.enter_full_name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope me-2"></i>{{ __('messages.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email ?? '') }}" placeholder="{{ __('messages.enter_email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">
                                        <i class="bi bi-telephone me-2"></i>{{ __('messages.phone_number') }}
                                    </label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone ?? '') }}" placeholder="{{ __('messages.enter_phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">
                                        <i class="bi bi-geo-alt me-2"></i>{{ __('messages.address') }}
                                    </label>
                                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $user->address ?? '') }}" placeholder="{{ __('messages.enter_address') }}">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-lock me-2"></i>{{ __('messages.new_password_optional') }}
                                    </label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('messages.enter_password') }}" autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="bi bi-lock-fill me-2"></i>{{ __('messages.confirm_password') }}
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                                        placeholder="{{ __('messages.reenter_password') }}" autocomplete="new-password">
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-auth-primary w-100 py-3">
                                        <i class="bi bi-check2-circle me-2"></i>{{ __('messages.update_profile') }}
                                    </button>
                                </div>
                            </div>
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
@media (max-width: 768px) { .auth-section { padding: 40px 0; } }
</style>
@endsection
