<?php

namespace Tests\Feature;

use App\Tip;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TipFavouriteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if tip was favourited
     *
     * @return void
     */
    public function testStore()
    {
        $tip = factory(Tip::class)->states(['published'])->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('tip/' . $tip->slug);

        $response->assertStatus(302);
        $response->assertRedirect('tip/' . $tip->slug);

        $this->assertCount(1, $user->fresh()->favourites);
    }
}
