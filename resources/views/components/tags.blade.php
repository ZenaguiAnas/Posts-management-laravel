

@foreach($tags as $tag)
<span class="badge badge-success" style="background-color: darkorange"><a href="{{ route('posts.tag.index', ['id' => $tag->id]) }}">{{$tag->name}}</a></span>
@endforeach