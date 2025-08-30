@extends('layouts.app')
@include('layouts.sidebar')

@section('content')

  <main class="content">
    <br> <br>
    <h4>Welcome, To {{ $user->name }} 👋</h4> <br>

    @include('posts.create_post')

    <div id="postsContainer">
      @include('posts.message.message')

      @foreach($posts as $postNew)

        @include('posts.post_card', ['newPost' => $postNew])

      @endforeach


    </div>
  </main>


  @include('posts.like')
  @include('posts.comments_ajax')
  @include('posts.share')


@endsection