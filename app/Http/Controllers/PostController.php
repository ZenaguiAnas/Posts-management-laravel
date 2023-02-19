<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    // : Response
    {
        // dd(Post::all());
        return view('posts.index', [
            'posts' => Post::all()
        ]);
    }
 
    
    public function show(string $id)
    // : Response
    {
        // dd(Post::find($id));
        return view('posts.show', [
            'post' => Post::find($id)
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        // dd($request->all());
        $title = $request->input('title');
        $content = $request->input('content');
        dd($title, 'content: ', $content);
    }

}
