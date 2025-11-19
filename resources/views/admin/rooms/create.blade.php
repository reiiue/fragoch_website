<!-- resources/views/admin/rooms/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4">Add New Room</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="room_type" class="form-label fw-bold">Room Type</label>
                    <input type="text" id="room_type" name="room_type" class="form-control" value="{{ old('room_type') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="base_price" class="form-label fw-bold">Price per Night</label>
                    <input type="number" id="base_price" name="base_price" class="form-control" step="0.01" value="{{ old('base_price') }}" required>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label fw-bold">Room Images</label>
                    <input type="file" id="images" name="images[]" class="form-control" multiple>
                    <small class="text-muted">You can upload multiple images.</small>
                </div>

                <button type="submit" class="btn btn-success">Create Room</button>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
