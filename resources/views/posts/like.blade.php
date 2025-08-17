{{-- Like Button Module --}}
@push('styles')
<style>
.like-btn {
    text-decoration: none !important; /* remove underline */
}
.like-btn:hover {
    text-decoration: none !important;
}
</style>
@endpush

@push('scripts')
<script>
(function LikeModule() {
  $(document).on('click', '.like-btn', function () {
    const btn = $(this);
    const postId = btn.data('post-id');

    $.ajax({
      url: `/posts/${postId}/like`,
      type: 'POST',
      data: {_token: '{{ csrf_token() }}'},
      success: function (res) {
        btn.find('.like-count').text(res.likes_count);
        if (res.status === 'liked') btn.addClass('text-primary');
        else btn.removeClass('text-primary');
      },
      error: function(){ alert('Failed to update like.'); }
    });
  });
})();
</script>
@endpush
