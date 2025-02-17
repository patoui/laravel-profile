<?php

namespace Tests\Feature;

use App\Jobs\ProcessAnalytic;
use App\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index(): void
    {
        // Arrange
        $video = Video::factory()->published()->create();

        // Act
        $response = $this->get(route('video.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($video->title);
    }

    /**
     * @test
     */
    public function show(): void
    {
        // Arrange
        Bus::fake();
        /** @var Video $video */
        $video = Video::factory()->published()->create();

        // Act
        $response = $this->get(route('video.show', [$video->slug]));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($video->title);
        $response->assertSee('https://www.youtube.com/embed/' . $video->external_id);
        Bus::assertDispatched(ProcessAnalytic::class);
    }
}
