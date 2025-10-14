@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-4">

    <!-- Chat toggle button -->
    <button class="btn btn-primary position-fixed bottom-0 end-0 mb-3 me-3 rounded-circle shadow"
            id="chat-toggle-btn"
            style="width: 60px; height: 60px;">
        <i class="fas fa-comments"></i>
    </button>

    <!-- Floating Chat Box -->
    <div id="chat-box" class="card shadow-lg position-fixed bottom-0 end-0 mb-5 me-3"
         style="width: 350px; display: none; z-index: 1050;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span id="chat-with">{{ $friend->name ?? 'Select a friend' }}</span>
            <button type="button" class="btn-close btn-close-white" id="close-chat"></button>
        </div>

        <div id="chat-messages" class="card-body"
             style="height: 350px; overflow-y: auto; background: #f8f9fa;">
            @if(isset($messages))
                @foreach($messages as $msg)
                    <div class="{{ $msg->sender_id == auth()->id() ? 'text-end' : 'text-start' }} mb-1">
                        <span class="{{ $msg->sender_id == auth()->id() ? 'bg-primary text-white p-2 rounded-3' : 'bg-light p-2 rounded-3 border' }}">
                            {{ $msg->message }}
                        </span>
                    </div>
                @endforeach
            @else
                <p class="text-center text-muted">Select a friend to start chatting</p>
            @endif
        </div>

        <div class="card-footer bg-light">
            <form id="send-message-form" class="d-flex">
                @csrf
                <input type="text" id="message-input" class="form-control me-2" placeholder="Type message..." autocomplete="off">
                <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let selectedFriend = {{ $friend->id ?? 'null' }};

// Toggle Chat Popup
$('#chat-toggle-btn').click(function() {
    $('#chat-box').toggle();
});

// Close Chat Popup
$('#close-chat').click(function() {
    $('#chat-box').hide();
});

// Auto-scroll to bottom
function scrollToBottom() {
    $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
}

// Fetch messages periodically
function fetchMessages() {
    if(!selectedFriend) return;
    $.get('/chat/' + selectedFriend, function(data) {
        $('#chat-messages').html($(data).find('#chat-messages').html());
        scrollToBottom();

        // Mark messages as seen
        $.post('/chat/' + selectedFriend + '/seen', {_token: '{{ csrf_token() }}'}, function(res){
            $('#chatDropdown .badge').text(res.unreadCount).toggle(res.unreadCount > 0);
        });
    });
}

// Send message
$('#send-message-form').submit(function(e){
    e.preventDefault();
    if(!selectedFriend) return;
    let msg = $('#message-input').val().trim();
    if(!msg) return;

    $.post('/chat/' + selectedFriend + '/send', {_token: '{{ csrf_token() }}', message: msg}, function(){
        $('#message-input').val('');
        fetchMessages();
    });
});

// Poll every 5 sec
setInterval(fetchMessages, 5000);

// Scroll to bottom on load
scrollToBottom();
</script>
@endsection
