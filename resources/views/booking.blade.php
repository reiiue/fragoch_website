@extends('layouts.app')

@section('content')

@include('partials.navbar')

<section class="py-5" style="background-color: #f8f9fa; margin-top: 56px; min-height: 100vh;">
    <div class="container">
        <div class="row g-4">
            <!-- Booking Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4" style="color: #1a4d2e;">Book Your Stay</h2>

                        <!-- Step Indicator -->
                        <div class="mb-5">
                            <div class="row text-center">
                                @foreach(['Guest Info','Room Details','Payment'] as $idx=>$step)
                                <div class="col-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="step-circle" id="step-circle-{{ $idx+1 }}">{{ $idx+1 }}</div>
                                        <small class="fw-bold" id="step-label-{{ $idx+1 }}">{{ $step }}</small>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar" id="step-progress" style="width: 33%; background-color: #c9a961;"></div>
                            </div>
                        </div>

                        <!-- Form submitting to Laravel -->
                        <form id="booking-form" action="{{ route('book.store') }}" method="POST">
                            @csrf

                            <!-- Step 1: Guest Info -->
                            <div class="step" id="step-1">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">First Name</label>
                                        <input type="text" class="form-control border-2" name="firstName" 
                                               value="{{ auth()->check() ? explode(' ', auth()->user()->name)[0] : '' }}" 
                                               placeholder="John" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Last Name</label>
                                        <input type="text" class="form-control border-2" name="lastName" 
                                               value="{{ auth()->check() ? (count(explode(' ', auth()->user()->name)) > 1 ? explode(' ', auth()->user()->name)[1] : '') : '' }}" 
                                               placeholder="Doe" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control border-2" name="email" 
                                               value="{{ auth()->check() ? auth()->user()->email : '' }}" 
                                               placeholder="john@example.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone</label>
                                        <input type="tel" class="form-control border-2" name="phone" 
                                               value="{{ auth()->check() && auth()->user()->phone_num ? auth()->user()->phone_num : '' }}" 
                                               placeholder="+(63) 123-4567">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Special Requests</label>
                                    <textarea class="form-control border-2" name="specialRequests" rows="3" 
                                              placeholder="e.g., Late check-in, High floor preference, etc."></textarea>
                                </div>
                            </div>

                            <!-- Step 2: Room Details -->
                            <div class="step d-none" id="step-2">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Check-in Date</label>
                                        <input type="date" class="form-control border-2" name="checkIn" id="checkIn"
                                               value="{{ old('checkIn', auth()->check() && auth()->user()->check_in_date ? auth()->user()->check_in_date->format('Y-m-d') : \Carbon\Carbon::today()->format('Y-m-d')) }}" 
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Check-out Date</label>
                                        <input type="date" class="form-control border-2" name="checkOut" id="checkOut"
                                               value="{{ old('checkOut', auth()->check() && auth()->user()->check_out_date ? auth()->user()->check_out_date->format('Y-m-d') : \Carbon\Carbon::tomorrow()->format('Y-m-d')) }}" 
                                               required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Room Type</label>
                                        <select class="form-select border-2" name="roomType">
                                            @foreach (\App\Models\Room::where('status', 'available')->get() as $room)
                                                <option value="{{ $room->id }}">
                                                    {{ $room->room_type }} - ₱{{ number_format($room->base_price, 2) }}/night
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

    {{-- Rooms --}}
    <div class="col-md-3">
        <label class="form-label fw-bold">Rooms</label>
        <select class="form-select border-2" name="rooms">
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" 
                    {{ old('rooms', $booking->number_of_rooms ?? '') == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>
        @error('rooms')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Guests --}}
    <div class="col-md-3">
        <label class="form-label fw-bold">Guests</label>
        <select class="form-select border-2" name="guests">
            @for($i = 1; $i <= 6; $i++)
                <option value="{{ $i }}" 
                    {{ old('guests', $booking->number_of_guests ?? '') == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>
        @error('guests')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


                                </div>
                            </div>

                            <!-- Step 3: Payment -->
                            <div class="step d-none" id="step-3">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Cardholder Name</label>
                                        <input type="text" class="form-control border-2" name="cardName" placeholder="John Doe" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Card Number</label>
                                        <input type="text" class="form-control border-2" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Expiry</label>
                                        <input type="text" class="form-control border-2" name="cardExpiry" placeholder="MM/YY" maxlength="5" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">CVC</label>
                                        <input type="text" class="form-control border-2" name="cardCVC" placeholder="123" maxlength="3" required>
                                    </div>
                                </div>
                                <div class="alert alert-warning"><i class="bi bi-shield-check me-2"></i>Payment info is secure.</div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-lg" id="prev-btn" disabled style="background-color:#e9ecef;color:#333;">
                                    <i class="bi bi-chevron-left me-2"></i>Previous
                                </button>
                                <button type="button" class="btn btn-lg" id="next-btn" style="background-color:#1a4d2e;color:#fff;">
                                    Next<i class="bi bi-chevron-right ms-2"></i>
                                </button>
                                <button type="submit" class="btn btn-lg d-none" id="submit-btn" style="background-color:#c9a961;color:#fff;">
                                    <i class="bi bi-check-circle me-2"></i>Complete Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Booking Summary Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg position-sticky" style="top:100px;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4" style="color:#1a4d2e;"><i class="bi bi-receipt me-2"></i>Booking Summary</h4>
                        <div id="summary-details">
                            <p class="text-muted">Fill in your details to see summary.</p>
                        </div>
                        <div class="mt-4 pt-3 border-top">
                            <small class="text-muted d-block mb-2">Progress</small>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar" id="summary-progress" style="width:33%;background-color:#c9a961;"></div>
                            </div>
                            <small class="text-muted d-block mt-2" id="summary-step">Step 1 of 3</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
const roomPrices = {
    @foreach ($rooms as $room)
        "{{ $room->id }}": {{ $room->base_price }},
    @endforeach
};

let currentStep = 1;
const totalSteps = 3;

const steps = document.querySelectorAll('.step');
const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');
const submitBtn = document.getElementById('submit-btn');
const bookingForm = document.getElementById('booking-form');

const checkInInput = document.getElementById('checkIn');
const checkOutInput = document.getElementById('checkOut');

// Ensure check-out is always after check-in
checkInInput.addEventListener('change', () => {
    const checkInDate = new Date(checkInInput.value);
    const minCheckOut = new Date(checkInDate);
    minCheckOut.setDate(minCheckOut.getDate() + 1);

    if (new Date(checkOutInput.value) <= checkInDate) {
        checkOutInput.value = minCheckOut.toISOString().split('T')[0];
    }
    checkOutInput.min = minCheckOut.toISOString().split('T')[0];

    updateSummary();
});

checkOutInput.addEventListener('change', updateSummary);

// Update summary sidebar
function updateSummary() {
    const formData = new FormData(bookingForm);

    if (formData.get('checkIn') && formData.get('checkOut') && formData.get('roomType')) {
        const checkIn = new Date(formData.get('checkIn')).toLocaleDateString();
        const checkOut = new Date(formData.get('checkOut')).toLocaleDateString();
        const nights = Math.ceil((new Date(formData.get('checkOut')) - new Date(formData.get('checkIn'))) / (1000 * 60 * 60 * 24));
        const rooms = parseInt(formData.get('rooms')) || 1;
        const roomId = formData.get('roomType');
        const price = parseFloat(roomPrices[roomId]) || 0;
        const subtotal = nights * rooms * price;
        const taxes = Math.round(subtotal * 0.1);
        const total = subtotal + taxes;

        const selectedRoomOption = bookingForm.querySelector('select[name="roomType"] option:checked');
        const roomName = selectedRoomOption ? selectedRoomOption.text.split(' - ')[0] : '';

        document.getElementById('summary-details').innerHTML = `
            <div class="mb-4 pb-3 border-bottom">
                <div class="d-flex justify-content-between"><small class="text-muted">Check-in</small><small class="fw-bold">${checkIn}</small></div>
                <div class="d-flex justify-content-between"><small class="text-muted">Check-out</small><small class="fw-bold">${checkOut}</small></div>
                <div class="d-flex justify-content-between"><small class="text-muted">Duration</small><small class="fw-bold">${nights} night${nights!==1?'s':''}</small></div>
            </div>
            <div class="mb-4 pb-3 border-bottom">
                <div class="d-flex justify-content-between"><small class="text-muted">Room Type</small><small class="fw-bold">${roomName}</small></div>
                <div class="d-flex justify-content-between"><small class="text-muted">Rooms</small><small class="fw-bold">${rooms}</small></div>
            </div>
            <div class="mb-4 pb-3 border-bottom">
                <div class="d-flex justify-content-between"><small class="text-muted">Price per Room</small><small class="fw-bold">₱${price.toFixed(2)}</small></div>
                <div class="d-flex justify-content-between"><small class="text-muted">Subtotal</small><small class="fw-bold">₱${subtotal.toFixed(2)}</small></div>
                <div class="d-flex justify-content-between"><small class="text-muted">Taxes & Fees</small><small class="fw-bold">₱${taxes.toFixed(2)}</small></div>
            </div>
            <div class="d-flex justify-content-between"><h6 class="fw-bold" style="color:#1a4d2e;">Total</h6><h6 class="fw-bold" style="color:#c9a961;">₱${total.toFixed(2)}</h6></div>
        `;
    }
}

// Show the correct step and update progress
function showStep(step) {
    steps.forEach((el, idx) => el.classList.toggle('d-none', idx + 1 !== step));
    
    prevBtn.disabled = step === 1;
    nextBtn.classList.toggle('d-none', step === totalSteps);
    submitBtn.classList.toggle('d-none', step !== totalSteps);

    const progressPercent = (step / totalSteps) * 100;
    document.getElementById('step-progress').style.width = `${progressPercent}%`;
    document.getElementById('summary-progress').style.width = `${progressPercent}%`;
    document.getElementById('summary-step').textContent = `Step ${step} of ${totalSteps}`;

    updateSummary();
}

// Navigation buttons
nextBtn.addEventListener('click', () => {
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
});

prevBtn.addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});


// Update summary live when inputs change
bookingForm.addEventListener('input', updateSummary);

// Initial display
showStep(currentStep);
</script>


@endsection
