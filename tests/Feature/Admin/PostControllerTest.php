<?php

namespace Tests\Feature\Admin;

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

    private function auth()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
    }
}
