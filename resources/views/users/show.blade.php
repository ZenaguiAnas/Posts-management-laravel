@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-md-4">
      <h5>User's Avatar</h5>
      <img src="{{$user->image ? $user->image->url() : ''}}" alt="" class="img-thumbnail avatar">
      @can('update', $user)
        <a href="{{route('users.edit', ['user' => $user->id])}}" class="btn btn-info btn-sm">Edit</a>
      @endcan
    </div>
    <div class="col-md-8">
      <h3>{{$user->name}}</h3>
      <x-comment-form :action="route('users.comments.store', ['user' => $user->id])"></x-comment-form>

      <hr>

      @forelse($user->comments as $comment)

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
  </div>
</form>
    
@endsection