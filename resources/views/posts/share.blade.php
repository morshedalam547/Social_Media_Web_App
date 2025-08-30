@push('scripts')
    <script>
        $(document).on('click', '.share-item', function (e) {
            e.preventDefault();

            let platform = $(this).data('platform');
            let postId = $(this).data('post-id');

            $.ajax({
                url: "{{ url('posts/share') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    post_id: postId,
                    platform: platform
                },
                success: function (res) {
                    console.log("Share logged:", res);

                    // Open in new tab
                    let postUrl = "{{ url('posts') }}/" + postId;

                    if (platform === 'facebook') {
                        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(postUrl)}`, '_blank');
                    } else if (platform === 'twitter') {
                        window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(postUrl)}`, '_blank');
                    } else if (platform === 'email') {
                        window.open(`mailto:?subject=Check this post&body=${encodeURIComponent(postUrl)}`, '_blank');
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);

                }
            });
        });    
    </script>
@endpush