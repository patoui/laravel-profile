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
    public function testStore()
    {
        $post = factory(Post::class)->states(['published'])->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('post/' . $post->slug);

        $response->assertStatus(302);
        $response->assertRedirect('post/' . $post->slug);

        $this->assertCount(1, $user->fresh()->favourites);
    }
}
