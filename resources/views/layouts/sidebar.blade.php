<style>

.sidebar {
    width: 250px;
    height: 100vh;
    background: #121212;
    position: sticky;
    top: 0;
    overflow-y: auto;
}

.sidebar .menu-btn {
    border: none !important;
    transition: all 0.15s;
    color: #fff;
}

.sidebar .menu-btn:hover {
    background-color: rgba(255, 255, 255, 0.08);
}

/* CLICK FEEDBACK */
.sidebar .menu-btn:active {
    background-color: rgba(255, 255, 255, 0.2) !important;
    transform: scale(0.98);
}

/* PERSISTENT ACTIVE STATE (selected page) */
.sidebar .menu-btn.active {
    background-color: #198754 !important;
    color: #fff !important;
    transform: none; /* avoid active click shrinking staying applied */
}

/* Remove borders for header/footer if needed */
.sidebar .top-section,
.sidebar .footer-section {
    border: none !important;
}

</style>


@php
    $menuItems = [
        [ 'id' => 'overview', 'label' => 'Overview', 'icon' => 'bar-chart-3', 'route' => route('admin.dashboard') ],
        [ 'id' => 'marketing', 'label' => 'Marketing & Bookings', 'icon' => 'briefcase', 'route' => route('admin.marketing-booking') ],
        [ 'id' => 'sustainability', 'label' => 'Sustainability', 'icon' => 'leaf', 'route' => route('admin.sustainability-tracker') ],
        [ 'id' => 'tasks', 'label' => 'Task Board', 'icon' => 'check-square', 'route' => route('admin.task-board') ],
        [ 'id' => 'feedback', 'label' => 'Guest Feedback', 'icon' => 'message-square', 'route' => route('admin.guests.guest-feedback')],
        [ 'id' => 'employees', 'label' => 'Employees', 'icon' => 'users', 'route' => route('admin.employees.index') ],
        [ 'id' => 'sales', 'label' => 'Sales & Revenue', 'icon' => 'trending-up', 'route' => route('admin.sales.sales-revenue')  ],
        [ 'id' => 'rooms', 'label' => 'Room Management', 'icon' => 'home', 'route' => route('admin.rooms.index') ],
    ];
@endphp

<aside class="sidebar text-white d-flex flex-column">

    <!-- Logo -->
    <div class="p-4 top-section d-flex align-items-center gap-3">
    <a href="{{ route('home') }}">
            <div class="bg-primary p-2 rounded d-flex align-items-center justify-content-center">
                <i data-lucide="log-out" class="text-white"></i>
            </div>
    </a>

        <div>
            <h1 class="fw-bold fs-5 mb-0">Admin Hub</h1>
            <small class="text-white-50">Management Suite</small>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-grow-1 px-3 mt-3">
        @foreach ($menuItems as $item)
            @php $active = ($activeModule ?? '') === $item['id']; @endphp

            <a href="{{ $item['route'] }}"
               class="menu-btn btn w-100 d-flex align-items-center gap-3 text-start mb-2 py-2
               {{ $active ? 'active' : 'btn-outline-light' }}">
                <i data-lucide="{{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- Footer -->
    <div class="p-3 footer-section">
        <button class="btn btn-outline-light w-100 mb-2">Settings</button>

    </div>
</aside>
