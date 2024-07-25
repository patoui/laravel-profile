<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostFavouriteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if post was favourited
     *
     * @return void
     */
    // public function testStore(): void
    // {
    //     $post = Post::factory()->published()->create();
    //     $user = User::factory()->create();
    //     $this->actingAs($user);

    //     $response = $this->post('post/' . $post->slug);

    //     $response->assertStatus(302);
    //     $response->assertRedirect('post/' . $post->slug);

    //     self::assertCount(1, $user->fresh()->favourites);
    // }
}
