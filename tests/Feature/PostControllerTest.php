<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_be_display_posts()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.index'));

        $response->assertStatus(200)
            ->assertSee($post->title);
    }

    /** @test */
    public function test_can_be_display_create_form()
    {
        $response = $this->get(route('post.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function test_can_be_store_post()
    {
        $data = [
            'title' => 'Test Post',
            'content' => 'This is a test post content.'
        ];

        $response = $this->post(route('post.store'), $data);

        $response->assertRedirect(route('post.index'));

        $this->assertDatabaseHas('posts', $data);
    }

    /** @test */
    public function test_can_be_display_post()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.show', ['post' => $post]));

        $response->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($post->content);
    }

    /** @test */
    public function test_can_be_display_edit_form()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('post.edit', ['post' => $post->id]));

        $response->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($post->content);
    }

    /** @test */
    public function test_can_be_update_post()
    {
        $post = Post::factory()->create();
        $newData = [
            'title' => 'Updated Test Post',
            'content' => 'This is an updated test post content.'
        ];

        $response = $this->put(route('post.update', ['post' => $post->id]), $newData);

        $response->assertRedirect(route('post.show', ['post' => $post]));

        $this->assertDatabaseHas('posts', $newData);
    }

    /** @test */
    public function test_can_be_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('post.delete', ['post' => $post]));

        $response->assertRedirect(route('post.index'));

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
