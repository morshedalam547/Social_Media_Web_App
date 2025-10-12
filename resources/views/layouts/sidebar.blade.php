<style>
/* Container: sidebar + main content + sidebar */
.layout-container {
  display: flex;
  justify-content: center; /* main content centered */
  gap: 1rem; /* sidebar এবং main content এর মধ্যে gap */
  padding: 1rem;
}

/* Left Sidebar */
.sidebar-left {
  width: 250px;
  background-color: #f8f9fa;
  padding: 1rem;
  border: 1px solid #ddd;
}

/* Main Content */
.content {
  width: 600px; /* centralized content width */
  background-color: #fff;
  padding: 2rem;
  min-height: 80vh;
  box-sizing: border-box;
}

/* Right Sidebar */
.sidebar-right {
  width: 250px;
  background-color: #f8f9fa;
  padding: 1rem;
  border: 1px solid #ddd;
}

/* Responsive: small screens */
@media (max-width: 991px) {
  .layout-container {
    flex-direction: column;
    align-items: center; /* content centered on mobile */
  }

  .sidebar-left,
  .sidebar-right,
  .content {
    width: 100%;
  }
}

</style>



<div class="layout-container">
    <!-- Left Sidebar -->
    <div class="sidebar-left d-none d-md-block">
        <h5>Left Sidebar</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('profile.show') }}" class="nav-link">Profile</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Settings</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="content">
    
        <h4>Welcome, {{ $user->name }} 👋</h4> <br>
        @include('posts.create_post')

        <div id="postsContainer">
            @include('posts.message.message')
            @foreach($posts as $postNew)
                @include('posts.post_card', ['newPost' => $postNew])
            @endforeach
        </div>
    </main>

    <!-- Right Sidebar -->
    <div class="sidebar-right d-none d-md-block">
        <h5>Right Sidebar</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link">Notifications</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Messages</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Support</a></li>
        </ul>
    </div>
</div>
