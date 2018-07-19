<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserCanViewTheirProfile()
    {
        // Arrange
        $user = factory(User::class)->create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
        $this->actingAs($user);
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'body' => 'This is my awesome comment',
        ]);

        // Act
        $response = $this->get("/profile/{$user->email}");

        // Assert
        $response->assertSuccessful();
        $response->assertSee('John Doe');
        $response->assertSee('john.doe@example.com');
        $response->assertSee('This is my awesome comment');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserCannotViewOthersProfile()
    {
        // Arrange
        $user = factory(User::class)->create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ]);
        $other = factory(User::class)->create([
            'name' => 'Bob Smith',
            'email' => 'bob.smith@example.com',
        ]);
        $this->actingAs($user);
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'body' => 'This is my awesome comment',
        ]);

        // Assert
        $this->expectException(AuthorizationException::class);

        // Act
        $response = $this->get("/profile/{$other->email}");
    }
}
