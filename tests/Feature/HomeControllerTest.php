<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index(): void
    {
        $this->get('/')->assertSuccessful();
    }

    /**
     * @test
     */
    public function index_authenticated_user_can_see_email(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/')->assertSuccessful();
    }
}
