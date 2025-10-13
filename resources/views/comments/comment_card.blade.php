<div class="d-flex mb-2 ms-{{ $userComment->parent_id ? '5' : '0' }}" id="userComment-{{ $userComment->id }}">
  <?php $commentUser = $userComment->user ?>

  <img src="{{ $commentUser->profile_image ? asset('storage/' . $commentUser->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($commentUser?->name) }}" 
       alt="{{ $commentUser?->name }}" class="rounded-circle me-2" width="32" height="32">

  <div>
    <strong>{{ $commentUser->name }}</strong>
    <p class="mb-0">{{ $userComment->content }}</p>
    <small class="text-muted">{{ $userComment->created_at->diffForHumans() }}</small>

    {{-- Reply Button --}}
    <button class="btn btn-sm btn-link text-primary reply-btn" data-comment-id="{{ $userComment->id }}">Reply</button>

    {{-- Reply Form (hidden) --}}
    <form class="reply-form d-none mt-1" data-post-id="{{ $userComment->post_id }}">
      @csrf
      <input type="hidden" name="parent_id" value="{{ $userComment->id }}">
      <div class="input-group input-group-sm">
        <input type="text" name="content" class="form-control form-control-sm" placeholder="Write a reply..." required>
        <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-paper-plane"></i></button>
      </div>
    </form>

    {{-- Nested replies --}}
    @foreach($userComment->replies as $reply)
        @include('comments.comment_card', ['userComment' => $reply])
    @endforeach
  </div>
</div>
