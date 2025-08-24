@extends('layouts.app')
@include('layouts.sidebar')

@section('content')
<main class="content">
  <h2 class="my-3">Welcome, {{ $user->name }}</h2>

  @include('posts.create_post')

  <div id="postsContainer">
    @foreach($posts as $post)
      @include('posts.post_card', ['post' => $post])
    @endforeach
  </div>
</main>

@include('posts.like')
@include('posts.comments')
@include('posts.share')


@endsection
