<!-- resources/views/dashboard/users/form.blade.php -->

<div class="mb-3">
    <label for="name" class="form-label">الاسم</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">البريد الإلكتروني</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
</div>
<div class="mb-3">
    <label for="phone" class="form-label">رقم الهاتف</label>
    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
</div>
<div class="mb-3">
    <label for="address" class="form-label">العنوان</label>
    <input type="text" class="form-control" id="address" name="address"
        value="{{ old('address', $user->address) }}" required>
</div>
<div class="mb-3">
    <label for="role" class="form-label">الصلاحية</label>
    <select class="form-select" id="role" name="role" required>
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
        <option value="driver" {{ old('role', $user->role) == 'driver' ? 'selected' : '' }}>Driver</option>
        <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
        <option value="company" {{ old('role', $user->role) == 'company' ? 'selected' : '' }}>Company</option>
    </select>
</div>
<div class="mb-3">
    <label for="avatar" class="form-label">الصورة</label>
    <input type="file" class="form-control" id="avatar" name="avatar">
    @if ($user->avatar)
        <div class="mt-2">
            <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" style="width: 100px;">
        </div>
    @endif
</div>
<div class="mb-3">
    <label for="password" class="form-label">كلمة المرور</label>
    <input type="password" class="form-control" id="password" name="password" required>
</div>
