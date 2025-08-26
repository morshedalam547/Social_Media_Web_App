@extends('layouts.app')
@include('layouts.sidebar')

@section('content')

<main class="content">
   <br> <br>
  <h4>Welcome, To {{ $user->name }} 👋</h4> <br>

  @include('posts.create_post')

  <div id="postsContainer">
    @include('posts.message.message')

    @foreach($posts as $post)

      @include('posts.post_card', ['post' => $post])

    @endforeach
    
  </div>
</main>


@include('posts.like')
@include('posts.comments')
@include('posts.share')


@endsection
