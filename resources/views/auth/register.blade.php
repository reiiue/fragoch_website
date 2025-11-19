@extends('layouts.app')

@section('content')
<div class="container-fluid p-0" style="height: 100vh; background: url('/placeholder.svg?height=900&width=1600&query=luxury+hotel') center/cover no-repeat;">
    <div style="background-color: rgba(26, 77, 46, 0.6); height: 100%; display: flex; align-items: center; justify-content: center;">
        <div class="card shadow-lg" style="width: 400px; border-radius: 1rem; background-color: #fff;">
            <div class="card-body p-5">

                <div class="text-center mb-4">
                    <h2 class="fw-bold text-dark">Create Account</h2>
                    <p class="text-muted">Register to start booking</p>
                </div>

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

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label text-dark">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-dark">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn w-100 mb-3" style="background-color: #c9a961; color: #1a4d2e; font-weight: 600;">
                        Register
                    </button>

                    <!-- Login Link -->
                    <div class="text-center">
                        <span class="small text-dark">Already have an account? </span>
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #1a4d2e;">Log in</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
