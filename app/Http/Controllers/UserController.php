<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
         {
             $this->middleware('auth');
     
             $this->authorizeResource(User::class, 'user');
         }

    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // dd($user);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // dd($user);

        return view('users.edit', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, User $user): RedirectResponse
    {
        if($request->hasFile('avatar')) {

            $path = $request->file('avatar')->store('users');

            if($user->image){
                Storage::delete($user->image->path);
                $user->image->path = $path;
                $user->image->save();
            } else {
                $user->image()->save(Image::make(['path' => $path]));
            }

            // $image = new Image(['path' => $path]);
            // $user->image()->save($image);


            return redirect()->back()->with('status', 'This post is updated successfuly!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        //
    }
}
