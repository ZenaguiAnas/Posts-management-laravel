<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $posts = Post::all();

        $users = User::all();

        if($posts->count() == 0){
            $this->command->info("please create some posts!");
            return;
        }

        Comment::factory(1000)->make()->each(function($comment) use($posts, $users){ // to make $users defined we have to use it 
            $comment->post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
