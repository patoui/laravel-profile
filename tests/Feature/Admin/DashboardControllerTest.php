<?php

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view the dashboard as an authenticated user
     *
     *
     * @test
     */
    public function index(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user)
            ->get('admin/dashboard')
            ->assertSuccessful();
    }
}
