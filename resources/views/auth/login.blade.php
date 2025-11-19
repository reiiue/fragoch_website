@extends('layouts.app')

@section('content')
<div class="container-fluid p-0" style="height: 100vh; background: url('/placeholder.svg?height=900&width=1600&query=luxury+hotel') center/cover no-repeat;">
    <div style="background-color: rgba(26, 77, 46, 0.6); height: 100%; display: flex; align-items: center; justify-content: center;">
        <div class="card shadow-lg" style="width: 400px; border-radius: 1rem; background-color: #fff;">
            <div class="card-body p-5">

                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark">Welcome Back</h2>
                    <p class="text-muted">Login to access your account</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-3">{{ session('status') }}</div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label text-dark">Remember me</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn w-100 mb-3" style="background-color: #c9a961; color: #1a4d2e; font-weight: 600;">
                        Log in
                    </button>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-dark small">
                                Forgot your password?
                            </a>
                        </div>
                    @endif
                </form>

                <!-- Optional Register Link -->
                <div class="text-center mt-3">
                    <span class="small text-dark">Don't have an account? </span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #1a4d2e;">Register</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
