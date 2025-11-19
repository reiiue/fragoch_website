<!-- resources/views/partials/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1a4d2e;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="font-size: 1.5rem;">
            <i class="bi bi-gem me-2"></i>Fragoch Tourist Inn
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <!-- Normal Navigation Links -->
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#amenities">Amenities</a></li>
                <li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
                <li class="nav-item"><a class="nav-link" href="#booking">Book Now</a></li>

                <!-- Unified Login/Logout -->
                @php
                    $user = auth()->guard('web')->user();
                    $admin = auth()->guard('admin')->user();
                @endphp

                @if(!$user && !$admin)
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ $admin->name ?? $user->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if($admin)
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ $admin ? route('admin.logout') : route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
