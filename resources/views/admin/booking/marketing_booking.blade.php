{{-- resources/views/admin/booking/marketing-booking.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="mb-4">
        <h1 class="display-5 fw-bold">Marketing & Booking Management</h1>
        <p class="text-muted">Track campaigns and manage reservations</p>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Bookings</h6>
                    <p class="fs-3 fw-bold">365</p>
                    <p class="text-muted small">This month</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">Confirmed</h6>
                    <p class="fs-3 fw-bold">342</p>
                    <p class="text-muted small">93.7% rate</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">Pending</h6>
                    <p class="fs-3 fw-bold">18</p>
                    <p class="text-muted small">Awaiting approval</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">Avg Guest Count</h6>
                    <p class="fs-3 fw-bold">3.8</p>
                    <p class="text-muted small">Per booking</p>
                </div>
            </div>
        </div>
    </div>

{{-- Booking Trends --}}
<div class="card border mb-4">
    <div class="card-body">
        <h5 class="card-title">Booking Trends</h5>
        <p class="card-text text-muted mb-3">Monthly bookings and cancellation rate</p>

        @php
            $bookingData = [
                ['month' => 'Jan', 'bookings' => 40, 'cancellations' => 5],
                ['month' => 'Feb', 'bookings' => 52, 'cancellations' => 3],
                ['month' => 'Mar', 'bookings' => 48, 'cancellations' => 4],
                ['month' => 'Apr', 'bookings' => 65, 'cancellations' => 6],
                ['month' => 'May', 'bookings' => 72, 'cancellations' => 4],
                ['month' => 'Jun', 'bookings' => 88, 'cancellations' => 5],
            ];
            $maxBooking = max(array_column($bookingData, 'bookings'));
            $chartHeight = 200; // px
        @endphp

        <div class="d-flex align-items-end justify-content-center" style="height: {{ $chartHeight }}px;">
            @foreach($bookingData as $data)
                @php
                    $bookingHeight = ($data['bookings'] / $maxBooking) * $chartHeight;
                    $cancellationHeight = ($data['cancellations'] / $maxBooking) * $chartHeight;
                @endphp
                <div class="text-center mx-2" style="width: 50px;">
                    <div class="d-flex flex-column align-items-center">
                        {{-- Bookings --}}
                        <div class="rounded-top mb-1" 
                             style="height: {{ $bookingHeight }}px; width: 20px; background: linear-gradient(180deg, #4e73df, #224abe); transition: 0.3s;"
                             title="Bookings: {{ $data['bookings'] }}">
                        </div>
                        {{-- Cancellations --}}
                        <div class="rounded-top" 
                             style="height: {{ $cancellationHeight }}px; width: 20px; background: linear-gradient(180deg, #e74a3b, #c53030); transition: 0.3s;"
                             title="Cancellations: {{ $data['cancellations'] }}">
                        </div>
                    </div>
                    <small class="d-block mt-2">{{ $data['month'] }}</small>
                </div>
            @endforeach
        </div>

        {{-- Legend --}}
        <div class="d-flex justify-content-center gap-4 mt-4">
            <div class="d-flex align-items-center gap-1">
                <span class="d-inline-block" style="width: 20px; height: 10px; background: linear-gradient(180deg, #4e73df, #224abe); border-radius: 3px;"></span>
                <small>Bookings</small>
            </div>
            <div class="d-flex align-items-center gap-1">
                <span class="d-inline-block" style="width: 20px; height: 10px; background: linear-gradient(180deg, #e74a3b, #c53030); border-radius: 3px;"></span>
                <small>Cancellations</small>
            </div>
        </div>
    </div>
</div>


    <div class="row g-4">
        {{-- Recent Bookings --}}
        <div class="col-12 col-lg-6">
            <div class="card border">
                <div class="card-body">
                    <h5 class="card-title">Recent Bookings</h5>
                    <p class="text-muted mb-3">Latest customer reservations</p>

                    <div class="list-group">
                        <div class="list-group-item d-flex justify-content-between align-items-start mb-2 rounded">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">John Doe</div>
                                <small class="text-muted">📅 2025-01-20 | 👥 4 guests</small>
                            </div>
                            <span class="badge bg-success rounded-pill">Confirmed</span>
                        </div>

                        <div class="list-group-item d-flex justify-content-between align-items-start mb-2 rounded">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Jane Smith</div>
                                <small class="text-muted">📅 2025-01-22 | 👥 2 guests</small>
                            </div>
                            <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                        </div>

                        <div class="list-group-item d-flex justify-content-between align-items-start mb-2 rounded">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Bob Wilson</div>
                                <small class="text-muted">📅 2025-01-25 | 👥 6 guests</small>
                            </div>
                            <span class="badge bg-success rounded-pill">Confirmed</span>
                        </div>

                        <div class="list-group-item d-flex justify-content-between align-items-start rounded">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Alice Brown</div>
                                <small class="text-muted">📅 2025-01-28 | 👥 3 guests</small>
                            </div>
                            <span class="badge bg-success rounded-pill">Confirmed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Marketing Campaigns --}}
        <div class="col-12 col-lg-6">
            <div class="card border">
                <div class="card-body">
                    <h5 class="card-title">Marketing Campaigns</h5>
                    <p class="text-muted mb-3">Active campaigns performance</p>

                    <div class="mb-3 p-2 border rounded bg-light">
                        <h6>Summer Special</h6>
                        <div class="row text-center">
                            <div class="col">
                                <small class="text-muted d-block">Reach</small>
                                <strong>12,543</strong>
                            </div>
                            <div class="col">
                                <small class="text-muted d-block">Conversions</small>
                                <strong>324</strong>
                            </div>
                            <div class="col">
                                <small class="text-muted d-block">CTR</small>
                                <strong>2.6%</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 p-2 border rounded bg-light">
                        <h6>Holiday Deals</h6>
                        <div class="row text-center">
                            <div class="col">
                                <small class="text-muted d-block">Reach</small>
                                <strong>8,923</strong>
                            </div>
                            <div class="col">
                                <small class="text-muted d-block">Conversions</small>
                                <strong>198</strong>
                            </div>
                            <div class="col">
                                <small class="text-muted d-block">CTR</small>
                                <strong>2.2%</strong>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 border rounded bg-light">
                        <h6>Spring Escape</h6>
                        <div class="row text-center">
                            <div class="col">
                                <small class="text-muted d-block">Reach</small>
                                <strong>15,432</strong>
                            </div>
                            <div class="col">
                                <small class="text-muted d-block">Conversions</small>
                                <strong>489</strong>
                            </div>
                            <div class="col">
                                <small class="text-muted d-block">CTR</small>
                                <strong>3.2%</strong>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
