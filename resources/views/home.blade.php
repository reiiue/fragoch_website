@extends('layouts.app')

@section('content')

@include('partials.navbar')


<!-- Hero Section -->
<section class="hero" style="
    background-image: url('{{ asset('images/background.jpg') }}');
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 56px;
    position: relative;
    filter: saturate(1.5); /* Increase saturation */
">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(26, 77, 46, 0.5);"></div>

<div class="text-center text-white" style="position: relative; z-index: 1;">

    <h1 class="fw-bold mb-4 animate__animated animate__fadeInDown"
        style="
            font-size: 4rem;
            letter-spacing: 2px;
            color: #ffb066;
            text-shadow: 0 4px 15px rgba(0,0,0,0.6), 0 0 20px rgba(255,140,0,0.6);
        ">
        Welcome to <span style="color:#ff8c00;">Fragoch Tourist Inn</span>
    </h1>

    <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-1s"
       style="
            font-size: 1.7rem;
            opacity: 0.95;
            color: #ffe2c4;
            text-shadow: 0 2px 8px rgba(0,0,0,0.4);
       ">
        Explore Biliran and Experience comfort within budget at Fragoch.
    </p>

    <a href="{{ auth()->check() ? '#rooms' : route('login') }}"
       class="btn btn-lg animate__animated animate__zoomIn animate__delay-2s"
       style="
            background: linear-gradient(135deg, #ff8c00, #ff6f00);
            color: #fff;
            padding: 14px 45px;
            font-size: 1.3rem;
            border-radius: 50px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 10px 25px rgba(255,120,0,0.5);
            transition: 0.3s ease;
       "
       onmouseover="this.style.background='linear-gradient(135deg, #ff9e23, #ff7b00)'; this.style.transform='translateY(-4px)';"
       onmouseout="this.style.background='linear-gradient(135deg, #ff8c00, #ff6f00)'; this.style.transform='translateY(0)';"
    >
        Book Your Stay
    </a>

</div>

</section>



<!-- About Section -->
<section id="about" class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="{{ asset('images/fragoch-about.jpg') }}" 
                alt="Fragoch Tourist Inn Interior" 
                class="img-fluid rounded-3">
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4" style="color: #1a4d2e;">About Our Hotel</h2>
                <p class="fs-5 mb-3 text-muted">
                    Nestled in the heart of the city, our 5-star hotel offers an unparalleled experience of luxury and hospitality. 
                    With over 50 years of excellence in service, we pride ourselves on delivering exceptional comfort to our guests.
                </p>
                <p class="fs-5 mb-4 text-muted">
                    Our award-winning staff is dedicated to making your stay memorable. From world-class dining to spa facilities, 
                    every detail is designed to ensure your complete satisfaction.
                </p>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-star-fill me-3" style="font-size: 1.5rem; color: #c9a961;"></i>
                            <span class="fs-6"><strong>5-Star Rated</strong></span>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-award-fill me-3" style="font-size: 1.5rem; color: #c9a961;"></i>
                            <span class="fs-6"><strong>Award Winning</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Amenities Section -->
<section id="amenities" class="py-5">
    <div class="container">
        <h2 class="text-center display-5 fw-bold mb-5" style="color: #1a4d2e;">World-Class Amenities</h2>
        <div class="row g-4">
            @php
                $amenities = [
                    ['icon' => 'bi-cup-hot', 'title' => 'Fine Dining', 'desc' => 'Michelin-starred restaurants and bars'],
                    ['icon' => 'bi-droplet', 'title' => 'Spa & Wellness', 'desc' => 'Luxury spa with sauna and steam room'],
                    ['icon' => 'bi-bicycle', 'title' => 'Fitness Center', 'desc' => 'State-of-the-art gym facilities'],
                    ['icon' => 'bi-water', 'title' => 'Swimming Pool', 'desc' => 'Olympic-size heated pool'],
                    ['icon' => 'bi-wifi', 'title' => 'High-Speed WiFi', 'desc' => 'Complimentary throughout the hotel'],
                    ['icon' => 'bi-car-front', 'title' => 'Valet Parking', 'desc' => 'Secure underground parking'],
                ];
            @endphp
            @foreach ($amenities as $amenity)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4" style="background-color: #f8f9fa;">
                        <i class="bi {{ $amenity['icon'] }} mb-3" style="font-size: 2.5rem; color: #1a4d2e;"></i>
                        <h5 class="fw-bold mb-2" style="color: #1a4d2e;">{{ $amenity['title'] }}</h5>
                        <p class="text-muted mb-0">{{ $amenity['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Rooms Section -->
<section id="rooms" class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="text-center display-5 fw-bold mb-5" style="color: #1a4d2e;">Our Exclusive Rooms</h2>

        <div class="row g-4">

            @foreach ($rooms as $room)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">

                        <!-- ROOM IMAGE -->
                        @php
                            $image = $room->images->first();
                            $imageUrl = $image ? (Str::startsWith($image->image_url, ['http', 'https']) ? $image->image_url : asset('storage/' . $image->image_url)) : 'https://via.placeholder.com/400x300?text=No+Image';
                            $altText = $image->alt_text ?? $room->room_type;
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $altText }}" class="card-img-top" style="height: 250px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: #1a4d2e;">
                                {{ $room->room_type }}
                            </h5>
                        <p class="card-text text-muted mb-3">
                            {{ Str::limit($room->description, 120, '...') ?? 'A comfortable room for your stay.' }}
                        </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-bold" style="color: #c9a961;">
                                    ₱{{ number_format($room->base_price, 2) }}/night
                                </span>

                                <!-- BOOK BUTTON -->
                                <a href="{{ route('rooms.show', $room->id) }}" 
                                class="btn btn-sm" 
                                style="background-color:#1a4d2e; color:#fff;">
                                    View Details
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>



<!-- Booking Section -->
<section id="booking" class="py-5">
    <div class="container">
        <h2 class="text-center display-5 fw-bold mb-5" style="color: #1a4d2e;">Book Your Perfect Stay</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div id="booking-success" class="alert alert-success mb-4 d-none" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            Booking request submitted successfully! We'll confirm shortly.
                        </div>
                        <form id="booking-form">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Check-in Date</label>
                                    <input type="date" class="form-control border-2" name="checkIn" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Check-out Date</label>
                                    <input type="date" class="form-control border-2" name="checkOut" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Number of Guests</label>
                                    <select class="form-select border-2" name="guests">
                                        @for ($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Number of Rooms</label>
                                    <select class="form-select border-2" name="rooms">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Room' : 'Rooms' }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg w-100" style="background-color: #1a4d2e; color: #fff;">
                                <i class="bi bi-check-circle me-2"></i>Complete Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking JS -->
<script>
document.getElementById('booking-form').addEventListener('submit', function(e){
    e.preventDefault();
    document.getElementById('booking-success').classList.remove('d-none');
    setTimeout(() => {
        document.getElementById('booking-success').classList.add('d-none');
        this.reset();
    }, 3000);
});
</script>

@endsection
