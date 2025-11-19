{{-- resources/views/admin/sustainability/sustainability-tracker.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="mb-4">
        <h1 class="display-5 fw-bold">Sustainability & Operations</h1>
        <p class="text-muted">Monitor environmental impact and operational efficiency</p>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title d-flex align-items-center gap-2"><i class="bi bi-wind"></i> Carbon Emissions</h6>
                    <p class="fs-3 fw-bold">395 kg</p>
                    <p class="text-success small mb-0">↓ 12% from Jan</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title d-flex align-items-center gap-2"><i class="bi bi-droplet"></i> Water Usage</h6>
                    <p class="fs-3 fw-bold">2.4k gal</p>
                    <p class="text-success small mb-0">↓ 8% from Jan</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title d-flex align-items-center gap-2"><i class="bi bi-lightning"></i> Energy Consumption</h6>
                    <p class="fs-3 fw-bold">250 kWh</p>
                    <p class="text-success small mb-0">↓ 11% from Jan</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title d-flex align-items-center gap-2"><i class="bi bi-activity"></i> Waste Diverted</h6>
                    <p class="fs-3 fw-bold">270 kg</p>
                    <p class="text-success small mb-0">↓ 16% from Jan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Modern Sustainability Metrics Trend --}}
<div class="card border mb-4">
    <div class="card-body">
        <h5 class="card-title">Sustainability Metrics Trend</h5>
        <p class="text-muted mb-3">6-month performance tracking</p>

        @php
            $emissionsData = [
                ['month' => 'Jan', 'carbon' => 450, 'waste' => 320, 'energy' => 280],
                ['month' => 'Feb', 'carbon' => 440, 'waste' => 310, 'energy' => 275],
                ['month' => 'Mar', 'carbon' => 430, 'waste' => 300, 'energy' => 270],
                ['month' => 'Apr', 'carbon' => 420, 'waste' => 290, 'energy' => 265],
                ['month' => 'May', 'carbon' => 410, 'waste' => 280, 'energy' => 260],
                ['month' => 'Jun', 'carbon' => 395, 'waste' => 270, 'energy' => 250],
            ];
            $maxValue = max(array_merge(
                array_column($emissionsData, 'carbon'),
                array_column($emissionsData, 'waste'),
                array_column($emissionsData, 'energy')
            ));
            $chartHeight = 200; // px
        @endphp

        <div class="position-relative" style="height: {{ $chartHeight }}px;">
            <div class="d-flex align-items-end justify-content-between h-100">
                @foreach($emissionsData as $data)
                    @php
                        $carbonY = ($data['carbon'] / $maxValue) * $chartHeight;
                        $wasteY = ($data['waste'] / $maxValue) * $chartHeight;
                        $energyY = ($data['energy'] / $maxValue) * $chartHeight;
                    @endphp
                    <div class="text-center" style="width: 50px; position: relative;">
                        {{-- Carbon Dot --}}
                        <div class="rounded-circle bg-primary position-absolute" 
                             style="width:10px; height:10px; bottom: {{ $carbonY }}px; left:50%; transform:translateX(-50%);" 
                             title="Carbon: {{ $data['carbon'] }}"></div>
                        {{-- Waste Dot --}}
                        <div class="rounded-circle bg-success position-absolute" 
                             style="width:10px; height:10px; bottom: {{ $wasteY }}px; left:50%; transform:translateX(-50%);" 
                             title="Waste: {{ $data['waste'] }}"></div>
                        {{-- Energy Dot --}}
                        <div class="rounded-circle bg-warning position-absolute" 
                             style="width:10px; height:10px; bottom: {{ $energyY }}px; left:50%; transform:translateX(-50%);" 
                             title="Energy: {{ $data['energy'] }}"></div>
                        <small class="d-block mt-2">{{ $data['month'] }}</small>
                    </div>
                @endforeach
            </div>

            {{-- Lines using pseudo-elements --}}
            <style>
                .line-chart-dot {
                    position: absolute;
                    width: 0;
                    height: 0;
                }
                /* Carbon Line */
                @foreach($emissionsData as $i => $data)
                    @if($i < count($emissionsData)-1)
                        .carbon-line-{{ $i }} {
                            position: absolute;
                            bottom: {{ ($data['carbon'] / $maxValue) * $chartHeight }}px;
                            left: calc({{ $i * (100 / (count($emissionsData)-1)) }}%);
                            width: calc(100% / {{ count($emissionsData)-1 }});
                            height: 2px;
                            background: linear-gradient(to right, #0d6efd, #0d6efd);
                        }
                    @endif
                @endforeach
            </style>
        </div>

        {{-- Legend --}}
        <div class="d-flex justify-content-center gap-4 mt-3">
            <div class="d-flex align-items-center gap-1">
                <span class="d-inline-block" style="width: 15px; height: 10px; background: #0d6efd; border-radius: 3px;"></span>
                <small>Carbon</small>
            </div>
            <div class="d-flex align-items-center gap-1">
                <span class="d-inline-block" style="width: 15px; height: 10px; background: #198754; border-radius: 3px;"></span>
                <small>Waste</small>
            </div>
            <div class="d-flex align-items-center gap-1">
                <span class="d-inline-block" style="width: 15px; height: 10px; background: #ffc107; border-radius: 3px;"></span>
                <small>Energy</small>
            </div>
        </div>
    </div>
</div>

    {{-- Green Initiatives --}}
    @php
        $initiatives = [
            ['name' => 'Water Conservation', 'savings' => '35%', 'status' => 'Active'],
            ['name' => 'Energy Efficiency', 'savings' => '28%', 'status' => 'Active'],
            ['name' => 'Waste Reduction', 'savings' => '42%', 'status' => 'Active'],
            ['name' => 'Green Operations', 'savings' => '18%', 'status' => 'Planned'],
        ];
    @endphp

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Green Initiatives</h5>
            <p class="text-muted mb-3">Sustainability programs and their impact</p>
            <div class="row g-3">
                @foreach($initiatives as $initiative)
                    <div class="col-12 col-md-6">
                        <div class="card border rounded-3 p-3" style="background: linear-gradient(135deg, rgba(25,135,84,0.05), rgba(13,110,253,0.05));">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-medium">{{ $initiative['name'] }}</h6>
                                <span class="badge {{ $initiative['status'] == 'Active' ? 'bg-success' : 'bg-primary' }}">{{ $initiative['status'] }}</span>
                            </div>
                            <p class="fs-3 fw-bold text-success mb-1">{{ $initiative['savings'] }}</p>
                            <small class="text-muted">Resource savings</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
