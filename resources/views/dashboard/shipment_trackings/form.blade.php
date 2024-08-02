<!-- resources/views/shipment_trackings/form.blade.php -->

<div class="mb-3">
    <label for="shipment_id" class="form-label">Shipment</label>
    <select class="form-select" id="container_id" name="container_id" required>
        @foreach (App\Models\Container::all() as $shipment)
            <option value="{{ $shipment->id }}"
                {{ old('container_id', $shipmentTracking->shipment_id) == $shipment->id ? 'selected' : '' }}>
                {{ $shipment->container_number }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="location_id" class="form-label">Location</label>
    <select class="form-select" id="location_id" name="location_id" required>
        @foreach (App\Models\Location::all() as $location)
            <option value="{{ $location->id }}"
                {{ old('location_id', $shipmentTracking->location_id) == $location->id ? 'selected' : '' }}>
                {{ $location->name }}</option>
        @endforeach
    </select>
</div>
