<div>
  <label for="title">Your title</label>
  <input name="title" id="title" type="text" value="{{ old('title', $post->title ?? null) }}">
</div>
<div>
  <label for="content">Your content</label>
  <input name="content" id="content" type="text" value="{{ old('content', $post->content ?? null) }}">
</div>

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
    <li>{{$error}}</li> 
  @endforeach
</ul>
@endif