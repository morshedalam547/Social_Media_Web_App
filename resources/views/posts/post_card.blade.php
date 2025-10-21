<div class="card mb-3 shadow-sm position-relative post-card" data-post-id="{{ $newPost->id }}">
  <div class="card-body">

    {{-- User Post --}}
    <div class="d-flex align-items-center mb-2">
      <a href="{{ route('user.profile', $newPost->user->id) }}" class="text-decoration-none text-dark d-flex align-items-center">
        <img src="{{ $newPost->user->profile_image ? asset('storage/' . $newPost->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($newPost->user->name) }}" 
             alt="{{ $newPost->user->name }}" class="rounded-circle me-2" width="40" height="40">
        <div>
          <strong>{{ $newPost->user->name }}</strong><br>
          <small class="text-muted">{{ $newPost->created_at->diffForHumans() }}</small>
        </div>
      </a>
    </div>

    {{-- Post Content --}}
    <p class="mb-2">{{ $newPost->content }}</p>

    @if($newPost->image)
      <img src="{{ asset('storage/' . $newPost->image) }}" alt="Post Image" class="img-fluid rounded mb-2" style="max-height:300px;">
    @endif

    {{-- Like  --}}
    <div class="d-flex justify-content-around border-top pt-2 mt-2 align-items-center">

    <div class="like-container position-relative d-inline-block">
        @php
            $userReaction = $newPost->reactions()->where('user_id', auth()->id())->first();
        @endphp
        <button class="btn btn-link text-muted like-btn" data-post-id="{{ $newPost->id }}">
            <span class="like-emoji">
                {!! $userReaction ? ($userReaction->type == 'like' ? '👍' : ($userReaction->type == 'love' ? '❤️' : ($userReaction->type == 'haha' ? '😂' : '😮'))) : '👍' !!}
            </span>
            <span class="like-text">{{ $userReaction ? ucfirst($userReaction->type) : 'Like' }}</span>
            (<span class="like-count">{{ $newPost->reactions->count() }}</span>)
        </button>

        {{-- Emoji Popup --}}
    <div class="emoji-popup bg-white shadow rounded position-absolute">
    <span class="emoji" data-emoji="like">👍</span>
    <span class="emoji" data-emoji="love">❤️</span>
    <span class="emoji" data-emoji="haha">😂</span>
    <span class="emoji" data-emoji="wow">😮</span>
</div>

    </div>






      <button class="btn btn-link text-muted comment-toggle-btn text-decoration-none " data-post-id="{{ $newPost->id }}">
        <i class="fas fa-comment me-1 "></i> Comments (<span class="comment-count">{{ $newPost->comments->count() }}</span>)
      </button>

      <div class="dropdown">
        <button class="btn btn-link text-muted dropdown-toggle text-decoration-none " type="button" data-bs-toggle="dropdown">
          <i class="fas fa-share me-1"></i> Share
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item share-item" data-platform="facebook" data-post-id="{{ $newPost->id }}" href="#">Facebook</a></li>
          <li><a class="dropdown-item share-item" data-platform="twitter" data-post-id="{{ $newPost->id }}" href="#">Twitter</a></li>
          <li><a class="dropdown-item share-item" data-platform="email" data-post-id="{{ $newPost->id }}" href="#">Email</a></li>
        </ul>
      </div>
    </div>
    

    {{-- Comments Section --}}
    <div class="comments-section mt-3 d-none" id="commentsSection{{ $newPost->id }}">
      <div class="comments-list mb-3">
        @foreach($newPost->comments->where('parent_id', null) as $newComment)
          @include('comments.comment_card', ['userComment' => $newComment])
        @endforeach
      </div>

      {{-- Add main comment --}}
      <form class="add-comment-form" data-post-id="{{ $newPost->id }}">
        @csrf
        <div class="input-group">
          <input type="text" name="content" class="form-control form-control-sm" placeholder="Write a comment..." required>
          <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-paper-plane"></i></button>
        </div>
      </form>
    </div>

    @include('posts.post_delete')

  </div>
</div>
