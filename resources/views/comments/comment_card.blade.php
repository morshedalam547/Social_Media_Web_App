<div class="d-flex mb-2" id="userComment-{{ $userComment->id }}">

  <?php  $commentUser = $userComment->user  ?>

  <img src="{{ $commentUser->profile_image
  ? asset('storage/' . $commentUser->profile_image)
  : 'https://ui-avatars.com/api/?name=' . urlencode($commentUser?->name) }}" alt="{{ $commentUser?->name }}"
    class="rounded-circle me-2" width="32" height="32">

  <div>
    <strong>{{ $commentUser->name }}</strong>
    <p class="mb-0">{{ $userComment->content }}</p>
    <small class="text-muted">{{ $userComment->created_at->diffForHumans() }}</small>
  </div>
</div>