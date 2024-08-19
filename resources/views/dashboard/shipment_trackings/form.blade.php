<!-- resources/views/shipment_trackings/form.blade.php -->

<div class="mb-3">
    <label for="shipment_id" class="form-label">الحاوية</label>
    <select class="form-select" id="container_id" name="container_id" required>
        @foreach (App\Models\Container::all() as $shipment)
            <option value="{{ $shipment->id }}"
                {{ old('container_id', $shipmentTracking->shipment_id) == $shipment->id ? 'selected' : '' }}>
                {{ $shipment->container_number }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="location_id" class="form-label">الموقع</label>
    <select class="form-select" id="location_id" name="location_id" required>
        @foreach (App\Models\Location::all() as $location)
            <option value="{{ $location->id }}"
                {{ old('location_id', $shipmentTracking->location_id) == $location->id ? 'selected' : '' }}>
                {{ $location->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="delivered_date" class="form-label">التاريخ</label>
    <input type="date" class="form-control" id="delivered_date" name="delivered_date"
        value="{{ old('delivered_date', $shipmentTracking->delivered_date) }}">
</div>
<div class="mb-3">
    <label for="expected_arrival_date" class="form-label">تاريخ التسليم المتوقع</label>
    <input type="date" class="form-control" id="expected_arrival_date" name="expected_arrival_date"
        value="{{ old('expected_arrival_date', $shipmentTracking->expected_arrival_date) }}">
</div>
