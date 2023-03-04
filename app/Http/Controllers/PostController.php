<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
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

    public function store(StorePostRequest $request){
        // ! here we recieve the data through the dependecy injection Request 
        // dd($request->all());

        // * DATA VALIDATION BEFORE SENDING TO DB
        // $request->validate([
        //     'title' => 'required|min:4|max:100', // or we can do 'title' => 'bail|required|min:4|max:100', this is means that if  the first condition is not verified so stopt without checking out others
        //     'content' => 'required'
        // ]); 

        $data = $request->only(['title', 'content']);
        $data['slug'] = Str::slug($data['title'], '-');
        $data['active'] = false;

        $post = Post::create($data);

        // $post = new Post();
        // $post->title = $request->input('title');
        // $post->content = $request->input('content');
        // $post->slug = Str::slug($post->title, '-');
        // $post->active = false;
        // // dd($title, 'content: ', $content);
        // $post->save();
        // $request->Session()->flash('status', 'post was created successfuly!');
        
        // dd('OK');
        // return redirect()->route('posts.show', ['post' => $post->id]);
        return redirect()->route('posts.index')->with('status', 'Category created successfully!');
    }

    // Edit method to return the edit view
    public function edit($id){
        $post = Post::findOrFail($id);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    // Update to update the data into the DB based on the edit view
    public function update(StorePostRequest $request, $id){
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($request->input('content', '-'));

        $post->save();

        return redirect()->route('posts.index')->with('status', 'This post is updated successfuly!');
    }

    public function destroy(Request $request, $id){
        //? The first method for deleting an item
        $post = Post::findOrFail($id);
        $post->delete();

        //? The second method for deleting an item
        // Post::destroy($id);

        return redirect()->route('posts.index')->with('status', 'This post is deleted successfuly!');
    }

}
