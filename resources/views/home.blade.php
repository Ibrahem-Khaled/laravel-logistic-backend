<!-- resources/views/dashboard/home.blade.php -->
@extends('layouts.dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">إجمالي المستخدمين</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">إجمالي الشحنات</h5>
                    <p class="card-text">{{ $totalShipments }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">الشحنات المعلقة</h5>
                    <p class="card-text">{{ $pendingShipments }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">الشحنات الفاشلة</h5>
                    <p class="card-text">{{ $failedDeliveries }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    الأنشطة الأخيرة
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($recentActivities as $activity)
                        <li class="list-group-item">{{ $activity->description }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    إضافة مستخدم جديد
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">إضافة المستخدم</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    آخر الأخبار
                </div>
                <div class="card-body">
                    <p class="card-text">يمكنك هنا عرض آخر الأخبار أو التحديثات المتعلقة بخدماتك أو شركتك.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
