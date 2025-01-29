@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">إدارة بيانات WebEn</h1>

        <!-- نموذج الإضافة -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>إضافة بيانات جديدة</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('web-ens.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- عنوان الموقع -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="site_title">عنوان الموقع</label>
                                <input type="text" name="site_title" class="form-control"
                                    placeholder="أدخل عنوان الموقع">
                            </div>
                        </div>

                        <!-- وصف الموقع -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="site_description">وصف الموقع</label>
                                <input type="text" name="site_description" class="form-control"
                                    placeholder="أدخل وصف الموقع">
                            </div>
                        </div>

                        <!-- صورة الموقع -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="site_image">صورة الموقع</label>
                                <input type="file" name="site_image" class="form-control">
                            </div>
                        </div>

                        <!-- الكلمات المفتاحية -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="keywords">الكلمات المفتاحية</label>
                                <input type="text" name="keywords" class="form-control"
                                    placeholder="أدخل الكلمات المفتاحية">
                            </div>
                        </div>

                        <!-- عنوان البطل -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="hero_title">عنوان البطل</label>
                                <input type="text" name="hero_title" class="form-control" placeholder="أدخل عنوان البطل">
                            </div>
                        </div>

                        <!-- وصف البطل -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="hero_description">وصف البطل</label>
                                <input type="text" name="hero_description" class="form-control"
                                    placeholder="أدخل وصف البطل">
                            </div>
                        </div>

                        <!-- صورة البطل -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="hero_image">صورة البطل</label>
                                <input type="file" name="hero_image" class="form-control">
                            </div>
                        </div>

                        <!-- عنوان القسم "نبذة عنا" -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="about_title">عنوان القسم "نبذة عنا"</label>
                                <input type="text" name="about_title" class="form-control"
                                    placeholder="أدخل عنوان القسم">
                            </div>
                        </div>

                        <!-- وصف القسم "نبذة عنا" -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="about_description">وصف القسم "نبذة عنا"</label>
                                <input type="text" name="about_description" class="form-control"
                                    placeholder="أدخل وصف القسم">
                            </div>
                        </div>

                        <!-- صورة القسم "نبذة عنا" -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="about_image">صورة القسم "نبذة عنا"</label>
                                <input type="file" name="about_image" class="form-control">
                            </div>
                        </div>

                        <!-- ميزات القسم "نبذة عنا" -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="about_features">ميزات القسم "نبذة عنا"</label>
                                <textarea name="about_features" class="form-control" placeholder="أدخل الميزات كـ JSON"></textarea>
                            </div>
                        </div>

                        <!-- عنوان القسم "الموقع" -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="location_title">عنوان القسم "الموقع"</label>
                                <input type="text" name="location_title" class="form-control"
                                    placeholder="أدخل عنوان القسم">
                            </div>
                        </div>

                        <!-- وصف القسم "الموقع" -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="location_description">وصف القسم "الموقع"</label>
                                <input type="text" name="location_description" class="form-control"
                                    placeholder="أدخل وصف القسم">
                            </div>
                        </div>

                        <!-- صورة القسم "الموقع" -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="location_image">صورة القسم "الموقع"</label>
                                <input type="file" name="location_image" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- زر الحفظ -->
                    <button type="submit" class="btn btn-success">حفظ</button>
                </form>
            </div>
        </div>

        <!-- جدول عرض البيانات -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>عرض البيانات</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>عنوان الموقع</th>
                            <th>وصف الموقع</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($webEns as $webEn)
                            <tr>
                                <td>{{ $webEn->site_title }}</td>
                                <td>{{ $webEn->site_description }}</td>
                                <td>
                                    <!-- زر التعديل -->
                                    <a href="{{ route('web-ens.edit', $webEn->id) }}"
                                        class="btn btn-sm btn-warning">تعديل</a>
                                    <!-- نموذج الحذف -->
                                    <form action="{{ route('web-ens.destroy', $webEn->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
