<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function about(){
        return view('about');
    }

    public function blog($id = '1', $author = 'author by default'){
        $posts = [
            1 => ['title' => 'learn laravel 6'],
            2 => ['title' => 'learn laravel 8'],
        ];
        return view('posts.show', [
            'data' => $posts[$id],
            'author' => $author,
        ]);
    }
}
