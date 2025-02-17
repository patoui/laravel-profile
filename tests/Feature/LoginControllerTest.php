<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to display the login form
     *
     * @test
     */
    public function show_login_form(): void
    {
        $this->get('login')->assertStatus(200);
    }

    /**
     * @test
     */
    public function login(): void
    {
        // Arrange
        User::factory()->create([
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

    /**
     * @test
     */
    public function login_not_admin(): void
    {
        // Arrange
        User::factory()->create([
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

    /**
     * @test
     */
    public function logout(): void
    {
        // Arrange
        $user = User::factory()->create([
            'email' => 'patrique.ouimet@gmail.com',
            'password' => bcrypt('testpass'),
        ]);

        // Act
        $response = $this->actingAs($user)->get('logout');

        // Assert
        $response->assertStatus(302)->assertRedirect('/');
    }
}
