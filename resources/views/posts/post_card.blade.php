<div class="card mb-3 shadow-sm position-relative post-card" data-post-id="{{ $post->id }}">
  <div class="card-body">
    {{-- post creator & timestamp --}}
    <div class="d-flex align-items-center mb-2">
      <img
        src="{{ $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
        alt="{{ $post->user->name }}" class="rounded-circle me-2" width="40" height="40">
      <div>
        <strong>{{ $post->user->name }}</strong><br>
        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
      </div>
    </div>

    <p class="mb-2">{{ $post->content }}</p>
    @if($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid rounded mb-2"
      style="max-height:300px;">
  @endif

    {{-- Like Button --}}
    <div class="d-flex justify-content-around border-top pt-2 mt-2 align-items-center">
      <button class="btn btn-link text-muted like-btn" data-post-id="{{ $post->id }}">
        <i class="fas fa-thumbs-up me-1"></i> Like (<span class="like-count">{{ $post->likes->count() }}</span>)
      </button>

      {{-- Comment Button --}}
      <button class="btn btn-link text-muted comment-toggle-btn" data-post-id="{{ $post->id }}">
        <i class="fas fa-comment me-1"></i> Comment (<span class="comment-count">{{ $post->comments->count() }}</span>)
      </button>


      {{-- share Button --}}
      <div class="dropdown">
        <button class="btn btn-link text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown"
          style="text-decoration: none;">
          <i class="fas fa-share me-1"></i> Share
        </button>

        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item share-item" data-platform="facebook" data-post-id="{{ $post->id }}" href="#">
              Facebook
            </a>
          </li>
          <li>
            <a class="dropdown-item share-item" data-platform="twitter" data-post-id="{{ $post->id }}" href="#">
              Twitter
            </a>
          </li>
          <li>
            <a class="dropdown-item share-item" data-platform="email" data-post-id="{{ $post->id }}" href="#">
              Email
            </a>
          </li>
        </ul>
      </div>

    </div>

    {{-- new Comments --}}

    <div class="comments-section mt-3 d-none" id="commentsSection{{ $post->id }}">
      <div class="comments-list mb-3">
        @foreach($post->comments as $comment)
      <div class="d-flex mb-2">
        <img
        src="{{ $comment->user->profile_image ? asset('storage/' . $comment->user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
        alt="{{ $comment->user->name }}" class="rounded-circle me-2" width="32" height="32">
        <div>
        <strong>{{ $comment->user->name }}</strong>
        <p class="mb-0">{{ $comment->content }}</p>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
        </div>
      </div>
    @endforeach
      </div>
      <form class="add-comment-form" data-post-id="{{ $post->id }}">
        @csrf
        <div class="input-group">
          <input type="text" name="content" class="form-control form-control-sm" placeholder="Write a comment..."
            required>
          <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-paper-plane"></i></button>
        </div>
      </form>
    </div>

    @include('posts.post_delete')

  </div>
</div>