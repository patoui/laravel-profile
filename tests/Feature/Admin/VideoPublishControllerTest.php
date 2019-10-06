<?php

namespace Tests\Feature\Admin;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoPublishControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShow()
    {
        // Arrange
        $user = factory(User::class)->states('admin')->create();
        $this->actingAs($user);
        $video = factory(Video::class)->create();

        // Act
        $response = $this->get(route('admin.video.publish', [$video->slug]));

        // Assert
        $response->assertRedirect(route('admin.dashboard'));
    }
}
