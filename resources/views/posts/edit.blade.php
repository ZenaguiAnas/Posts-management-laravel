@extends('layout')

@section('content')

<form method="POST" action="{{ route('posts.store', ['post' => $post->id]) }}">
  @csrf
  @method('PUT')
  
  @include('posts.form')

  <button type="submit">Update post</button>
</form>
    
@endsection