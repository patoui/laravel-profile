<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegister()
    {
        // Act
        $response = $this->post(
            'register',
            [
                'name' => 'John Doe',
                'email' => 'john.doe@gmail.com',
                'password' => 'testpass',
                'password_confirmation' => 'testpass',
            ]
        );

        // Assert
        $this->assertNotNull(
            User::where('email', 'john.doe@gmail.com')->first()
        );
    }
}
