{{-- Like Button Module --}}
@push('styles')
<style>
.like-btn {
    text-decoration: none !important; 
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
      url: "{{ route('posts.like') }}",  
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        post_id: postId                   
      },
      success: function (res) {
        btn.find('.like-count').text(res.likes_count ?? 0);
        if (res.status === 'liked') {
          btn.addClass('text-primary');
        } else {
          btn.removeClass('text-primary');
        }
      },
      error: function(){ 
        alert('Failed to update like.'); 
      }
    });
  });
})();
</script>
@endpush
mmmm