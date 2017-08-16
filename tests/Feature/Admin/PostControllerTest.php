<?php

namespace Tests\Feature\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view the post create page as an authenticated user
     */
    public function testCreate()
    {
        $this->auth();

        $this->get('admin/post/create')
            ->assertStatus(200);
    }

    private function auth()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
    }
}
