<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    // : Response
    {


        // $posts = Post::withCount('comments')->get();


        // ! v2 : To reduce the number of the queries and to perform the application
        // $posts = Post::withCount('comments')->with('user')->get();

        // ! v3 : Using a cache
        $posts = Cache::remember("posts", now()->addSeconds(10), function(){
            return Post::withCount('comments')->with(['user', 'tags'])->get();
        });


        // DB::connection()->enableQueryLog();
        
        // $posts = Post::all();

        // foreach($posts as $post){
        //     foreach($post->comments() as $comment){

        //     }
        // }

        // dd(DB::getQueryLog());

        // dd(Post::all());

        // return view('posts.index', [
        //     'posts' => Post::all()
        // ]);

        return view('posts.index', [
            'posts' => $posts, 'tab' => 'list'
        ]);
    }


    public function archive()
    {


        return view('posts.index', [
            'posts' => Post::onlyTrashed()->withCount('comments')->get(), 'tab' => 'archive'
        ]);
    }

    public function all()
    {

        return view('posts.index', [
            'posts' => Post::withTrashed()->withCount('comments')->get(), 'tab' => 'all'
        ]);
    }
 
    
    public function show(string $id)
    // : Response
    {
        // dd(Post::find($id));
        
        $post = Cache::remember("post-show-{$id}", 60, function() use($id){
            return Post::with(['comments', 'tags', 'comments.user'])->find($id);
        });

        return view('posts.show', [
            'post' => $post
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

        // dd($request->user()->id);



        // $data = $request->only(['title', 'content']);
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
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

        // if(Gate::denies("post.update", $post)){
        //     abort(403, "You are unauthorized !");
        // }

        // *
        $this->authorize("update", $post);
        
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    // Update to update the data into the DB based on the edit view
    public function update(StorePostRequest $request, $id){
        $post = Post::findOrFail($id);


        // if(Gate::denies("post.update", $post)){
        //     abort(403, "You are unauthorized !");
        // }

        // *
        $this->authorize("update", $post);


        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($request->input('content', '-'));

        $post->save();

        return redirect()->route('posts.index')->with('status', 'This post is updated successfuly!');
    }

    public function destroy(Request $request, $id){
        //? The first method for deleting an item
        $post = Post::findOrFail($id);

        $this->authorize("delete", $post);

        $post->delete();

        //? The second method for deleting an item
        // Post::destroy($id);

        return redirect()->route('posts.index')->with('status', 'This post is deleted successfuly!');
    }

    public function restore($id){
        // dd($id);
        
        // $post = Post::find($id); => doesn't work with trashed posts
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->restore();


        return redirect()->back();
    }

    public function forcedelete($id){
        // dd($id);
        
        // $post = Post::find($id); => doesn't work with trashed posts
        $post = Post::onlyTrashed()->where('id', $id)->first();

        $post->forceDelete();

        return redirect()->back();
    }

}
