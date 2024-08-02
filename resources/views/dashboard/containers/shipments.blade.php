@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>الشحنات</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShipmentModal">
                إضافة شحنة
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
                        <th>المستخدم</th>
                        <th>الحاوية</th>
                        <th>الحالة</th>
                        <th>أماكن الشحنة</th>
                        <th>رقم التتبع</th>
                        <th>تاريخ الإرسال</th>
                        <th>تاريخ الاستلام</th>
                        <th>الوزن</th>
                        <th>الأبعاد</th>
                        <th>العد التنازلي</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $shipment)
                        <tr>
                            <td>{{ $shipment->user->name }}</td>
                            <td>{{ $shipment->container->container_number }}</td>
                            <td>{{ __('حالة الشحن - ') . ucfirst($shipment->status) }}</td>
                            <td>
                                <ul>
                                    @foreach ($shipment->container->location as $tracking)
                                        <li>{{ $tracking->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->sent_date }}</td>
                            <td>{{ $shipment->delivered_date }}</td>
                            <td>{{ $shipment->weight }}</td>
                            <td>{{ $shipment->dimensions }}</td>
                            <td>
                                @php
                                    $deliveredDate = \Carbon\Carbon::parse($shipment->delivered_date);
                                    $currentDate = \Carbon\Carbon::now();
                                    $daysLeft = $currentDate->diffInDays($deliveredDate, false);
                                @endphp
                                @if ($daysLeft > 0)
                                    <span class="text-success">{{ $daysLeft }} يوم</span>
                                @elseif($daysLeft == 0)
                                    <span class="text-warning">اليوم</span>
                                @else
                                    <span class="text-danger">تأخر {{ abs($daysLeft) }} يوم</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editShipmentModal{{ $shipment->id }}">
                                    تعديل
                                </button>
                                <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>

                        <!-- تعديل شحنة -->
                        <div class="modal fade" id="editShipmentModal{{ $shipment->id }}" tabindex="-1"
                            aria-labelledby="editShipmentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editShipmentModalLabel">تعديل الشحنة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('shipments.update', $shipment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @include('dashboard.shipments.form', ['shipment' => $shipment])
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
                {{ $shipments->links() }}
            </div>
        </div>
    </div>

    <!-- إضافة شحنة -->
    <div class="modal fade" id="addShipmentModal" tabindex="-1" aria-labelledby="addShipmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addShipmentModalLabel">إضافة شحنة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('shipments.store') }}" method="POST">
                        @csrf
                        @include('dashboard.shipments.form', ['shipment' => new App\Models\Shipment()])
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
