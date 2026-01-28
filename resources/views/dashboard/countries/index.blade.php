@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">إدارة الدول</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">قائمة الدول</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCountryModal">
                <i class="fas fa-plus"></i> إضافة دولة
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الاسم بالإنجليزية</th>
                            <th>الاسم بالعربية</th>
                            <th>ISO2</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($countries as $country)
                            <tr>
                                <td>{{ $country->name_en }}</td>
                                <td>{{ $country->name_ar ?? '-' }}</td>
                                <td>{{ $country->iso2 ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $country->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $country->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#editCountryModal{{ $country->id }}">تعديل</button>
                                    <form action="{{ route('dashboard.countries.destroy', $country->id) }}"
                                        method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">لا توجد دول</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $countries->links() }}
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCountryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.countries.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">إضافة دولة</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>الاسم بالإنجليزية *</label>
                        <input type="text" name="name_en" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>الاسم بالعربية</label>
                        <input type="text" name="name_ar" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>ISO2</label>
                        <input type="text" name="iso2" class="form-control" maxlength="2">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" checked> نشط
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modals -->
@foreach($countries as $country)
<div class="modal fade" id="editCountryModal{{ $country->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.countries.update', $country->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">تعديل دولة</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>الاسم بالإنجليزية *</label>
                        <input type="text" name="name_en" class="form-control" value="{{ $country->name_en }}" required>
                    </div>
                    <div class="form-group">
                        <label>الاسم بالعربية</label>
                        <input type="text" name="name_ar" class="form-control" value="{{ $country->name_ar }}">
                    </div>
                    <div class="form-group">
                        <label>ISO2</label>
                        <input type="text" name="iso2" class="form-control" value="{{ $country->iso2 }}" maxlength="2">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" {{ $country->is_active ? 'checked' : '' }}> نشط
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
