<?php

namespace Tests\Feature\Admin;

use App\User;
use App\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create(): void
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->get(route('admin.video.create'));

        // Assert
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store(): void
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->post(route('admin.video.store'), [
            'title' => 'My New Video Title',
            'slug' => 'my-new-video-body',
            'external_id' => uniqid('foo', true),
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        $video = app(Video::class)->where('title', 'My New Video Title')->first();
        $this->assertNotNull($video);
        $this->assertEquals('My New Video Title', $video->fresh()->title);
        $this->assertEquals('my-new-video-body', $video->fresh()->slug);
    }

    /**
     * @test
     */
    public function edit(): void
    {
        // Arrange
        $this->auth();
        $video = Video::factory()->create();

        // Act
        $response = $this->get(route('admin.video.edit', [$video]));

        // Assert
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function update(): void
    {
        // Arrange
        $this->auth();
        $video = Video::factory()->create([
            'title' => 'First Title',
            'slug' => 'first-title',
            'external_id' => uniqid(true),
        ]);

        // Act
        $response = $this->put(route('admin.video.update', [$video->slug]), [
            'title' => 'Second Title',
            'slug' => 'second-title',
            'external_id' => uniqid('foo', true),
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        $this->assertEquals('Second Title', $video->fresh()->title);
        $this->assertEquals('second-title', $video->fresh()->slug);
    }

    /**
     * Helper method to setup authenticated user
     */
    private function auth(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user);
    }
}
