
<div class="container mt-5">

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="card shadow-sm mb-4">
        {{-- Cover Photo --}}
        <div class="position-relative">
            @if ($user->cover_image)
                <img src="{{ asset('storage/' . $user->cover_image) }}" 
                     alt="Cover Image" class="w-100 cover-img rounded-top">
            @else
                <img src="https://images.unsplash.com/photo-1484417894907-623942c8ee29?w=1200&h=300&fit=crop" 
                     alt="Default Cover" class="w-100 cover-img rounded-top">
            @endif

            {{-- Cover Upload Button --}}
            <button class="btn btn-light position-absolute top-0 end-0 m-3 shadow-sm rounded-circle"
                    onclick="document.getElementById('coverInput').click();">
                <i class="fas fa-camera"></i>
            </button>

            <form id="coverUploadForm" action="{{ route('profile.updateCover') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                @csrf
                <input type="file" name="cover_image" id="coverInput" accept="image/*" onchange="this.form.submit();">
            </form>

            {{-- Profile Image --}}
            <div class="position-absolute" style="bottom:-60px; left:30px;">
                @if ($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" 
                         alt="{{ $user->name }}" class="rounded-circle border border-3 border-white shadow" width="120" height="120">
                @else
                    <img src="https://via.placeholder.com/120" 
                         alt="{{ $user->name }}" class="rounded-circle border border-3 border-white shadow">
                @endif

                <button class="btn btn-light small shadow-sm rounded-circle position-absolute top-0 end-0"
                        onclick="document.getElementById('profileInput').click();">
                    <i class="fas fa-camera"></i>
                </button>

                <form id="profileUploadForm" action="{{ route('profile.updateProfileImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="file" name="profile_image" id="profileInput" accept="image/*" onchange="this.form.submit();">
                </form>
            </div>
        </div>

        <div class="card-body mt-5 pt-5">
            {{-- Profile Info --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h2 class="ms-5">{{ $user->name }}</h2>
                <div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm me-2">Edit Profile</a>
                    <button class="btn btn-primary btn-sm">Share Profile</button>
                </div>
            </div>

            <div class="mb-2 ms-5">
                <span class="badge bg-success me-1"><i class="fas fa-check"></i> Verified</span>
                <span class="badge bg-primary"><i class="fas fa-star"></i> Pro Developer</span>
    

            <p class="ms-5">{{ $user->bio ?? 'Hi 👋, I’m a Backend Software Engineer Developer from Bangladesh' }}</p>
        </div>
        </div>
        </div>
        </div>


@include('posts.dashboard')