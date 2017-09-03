<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to display the login form
     */
    public function testShowLoginForm()
    {
        $response = $this->get('login');

        $response->assertStatus(200);
    }

    public function testLogin()
    {
        // Arrange
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com',
            'password' => bcrypt('testpass'),
        ]);

        // Act
        $response = $this->post(
            'login',
            [
                'email' => 'patrique.ouimet@gmail.com',
                'password' => 'testpass',
            ]
        );

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('admin/dashboard');
    }

    public function testLoginNotAdmin()
    {
        // Arrange
        $user = factory(User::class)->create([
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('testpass'),
        ]);

        // Act
        $response = $this->post(
            'login',
            [
                'email' => 'john.doe@gmail.com',
                'password' => 'testpass',
            ]
        );

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('/');
    }

    public function testLogout()
    {
        // Arrange
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com',
            'password' => bcrypt('testpass'),
        ]);

        // Act
        $response = $this->actingAs($user)->get('logout');

        // Assert
        $response->assertStatus(302)
            ->assertRedirect('/');
    }
}
