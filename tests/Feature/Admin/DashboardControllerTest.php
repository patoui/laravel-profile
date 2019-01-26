<?php

namespace Tests\Feature\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view the dashboard as an authenticated user
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get('admin/dashboard')
            ->assertSuccessful();
    }
}
