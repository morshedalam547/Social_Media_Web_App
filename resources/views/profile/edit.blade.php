
@extends('layouts.app')
@section('content')
<br>
<br>
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
    </div>

    <!-- Profile Image -->
    <div class="mb-3">
        <label>Profile Image</label><br>
        @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" width="100" class="mb-2">
        @endif
        <input type="file" name="profile_image" class="form-control">
    </div>

    <button class="btn btn-success">Update</button>
</form>
@endsection