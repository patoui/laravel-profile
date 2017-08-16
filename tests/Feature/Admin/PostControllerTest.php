<?php

namespace Tests\Feature\Admin;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view the post create page as an authenticated user
     */
    public function testCreate()
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
     */
    public function testPost()
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->post(
            'admin/post',
            [
                'title' => 'My New Post Title',
                'body' => 'My New Post Body',
                'slug' => 'my-new-post-body',
            ]
        );

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('admin/dashboard');

        // Assert model was created
        $this->assertNotNull(
            app(Post::class)->where('title', 'My New Post Title')->first()
        );
    }

    /**
     * Test to view the post edit page as an authenticated user
     */
    public function testEdit()
    {
        // Arrange
        $this->auth();
        $post = factory(Post::class)->create();

        // Act
        $response = $this->get('admin/post/' . $post->id . '/edit');

        // Assert
        $response->assertStatus(200);
    }

    /**
     * Test to update a post as an authenticated user
     */
    public function testUpdate()
    {
        // Arrange
        $this->auth();
        $post = factory(Post::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        // Act
        $response = $this->put(
            'admin/post/' . $post->id,
            [
                'title' => 'Second Title',
                'body' => 'Second Body',
                'slug' => 'second-title',
            ]
        );

        // Assert
        $response->assertStatus(302);

        // Assert title was updated
        $this->assertEquals(
            'Second Title',
            $post->fresh()->title
        );

        // Assert body was updated
        $this->assertEquals(
            'Second Body',
            $post->fresh()->body
        );

        // Assert slug was updated
        $this->assertEquals(
            'second-title',
            $post->fresh()->slug
        );
    }

    /**
     * Helper method to setup authenticated user
     */
    private function auth()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
    }
}
