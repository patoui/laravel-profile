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
        $this->auth();

        $this->get('admin/post/create')
            ->assertStatus(200);
    }

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
    }

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

    public function testUpdate()
    {
        // Arrange
        $this->auth();
        $post = factory(Post::class)->create([
            'title' => 'First Title'
        ]);

        // Act
        $response = $this->put(
            'admin/post/' . $post->id,
            ['title' => 'Second Title']
        );

        // Assert
        $response->assertStatus(302);

        $this->assertEquals(
            'Second Title',
            $post->fresh()->title
        );
    }

    private function auth()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
    }
}
