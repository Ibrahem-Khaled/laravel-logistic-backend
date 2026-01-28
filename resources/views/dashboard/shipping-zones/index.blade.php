@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">إدارة المناطق</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($zones as $zone)
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $zone->code }} - {{ $zone->name ?? '' }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>البلد الأصل:</strong> {{ $zone->originCountry->name_ar ?? $zone->originCountry->name_en }}</p>

                    <h6>الدول المرتبطة:</h6>
                    @php
                        $zoneCountries = \App\Models\ShippingZoneCountry::where('shipping_zone_id', $zone->id)
                            ->where('origin_country_id', $zone->origin_country_id)
                            ->with('destinationCountry')
                            ->get();
                    @endphp
                    <ul class="list-group mb-3">
                        @forelse($zoneCountries as $mapping)
                            <li class="list-group-item">{{ $mapping->destinationCountry->name_ar ?? $mapping->destinationCountry->name_en }}</li>
                        @empty
                            <li class="list-group-item text-muted">لا توجد دول مرتبطة</li>
                        @endforelse
                    </ul>

                    <button class="btn btn-sm btn-info" data-toggle="modal"
                        data-target="#assignCountriesModal{{ $zone->id }}">ربط دول</button>
                </div>
            </div>
        </div>

        <!-- Assign Countries Modal -->
        <div class="modal fade" id="assignCountriesModal{{ $zone->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('dashboard.shipping-zones.assign-countries', $zone->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">ربط دول بمنطقة {{ $zone->code }}</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>اختر الدول:</label>
                                <select name="country_ids[]" class="form-control" multiple size="10">
                                    @foreach($countries as $country)
                                        @php
                                            $isAssigned = \App\Models\ShippingZoneCountry::where('shipping_zone_id', $zone->id)
                                                ->where('origin_country_id', $zone->origin_country_id)
                                                ->where('destination_country_id', $country->id)
                                                ->exists();
                                        @endphp
                                        <option value="{{ $country->id }}" {{ $isAssigned ? 'selected' : '' }}>
                                            {{ $country->name_ar ?? $country->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">اضغط Ctrl/Cmd لاختيار عدة دول</small>
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
        @endforeach
    </div>
</div>
@endsection
