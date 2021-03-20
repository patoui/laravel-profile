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
        $video = Video::factory()->published()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('video.favourite.store', [$video->slug]));

        $response->assertStatus(302);
        $response->assertRedirect(route('video.show', [$video->slug]));

        self::assertCount(1, $user->fresh()->favourites);
    }
}
