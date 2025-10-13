@extends('layouts.app')

@section('content')



<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Central Column -->
        <div class="col-lg-5 col-md-7 col-sm-10">

            <!-- Profile Card -->
            <div class="card shadow-sm mb-4">
                <div class="position-relative">
                    {{-- Cover Photo --}}
                    <img src="{{ $user->cover_image ? asset('storage/' . $user->cover_image) : asset('default.jpg') }}" class="img-fluid rounded-top">

                    {{-- Cover Upload Button --}}
                    @auth
            
                    <form action="{{ route('profile.updateCover') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                        @csrf
                        <input type="file" name="cover_image" id="coverInput" accept="image/*" onchange="this.form.submit();">
                    </form>
                    @endauth

                    {{-- Profile Image --}}
                    <div class="position-absolute" style="bottom:-45px; left:20px;">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/90' }}"
                             class="rounded-circle border border-3 border-white shadow" width="90" height="90">
                        
                        @auth
                        <form id="profileUploadForm" action="{{ route('profile.updateImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                            @csrf
                            <input type="file" name="profile_image" id="profileInput" accept="image/*" onchange="this.form.submit();">
                        </form>

                        @endauth
                    </div>
                </div>

                <div class="card-body mt-5 pt-5">
                

                    <div class="mb-2">
                        <span class="badge bg-success me-1"><i class="fas fa-check"></i> Verified</span>
                        <span class="badge bg-primary"><i class="fas fa-star"></i> Pro Developer</span>
                        <p class="mt-2">{{ $user->bio ?? 'Hi 👋, I’m a Backend Software Engineer Developer from Bangladesh' }}</p>
                    </div>
                </div>
            </div>

            <!-- User Posts -->
            <main class="content">
               

                <div id="postsContainer">
                    @include('posts.message.message')

                    @foreach($posts as $newPost)
                        @include('posts.post_card', ['newPost' => $newPost])
                    @endforeach
                </div>
            </main>

        </div>
    </div>
</div>

@include('posts.like')
@include('posts.comments_ajax')
@include('posts.share')

@endsection
