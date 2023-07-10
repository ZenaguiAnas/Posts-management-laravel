<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $users = User::all();

        if($users->count() == 0){
            $this->command->info("please create some users!");
            return;
        }

        Post::factory(300)->make()->each(function($post) use($users){ // to make $users defined we have to use it 
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
