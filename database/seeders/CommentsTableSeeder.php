<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
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

        Comment::factory(1000)->make()->each(function($comment) use($posts){ // to make $users defined we have to use it 
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
