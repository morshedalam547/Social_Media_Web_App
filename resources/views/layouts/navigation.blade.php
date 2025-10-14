<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm border-bottom py-2">
  <div class="container-fluid justify-content-center">
    <div class="d-flex align-items-center gap-3 w-75 justify-content-center">

      <!-- Brand -->
      <a class="navbar-brand d-flex align-items-center fw-bold text-primary me-3" href="{{ route('dashboard') }}">
        <i class="fa-brands fa-facebook me-1"></i> Facebook Clone
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible Content -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarContent">

        <!-- Search -->
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

        <!-- Right Links -->
        <ul class="navbar-nav ms-3 align-items-center gap-3">

          @auth
          @php
              $pendingRequests = \App\Models\Friendship::where('receiver_id', auth()->id())
                  ->where('status', 'pending')
                  ->with('sender')
                  ->get();
          @endphp

          <!-- 🔔 Friend Request Notification Dropdown -->
          <li class="nav-item dropdown position-relative">
            <a class="nav-link dropdown-toggle" href="#" id="friendDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
             <i class="bi bi-bell-fill"></i>
              @if($pendingRequests->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                  {{ $pendingRequests->count() }}
                </span>
              @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2" aria-labelledby="friendDropdown"
                style="width: 300px; max-height: 400px; overflow-y: auto;">
              <li class="dropdown-header fw-bold">Friend Requests</li>
              <hr class="my-1">
              
              @forelse($pendingRequests as $request)
                <li class="d-flex align-items-center justify-content-between mb-2 p-1 border-bottom">
                  <div class="d-flex align-items-center">
                    <img src="{{ $request->sender->profile_image ? asset('storage/'.$request->sender->profile_image) : asset('default-avatar.png') }}"
                         class="rounded-circle me-2 border" width="40" height="40">
                    <span>{{ $request->sender->name }}</span>
                  </div>
                  <div class="btn-group btn-group-sm">
                    <form action="{{ route('friend.accept', $request->id) }}" method="POST">
                      @csrf
                      <button class="btn btn-success btn-sm">Accept</button>
                    </form>
                    <form action="{{ route('friend.reject', $request->id) }}" method="POST">
                      @csrf
                      <button class="btn btn-danger btn-sm">Reject</button>
                    </form>
                  </div>
                </li>
              @empty
                <li class="text-center text-muted py-2">No new requests 😅</li>
              @endforelse
            </ul>
          </li>

          <!-- 👤 Profile Dropdown -->
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
