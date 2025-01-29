@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>السلايدر</h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSliderModal">
                إضافة سلايدر
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
                        <th>العنوان</th>
                        <th>المحتوى</th>
                        <th>الصورة</th>
                        <th>الرابط</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->body }}</td>
                            <td>
                                @if ($slider->image)
                                    <img src="{{ Storage::url($slider->image) }}" alt="الصورة" style="width: 100px;">
                                @else
                                    <span>لا توجد صورة</span>
                                @endif
                            </td>
                            <td>{{ $slider->link }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editSliderModal{{ $slider->id }}">
                                    تعديل
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deleteConfirmationModal{{ $slider->id }}">
                                    حذف
                                </button>
                            </td>
                        </tr>

                        <!-- تعديل سلايدر -->
                        <div class="modal fade" id="editSliderModal{{ $slider->id }}" tabindex="-1"
                            aria-labelledby="editSliderModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSliderModalLabel">تعديل السلايدر</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('sliders.update', $slider->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="title" class="form-label">العنوان</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ $slider->title }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="body" class="form-label">المحتوى</label>
                                                <textarea class="form-control" id="body" name="body">{{ $slider->body }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">الصورة</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                                @if ($slider->image)
                                                    <div class="mt-2">
                                                        <img src="{{ Storage::url($slider->image) }}" alt="الصورة"
                                                            style="width: 100px;">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="link" class="form-label">الرابط</label>
                                                <input type="text" class="form-control" id="link" name="link"
                                                    value="{{ $slider->link }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $slider->id }}" tabindex="-1"
                            aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">تأكيد الحذف</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>هل أنت متأكد أنك تريد حذف هذا السلايدر؟</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">إلغاء</button>
                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- إضافة سلايدر -->
    <div class="modal fade" id="addSliderModal" tabindex="-1" aria-labelledby="addSliderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSliderModalLabel">إضافة سلايدر</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">العنوان</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">المحتوى</label>
                            <textarea class="form-control" id="body" name="body"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">الصورة</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">الرابط</label>
                            <input type="text" class="form-control" id="link" name="link">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary">إضافة سلايدر</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
