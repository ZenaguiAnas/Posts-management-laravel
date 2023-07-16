{{-- @extends('layout')

@section('content') --}}

@extends('layouts.app')

@section('content')

  <nav class="nav nav-tabs nav-stacked my-5">
    <a class="nav-link @if($tab == 'list') active @endif" href="/posts">List</a>
    <a class="nav-link @if($tab == 'archive') active @endif" href="/posts/archive">Archive</a>
    <a class="nav-link @if($tab == 'all') active @endif" href="/posts/all">All</a>
  </nav>

  <div class="my-3">
    <h4>{{$posts->count()}} post(s)</h4>
  </div>

  <h1>List of posts</h1>

  <ul class="list-group">
    @foreach ($posts as $post)

    {{-- @if($post->image)
    <img src="{{$post->image->url()}}" class="mt-3 img-fluid rounded" alt="">
    @endif --}}

    <img src="{{Storage::url($post->image->path ?? null)}}" class="img-fluid rounded" alt="">

    <li class="list-group-item">
      <h2><a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a></h2>
      <p>{{$post->content}}</p>
      <em>{{$post->created_at}}</em>


      {{-- @include('comments.form') --}}

      <div>
      <x-tags :tags="$post->tags"></x-tags>
      </div>

      @if ($post->comments_count)
        <div>
        <span class="btn btn-success">{{ $post->comments_count }}</span>
        </div>  
      @else
        <div>
          <span class="btn btn-dark">No comments yet !</span>
        </div>  
      @endif  

      <p class="text-muted">
        {{ $post->updated_at->diffForHumans() }}, by {{ $post->user->name }}
      </p>

      @auth
      @can("update", $post)
      <a class="btn btn-warning" href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
      @endcan

      @if(!$post->deleted_at)
        @can("delete", $post)
        <form style="display: inline" method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
          @csrf
          @method('DELETE')
                
          <button class="btn btn-danger" type="submit">Delete post</button>
        </form>
        @endcan
      @else
        @can("restore", $post)
        <form style="display: inline" method="POST" action="{{ url('/posts/'.$post->id.'/restore') }}">
          @csrf
          @method('PATCH')
          <button class="btn btn-success" type="submit">Restore</button>
        </form>
        @endcan

        @can("forceDelete", $post)
        <form style="display: inline" method="POST" action="{{ url('/posts/'.$post->id.'/forcedelete') }}">
          @csrf
          @method('DELETE')
                
          <button class="btn btn-danger" type="submit">Delete Definitly</button>
        </form>
        @endcan
      @endif
      @endauth
      
      
    </li>  

    @endforeach
  </ul>

@endsection