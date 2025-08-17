@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #f0f2f5; min-height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4 shadow-sm rounded-4">

                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Reset Password</h2>
                    <p class="text-muted">Enter your new password</p>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Success message --}}
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Reset Password Form --}}
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                  
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-lg rounded-pill" value="{{ old('email', $email ?? '') }}" placeholder="Email Address" required autofocus>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control form-control-lg rounded-pill" placeholder="New Password" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control form-control-lg rounded-pill" placeholder="Confirm Password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold">Reset Password</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
