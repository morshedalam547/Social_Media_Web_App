<!-- sidebar.blade.php -->
<style>
  /* Left sidebar */
  .sidebar-left {
    position: fixed;
    top: 56px;
    left: 0;
    width: 250px;
    height: calc(100vh - 56px);
    background-color: #f8f9fa;
    overflow-y: auto;
    padding: 1rem;
    border-right: 1px solid #ddd;
    z-index: 1030;
  }

  /* Right sidebar */
  .sidebar-right {
    position: fixed;
    top: 56px;
    right: 0;
    width: 250px;
    height: calc(100vh - 56px);
    background-color: #f8f9fa;
    overflow-y: auto;
    padding: 1rem;
    border-left: 1px solid #ddd;
    z-index: 1030;
  }
</style>

<!-- Left Sidebar -->
<div class="sidebar-left d-none d-md-block">
  <h5>Left Sidebar</h5>
  <ul class="nav flex-column">
    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
    <li class="nav-item"><a href="{{ route('profile.show') }}" class="nav-link">Profile</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Settings</a></li>
  </ul>
</div>

<!-- Right Sidebar -->
<div class="sidebar-right d-none d-md-block">
  <h5>Right Sidebar</h5>
  <ul class="nav flex-column">
    <li class="nav-item"><a href="#" class="nav-link">Notifications</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Messages</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Support</a></li>
  </ul>
</div>