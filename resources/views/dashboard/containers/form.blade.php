<!-- resources/views/containers/form.blade.php -->

<div class="mb-3">
    <label for="container_number" class="form-label">رقم الحاوية</label>
    <input type="text" class="form-control" id="container_number" name="container_number"
        value="{{ old('container_number', $container->container_number) }}" required>
</div>
<div class="mb-3">
    <label for="size" class="form-label">الحجم</label>
    <select class="form-select" id="size" name="size" required>
        <option value="20" {{ old('size', $container->size) == '20' ? 'selected' : '' }}>20</option>
        <option value="40" {{ old('size', $container->size) == '40' ? 'selected' : '' }}>40</option>
        <option value="45" {{ old('size', $container->size) == '45' ? 'selected' : '' }}>45</option>
        <option value="20HC" {{ old('size', $container->size) == '20HC' ? 'selected' : '' }}>20HC</option>
        <option value="40HC" {{ old('size', $container->size) == '40HC' ? 'selected' : '' }}>40HC</option>
        <option value="45HC" {{ old('size', $container->size) == '45HC' ? 'selected' : '' }}>45HC</option>
    </select>
</div>
<div class="mb-3">
    <label for="notes" class="form-label">ملحوظة</label>
    <textarea class="form-control" id="notes" name="notes">{{ old('notes', $container->notes) }}</textarea>
</div>
