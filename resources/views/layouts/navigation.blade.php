<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top mb-2 py-2 border-bottom shadow-sm">
  <div class="container">
    <a class="navbar-brand text-primary fw-bold" href="{{ route('dashboard') }}">Social Media App</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        @auth
              <li class="nav-item dropdown bg-success:hover">
                <a class="nav-link dropdown-toggle d-flex align-items-center text-primary" href="#" id="userDropdown"
                  role="button" data-bs-toggle="dropdown">
                  <img src="{{$user->profile_image
          ? asset('storage/' . $user->profile_image)
          : asset('default-avatar.png') }}" alt="Profile" class="rounded-circle me-2" width="30"
                    height="30">
                  {{$user->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a></li>
                  <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                  <li>
                    <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button class="dropdown-item text-danger">Logout</button>
                    </form>
                  </li>
                </ul>
              </li>
        @endauth

        @guest
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('register') }}">Register</a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>