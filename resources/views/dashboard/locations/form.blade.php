<!-- resources/views/locations/form.blade.php -->

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $location->name) }}"
        required>
</div>
<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address"
        value="{{ old('address', $location->address) }}">
</div>
<div class="mb-3">
    <label for="region" class="form-label">Region</label>
    <input type="text" class="form-control" id="region" name="region"
        value="{{ old('region', $location->region) }}">
</div>
