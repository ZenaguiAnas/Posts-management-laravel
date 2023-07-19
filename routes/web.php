<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', function(){
      return view('welcome');
});


// Route::get('/posts/{id?}/{author?}', 'App\Http\Controllers\HomeController@blog')->name("blog-post");
// Route::get('/home', 'App\Http\Controllers\HomeController@home')->name("home");
Route::get('/about', [HomeController::class, 'about'])->name("about");
Route::get('/secret', [HomeController::class, 'secret'])->name("secret")->middleware('can:secret.page');

Route::get('/posts/archive', [PostController::class, 'archive']);
Route::get('/posts/all', [PostController::class, 'all']);
Route::patch('/posts/{id}/restore', [PostController::class, 'restore']);
Route::delete('/posts/{id}/forcedelete', [PostController::class, 'forcedelete']);

Route::get('/posts/tag/{id}', [PostTagController::class, 'index'])->name('posts.tag.index');

Route::resource('posts.comments', PostCommentController::class)->only(['store']);
Route::resource('/posts', PostController::class);
      // ->middleware("auth");
      // ->only(['index', 'show', 'create', 'store', 'update', 'edit']);
      // ->except(['destroy']);

Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
