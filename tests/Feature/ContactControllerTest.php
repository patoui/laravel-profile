<?php

namespace Tests\Feature;

use Mail;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactControllerTest extends TestCase
{
    /**
     * Test sending a contact request email
     */
    public function testStore()
    {
        $pendingMail = Mockery::mock('Illuminate\Mail\PendingMail');

        Mail::shouldReceive('to')
            ->andReturn($pendingMail);

        $pendingMail->shouldReceive('send');

        $response = $this->post(
            'contact',
            [
                'name' => 'Patrique Ouimet',
                'email' => 'patrique.ouimet@gmail.com',
                'phone' => '9059220633',
                'message' => 'Hi there, would like you have a chat with you.',
            ]
        );

        $response->assertStatus(302);
    }
}