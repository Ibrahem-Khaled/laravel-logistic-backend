<!-- resources/views/containers/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>الحاويات</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContainerModal">
                إضافة حاوية
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
                        <th>رقم الحاوية</th>
                        <th>الحجم</th>
                        <th>الملاحظات</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($containers as $container)
                        <tr>
                            <td><a
                                    href="{{ route('containers.shipments', $container->id) }}">{{ $container->container_number }}</a>
                            </td>
                            <td>{{ $container->size }}</td>
                            <td>{{ $container->notes }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editContainerModal{{ $container->id }}">
                                    تعديل
                                </button>
                                <form action="{{ route('containers.destroy', $container->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>

                        <!-- تعديل حاوية -->
                        <div class="modal fade" id="editContainerModal{{ $container->id }}" tabindex="-1"
                            aria-labelledby="editContainerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editContainerModalLabel">تعديل الحاوية</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('containers.update', $container->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @include('dashboard.containers.form', [
                                                'container' => $container,
                                            ])
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $containers->links() }}
            </div>
        </div>
    </div>

    <!-- إضافة حاوية -->
    <div class="modal fade" id="addContainerModal" tabindex="-1" aria-labelledby="addContainerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContainerModalLabel">إضافة حاوية</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('containers.store') }}" method="POST">
                        @csrf
                        @include('dashboard.containers.form', ['container' => new App\Models\Container()])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
