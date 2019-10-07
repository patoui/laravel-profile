<?php

namespace Tests\Feature;

use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex() : void
    {
        // Arrange
        $video = factory(Video::class)->state('published')->create();

        // Act
        $response = $this->get(route('video.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($video->title);
    }

    public function testShow() : void
    {
        // Arrange
        $video = factory(Video::class)->state('published')->create();

        // Act
        $response = $this->get(route('video.show', [$video->slug]));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($video->title);
        $response->assertSee('https://www.youtube.com/embed/'.$video->external_id);
    }
}
