<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($id){
        $tag = Tag::find($id);
        $posts = $tag->pivot;

        return view('posts.index', [
            'posts' => $tag->posts()->withCount('comments')->with(['user', 'tags'])->get(), 'tab' => 'list'
        ]);
    }
}
