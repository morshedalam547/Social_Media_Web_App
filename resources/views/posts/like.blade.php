@push('scripts')
<script>
$(document).ready(function() {

    // 🎵 Sound files load
    const hoverSound = new Audio('/sounds/hover.mp3');
    const clickSound = new Audio('/sounds/click.mp3');

    // Hover করলে emoji-popup show হবে
    $(document).on('mouseenter', '.like-container', function() {
        let popup = $(this).find('.emoji-popup');
        clearTimeout(popup.data('timeout'));
        popup.stop(true, true).fadeIn(150);
    });

    // Hover সরালে emoji-popup hide হবে
    $(document).on('mouseleave', '.like-container', function() {
        let popup = $(this).find('.emoji-popup');
        let timeout = setTimeout(() => {
            if (!popup.is(':hover')) {
                popup.stop(true, true).fadeOut(150);
            }
        }, 100);
        popup.data('timeout', timeout);
    });

    // Popup থেকেও mouse সরালে hide হবে
    $(document).on('mouseleave', '.emoji-popup', function() {
        $(this).stop(true, true).fadeOut(150);
    });

    // 🎵 Emoji hover করলে soft sound বাজবে
    $(document).on('mouseenter', '.emoji', function() {
        hoverSound.currentTime = 0;
        hoverSound.play();
    });

    // 🟡 Like button এ click করলে normal like হবে
    $(document).on('click', '.like-btn', function(e) {
        e.preventDefault();
        let btn = $(this);
        let container = btn.closest('.like-container');
        let postId = btn.data('post-id');

        // 🎵 click sound বাজবে
        clickSound.currentTime = 0;
        clickSound.play();

        $.post('/posts/' + postId + '/react', {
            _token: '{{ csrf_token() }}',
            reaction: 'like'
        }, function(res) {
            btn.find('.like-count').text(res.likes_count ?? 0);
            btn.find('.like-emoji').text('👍');
            btn.find('.like-text').text('Like');
        });
    });

    // 🔵 Emoji তে click করলে selected reaction হবে
    $(document).on('click', '.emoji', function() {
        let emoji = $(this).data('emoji');
        let container = $(this).closest('.like-container');
        let postId = container.find('.like-btn').data('post-id');
        let btn = container.find('.like-btn');

        // 🎵 click sound বাজবে
        clickSound.currentTime = 0;
        clickSound.play();

        $.post('/posts/' + postId + '/react', {
            _token: '{{ csrf_token() }}',
            reaction: emoji
        }, function(res) {
            btn.find('.like-count').text(res.likes_count ?? 0);
            btn.find('.like-emoji').text(
                emoji == 'like' ? '👍' :
                emoji == 'love' ? '❤️' :
                emoji == 'haha' ? '😂' :
                emoji == 'wow' ? '😮' : '👍'
            );
            btn.find('.like-text').text(emoji.charAt(0).toUpperCase() + emoji.slice(1));
        });

        container.find('.emoji-popup').fadeOut(120);
    });

});

</script>
@endpush


@push('styles')
<style>
.like-container {
    position: relative;
}

.like-container .emoji-popup {
    display: flex;
    flex-direction: row; /* এক লাইনে দেখাবে */
    justify-content: center;
    align-items: center;
    gap: 10px;

    position: absolute;
    bottom: 40px;
    left: 0;
    background: #fff;
    border-radius: 50px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    padding: 8px 12px;
    z-index: 10;

    /* Hidden অবস্থায় */
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px) scale(0.95);
    transition: all 0.2s ease-out;
}

/* Hover করলে সুন্দরভাবে visible হবে */
.like-container:hover .emoji-popup {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.emoji-popup .emoji {
    cursor: pointer;
    font-size: 1.6rem;
    transition: transform 0.2s, filter 0.2s;
}

.emoji-popup .emoji:hover {
    transform: scale(1.4);
    filter: drop-shadow(0 2px 3px rgba(0,0,0,0.2));
}

.like-btn {
    text-decoration: none !important;
}

</style>
@endpush
