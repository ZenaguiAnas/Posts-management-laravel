@extends('layout')

@section('content')

  <h1>List of posts</h1>

  <ul>
    @foreach ($posts as $post)
    <li>
      <h2><a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a></h2>
      <p>{{$post->content}}</p>
      <em>{{$post->created_at}}</em>
      <a href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
    </li>  
    @endforeach
  </ul>

@endsection