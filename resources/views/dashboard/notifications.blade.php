@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>الاشعارات</h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNotificationModal">إضافة
                إشعار</button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>العنوان</th>
                        <th>الوصف</th>
                        <th>الصورة</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->title }}</td>
                            <td>{{ $notification->body }}</td>
                            <td>{{ $notification->image }}</td>
                            <td>
                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Notification Modal -->
    <div class="modal fade" id="addNotificationModal" tabindex="-1" aria-labelledby="addNotificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNotificationModalLabel">إضافة إشعار جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('notifications.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">العنوان</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="body">الوصف</label>
                            <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">الصورة</label>
                            <input type="text" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection