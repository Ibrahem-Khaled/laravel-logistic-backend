<div class="mb-3">
    <label for="user_id" class="form-label">المستخدم</label>
    <select class="form-select" id="user_id" name="user_id" required>
        @foreach (App\Models\User::all() as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $shipment->user_id) == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="container_id" class="form-label">الحاوية</label>
    <select class="form-select" id="container_id" name="container_id" required>
        @foreach (App\Models\Container::all() as $container)
            <option value="{{ $container->id }}"
                {{ old('container_id', $shipment->container_id) == $container->id ? 'selected' : '' }}>
                {{ $container->container_number }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="type" class="form-label">نوع الشحنة</label>
    <select class="form-select" id="type" name="type" required>
        <option value="aerial" {{ old('type', $shipment->type) == 'aerial' ? 'selected' : '' }}>جوي</option>
        <option value="ground" {{ old('type', $shipment->type) == 'ground' ? 'selected' : '' }}>بري</option>
        <option value="nautical" {{ old('type', $shipment->type) == 'nautical' ? 'selected' : '' }}>بحري</option>
    </select>
</div>

<div class="mb-3">
    <label for="tracking_number" class="form-label">رقم التتبع</label>
    <input type="text" class="form-control" id="tracking_number" name="tracking_number"
        value="{{ old('tracking_number', $shipment->tracking_number) }}" required>
</div>

<div class="mb-3">
    <label for="sent_area" class="form-label">منطقة الإرسال</label>
    <input type="text" class="form-control" id="sent_area" name="sent_area"
        value="{{ old('sent_area', $shipment->sent_area) }}" required>
</div>

<div class="mb-3">
    <label for="delivered_area" class="form-label">منطقة الاستلام</label>
    <input type="text" class="form-control" id="delivered_area" name="delivered_area"
        value="{{ old('delivered_area', $shipment->delivered_area) }}" required>
</div>

<div class="mb-3">
    <label for="sent_date" class="form-label">تاريخ الإرسال</label>
    <input type="date" class="form-control" id="sent_date" name="sent_date"
        value="{{ old('sent_date', $shipment->sent_date) }}">
</div>

<div class="mb-3">
    <label for="delivered_date" class="form-label">تاريخ الاستلام</label>
    <input type="date" class="form-control" id="delivered_date" name="delivered_date"
        value="{{ old('delivered_date', $shipment->delivered_date) }}">
</div>

<div class="mb-3">
    <label for="weight" class="form-label">الوزن (كغ)</label>
    <input type="number" class="form-control" id="weight" name="weight"
        value="{{ old('weight', $shipment->weight) }}" required>
</div>

<div class="mb-3">
    <label for="dimensions" class="form-label">مكعب (متر)</label>
    <input type="text" class="form-control" id="dimensions" name="dimensions"
        value="{{ old('dimensions', $shipment->dimensions) }}" required>
</div>

<div class="mb-3">
    <label for="price" class="form-label">السعر</label>
    <input type="number" class="form-control" id="price" name="price"
        value="{{ old('price', $shipment->price) }}" step="0.01" required>
</div>

<div class="mb-3">
    <label for="shipment_count" class="form-label">عدد الشحنات</label>
    <input type="number" class="form-control" id="shipment_count" name="shipment_count"
        value="{{ old('shipment_count', $shipment->shipment_count) }}" required>
</div>
