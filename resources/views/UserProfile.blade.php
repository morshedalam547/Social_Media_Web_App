<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Central Column -->
        <div class="col-lg-5 col-md- col-sm-10">
            <div class="card shadow-sm mb-4">

                {{-- Cover Photo --}}
                <div class="position-relative">
                    @if ($user->cover_image)
                        <img src="{{ asset('storage/' . $user->cover_image) }}" class="img-fluid rounded-top">
                    @else
                        <img src="default.jpg" class="img-fluid rounded-top">
                    @endif

                    {{-- Cover Upload Button --}}
                    <button class="btn btn-light position-absolute top-0 end-0 m-3 shadow-sm rounded-circle"
                            onclick="document.getElementById('coverInput').click();">
                        <i class="fas fa-camera"></i>
                    </button>

                    <form action="{{ route('profile.updateCover') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                        @csrf
                        <input type="file" name="cover_image" id="coverInput" accept="image/*" onchange="this.form.submit();">
                    </form>

                    {{-- Profile Image --}}
                    <div class="position-absolute" style="bottom:-45px; left:20px;">
                        @if ($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" 
                                 alt="{{ $user->name }}" class="rounded-circle border border-3 border-white shadow" width="90" height="90">
                        @else
                            <img src="https://via.placeholder.com/90" 
                                 alt="{{ $user->name }}" class="rounded-circle border border-3 border-white shadow">
                        @endif

                        <form id="profileUploadForm" action="{{ route('profile.updateImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                            @csrf
                            <input type="file" name="profile_image" id="profileInput" accept="image/*" onchange="this.form.submit();">
                        </form>

                        <button class="btn btn-light btn-sm shadow-sm rounded-circle position-absolute top-0 end-0"
                                onclick="document.getElementById('profileInput').click();">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                </div>

             {{-- Card Body --}}
<div class="card-body mt-5 pt-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0">{{ $user->name }}</h4>

        <div class="d-flex align-items-center gap-2">
            {{-- Friends Dropdown --}}
            @php
                $friends = $user->friends(); // collection
            @endphp

            @if($friends->count() > 0)
                <div class="dropdown">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                            id="friendsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Friends ({{ $friends->count() }})
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                        aria-labelledby="friendsDropdown" style="width: 250px; max-height: 300px; overflow-y: auto;">
                        @foreach($friends as $friend)
                            <li class="d-flex align-items-center mb-2">
                                <a href="{{ route('user.profile', $friend->id) }}" class="d-flex align-items-center text-decoration-none text-dark">
                                    <img src="{{ $friend->profile_image ? asset('storage/'.$friend->profile_image) : asset('default-avatar.png') }}"
                                         class="rounded-circle border border-2 me-2" width="40" height="40">
                                    <span>{{ $friend->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Edit Profile Button --}}
            @if(auth()->id() === $user->id)
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-pen"></i> Edit Profile
                </a>
            @endif
        </div>
    </div>

    <div class="mb-2">
        <span class="badge bg-success me-1"><i class="fas fa-check"></i> Verified</span>
        <span class="badge bg-primary"><i class="fas fa-star"></i> Pro Developer</span>
        <p class="mt-2">{{ $user->bio ?? 'Hi 👋, I’m a Backend Software Engineer Developer from Bangladesh' }}</p>
    </div>
</div>

            </div>

    <!-- Main Content -->
    <main class="content">
         <br> <br>
        <h4>Welcome, {{ $user->name }} 👋</h4>
        @include('posts.create_post')

        <div id="postsContainer">
            @include('posts.message.message')
            @foreach($posts as $postNew)
                @include('posts.post_card', ['newPost' => $postNew])
            @endforeach
        </div>
    </main>
    
            </div>
            
        </div>
        
    </div>
    
</div>


@extends('layouts.app')
@include('posts.like')
  @include('posts.comments_ajax')
  @include('posts.share')


{{-- @include('posts.dashboard') --}}