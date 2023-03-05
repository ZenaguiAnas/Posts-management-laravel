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

    public function testPostStoreFail(){
        $data = [
            "title" => "",
            "content" => ""
        ];

        $this->post('/posts', $data)
             ->assertStatus(302)
             ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        // dd($messages);  // for debugging

        $this->assertEquals($messages['title'][0], 'The title field is required.');
        $this->assertEquals($messages['content'][0], 'The content field is required.');
    }

    public function testPostUpdate(){
        $post = new Post();

        $post->title = "second Title to test";
        $post->slug = Str::slug($post->title, '-');
        $post->content = "new Content";
        $post->active = true;

        $post->save();

        $this->assertDatabaseHas('posts', $post->toArray());

        $data = [
            "title" => "test our post updated",
            "slug" => Str::slug("test our post updated", '-'),
            "content" => "Store content",
            "active" => false,
        ];

        $this->put("/posts/{$post->id}", $data)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertDatabaseHas('posts', [
            'title' => $data['title']
        ]);

        $this->assertDatabaseMissing('posts', [
            'title' => $post->title
        ]);
    }
    
}
