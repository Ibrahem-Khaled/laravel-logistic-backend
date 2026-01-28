@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">جداول التسعير</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">قائمة جداول التسعير</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRateCardModal">
                <i class="fas fa-plus"></i> إضافة جدول تسعير
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>البلد الأصل</th>
                            <th>نوع الشحنة</th>
                            <th>الاسم</th>
                            <th>العملة</th>
                            <th>الحالة</th>
                            <th>من تاريخ</th>
                            <th>إلى تاريخ</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rateCards as $card)
                            <tr>
                                <td>{{ $card->originCountry->name_ar ?? $card->originCountry->name_en }}</td>
                                <td>
                                    <span class="badge {{ $card->shipment_type === 'parcel' ? 'badge-info' : 'badge-warning' }}">
                                        {{ $card->shipment_type === 'parcel' ? 'طرد' : 'وثائق' }}
                                    </span>
                                </td>
                                <td>{{ $card->name ?? '-' }}</td>
                                <td>{{ $card->currency }}</td>
                                <td>
                                    <span class="badge {{ $card->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $card->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td>{{ $card->valid_from ? $card->valid_from->format('Y-m-d') : '-' }}</td>
                                <td>{{ $card->valid_to ? $card->valid_to->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <a href="{{ route('dashboard.shipping-rates.index', $card->id) }}"
                                        class="btn btn-sm btn-info">الأسعار</a>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#editRateCardModal{{ $card->id }}">تعديل</button>
                                    <form action="{{ route('dashboard.shipping-rate-cards.destroy', $card->id) }}"
                                        method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">لا توجد جداول تسعير</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addRateCardModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.shipping-rate-cards.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">إضافة جدول تسعير</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>البلد الأصل *</label>
                        <select name="origin_country_id" class="form-control" required>
                            <option value="">اختر البلد</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ ($jordan && $country->id == $jordan->id) ? 'selected' : '' }}>
                                    {{ $country->name_ar ?? $country->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>نوع الشحنة *</label>
                        <select name="shipment_type" class="form-control" required>
                            <option value="parcel">طرد</option>
                            <option value="documents">وثائق</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>العملة *</label>
                        <input type="text" name="currency" class="form-control" value="JOD" maxlength="3" required>
                    </div>
                    <div class="form-group">
                        <label>من تاريخ</label>
                        <input type="date" name="valid_from" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>إلى تاريخ</label>
                        <input type="date" name="valid_to" class="form-control">
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
@foreach($rateCards as $card)
<div class="modal fade" id="editRateCardModal{{ $card->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.shipping-rate-cards.update', $card->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">تعديل جدول تسعير</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>البلد الأصل</label>
                        <input type="text" class="form-control" value="{{ $card->originCountry->name_ar ?? $card->originCountry->name_en }}" readonly>
                        <small class="form-text text-muted">لا يمكن تغيير البلد الأصل بعد الإنشاء</small>
                    </div>
                    <div class="form-group">
                        <label>نوع الشحنة</label>
                        <input type="text" class="form-control" value="{{ $card->shipment_type === 'parcel' ? 'طرد' : 'وثائق' }}" readonly>
                        <small class="form-text text-muted">لا يمكن تغيير نوع الشحنة بعد الإنشاء</small>
                    </div>
                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="name" class="form-control" value="{{ $card->name }}">
                    </div>
                    <div class="form-group">
                        <label>العملة *</label>
                        <input type="text" name="currency" class="form-control" value="{{ $card->currency }}" maxlength="3" required>
                    </div>
                    <div class="form-group">
                        <label>من تاريخ</label>
                        <input type="date" name="valid_from" class="form-control"
                            value="{{ $card->valid_from ? $card->valid_from->format('Y-m-d') : '' }}">
                    </div>
                    <div class="form-group">
                        <label>إلى تاريخ</label>
                        <input type="date" name="valid_to" class="form-control"
                            value="{{ $card->valid_to ? $card->valid_to->format('Y-m-d') : '' }}">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" {{ $card->is_active ? 'checked' : '' }}> نشط
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
