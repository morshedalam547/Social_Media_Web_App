@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">My Friends ({{ $friends->count() }})</h4>
        </div>
        <div class="card-body d-flex flex-wrap">
            @forelse($friends as $friend)
                <div class="text-center me-3 mb-3">
                    <a href="{{ route('user.profile', $friend->id) }}" class="text-decoration-none text-dark">
                        <img src="{{ $friend->profile_image ? asset('storage/'.$friend->profile_image) : asset('default-avatar.png') }}"
                             class="rounded-circle border shadow-sm" width="80" height="80">
                        <p class="mt-2 mb-0 fw-semibold">{{ $friend->name }}</p>
                    </a>
                </div>
            @empty
                <div class="text-center text-muted w-100">No friends yet 😅</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
