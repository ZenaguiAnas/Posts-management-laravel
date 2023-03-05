<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class PostTest extends TestCase
{
    
    use RefreshDatabase;

    public function testSavePost(): void
    {
        $post = new Post();
        $post->title = "new Title to test";
        $post->slug = Str::slug($post->title, '-');
        $post->content = "new Content";
        $post->active = false;

        $post->save();

        $this->assertDatabaseHas('posts', [
            'title' => 'new Title to test'
        ]);

        // $this->assertDatabaseMissing('posts', [ // means if this item is not created in DB that's OK
        //     'title' => 'new Title to test'
        // ]);
    }

    public function testPostStoreValid(){
        $data = [
            "title" => "test our store post",
            "slug" => Str::slug("test our store post", '-'),
            "content" => "Store content",
            "active" => false,
        ];

        $this->post('/posts', $data)
             ->assertStatus(302)
             ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Category created successfully!');
    }
    
}
