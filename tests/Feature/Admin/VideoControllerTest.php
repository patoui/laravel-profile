<?php

namespace Tests\Feature\Admin;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->get(route('admin.video.create'));

        // Assert
        $response->assertStatus(200);
    }

    public function testStore()
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->post(route('admin.video.store'), [
            'title' => 'My New Video Title',
            'slug' => 'my-new-video-body',
            'external_id' => uniqid(true),
            'tags' => ['one', 'two', 'three'],
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        $video = app(Video::class)->where('title', 'My New Video Title')->first();
        $this->assertNotNull($video);
        $this->assertEquals('My New Video Title', $video->fresh()->title);
        $this->assertEquals('my-new-video-body', $video->fresh()->slug);
        $this->assertEquals(3, $video->tags()->count());
    }

    public function testEdit()
    {
        // Arrange
        $this->auth();
        $video = factory(Video::class)->create();

        // Act
        $response = $this->get(route('admin.video.edit', [$video->slug]));

        // Assert
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        // Arrange
        $this->auth();
        $video = factory(Video::class)->create([
            'title' => 'First Title',
            'slug' => 'first-title',
            'external_id' => uniqid(true),
        ]);

        // Act
        $response = $this->put(route('admin.video.update', [$video->slug]), [
            'title' => 'Second Title',
            'slug' => 'second-title',
            'external_id' => uniqid(true),
            'tags' => ['one', 'two', 'three'],
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        $this->assertEquals('Second Title', $video->fresh()->title);
        $this->assertEquals('second-title', $video->fresh()->slug);
        $this->assertEquals(3, $video->tags()->count());
    }

    /**
     * Helper method to setup authenticated user
     */
    private function auth()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user);
    }
}
