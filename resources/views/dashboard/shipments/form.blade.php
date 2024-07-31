<!-- resources/views/shipments/form.blade.php -->

<div class="mb-3">
    <label for="user_id" class="form-label">User</label>
    <select class="form-select" id="user_id" name="user_id" required>
        @foreach (App\Models\User::all() as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $shipment->user_id) == $user->id ? 'selected' : '' }}>
                {{ $user->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="container_id" class="form-label">Container</label>
    <select class="form-select" id="container_id" name="container_id" required>
        @foreach (App\Models\Container::all() as $container)
            <option value="{{ $container->id }}"
                {{ old('container_id', $shipment->container_id) == $container->id ? 'selected' : '' }}>
                {{ $container->container_number }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select" id="status" name="status" required>
        <option value="pending" {{ old('status', $shipment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_transit" {{ old('status', $shipment->status) == 'in_transit' ? 'selected' : '' }}>In Transit
        </option>
        <option value="delivered" {{ old('status', $shipment->status) == 'delivered' ? 'selected' : '' }}>Delivered
        </option>
        <option value="failed" {{ old('status', $shipment->status) == 'failed' ? 'selected' : '' }}>Failed</option>
    </select>
</div>
<div class="mb-3">
    <label for="tracking_number" class="form-label">Tracking Number</label>
    <input type="text" class="form-control" id="tracking_number" name="tracking_number"
        value="{{ old('tracking_number', $shipment->tracking_number) }}">
</div>
<div class="mb-3">
    <label for="sent_date" class="form-label">Sent Date</label>
    <input type="date" class="form-control" id="sent_date" name="sent_date"
        value="{{ old('sent_date', $shipment->sent_date) }}">
</div>
<div class="mb-3">
    <label for="delivered_date" class="form-label">Delivered Date</label>
    <input type="date" class="form-control" id="delivered_date" name="delivered_date"
        value="{{ old('delivered_date', $shipment->delivered_date) }}">
</div>
<div class="mb-3">
    <label for="weight" class="form-label">Weight</label>
    <input type="number" class="form-control" id="weight" name="weight"
        value="{{ old('weight', $shipment->weight) }}">
</div>
<div class="mb-3">
    <label for="dimensions" class="form-label">Dimensions</label>
    <input type="text" class="form-control" id="dimensions" name="dimensions"
        value="{{ old('dimensions', $shipment->dimensions) }}">
</div>
