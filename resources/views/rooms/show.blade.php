@extends('layouts.app')

@section('content')

@include('partials.navbar')

<!-- Breadcrumb -->
<section class="py-3" style="background-color: #f8f9fa; margin-top: 56px;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: #1a4d2e">Home</a></li>
                <li class="breadcrumb-item active">{{ $room->room_type }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- Room Images -->
            <div class="col-lg-8">
                @if($room->images && $room->images->count())
                <div id="roomCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($room->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100 rounded-3" style="height:500px; object-fit:cover;" alt="{{ $image->alt_text ?? 'Room Image' }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                <!-- Thumbnails -->
                <div class="d-flex gap-2 overflow-auto">
                    @foreach($room->images as $key => $image)
                        <img src="{{ asset('storage/' . $image->image_url) }}" class="rounded" style="width:100px;height:100px; object-fit:cover; cursor:pointer;" data-bs-target="#roomCarousel" data-bs-slide-to="{{ $key }}">
                    @endforeach
                </div>
                @else
                    <p class="text-muted">No images available for this room.</p>
                @endif
            </div>

<!-- Booking Panel -->
<div class="col-lg-4">
    <div class="card border-0 shadow-lg position-sticky" style="top:80px;">
        <div class="card-body p-4">
            <h3 class="fw-bold mb-2" style="color: #1a4d2e;">{{ $room->room_type }}</h3>

            <!-- Rating -->
            <div class="mb-4">
                <div class="d-flex align-items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= floor($room->rating ?? 0) ? '-fill' : '' }}" style="color:#c9a961;"></i>
                    @endfor
                    <span class="ms-2 fw-bold" style="color:#c9a961;">
                        {{ $room->rating ?? '0' }} 
                        <small class="text-muted">({{ $reviews->count() ?? 0 }} reviews)</small>
                    </span>
                </div>
            </div>

            <!-- Price -->
            <div class="mb-4 pb-4 border-bottom">
                <h4 class="mb-2" style="color:#c9a961;">
                    ₱{{ number_format($room->base_price ?? 0, 2) }}
                    <span class="fs-6 text-muted">/night</span>
                </h4>
                <small class="text-muted">Prices may vary based on dates and availability</small>
            </div>

            <!-- Booking Form -->
<form action="{{ route('book.create', $room->id) }}" method="GET">
    <input type="hidden" name="room_id" value="{{ $room->id }}">

    <div class="mb-3">
        <label class="form-label fw-bold small">Check-in Date</label>
        <input type="date" name="check_in_date" class="form-control mb-2" >

        <label class="form-label fw-bold small">Check-out Date</label>
        <input type="date" name="check_out_date" class="form-control mb-2" >

        <label class="form-label fw-bold small">Number of Rooms</label>
        <select name="number_of_rooms" class="form-select">
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'room' : 'rooms' }}</option>
            @endfor
        </select>
    </div>

    <button type="submit" class="btn w-100 btn-lg mb-2" style="background-color:#c9a961; color:#fff;">
        Book Now
    </button>
</form>





                    </div>
                </div>
            </div>
        </div>

        <!-- Room Description -->
        <div class="row g-4 mb-5">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3" style="color:#1a4d2e;">About This Room</h3>
                <p class="lead text-muted">{{ $room->description ?? 'No description available.' }}</p>

                <!-- Features -->
                <h4 class="fw-bold mb-3" style="color:#1a4d2e;">Room Features</h4>
                <div class="row g-3 mb-5">
                    @if(!empty($room->features) && is_array($room->features))
                        @foreach($room->features as $feature)
                            <div class="col-sm-6">
                                <div class="d-flex align-items-start p-3 bg-light rounded">
                                    <i class="bi {{ $feature['icon'] ?? 'bi-check' }} me-3" style="color:#c9a961;font-size:1.5rem;"></i>
                                    <div>
                                        <h6 class="mb-1" style="color:#1a4d2e;">{{ $feature['title'] ?? '' }}</h6>
                                        <small class="text-muted">{{ $feature['value'] ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No features available.</p>
                    @endif
                </div>

                <!-- Amenities -->
                <h4 class="fw-bold mb-3" style="color:#1a4d2e;">Room Amenities</h4>
                <div class="row g-3 mb-5">
                    @if(!empty($room->amenities) && is_array($room->amenities))
                        @foreach($room->amenities as $amenity)
                            <div class="col-sm-6">
                                <div class="d-flex align-items-start">
                                    <i class="bi {{ $amenity['icon'] ?? 'bi-check' }} me-3" style="color:#c9a961; font-size:1.3rem;"></i>
                                    <div>
                                        <h6>{{ $amenity['name'] ?? '' }}</h6>
                                        <small class="text-muted">{{ $amenity['description'] ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No amenities available.</p>
                    @endif
                </div>

                <!-- Reviews -->
                <h4 class="fw-bold mb-3" style="color:#1a4d2e;">Guest Reviews ({{ $reviews->count() ?? 0 }})</h4>
                @if(isset($reviews) && $reviews->count())
                    @foreach($reviews as $review)
                        <div class="card mb-3 bg-light border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-0">{{ $review->user->name ?? 'Anonymous' }}</h6>
                                        <small class="text-muted">{{ $review->created_at->format('M d, Y') ?? '' }}</small>
                                    </div>
                                    <div>
                                        @for($i=1;$i<=5;$i++)
                                            <i class="bi bi-star{{ $i <= ($review->rating ?? 0) ? '-fill' : '' }}" style="color:#c9a961;font-size:0.8rem;"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="mb-0">{{ $review->content ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No reviews yet.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
