<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("about");

Route::get('/posts/archive', 'App\Http\Controllers\PostController@archive');
Route::get('/posts/all', 'App\Http\Controllers\PostController@all');
Route::patch('/posts/{id}/restore', 'App\Http\Controllers\PostController@restore');
Route::delete('/posts/{id}/forcedelete', 'App\Http\Controllers\PostController@forcedelete');

Route::resource('/posts', 'App\Http\Controllers\PostController');
      // ->middleware("auth");
      // ->only(['index', 'show', 'create', 'store', 'update', 'edit']);
      // ->except(['destroy']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
