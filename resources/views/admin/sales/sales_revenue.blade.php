{{-- resources/views/admin/sales-revenue.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container py-5">

    {{-- Page Header --}}
    <div class="mb-4">
        <h1 class="h3 fw-bold">Sales & Revenue Monitoring</h1>
        <p class="text-muted">Track financial performance and sales metrics</p>
    </div>

    {{-- Top Metrics --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar fs-4 mb-1"></i>
                    <div class="fw-medium">Total Revenue</div>
                    <h4 class="fw-bold">$208k</h4>
                    <small class="text-muted">This year</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="bi bi-calendar-month fs-4 mb-1"></i>
                    <div class="fw-medium">This Month</div>
                    <h4 class="fw-bold">$48k</h4>
                    <small class="text-success">↑ 24.5% from May</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="bi bi-cart-fill fs-4 mb-1"></i>
                    <div class="fw-medium">Conversion Rate</div>
                    <h4 class="fw-bold">3.2%</h4>
                    <small class="text-muted">Of visitors</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="bi bi-bullseye fs-4 mb-1"></i>
                    <div class="fw-medium">Target Status</div>
                    <h4 class="fw-bold text-success">150%</h4>
                    <small class="text-success">Exceeding targets</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Revenue Area Chart --}}
    <div class="card mb-4">
        <div class="card-header">
            Revenue Performance
            <small class="text-muted d-block">Monthly revenue vs target and profit</small>
        </div>
        <div class="card-body">
            <canvas id="revenueChart" style="height: 300px;"></canvas>
        </div>
    </div>

    <div class="row g-3">
        {{-- Profit Line Chart --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Profit Margin
                    <small class="text-muted d-block">Monthly profit tracking</small>
                </div>
                <div class="card-body">
                    <canvas id="profitChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Product Sales Pie Chart --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Product Sales Mix
                    <small class="text-muted d-block">Revenue by package type</small>
                </div>
                <div class="card-body">
                    <canvas id="salesPieChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // === Static Data ===
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const revenue = [24000, 28000, 31000, 35000, 42000, 48000];
    const target = [20000, 22000, 25000, 28000, 30000, 32000];
    const profit = [5200, 6400, 7500, 8800, 10500, 12000];
    const productLabels = ['Premium Package', 'Standard Package', 'Basic Package'];
    const productValues = [45, 35, 20];

    // === Revenue Chart ===
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Revenue',
                    data: revenue,
                    borderColor: '#4ade80',
                    backgroundColor: 'rgba(74, 222, 128, 0.2)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Target',
                    data: target,
                    borderColor: '#60a5fa',
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // === Profit Chart ===
    const ctxProfit = document.getElementById('profitChart').getContext('2d');
    new Chart(ctxProfit, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Profit',
                data: profit,
                borderColor: '#facc15',
                backgroundColor: 'rgba(250, 204, 21, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // === Product Sales Pie Chart ===
    const ctxPie = document.getElementById('salesPieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: productLabels,
            datasets: [{
                data: productValues,
                backgroundColor: ['#38bdf8','#4ade80','#fbbf24']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>
@endsection
