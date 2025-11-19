@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="container-fluid">

    <!-- Heading -->
    <div class="mb-4">
        <h1 class="fw-bold">Dashboard Overview</h1>
        <p class="text-muted">Welcome to your business management hub</p>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4">

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Bookings</h6>
                    <h3 class="fw-bold">1,247</h3>
                    <p class="small text-success mt-1">+12% from last month</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Revenue</h6>
                    <h3 class="fw-bold">$48,234</h3>
                    <p class="small text-success mt-1">+8% from last month</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Active Tasks</h6>
                    <h3 class="fw-bold">342</h3>
                    <p class="small text-muted mt-1">22 completed today</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Team Members</h6>
                    <h3 class="fw-bold">128</h3>
                    <p class="small text-muted mt-1">5 new this month</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts -->
    <div class="card shadow-sm mt-5">
        <div class="card-body">
            <h4 class="mb-2">Revenue Trend</h4>
            <p class="text-muted small mb-4">Monthly performance metrics</p>

            <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                <span class="text-muted">Chart Placeholder</span>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h4 class="mb-2">Department Distribution</h4>
            <p class="text-muted small mb-4">Team allocation</p>

            <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
                <span class="text-muted">Pie Chart Placeholder</span>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4 mb-5">
        <div class="card-body">
            <h4 class="mb-2">Bookings & Tasks Overview</h4>
            <p class="text-muted small mb-4">Comparison across months</p>

            <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                <span class="text-muted">Bar Chart Placeholder</span>
            </div>
        </div>
    </div>

</div>
@endsection
