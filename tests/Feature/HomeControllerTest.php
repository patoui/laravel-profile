<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $this->get('/')->assertSuccessful();
    }

    public function testIndexAuthenticatedUserCanSeeEmail(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/')->assertSuccessful();
    }
}
