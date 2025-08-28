<div class="d-flex mb-2" id="comment-{{ $comment->id }}">
  <img src="{{ $comment->user->profile_image 
                ? asset('storage/' . $comment->user->profile_image) 
                : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
       alt="{{ $comment->user->name }}"
       class="rounded-circle me-2" width="32" height="32">
  <div>
    <strong>{{ $comment->user->name }}</strong>
    <p class="mb-0">{{ $comment->content }}</p>
    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
  </div>
</div>
