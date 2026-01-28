@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        إدارة الأسعار - {{ $shippingRateCard->name ?? ($shippingRateCard->shipment_type === 'parcel' ? 'طرد' : 'وثائق') }}
    </h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">الأسعار حسب المناطق</h6>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRateModal">
                <i class="fas fa-plus"></i> إضافة سعر
            </button>
        </div>
        <div class="card-body">
            @foreach($zones as $zone)
                <h5 class="mt-4 mb-3">{{ $zone->code }} - {{ $zone->name ?? '' }}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>نوع التسعير</th>
                                <th>من (كغ)</th>
                                <th>إلى (كغ)</th>
                                <th>السعر</th>
                                <th>السعر/كغ</th>
                                <th>ترتيب</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $zoneRates = $rates[$zone->id] ?? collect();
                            @endphp
                            @forelse($zoneRates as $rate)
                                <tr>
                                    <td>
                                        <span class="badge {{ $rate->pricing_type === 'flat' ? 'badge-primary' : 'badge-info' }}">
                                            {{ $rate->pricing_type === 'flat' ? 'ثابت' : 'لكل كغ' }}
                                        </span>
                                    </td>
                                    <td>{{ $rate->weight_from_kg }}</td>
                                    <td>{{ $rate->weight_to_kg >= 9999 ? '∞' : $rate->weight_to_kg }}</td>
                                    <td>{{ $rate->price ?? '-' }}</td>
                                    <td>{{ $rate->price_per_kg ?? '-' }}</td>
                                    <td>{{ $rate->sort_order }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#editRateModal{{ $rate->id }}">تعديل</button>
                                        <form action="{{ route('dashboard.shipping-rates.destroy', [$shippingRateCard->id, $rate->id]) }}"
                                            method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">لا توجد أسعار لهذه المنطقة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addRateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.shipping-rates.store', $shippingRateCard->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">إضافة سعر</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>المنطقة *</label>
                        <select name="shipping_zone_id" class="form-control" required>
                            @foreach($zones as $zone)
                                <option value="{{ $zone->id }}">{{ $zone->code }} - {{ $zone->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>نوع التسعير *</label>
                        <select name="pricing_type" class="form-control" id="pricing_type" required>
                            <option value="flat">ثابت</option>
                            <option value="per_kg">لكل كغ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>من (كغ) *</label>
                        <input type="number" name="weight_from_kg" class="form-control" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>إلى (كغ) *</label>
                        <input type="number" name="weight_to_kg" class="form-control" step="0.01" min="0" required>
                    </div>
                    <div class="form-group" id="price-group">
                        <label>السعر (ثابت) *</label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0">
                    </div>
                    <div class="form-group" id="price-per-kg-group" style="display: none;">
                        <label>السعر لكل كغ *</label>
                        <input type="number" name="price_per_kg" class="form-control" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                        <label>ترتيب</label>
                        <input type="number" name="sort_order" class="form-control" value="0" min="0">
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
@foreach($rates->flatten() as $rate)
<div class="modal fade" id="editRateModal{{ $rate->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.shipping-rates.update', [$shippingRateCard->id, $rate->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">تعديل سعر</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>نوع التسعير *</label>
                        <select name="pricing_type" class="form-control edit-pricing-type" data-rate-id="{{ $rate->id }}" required>
                            <option value="flat" {{ $rate->pricing_type === 'flat' ? 'selected' : '' }}>ثابت</option>
                            <option value="per_kg" {{ $rate->pricing_type === 'per_kg' ? 'selected' : '' }}>لكل كغ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>من (كغ) *</label>
                        <input type="number" name="weight_from_kg" class="form-control" step="0.01" min="0"
                            value="{{ $rate->weight_from_kg }}" required>
                    </div>
                    <div class="form-group">
                        <label>إلى (كغ) *</label>
                        <input type="number" name="weight_to_kg" class="form-control" step="0.01" min="0"
                            value="{{ $rate->weight_to_kg }}" required>
                    </div>
                    <div class="form-group edit-price-group{{ $rate->id }}"
                        style="{{ $rate->pricing_type === 'per_kg' ? 'display: none;' : '' }}">
                        <label>السعر (ثابت) *</label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0"
                            value="{{ $rate->price }}">
                    </div>
                    <div class="form-group edit-price-per-kg-group{{ $rate->id }}"
                        style="{{ $rate->pricing_type === 'flat' ? 'display: none;' : '' }}">
                        <label>السعر لكل كغ *</label>
                        <input type="number" name="price_per_kg" class="form-control" step="0.01" min="0"
                            value="{{ $rate->price_per_kg }}">
                    </div>
                    <div class="form-group">
                        <label>ترتيب</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ $rate->sort_order }}" min="0">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pricingTypeSelect = document.getElementById('pricing_type');
    const priceGroup = document.getElementById('price-group');
    const pricePerKgGroup = document.getElementById('price-per-kg-group');

    pricingTypeSelect.addEventListener('change', function() {
        if (this.value === 'flat') {
            priceGroup.style.display = 'block';
            pricePerKgGroup.style.display = 'none';
            priceGroup.querySelector('input').required = true;
            pricePerKgGroup.querySelector('input').required = false;
        } else {
            priceGroup.style.display = 'none';
            pricePerKgGroup.style.display = 'block';
            priceGroup.querySelector('input').required = false;
            pricePerKgGroup.querySelector('input').required = true;
        }
    });

    // Handle edit modals
    document.querySelectorAll('.edit-pricing-type').forEach(select => {
        select.addEventListener('change', function() {
            const rateId = this.dataset.rateId;
            const priceGroup = document.querySelector('.edit-price-group' + rateId);
            const pricePerKgGroup = document.querySelector('.edit-price-per-kg-group' + rateId);

            if (this.value === 'flat') {
                priceGroup.style.display = 'block';
                pricePerKgGroup.style.display = 'none';
            } else {
                priceGroup.style.display = 'none';
                pricePerKgGroup.style.display = 'block';
            }
        });
    });
});
</script>
@endsection
