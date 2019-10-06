<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Arrange
        $user = factory(User::class)->states('me')->create();
        Storage::fake('media');
        $image = UploadedFile::fake()->image('test.png', 100, 100)->size(100);
        $user->addMedia($image)->preservingOriginal()->toMediaCollection();

        // Act
        $response = $this->actingAs($user)->get('/admin/media');

        // Assert
        $response->assertSuccessful();
        $response->assertSee('test');
        $response->assertSee('test.png');
        Storage::disk('media')->assertExists('1/test.png');
    }

    public function testCreate()
    {
        // Arrange
        $user = factory(User::class)->states('me')->create();

        // Act
        $response = $this->actingAs($user)->get('/admin/media/create');

        // Assert
        $response->assertSuccessful();
    }

    public function testStore()
    {
        Storage::disk('media');

        // Arrange
        $user = factory(User::class)->states('me')->create();
        Storage::fake('media');
        $image = UploadedFile::fake()->image('upload-test.png', 100, 100)->size(100);

        // Act
        $response = $this->actingAs($user)->post('/admin/media', ['media' => $image]);

        // Assert
        $response->assertRedirect('/admin/media');
        Storage::disk('media')->assertExists('1/upload-test.png');
    }
}
