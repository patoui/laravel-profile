<?php

namespace Tests\Feature;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoFavouriteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore() : void
    {
        $video = factory(Video::class)->states(['published'])->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post(route('video.favourite.store', [$video->slug]));

        $response->assertStatus(302);
        $response->assertRedirect(route('video.show', [$video->slug]));

        $this->assertCount(1, $user->fresh()->favourites);
    }
}
