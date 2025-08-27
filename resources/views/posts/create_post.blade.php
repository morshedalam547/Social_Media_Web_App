<div class="card shadow-sm mb-4" id="createPostBlock">
  <div class="card-body">
    <form id="postForm" enctype="multipart/form-data">
      @csrf
      <div class="d-flex align-items-start mb-3">
        <img
          src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
          alt="Your avatar" class="rounded-circle me-3" width="40" height="40">
        <textarea name="content" class="form-control" rows="2" placeholder="What's on your mind?" required></textarea>
      </div>

      <input type="file" name="image" accept="image/*" id="imageInput" class="d-none">

      <div id="imagePreview" class="mb-3 d-none">
        <div class="position-relative d-inline-block">
          <img src="" alt="Preview" class="img-fluid rounded border" style="max-height: 250px;">
          <button type="button" id="removeImage"
            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle"><i
              class="fas fa-times"></i></button>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-secondary btn-sm" id="selectImageBtn">
          <i class="fas fa-image"></i>
        </button>
        <button type="submit" class="btn btn-primary btn-sm">Post</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

@push('scripts')
  <script>
    (function CreatePostModule() {
      const CSRF_TOKEN = '{{ csrf_token() }}';
      const imageInput = document.getElementById('imageInput');
      const imagePreview = document.getElementById('imagePreview');
      const imageTag = imagePreview?.querySelector('img');
      const removeImageBtn = document.getElementById('removeImage');




      $('#selectImageBtn').on('click', () => $('#imageInput').click());

      if (imageInput) {
        imageInput.addEventListener('change', function () {
          const file = this.files?.[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = e => { if (imageTag) imageTag.src = e.target.result; imagePreview.classList.remove('d-none'); };
            reader.readAsDataURL(file);
          }
        });
      }

      if (removeImageBtn) {
        removeImageBtn.addEventListener('click', function () { imageInput.value = ''; if (imageTag) imageTag.src = ''; imagePreview.classList.add('d-none'); });
      }

      $('#postForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
          url: "{{ route('posts.store') }}",
          method: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function (res) {
            $('#postForm')[0].reset();
            $('#imagePreview').addClass('d-none');
            $('#postsContainer').prepend(res.html);
            notyf.Success(res.message);
          },


          error: function (xhr) { alert('Failed to create post'); console.error(xhr.responseText); }
        });
      });
    })();
  </script>
@endpush