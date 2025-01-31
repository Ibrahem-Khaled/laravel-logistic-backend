@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">إدارة بيانات الموقع باللغة الانجليزية</h1>

        <!-- زر فتح مودال الإضافة -->

        @if ($webEns->isEmpty())
            <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#formModal"
                data-action="{{ route('web-ens.store') }}">
                إضافة بيانات جديدة
            </button>
        @endif

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
                                    <!-- زر فتح مودال التعديل -->
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#formModalEdit{{ $webEn->id }}"
                                        data-action="{{ route('web-ens.update', $webEn->id) }}">
                                        تعديل
                                    </button>

                                    <!-- مودال التعديل -->
                                    <div class="modal fade" id="formModalEdit{{ $webEn->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="formModalEditLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="formModalEditLabel">تعديل بيانات WebEn</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('dashboard.web.form', [
                                                        'action' => route('web-ens.update', $webEn->id),
                                                        'method' => 'PUT',
                                                        'webEn' => $webEn,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <!-- نموذج الحذف -->
                                    <form action="{{ route('web-ens.destroy', $webEn->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- مودال الإضافة -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">إضافة بيانات جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.web.form', [
                        'action' => route('web-ens.store'),
                        'method' => 'POST',
                        'webEn' => null,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
