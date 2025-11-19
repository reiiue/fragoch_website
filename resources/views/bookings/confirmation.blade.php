@extends('layouts.app')

@section('content')

@include('partials.navbar')

<section class="py-5" style="background-color: #f8f9fa; margin-top: 56px; min-height: 100vh;">
    <div class="container">
        {{-- Success Header --}}
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <div style="width:100px;height:100px;border-radius:50%;background-color:#d4edda;display:flex;align-items:center;justify-content:center;margin:0 auto 30px;font-size:3rem;color:#155724;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h1 class="fw-bold mb-3" style="color:#1a4d2e;font-size:2.5rem;">
                        Your Booking is Confirmed!
                    </h1>
                    <p class="text-muted fs-5 mb-4">
                        Thank you for choosing Luxury Hotel. Your reservation is complete and we look forward to your arrival.
                    </p>
                </div>

                {{-- Booking Reference Card --}}
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-body p-5 text-center">
                        <p class="text-muted mb-2">Your Booking Reference</p>
                        <h2 class="fw-bold mb-3" style="color:#c9a961; letter-spacing:3px;">
                            {{ $confirmationData->booking_ref ?? 'LUX2025-ABC123XYZ' }}
                        </h2>
                        <p class="text-muted small mb-0">
                            Save this reference number for your records and check-in
                        </p>
                    </div>
                </div>

                {{-- Email Notification --}}
                @if($emailSent ?? true)
                <div class="alert alert-success border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="font-size:1.5rem;"></i>
                        <div>
                            <strong>Confirmation email sent!</strong>
                            <p class="mb-0">
                                A detailed confirmation has been sent to 
                                <strong>{{ $user->email ?? 'john@example.com' }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Guest & Room Details --}}
        <div class="row g-4 mb-5">
            {{-- Guest Information --}}
{{-- Guest Information --}}
<div class="col-lg-6">
    <div class="card border-0 shadow-lg h-100">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4" style="color:#1a4d2e;">
                <i class="bi bi-person-circle me-2"></i>Guest Information
            </h5>

            {{-- Guest Name --}}
                <div class="col-12">
                    <p class="text-muted small mb-1">Full Name</p>
                    <p class="fw-bold">{{ $user->name }}</p>
                </div>

            {{-- Email & Phone Number in same row --}}
            <div class="row mb-0">
                <div class="col-6">
                    <p class="text-muted small mb-1">Email</p>
                    <p class="fw-bold">{{ $user->email }}</p>
                </div>
                <div class="col-6">
                    <p class="text-muted small mb-1">Phone Number</p>
                    <p class="fw-bold">{{ $user->phone_num }}</p>
                </div>
            </div>

        </div>
    </div>
</div>



           {{-- Room & Stay Details --}}
<div class="col-lg-6">
    <div class="card border-0 shadow-lg h-100">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4" style="color:#1a4d2e;">
                <i class="bi bi-door-closed me-2"></i>Room & Stay Details
            </h5>

            <div class="row mb-3">
                <div class="col-6">
                    <p class="text-muted small mb-1">Room Type</p>
                    <p class="fw-bold">{{ $confirmationData->room->room_type ?? 'N/A' }}</p>
                </div>
                <div class="col-6">
                    <p class="text-muted small mb-1">Number of Rooms</p>
                    <p class="fw-bold">{{ $confirmationData->number_of_rooms }}</p>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-6">
                    <p class="text-muted small mb-1">Total Guests</p>
                    <p class="fw-bold">{{ $confirmationData->number_of_guests }}</p>
                </div>
                <div class="col-6">
                    <p class="text-muted small mb-1">Number of Nights</p>
                    @php
                        $nights = \Carbon\Carbon::parse($confirmationData->check_in_date)
                                    ->diffInDays(\Carbon\Carbon::parse($confirmationData->check_out_date));
                    @endphp
                    <p class="fw-bold">{{ $nights }}</p>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Check-in & Check-out --}}
<div class="row g-4 mb-5">
    {{-- Check-in --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3" style="color:#1a4d2e;">
                    <i class="bi bi-calendar-check me-2"></i>Check-in
                </h5>
                <p class="text-muted small mb-2">Date & Time</p>
                <p class="fw-bold fs-5 mb-3">
                    {{ \Carbon\Carbon::parse($confirmationData->check_in_date)->format('l, F j, Y') }}
                </p>
                <p class="text-muted small mb-0">
                    <i class="bi bi-info-circle me-2"></i>Check-in starts at 3:00 PM
                </p>
            </div>
        </div>
    </div>

    {{-- Check-out --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3" style="color:#1a4d2e;">
                    <i class="bi bi-calendar-x me-2"></i>Check-out
                </h5>
                <p class="text-muted small mb-2">Date & Time</p>
                <p class="fw-bold fs-5 mb-3">
                    {{ \Carbon\Carbon::parse($confirmationData->check_out_date)->format('l, F j, Y') }}
                </p>
                <p class="text-muted small mb-0">
                    <i class="bi bi-info-circle me-2"></i>Check-out by 11:00 AM
                </p>
            </div>
        </div>
    </div>
</div>


        {{-- Special Requests --}}
        @if(!empty($confirmationData['specialRequests']))
        <div class="row mb-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg" style="border-left:4px solid #c9a961;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3" style="color:#1a4d2e;">
                            <i class="bi bi-bookmark me-2"></i>Special Requests
                        </h5>
                        <p class="mb-0">{{ $confirmationData['specialRequests'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
{{-- Pricing Summary --}}
<div class="row mb-5">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4" style="color:#1a4d2e;">
                    <i class="bi bi-receipt me-2"></i>Pricing Summary
                </h5>

                @php
                    // Subtotal from booking
                    $subtotal = $confirmationData->total_price;

                    // Taxes (10%)
                    $taxes = round($subtotal * 0.1);

                    // Total amount
                    $total = $subtotal + $taxes;

                    // Number of nights
                    $nights = \Carbon\Carbon::parse($confirmationData->check_in_date)
                                ->diffInDays(\Carbon\Carbon::parse($confirmationData->check_out_date));

                    // Room name
                    $roomName = $confirmationData->room->name ?? 'Room';
                @endphp

                {{-- Booking Breakdown --}}
                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span class="text-muted">
                        {{ $roomName }} x {{ $confirmationData->number_of_rooms }} room{{ $confirmationData->number_of_rooms > 1 ? 's' : '' }} x {{ $nights }} night{{ $nights > 1 ? 's' : '' }}
                    </span>
                    <span class="fw-bold">₱{{ $subtotal }}</span>
                </div>

                {{-- Taxes --}}
                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span class="text-muted">Taxes & Fees (10%)</span>
                    <span class="fw-bold">₱{{ $taxes }}</span>
                </div>

                {{-- Total --}}
                <div class="d-flex justify-content-between">
                    <span class="fw-bold" style="color:#1a4d2e;font-size:1.2rem;">Total Amount</span>
                    <span class="fw-bold" style="color:#c9a961;font-size:1.2rem;">₱{{ $total }}</span>
                </div>

            </div>
        </div>
    </div>
</div>


        {{-- Important Information --}}
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg" style="background-color:#fff3cd;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4" style="color:#856404;">
                            <i class="bi bi-exclamation-triangle me-2"></i>Important Information
                        </h5>
                        <ul class="mb-0">
                            <li class="mb-2">Please bring a valid ID and credit card at check-in</li>
                            <li class="mb-2">Free cancellation up to 48 hours before check-in</li>
                            <li class="mb-2">Late check-out available for additional fee (request at check-in)</li>
                            <li class="mb-2">Parking is complimentary for all guests</li>
                            <li>For any questions, contact us at +1 (555) 123-4567</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- What's Next Section --}}
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <h4 class="fw-bold mb-4 text-center" style="color:#1a4d2e;">What's Next?</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm text-center p-4" style="border-top:3px solid #c9a961;">
                            <div style="font-size:2rem;color:#c9a961;margin-bottom:10px;">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <h6 class="fw-bold mb-2">Check Your Email</h6>
                            <p class="text-muted small">Confirmation details and itinerary have been sent</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm text-center p-4" style="border-top:3px solid #c9a961;">
                            <div style="font-size:2rem;color:#c9a961;margin-bottom:10px;">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <h6 class="fw-bold mb-2">Pre-Arrival Call</h6>
                            <p class="text-muted small">We'll contact you 24 hours before check-in</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm text-center p-4" style="border-top:3px solid #c9a961;">
                            <div style="font-size:2rem;color:#c9a961;margin-bottom:10px;">
                                <i class="bi bi-door-open"></i>
                            </div>
                            <h6 class="fw-bold mb-2">Arrive & Enjoy</h6>
                            <p class="text-muted small">Check in and enjoy your luxurious stay</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="row mb-5">
            <div class="col-lg-6 mx-auto">
                <div class="d-flex gap-3 flex-column flex-sm-row">
                    <a href="/" class="btn btn-lg w-100" style="background-color:#1a4d2e;color:#fff;border:none;">
                        <i class="bi bi-house me-2"></i>Back to Home
                    </a>
                    <button class="btn btn-lg w-100" style="background-color:#fff;color:#1a4d2e;border:2px solid #1a4d2e;" onclick="window.print()">
                        <i class="bi bi-printer me-2"></i>Print Confirmation
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
