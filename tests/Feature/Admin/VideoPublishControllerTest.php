<?php

namespace Tests\Feature\Admin;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoPublishControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShow(): void
    {
        // Arrange
        $user = User::factory()->admin()->create();
        $this->actingAs($user);
        $video = Video::factory()->create();

        // Act
        $response = $this->get(route('admin.video.publish', [$video->slug]));

        // Assert
        $response->assertRedirect(route('admin.dashboard'));
    }
}
