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

        const form = $(this);
        const postId = form.data('post-id');
        $.ajax({
          url: `/posts/${postId}/comment`,
          type: 'POST',
          data: form.serialize(),
          success: function (res) {
            if (res.success) {
              $(`#commentsSection${postId} .comments-list`).append(res.html);
              form[0].reset();
              $(`.comment-toggle-btn[data-post-id="${postId}"] .comment-count`).text(res.comments_count);
            }
          },
          error: function () { alert('Failed to add comment.'); }
        });
      });
    })();
  </script>
@endpush