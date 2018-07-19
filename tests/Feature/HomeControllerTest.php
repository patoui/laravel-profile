<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertDontSee('/profile');
    }

    public function testIndexAuthenticatedUserCanSeeProfileLink()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertSee("/profile/{$user->email}");
    }
}
