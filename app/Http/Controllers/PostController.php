<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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
        // ! here we recieve the data through the dependecy injection Request 
        // dd($request->all());

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($post->title, '-');
        $post->active = false;
        // dd($title, 'content: ', $content);
        $post->save();
        // $request->Session()->flash('status', 'post was created successfuly!');
        
        // dd('OK');
        // return redirect()->route('posts.show', ['post' => $post->id]);
        return redirect()->route('posts.index')->with('status', 'Category Delete Successfully');
    }

}
