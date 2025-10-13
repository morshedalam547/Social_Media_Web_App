@push('scripts')
<script>
(function CommentModule() {
    // Toggle main comments
    $(document).on('click', '.comment-toggle-btn', function () {
        const postId = $(this).data('post-id');
        $(`#commentsSection${postId}`).toggleClass('d-none');
    });

    // Add main comment
    $(document).on('submit', '.add-comment-form', function (e) {
        e.preventDefault();
        const form = $(this);
        const postId = form.data('post-id');

        $.ajax({
            url: `/posts/${postId}/comment`,
            type: 'POST',
            data: form.serialize(),
            success: function (res) {
                if(res.success){
                    $(`#commentsSection${postId} .comments-list`).append(res.html);
                    form[0].reset();
                    $(`.comment-toggle-btn[data-post-id="${postId}"] .comment-count`).text(res.comments_count);
                }
            },
            error: function () { alert('Failed to add comment.'); }
        });
    });

    // Toggle reply form
    $(document).on('click', '.reply-btn', function () {
        $(this).siblings('.reply-form').toggleClass('d-none');
    });

    // Add reply comment
    $(document).on('submit', '.reply-form', function (e) {
        e.preventDefault();
        const form = $(this);
        const postId = form.data('post-id');

        $.ajax({
            url: `/posts/${postId}/comment`,
            type: 'POST',
            data: form.serialize(),
            success: function(res){
                if(res.success){
                    form.before(res.html);
                    form[0].reset();
                    form.addClass('d-none');
                    $(`.comment-toggle-btn[data-post-id="${postId}"] .comment-count`).text(res.comments_count);
                }
            },
            error: function(){ alert('Failed to add reply.'); }
        });
    });

})();
</script>
@endpush
