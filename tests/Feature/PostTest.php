<?php

namespace Tests\Feature;

use App\Models\posts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private function createDummyBlogPost()
    {        
        $post = posts::factory()->newTitle()->create();

        return $post;

}

    // public function testPostWhenEmpty()
    // {
    //     $response = $this->get('/posts');

    //     $response->assertSee('no posts yet');
    // }

    public function testPostWhenThereArePosts()
    {
        $post = $this->createDummyBlogPost();


        $response = $this->get('/posts');

        $response->assertSee('new title');
    }

    public function testPostStore()
    {
        $post= [
            "title" => "this is title",
            "content" => "this is content"
        ];


        $this->post('/posts',$post)->assertStatus(302)->assertSessionHas('status');
        // $this->assertEquals('status','posts created succesfully!');
    }

    public function testPostFailForValidation()
    {
        $post= [
            "title" => "t",
            "content" => "t"
        ];


        $this->post('/posts',$post)->assertStatus(302)->assertSessionHas('errors');
        
        $message = session('errors')->getMessages();
        $this->assertEquals($message['title'][0],'The title must be at least 5 characters.');
        $this->assertEquals($message['content'][0],'The content must be at least 5 characters.');
    }

    // public function testUpdateValid()
    // {
    //     $post = $this->createDummyBlogPost();

    //     $this->assertDatabaseHas('posts', $post->toArray());

    //     $params = [
    //         'title' => 'A new named title',
    //         'content' => 'Content was changed'
    //     ];

    //     $this->put("/posts/{$post->id}", $params)
    //         ->assertStatus(302);

    //     //     $this->assertDatabaseMissing('posts', $post->toArray());
    //     // $this->assertDatabaseHas('posts', [
    //     //     'title' => 'A new named title'
    //     // ]);
    // }

    // // public function testDelete() 
    // // {
    // //     $post = $this->createDummyBlogPost();
    // //     $this->assertDatabaseHas('posts', $post->toArray());

    // //     $this->delete("/posts/{$post->id}")
    // //         ->assertStatus(302);

    // //     $this->assertDatabaseMissing('posts', $post->toArray());
    // // }



}