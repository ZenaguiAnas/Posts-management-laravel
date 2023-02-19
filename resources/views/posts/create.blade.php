@extends('layout')

@section('content')

<form method="POST" action="{{ route('posts.store') }}">
  @csrf
  <div>
    <label for="title">Your title</label>
    <input name="title" id="title" type="text">
  </div>
  <div>
    <label for="content">Your content</label>
    <input name="content" id="content" type="text">
  </div>

  @if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li> 
    @endforeach
  </ul>
  @endif

  <button type="submit">Add post</button>
</form>
    
@endsection