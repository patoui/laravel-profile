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
    public function testCreate()
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
    public function testStore()
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
        $this->assertNotNull($tip);
        $this->assertNotNull(
            app(Activity::class)->where([
                'type' => 'created_tip',
                'subject_id' => $tip->id,
                'subject_type' => get_class($tip),
            ])->first()
        );
        $this->assertEquals('My New Tip Title', $tip->fresh()->title);
        $this->assertEquals('My New Tip Body', $tip->fresh()->body);
        $this->assertEquals('my-new-tip-body', $tip->fresh()->slug);
    }

    /**
     * Test to view the tip edit page as an authenticated user
     */
    public function testEdit()
    {
        // Arrange
        $this->auth();
        $tip = factory(Tip::class)->create();

        // Act
        $response = $this->get('admin/tip/' . $tip->slug . '/edit');

        // Assert
        $response->assertStatus(200);
    }

    /**
     * Test to update a tip as an authenticated user
     */
    public function testUpdate()
    {
        // Arrange
        $this->auth();
        $tip = factory(Tip::class)->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
        ]);

        // Act
        $response = $this->put("admin/tip/{$tip->slug}", [
            'title' => 'Second Title',
            'body' => 'Second Body',
            'slug' => 'second-title',
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        $this->assertEquals('Second Title', $tip->fresh()->title);
        $this->assertEquals('Second Body', $tip->fresh()->body);
        $this->assertEquals('second-title', $tip->fresh()->slug);
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
