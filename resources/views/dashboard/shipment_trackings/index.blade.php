<!-- resources/views/shipment_trackings/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>تتبع الشحنات</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShipmentTrackingModal">
                إضافة تتبع
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>الحاوية</th>
                        <th>الموقع</th>
                        <th>تاريخ الوصول</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipmentTrackings as $shipmentTracking)
                        <tr>
                            <td>{{ $shipmentTracking->container->container_number }}</td>
                            <td>{{ $shipmentTracking->location->name }}</td>
                            <td>{{ $shipmentTracking->delivered_date }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editShipmentTrackingModal{{ $shipmentTracking->id }}">
                                    تعديل
                                </button>
                                <form action="{{ route('shipment_trackings.destroy', $shipmentTracking->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>

                        <!-- تعديل تتبع الشحنة -->
                        <div class="modal fade" id="editShipmentTrackingModal{{ $shipmentTracking->id }}" tabindex="-1"
                            aria-labelledby="editShipmentTrackingModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editShipmentTrackingModalLabel">تعديل التتبع</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('shipment_trackings.update', $shipmentTracking->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            @include('dashboard.shipment_trackings.form', [
                                                'shipmentTracking' => $shipmentTracking,
                                            ])
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $shipmentTrackings->links() }}
            </div>
        </div>
    </div>

    <!-- إضافة تتبع شحنة -->
    <div class="modal fade" id="addShipmentTrackingModal" tabindex="-1" aria-labelledby="addShipmentTrackingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addShipmentTrackingModalLabel">إضافة تتبع</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('shipment_trackings.store') }}" method="POST">
                        @csrf
                        @include('dashboard.shipment_trackings.form', [
                            'shipmentTracking' => new App\Models\ShipmentTracking(),
                        ])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
