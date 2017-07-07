<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class CreateAndStorePostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Testing create and store a post.
     *
     * @group acceptance
     * @return void
     */
    public function testCreateAndStore()
    {
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com',
        ]);

        $this->browse(function ($browser) use ($user) {
                $browser->loginAs($user)
                    ->visit('/post/create')
                    ->type('title', 'My Post Title')
                    ->type('body', 'My Post Content')
                    ->press('Create')
                    ->assertPathIs('/dashboard')
                    ->assertSee('My Post Title');
        });
    }
}