@extends('layout')

@section('content')

  <h1>List of posts</h1>

  <ul class="list-group">
    @foreach ($posts as $post)
    <li class="list-group-item">
      <h2><a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a></h2>
      <p>{{$post->content}}</p>
      <em>{{$post->created_at}}</em>

      @if ($post->comments_count)
        <div>
        <span class="btn btn-success">{{ $post->comments_count }}</span>
        </div>  
      @else
        <div>
          <span class="btn btn-dark">No comments yet !</span>
        </div>  
      @endif

      <a class="btn btn-warning" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>

      <form style="display: inline" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
        @csrf
        @method('DELETE')
              
        <button class="btn btn-danger" type="submit">Delete post</button>
      </form>
      
    </li>  

    @endforeach
  </ul>

@endsection