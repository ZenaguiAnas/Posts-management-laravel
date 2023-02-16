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

Route::get('/posts/{id}/{author?}', function($id, $author = 'author by default'){
    // return $id . ", author $author!";
    $posts = [
        1 => ['title' => 'learn laravel 6'],
        2 => ['title' => 'learn laravel 8'],
    ];
    return view('posts.show', [
        'data' => $posts[$id],
        'author' => $author,
    ]);
});

Route::view('/', 'home');

// Route::get('/about', function () {
//     return view('about');
// });

Route::view('/about', 'about');
