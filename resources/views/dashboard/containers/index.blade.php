<!-- resources/views/containers/index.blade.php -->

@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Containers</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContainerModal">
                Add Container
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
                        <th>Container Number</th>
                        <th>Size</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($containers as $container)
                        <tr>
                            <td>{{ $container->container_number }}</td>
                            <td>{{ $container->size }}</td>
                            <td>{{ $container->notes }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editContainerModal{{ $container->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('containers.destroy', $container->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Container Modal -->
                        <div class="modal fade" id="editContainerModal{{ $container->id }}" tabindex="-1"
                            aria-labelledby="editContainerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editContainerModalLabel">Edit Container</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('containers.update', $container->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @include('dashboard.containers.form', ['container' => $container])
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
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

    <!-- Add Container Modal -->
    <div class="modal fade" id="addContainerModal" tabindex="-1" aria-labelledby="addContainerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContainerModalLabel">Add Container</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('containers.store') }}" method="POST">
                        @csrf
                        @include('dashboard.containers.form', ['container' => new App\Models\Container()])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
