<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Social Media Web App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f0f2f5;
    }

    .facebook-text {
      color: #0c2cacff;
      font-size: 48px;
      font-weight: bold;
    }

    .card {
      border-radius: 10px;
    }

    .form-toggle {
      cursor: pointer;
      color: #1877f2;
    }
  </style>
</head>

<body>

  <!--  Login/Register Form -->
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-10 d-flex flex-wrap justify-content-between align-items-start">

        <!-- Left Section -->
        <div class="mb-4">
          <div class="facebook-text mb-2">Social Media App</div>
          <h5>Recent logins</h5>
          <p>Click your picture or add an account.</p>
          <div class="d-flex gap-3">


            <!-- Add Account Box -->
            <div class="text-center">
              <a href="{{ route('login') }}">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" class="rounded" width="100"
                  alt="Add" />
                <div>Add Account</div>
              </a>
            </div>

          </div>
        </div>

        <!-- Right Section -->
        <div class="card p-4 shadow-sm" style="min-width: 340px;" id="form-card">

          <!-- Login Form using Laravel route -->
          <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf
            <input type="email" name="email" class="form-control mb-3" placeholder="Email address or phone number"
              required />
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required />
            <button type="submit" class="btn btn-primary w-100">Log In</button>
            <a href="{{ route('password.request') }}" class="d-block text-center mt-2 text-decoration-none">
              Forgotten password?
            </a>
            <hr />
            <button type="button" class="btn btn-success w-100" onclick="toggleForm()">New Registration</button>
          </form>

          <!-- Register Form using Laravel route -->
          <form method="POST" action="{{ route('register') }}" id="register-form"
            style="{{ session('register_errors') ? 'display:block;' : 'display:none;' }}">
            @csrf

            <div class="mb-3">
              <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" required />
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <input type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" placeholder="Email address" required />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="New Password" required />
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                required />
            </div>

            <button type="submit" class="btn btn-success w-100">Sign Up</button>
            <p class="text-center mt-3 form-toggle" onclick="toggleForm()">Already have an account? Log In</p>
          </form>



        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleForm() {
      const loginForm = document.getElementById('login-form');
      const registerForm = document.getElementById('register-form');
      loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
      registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';
    }

    // If validation error come, register form auto open
    @if(session('register_errors'))
      document.getElementById('login-form').style.display = 'none';
      document.getElementById('register-form').style.display = 'block';
    @endif
  </script>


</body>

</html>