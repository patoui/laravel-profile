<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister(): void
    {
        // Act
        $this->post(
            'register',
            [
                'name' => 'John Doe',
                'email' => 'john.doe@gmail.com',
                'password' => 'testpass',
                'password_confirmation' => 'testpass',
            ]
        );

        // Assert
        self::assertNotNull(
            User::where('email', 'john.doe@gmail.com')->first()
        );
    }
}
