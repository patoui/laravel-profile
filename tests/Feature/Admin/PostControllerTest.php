<?php

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view the post create page as an authenticated user
     *
     * @test
     */
    public function create(): void
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->get('admin/post/create');

        // Assert
        $response->assertStatus(200);
    }

    /**
     * Test to store a post as an authenticated user
     *
     * @test
     */
    public function store(): void
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->post('admin/post', [
            'title' => 'My New Post Title',
            'body' => 'My New Post Body',
            'slug' => 'my-new-post-body',
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('admin/dashboard');

        // Assert model was created
        /** @var Post $post */
        $post = Post::where('title', 'My New Post Title')->first();
        self::assertNotNull($post);
    }

    /**
     * Test to view the post edit page as an authenticated user
     *
     * @test
     */
    public function edit(): void
    {
        // Arrange
        $this->auth();
        $post = Post::factory()->create();

        // Act
        $response = $this->get(route('admin.post.edit', ['post' => $post->id]));

        // Assert
        $response->assertStatus(200);
    }

    /**
     * Test to update a post as an authenticated user
     *
     * @test
     */
    public function update(): void
    {
        // Arrange
        $this->auth();
        $post = Post::factory()->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        // Act
        $response = $this->put("admin/post/{$post->id}", [
            'title' => 'Second Title',
            'body' => 'Second Body',
            'slug' => 'second-title',
        ]);

        // Assert
        $response->assertStatus(302);

        // Assert title was updated
        $this->assertSame(
            'Second Title',
            $post->fresh()->title
        );

        // Assert body was updated
        $this->assertSame(
            'Second Body',
            $post->fresh()->body
        );

        // Assert slug was updated
        $this->assertSame(
            'second-title',
            $post->fresh()->slug
        );
    }

    /**
     * Helper method to setup authenticated user
     */
    private function auth(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user);
    }
}
