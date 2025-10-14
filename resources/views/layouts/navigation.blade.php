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
              $user = auth()->user();
              $pendingRequests = \App\Models\Friendship::where('receiver_id', $user->id)
                  ->where('status', 'pending')
                  ->with('sender')
                  ->get();

              // Latest 5 unread notifications
              $notifications = $user->unreadNotifications()->latest()->take(5)->get();
          @endphp

          <!-- Friend Requests Dropdown -->
          <li class="nav-item dropdown position-relative">
            <a class="nav-link dropdown-toggle" href="#" id="friendDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-friends"></i>
              @if($pendingRequests->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                  {{ $pendingRequests->count() }}
                </span>
              @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                aria-labelledby="friendDropdown"
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

          <!-- Notification Dropdown -->
          <li class="nav-item dropdown position-relative">
            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell"></i>
              @if($notifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm">
                  {{ $notifications->count() }}
                </span>
              @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                aria-labelledby="notificationDropdown"
                style="width: 300px; max-height: 400px; overflow-y: auto;">
              <li class="dropdown-header fw-bold">Notifications</li>
              <hr class="my-1">

              @forelse($notifications as $notification)
                <li class="d-flex align-items-center mb-2 p-1 border-bottom">
                  <img src="{{ asset('storage/' . ($notification->data['friend_image'] ?? 'default-avatar.png')) }}"
                       class="rounded-circle me-2 border" width="40" height="40">
                  <div>
                    <div class="small">{{ $notification->data['message'] }}</div>
                    <a href="{{ route('user.profile', $notification->data['friend_id']) ?? 0 }}" class="small text-primary">
                      View Profile
                    </a>
                  </div>
                </li>
              @empty
                <li class="text-center text-muted py-2">No notifications yet 😅</li>
              @endforelse
            </ul>
          </li>


<!-- Chat Dropdown -->
<li class="nav-item dropdown position-relative">
    <a class="nav-link dropdown-toggle" href="#" id="chatDropdown" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-comments"></i>
        <span id="chat-unread-badge"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
              style="display:none;"></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2"
        aria-labelledby="chatDropdown"
        style="width:300px; max-height:400px; overflow-y:auto;">
        <li class="dropdown-header fw-bold">Chats</li>
        <hr class="my-1">
        @php $friends = auth()->user()->friends(); @endphp

        @forelse($friends as $friend)
            @php
                $unread = $friend->messages()
                                 ->where('receiver_id', auth()->id())
                                 ->where('seen', false)->count();
            @endphp
            <li class="d-flex justify-content-between align-items-center mb-2 p-1 border-bottom chat-item"
                data-id="{{ $friend->id }}"
                data-name="{{ $friend->name }}"
                style="cursor:pointer;">
                <span>{{ $friend->name }}</span>
                <span class="badge bg-danger friend-unread" style="display:{{ $unread>0?'inline-block':'none' }}">{{ $unread }}</span>
            </li>
        @empty
            <li class="text-center text-muted py-2">No friends yet 😅</li>
        @endforelse
    </ul>
</li>

<!-- ✅ Popup Chat Box (hidden by default) -->
<div id="chat-popup" class="position-fixed bottom-0 end-0 m-3 shadow-lg border rounded bg-white"
     style="width:320px; display:none; z-index:1050;">
    <div class="p-2 bg-primary text-white d-flex justify-content-between align-items-center">
        <span id="chat-popup-name">Chat</span>
        <button class="btn-close btn-close-white" id="close-chat"></button>
    </div>
    <div id="chat-popup-messages" style="height:300px; overflow-y:auto; padding:10px;"></div>
    <div class="p-2 border-top">
        <form id="chat-popup-form">
            @csrf
            <div class="input-group">
                <input type="text" id="chat-popup-input" class="form-control" placeholder="Type a message...">
                <button class="btn btn-primary" type="submit">Send</button>
            </div>
        </form>
    </div>
</div>

<!-- ✅ Scripts -->
<script>
let selectedFriendId = null;

// 🔄 Update unread badge
function updateUnreadBadge() {
    $.get('{{ route("chat.unreadCount") }}', function(res) {
        if(res.count > 0){
            $('#chat-unread-badge').text(res.count).show();
        } else {
            $('#chat-unread-badge').hide();
        }

        $('.chat-item').each(function(){
            let fid = $(this).data('id');
            let unread = res.byFriend[fid] ?? 0;
            if(unread > 0){
                $(this).find('.friend-unread').text(unread).show();
            } else {
                $(this).find('.friend-unread').hide();
            }
        });
    });
}
updateUnreadBadge();
setInterval(updateUnreadBadge, 5000);

// 🧩 Open chat popup
$(document).on('click', '.chat-item', function() {
    let friendId = $(this).data('id');
    let friendName = $(this).data('name');
    selectedFriendId = friendId;
    $('#chat-popup-name').text(friendName);
    $('#chat-popup').fadeIn();
    loadChat(friendId);

    $.post('/chat/' + friendId + '/seen', {_token: '{{ csrf_token() }}'}, function(){
        updateUnreadBadge();
    });
});

// ❌ Close chat popup
$('#close-chat').click(function() {
    $('#chat-popup').fadeOut();
    selectedFriendId = null;
});

// 📩 Load messages
function loadChat(friendId){
    $.get('/chat/' + friendId, function(data){
        const messagesHtml = $(data).find('#chat-messages').html();
        $('#chat-popup-messages').html(messagesHtml);
        $('#chat-popup-messages').scrollTop($('#chat-popup-messages')[0].scrollHeight);
    });
}

// 📨 Send message
$('#chat-popup-form').submit(function(e){
    e.preventDefault();
    if(!selectedFriendId) return;

    const msg = $('#chat-popup-input').val().trim();
    if(!msg) return;

    $.post('/chat/' + selectedFriendId + '/send', {
        _token: '{{ csrf_token() }}',
        message: msg
    }, function(){
        $('#chat-popup-input').val('');
        loadChat(selectedFriendId);
    });
});

// 🔁 Auto refresh chat when popup open
setInterval(function(){
    if(selectedFriendId){
        loadChat(selectedFriendId);
    }
}, 3000);
</script>


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
