<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function secret(){
        return view('secret');
    }
    
    
    public function dashboard()
    {
        // dd(Auth::id());
        // dd(Auth::user()->email);
        // dd(Auth::check());
        return view('dashboard');
    }
}
