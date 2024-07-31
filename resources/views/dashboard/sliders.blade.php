@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Slides</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSlideModal">Create New Slide</button>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slides as $slide)
                    <tr>
                        <td><img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}" width="100"></td>
                        <td>{{ $slide->title }}</td>
                        <td>{{ $slide->description }}</td>
                        <td><a href="{{ $slide->link }}" target="_blank">{{ $slide->link }}</a></td>
                        <td>{{ ucfirst($slide->status) }}</td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editSlideModal{{ $slide->id }}">Edit</button>
                            <form action="{{ route('sliders.destroy', $slide->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Slide Modal -->
                    <div class="modal fade" id="editSlideModal{{ $slide->id }}" tabindex="-1"
                        aria-labelledby="editSlideModalLabel{{ $slide->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSlideModalLabel{{ $slide->id }}">Edit Slide</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('sliders.update', $slide->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="image{{ $slide->id }}" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image{{ $slide->id }}"
                                                name="image">
                                            <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}"
                                                width="100" class="mt-2">
                                        </div>
                                        <div class="mb-3">
                                            <label for="title{{ $slide->id }}" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title{{ $slide->id }}"
                                                name="title" value="{{ $slide->title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description{{ $slide->id }}"
                                                class="form-label">Description</label>
                                            <input type="text" class="form-control" id="description{{ $slide->id }}"
                                                name="description" value="{{ $slide->description }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="link{{ $slide->id }}" class="form-label">Link</label>
                                            <input type="url" class="form-control" id="link{{ $slide->id }}"
                                                name="link" value="{{ $slide->link }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status{{ $slide->id }}" class="form-label">Status</label>
                                            <select class="form-control" id="status{{ $slide->id }}" name="status"
                                                required>
                                                <option value="active" {{ $slide->status == 'active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="inactive"
                                                    {{ $slide->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Slide Modal -->
    <div class="modal fade" id="addSlideModal" tabindex="-1" aria-labelledby="addSlideModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSlideModalLabel">Create New Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="link" name="link">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
