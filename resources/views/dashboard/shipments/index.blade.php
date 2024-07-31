<!-- resources/views/shipments/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Shipments</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShipmentModal">
                Add Shipment
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
                        <th>User</th>
                        <th>Container</th>
                        <th>Status</th>
                        <th>Tracking Number</th>
                        <th>Sent Date</th>
                        <th>Delivered Date</th>
                        <th>Weight</th>
                        <th>Dimensions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $shipment)
                        <tr>
                            <td>{{ $shipment->user->name }}</td>
                            <td>{{ $shipment->container->container_number }}</td>
                            <td>{{ ucfirst($shipment->status) }}</td>
                            <td>{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->sent_date }}</td>
                            <td>{{ $shipment->delivered_date }}</td>
                            <td>{{ $shipment->weight }}</td>
                            <td>{{ $shipment->dimensions }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editShipmentModal{{ $shipment->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('shipments.destroy', $shipment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Shipment Modal -->
                        <div class="modal fade" id="editShipmentModal{{ $shipment->id }}" tabindex="-1"
                            aria-labelledby="editShipmentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editShipmentModalLabel">Edit Shipment</h5>
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
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
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

    <!-- Add Shipment Modal -->
    <div class="modal fade" id="addShipmentModal" tabindex="-1" aria-labelledby="addShipmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addShipmentModalLabel">Add Shipment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('shipments.store') }}" method="POST">
                        @csrf
                        @include('dashboard.shipments.form', ['shipment' => new App\Models\Shipment()])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
