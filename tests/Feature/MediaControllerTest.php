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

    /**
     * View files in media library
     *
     * @return void
     */
    public function testIndex()
    {
        // Arrange
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com'
        ]);
        Storage::fake('media');
        $image = UploadedFile::fake()->image('test.png', 100, 100)->size(100);
        $user->addMedia($image)
           ->preservingOriginal()
           ->toMediaCollection();

        // Act
        $response = $this->actingAs($user)
            ->get('/admin/media');

        // Assert
        $response->assertSuccessful();
        $response->assertSee('test');
        $response->assertSee('test.png');
        Storage::disk('media')->assertExists('1/test.png');
    }

    /**
     * View to upload new files
     *
     * @return void
     */
    public function testCreate()
    {
        // Arrange
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com'
        ]);

        // Act
        $response = $this->actingAs($user)
            ->get('/admin/media/create');

        // Assert
        $response->assertSuccessful();
        $response->assertSee('Add Media');
    }

    /**
     * Upload the file to the media library
     *
     * @return void
     */
    public function testStore()
    {
        // Arrange
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com'
        ]);
        Storage::fake('media');
        $image = UploadedFile::fake()->image('upload-test.png', 100, 100)->size(100);

        // Act
        $response = $this->actingAs($user)
            ->post('/admin/media', ['media' => $image]);

        // Assert
        $response->assertRedirect('/admin/media');
        Storage::disk('media')->assertExists('1/upload-test.png');
    }
}
