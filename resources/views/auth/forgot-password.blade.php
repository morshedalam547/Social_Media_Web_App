@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #f0f2f5; min-height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4 shadow-sm rounded-4">
                
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Forgot Password</h2>
                    <p class="text-muted">Enter your email to reset your password</p>
                </div>

          

                {{-- Forgot password form --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="Your Email" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold">Send Reset Link</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
