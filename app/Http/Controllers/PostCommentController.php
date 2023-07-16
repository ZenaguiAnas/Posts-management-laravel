<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function store(StoreComment $request, Post $post){
        // dd($post);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);

        return redirect()->back();
    }
}
