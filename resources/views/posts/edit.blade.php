@extends('layout')

@section('content')

<h1>Edit Post</h1>
<form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
  @csrf
  @method('PUT')
  
  @include('posts.form')

  <button class="btn btn-block btn-warning" type="submit">Update post</button>
</form>
    
@endsection