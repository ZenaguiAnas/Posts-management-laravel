@extends('layouts.app')

@section('content')


<h1>{{$post->title}}</h1>
<p>{{$post->content}}</p>
<em>{{$post->created_at->diffForHumans()}}</em>

<p> Status: 
  @if ($post->active)
    Enabled
  @else
    Disabled
  @endif
</p>

<h4>Comments</h4>

@forelse($post->comments as $comment)

<p>
  {{$comment->content}}
</p>
<p class="text-muted">
  {{-- <x-updated :date="$comment->created_at" :name="$comment->user->name"></x-updated> --}}
  added {{$comment->updated_at->diffForHumans()}}, by {{$comment->user->name}}
</p>
@empty
<p>No comments yet!</p>
@endforelse
</div>
<div class="col-4">
  {{-- @include('posts.sidebar') --}}
</div>
</div>

@endsection