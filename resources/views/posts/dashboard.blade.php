@extends('layouts.app')


@section('content')

    @include('layouts.sidebar')
  

  @include('posts.like')
  @include('posts.comments_ajax')
  @include('posts.share')


@endsection