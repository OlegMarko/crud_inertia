<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_post_can_be_created()
    {
        $post = Post::factory()->create([
            'title' => 'Test Post',
            'content' => 'This is a test post content.'
        ]);

        $this->assertModelExists($post);
    }

    /** @test */
    public function test_post_can_be_deleted()
    {
        $post = Post::factory()->create();

        $post->delete();

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
