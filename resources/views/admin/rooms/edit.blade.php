<!-- resources/views/admin/rooms/edit.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4">Edit Room - {{ $room->room_type }}</h2>

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
            <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="room_type" class="form-label fw-bold">Room Type</label>
                    <input type="text" id="room_type" name="room_type" class="form-control" value="{{ old('room_type', $room->room_type) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $room->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="base_price" class="form-label fw-bold">Price per Night</label>
                    <input type="number" id="base_price" name="base_price" class="form-control" step="0.01" value="{{ old('base_price', $room->base_price) }}" required>
                </div>

                <!-- Room Features -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Room Features</label>
                    <div id="features-wrapper">
                        @if(old('features', $room->features))
                            @foreach(old('features', $room->features) as $i => $feature)
                                <div class="row mb-2 feature-row">
                                    <div class="col-md-4">
                                        <input type="text" name="features[{{ $i }}][title]" class="form-control" placeholder="Title" value="{{ $feature['title'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="features[{{ $i }}][value]" class="form-control" placeholder="Value" value="{{ $feature['value'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="features[{{ $i }}][icon]" class="form-control" placeholder="Icon class" value="{{ $feature['icon'] ?? '' }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger btn-sm remove-feature">&times;</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-success btn-sm mt-2" id="add-feature">Add Feature</button>
                </div>

                <!-- Room Amenities -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Room Amenities</label>
                    <div id="amenities-wrapper">
                        @if(old('amenities', $room->amenities))
                            @foreach(old('amenities', $room->amenities) as $i => $amenity)
                                <div class="row mb-2 amenity-row">
                                    <div class="col-md-4">
                                        <input type="text" name="amenities[{{ $i }}][name]" class="form-control" placeholder="Name" value="{{ $amenity['name'] ?? '' }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="amenities[{{ $i }}][description]" class="form-control" placeholder="Description" value="{{ $amenity['description'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="amenities[{{ $i }}][icon]" class="form-control" placeholder="Icon class" value="{{ $amenity['icon'] ?? '' }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger btn-sm remove-amenity">&times;</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-success btn-sm mt-2" id="add-amenity">Add Amenity</button>
                </div>

                <!-- Current Images -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Current Images</label>
                    <div class="d-flex flex-wrap gap-2 mb-2">
                        @foreach($room->images as $image)
                            <div class="position-relative" style="width: 100px; height: 80px;">
                                <img src="{{ asset('storage/' . $image->image_url) }}" 
                                    alt="{{ $image->alt_text }}" 
                                    class="img-thumbnail" 
                                    style="width: 100px; height: 80px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>

                    <label for="images" class="form-label fw-bold">Upload New Images</label>
                    <input type="file" id="images" name="images[]" class="form-control" multiple>
                    <small class="text-muted">Upload new images to replace or add to existing ones.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Room</button>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<!-- JS to add/remove features and amenities dynamically -->
@push('scripts')
<script>
    let featureIndex = {{ count(old('features', $room->features ?? [])) }};
    let amenityIndex = {{ count(old('amenities', $room->amenities ?? [])) }};

    document.getElementById('add-feature').addEventListener('click', function() {
        const wrapper = document.getElementById('features-wrapper');
        const row = document.createElement('div');
        row.classList.add('row', 'mb-2', 'feature-row');
        row.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="features[${featureIndex}][title]" class="form-control" placeholder="Title" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="features[${featureIndex}][value]" class="form-control" placeholder="Value" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="features[${featureIndex}][icon]" class="form-control" placeholder="Icon class">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-feature">&times;</button>
            </div>
        `;
        wrapper.appendChild(row);
        featureIndex++;
    });

    document.getElementById('features-wrapper').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-feature')){
            e.target.closest('.feature-row').remove();
        }
    });

    document.getElementById('add-amenity').addEventListener('click', function() {
        const wrapper = document.getElementById('amenities-wrapper');
        const row = document.createElement('div');
        row.classList.add('row', 'mb-2', 'amenity-row');
        row.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="amenities[${amenityIndex}][name]" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="amenities[${amenityIndex}][description]" class="form-control" placeholder="Description">
            </div>
            <div class="col-md-2">
                <input type="text" name="amenities[${amenityIndex}][icon]" class="form-control" placeholder="Icon class">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-amenity">&times;</button>
            </div>
        `;
        wrapper.appendChild(row);
        amenityIndex++;
    });

    document.getElementById('amenities-wrapper').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-amenity')){
            e.target.closest('.amenity-row').remove();
        }
    });
</script>
@endpush

@endsection
