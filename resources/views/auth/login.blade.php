<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Facebook Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f0f2f5;
        }

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container .form-control {
            height: 45px;
        }

        .btn-login {
            background-color: #1877f2;
            color: white;
        }

        .btn-create {
            background-color: #42b72a;
            color: white;
        }

        .or-separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 15px 0;
        }

        .or-separator::before,
        .or-separator::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ccc;
        }

        .or-separator:not(:empty)::before {
            margin-right: .5em;
        }

        .or-separator:not(:empty)::after {
            margin-left: .5em;
        }

        .invalid-feedback {
            display: block;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <a href="{{ url('/') }}">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjYo7SC_yIP8hZRsARIwXWptOr1uObW9TApA&s"
                alt="Social Media logo" height="50">
        </a>


        <h5 class="mt-3 mb-4">Log in to Social Media</h5>


        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" id="login-form" novalidate>
            @csrf

            <input type="email" name="email" class="form-control mb-3 @error('email') is-invalid @enderror"
                placeholder="Email address or phone number" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <input type="password" name="password" class="form-control mb-3 @error('password') is-invalid @enderror"
                placeholder="Password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-login w-100 mb-2">Log In</button>

            <a href="{{ route('password.request') }}" class="d-block text-center mt-2 text-decoration-none">
                Forgotten password?
            </a>

            <hr>

            <button type="button" class="btn btn-create w-100" onclick="toggleForm()">
                Create new account
            </button>
        </form>


        <form method="POST" action="{{ route('register') }}" id="register-form" style="display:none;">
            @csrf

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
            registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>

</html>