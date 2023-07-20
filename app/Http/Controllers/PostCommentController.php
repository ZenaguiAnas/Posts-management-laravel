<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);    
    }

    public function show(Post $post){
        return new CommentResource($post->comments->first());
    }

    public function store(StoreComment $request, Post $post){
        // dd($post);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);

        return redirect()->back();
    }
}
