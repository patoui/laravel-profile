<?php

namespace Tests\Feature;

use App\Subscription;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to store a subscription
     */
    // public function testStore(): void
    // {
    //     // Act
    //     $response = $this->post(
    //         'subscription',
    //         ['subscription_email' => 'patrique.ouimet@gmail.com']
    //     );

    //     // Assert
    //     $response->assertStatus(302)->assertRedirect('/');

    //     self::assertNotNull(
    //         Subscription::where('email', 'patrique.ouimet@gmail.com')->first()
    //     );
    // }
}
