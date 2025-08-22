    @if($post->user_id === auth()->id())
<div class="dropdown position-absolute top-0 end-0 m-3">
  <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
    <i class="fas fa-ellipsis-h"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
    <li>
      <button class="dropdown-item text-danger delete-post-btn" 
              data-post-id="{{ $post->id }}" 
              type="button">
        Delete
      </button>
    </li>
  </ul>
</div>
@endif 


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

<script>
const notyf = new Notyf({
  duration: 3000,
  position: { x: 'right', y: 'top' }
});

$(document).on('click', '.delete-post-btn', function () {
    let postId = $(this).data('post-id');
    let postCard = $(`.post-card[data-post-id="${postId}"]`);

    $.ajax({
        url: "{{ url('posts') }}/" + postId,
        type: "POST",
        data: {
            _method: "DELETE",
            _token: "{{ csrf_token() }}",
            
        },
       success: function (res) {
    if (res.success) {
        postCard.fadeOut(400, function () {
            $(this).remove();
        });
        notyf.success(res.message);
    } else {
        notyf.error("Something went wrong.");
    }
}

    });
});
</script>
@endpush 
