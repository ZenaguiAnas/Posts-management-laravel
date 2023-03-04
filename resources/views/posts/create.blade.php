@extends('layout')

@section('content')

<form method="POST" action="{{ route('posts.store') }}">
  @csrf
  
  @include('posts.form')

  <button type="submit">Create post</button>
</form>
    
@endsection