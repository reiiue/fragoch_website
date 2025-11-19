<!-- resources/views/admin/rooms/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Rooms</h2>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-success">Add New Room</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room Type</th>
                        <th>Description</th>
                        <th>Price per Night</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->room_type }}</td>
                            <td class="description-cell" title="{{ $room->description }}">
                                {{ \Illuminate\Support\Str::limit($room->description, 100) }}
                            </td>
                            <td>₱{{ number_format($room->base_price, 2) }}</td>
<td>
    <div class="d-flex gap-2 align-items-center">
        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-primary btn-sm">Edit</a>
        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-inline-flex m-0">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No rooms found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Optional CSS to handle long descriptions -->
<style>
.description-cell {
    max-width: 300px; /* Adjust as needed */
    word-wrap: break-word;
}
</style>
@endsection
