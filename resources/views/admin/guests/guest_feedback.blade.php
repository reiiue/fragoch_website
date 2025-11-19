@extends('layouts.admin')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="mb-4">
        <h1 class="display-5 fw-bold">Guest Experience & Feedback</h1>
        <p class="text-muted">Monitor customer satisfaction and collect insights</p>
    </div>

    {{-- Metrics Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">Avg Rating</h6>
                    <p class="fs-3 fw-bold">4.5 / 5 <span class="text-success">↑ 0.3</span></p>
                    <p class="text-muted small">From Jan</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Feedback</h6>
                    <p class="fs-3 fw-bold">672</p>
                    <p class="text-muted small">This year</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">5-Star Reviews</h6>
                    <p class="fs-3 fw-bold">342</p>
                    <p class="text-muted small">50.9% of total</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title text-muted">Response Rate</h6>
                    <p class="fs-3 fw-bold">94%</p>
                    <p class="text-muted small">Excellent engagement</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Satisfaction Trend --}}
<div class="card border mb-4">
    <div class="card-body">
        <h5 class="card-title">Satisfaction Trend</h5>
        <p class="card-text text-muted mb-3">Guest satisfaction and feedback volume</p>

        @php
            $trendData = [
                ['month' => 'Jan', 'rating' => 4.2, 'feedback' => 87],
                ['month' => 'Feb', 'rating' => 4.4, 'feedback' => 102],
                ['month' => 'Mar', 'rating' => 4.5, 'feedback' => 98],
                ['month' => 'Apr', 'rating' => 4.6, 'feedback' => 115],
                ['month' => 'May', 'rating' => 4.7, 'feedback' => 128],
                ['month' => 'Jun', 'rating' => 4.8, 'feedback' => 142],
            ];
            $maxFeedback = max(array_column($trendData, 'feedback'));
            $chartHeight = 200; // maximum bar height in px
        @endphp

        {{-- Responsive scrollable chart --}}
        <div class="d-flex align-items-end overflow-auto" style="height: {{ $chartHeight }}px;">
            @foreach($trendData as $data)
                @php
                    $ratingHeight = ($data['rating'] / 5) * $chartHeight;
                    $feedbackHeight = ($data['feedback'] / $maxFeedback) * $chartHeight;
                @endphp
                <div class="text-center mx-2 flex-shrink-0" style="width: 50px;">
                    <div class="d-flex flex-column align-items-center justify-content-end h-100">
                        {{-- Rating --}}
                        <div class="rounded-top mb-1" 
                             style="height: {{ $ratingHeight }}px; width: 20px; background: linear-gradient(180deg, #f6e05e, #d69e2e); transition: 0.3s;"
                             title="Rating: {{ $data['rating'] }}">
                        </div>
                        {{-- Feedback Count --}}
                        <div class="rounded-top" 
                             style="height: {{ $feedbackHeight }}px; width: 20px; background: linear-gradient(180deg, #63b3ed, #3182ce); transition: 0.3s;"
                             title="Feedback: {{ $data['feedback'] }}">
                        </div>
                    </div>
                    <small class="d-block mt-2">{{ $data['month'] }}</small>
                </div>
            @endforeach
        </div>

        {{-- Legend --}}
        <div class="d-flex justify-content-center gap-4 mt-4 flex-wrap">
            <div class="d-flex align-items-center gap-1">
                <span class="d-inline-block" style="width: 20px; height: 10px; background: linear-gradient(180deg, #f6e05e, #d69e2e); border-radius: 3px;"></span>
                <small>Rating</small>
            </div>
            <div class="d-flex align-items-center gap-1">
                <span class="d-inline-block" style="width: 20px; height: 10px; background: linear-gradient(180deg, #63b3ed, #3182ce); border-radius: 3px;"></span>
                <small>Feedback Count</small>
            </div>
        </div>
    </div>
</div>



    {{-- Recent Feedback --}}
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Recent Guest Feedback</h5>
            <p class="text-muted mb-3">Latest reviews and comments from guests</p>
            <div class="list-group">
                <div class="list-group-item mb-2 rounded">
                    <div class="fw-bold">John Smith</div>
                    <small class="text-muted">2025-01-18</small>
                    <div class="text-warning mb-1">
                        ★★★★☆
                    </div>
                    <p class="mb-0 fst-italic">"Excellent service and great atmosphere!"</p>
                </div>

                <div class="list-group-item mb-2 rounded">
                    <div class="fw-bold">Jane Doe</div>
                    <small class="text-muted">2025-01-15</small>
                    <div class="text-warning mb-1">
                        ★★★★★
                    </div>
                    <p class="mb-0 fst-italic">"Friendly staff, very welcoming."</p>
                </div>

                <div class="list-group-item rounded">
                    <div class="fw-bold">Bob Wilson</div>
                    <small class="text-muted">2025-01-12</small>
                    <div class="text-warning mb-1">
                        ★★★★☆
                    </div>
                    <p class="mb-0 fst-italic">"Room was clean and comfortable."</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
