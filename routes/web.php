<?php

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

Route::get('/posts/{id?}/{author?}', 'App\Http\Controllers\HomeController@blog')->name("blog-post");
Route::get('/home', 'App\Http\Controllers\HomeController@home')->name("home");
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("about");
