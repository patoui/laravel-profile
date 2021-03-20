<?php

namespace Tests\Feature\Admin;

use App\Activity;
use App\Tip;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TipControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view the tip create page as an authenticated user
     */
    public function testCreate(): void
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->get('admin/tip/create');

        // Assert
        $response->assertStatus(200);
    }

    /**
     * Test to store a tip as an authenticated user
     */
    public function testStore(): void
    {
        // Arrange
        $this->auth();

        // Act
        $response = $this->post('admin/tip', [
            'title' => 'My New Tip Title',
            'body' => 'My New Tip Body',
            'slug' => 'my-new-tip-body',
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        $tip = app(Tip::class)->where('title', 'My New Tip Title')->first();
        self::assertNotNull($tip);
        self::assertNotNull(
            app(Activity::class)->where([
                'type' => 'created_tip',
                'subject_id' => $tip->id,
                'subject_type' => get_class($tip),
            ])->first()
        );
        self::assertEquals('My New Tip Title', $tip->fresh()->title);
        self::assertEquals('My New Tip Body', $tip->fresh()->body);
        self::assertEquals('my-new-tip-body', $tip->fresh()->slug);
    }

    /**
     * Test to view the tip edit page as an authenticated user
     */
    public function testEdit(): void
    {
        // Arrange
        $this->auth();
        $tip = Tip::factory()->create();

        // Act
        $response = $this->get('admin/tip/' . $tip->id . '/edit');

        // Assert
        $response->assertStatus(200);
    }

    /**
     * Test to update a tip as an authenticated user
     */
    public function testUpdate(): void
    {
        // Arrange
        $this->auth();
        $tip = Tip::factory()->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        // Act
        $response = $this->put("admin/tip/{$tip->id}", [
            'title' => 'Second Title',
            'body' => 'Second Body',
            'slug' => 'second-title',
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        self::assertEquals('Second Title', $tip->fresh()->title);
        self::assertEquals('Second Body', $tip->fresh()->body);
        self::assertEquals('second-title', $tip->fresh()->slug);
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
