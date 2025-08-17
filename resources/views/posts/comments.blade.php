{{-- Comment Module --}}
@push('styles')
<style>
.comment-toggle-btn {
    text-decoration: none !important; 
}
.comment-toggle-btn:hover {
    text-decoration: none !important;
}
</style>
@endpush

@push('scripts')
<script>
(function CommentModule() {
  // Show/Hide comments
  $(document).on('click', '.comment-toggle-btn', function () {
    const postId = $(this).data('post-id');
    $(`#commentsSection${postId}`).toggleClass('d-none');
  });

  // Add new comment
  $(document).on('submit', '.add-comment-form', function (e) {
    e.preventDefault();
    const form   = $(this);
    const postId = form.data('post-id');
    const input  = form.find('input[name="content"]');
    const text   = input.val().trim();
    if (!text) return;

    $.ajax({
      url: `/posts/${postId}/comment`,
      type: 'POST',
      data: {_token: '{{ csrf_token() }}', content: text},
      success: function (res) {
        const html = `
        <div class="d-flex mb-2">
          <img src="${res.user_image}" alt="${res.user_name}" class="rounded-circle me-2" width="32" height="32">
          <div>
            <strong>${res.user_name}</strong>
            <p class="mb-0">${res.content}</p>
            <small class="text-muted">${res.created_at}</small>
          </div>
        </div>`;
        $(`#commentsSection${postId} .comments-list`).append(html);
        input.val('');
        $(`.comment-toggle-btn[data-post-id="${postId}"] .comment-count`).text(res.comments_count);
      },
      error: function(){ alert('Failed to add comment.'); }
    });
  });
})();
</script>
@endpush
