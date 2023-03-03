@extends('layout')

@section('content')

<form method="POST" action="{{ route('posts.store') }}">
  @csrf
  @method('PUT')
  <div>
    <label for="title">Your title</label>
    <input name="title" id="title" type="text" value="{{ old('title') }}">
  </div>
  <div>
    <label for="content">Your content</label>
    <input name="content" id="content" type="text" value="{{ old('content') }}">
  </div>

  @if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li> 
    @endforeach
  </ul>
  @endif

  <button type="submit">Create post</button>
</form>
    
@endsection