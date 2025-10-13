<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm border-bottom py-2">
  <div class="container-fluid justify-content-center">
    <div class="d-flex align-items-center gap-3 w-75 justify-content-center">
    <!-- Brand (Centered) -->
    <a class="navbar-brand d-flex align-items-center fw-bold text-primary me-3" href="{{ route('dashboard') }}">
      <i class="fa-brands fa-facebook me-1"></i> Facebook Clone
    </a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible Content -->
    <div class="collapse navbar-collapse justify-content-center" id="navbarContent">

      <!-- Search Bar (Centered) -->
      <form action="{{ route('dashboard') }}" method="GET" class="d-flex mx-3 my-2 my-lg-0 w-50">
        <div class="input-group input-group-sm w-100">
          <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-pill"
                 placeholder="Search...">
          <button class="btn btn-info rounded-pill ms-1" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
          <a href="{{ route('dashboard') }}" class="btn btn-secondary rounded-pill ms-1">Reset</a>
        </div>
      </form>

      <!-- Right Side Links (Centered) -->
      <ul class="navbar-nav ms-3 align-items-center gap-3">

        @auth
        <!-- Notifications -->
        <li class="nav-item position-relative">
          <a class="nav-link" href="#" data-bs-toggle="tooltip" title="Notifications">
            <i class="fas fa-bell fa-lg"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
              3
            </span>
          </a>
        </li>

        <!-- Messages -->
        <li class="nav-item position-relative">
          <a class="nav-link" href="#" data-bs-toggle="tooltip" title="Messages">
            <i class="fas fa-envelope fa-lg"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
              5
            </span>
          </a>
        </li>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('default-avatar.png') }}"
                 alt="Profile" class="rounded-circle me-2 border border-2 border-primary" width="35" height="35">
            <span class="fw-semibold text-dark">{{ $user->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i> My Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @endauth

        @guest
          <li class="nav-item"><a class="nav-link fw-semibold text-dark" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold text-dark" href="{{ route('register') }}">Register</a></li>
        @endguest

      </ul>
</div>
    </div>
  </div>
</nav>

<!-- Activate Bootstrap Tooltips -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>
