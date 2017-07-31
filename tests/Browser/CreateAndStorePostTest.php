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
                    ->visit('/admin/post/create')
                    ->type('title', 'My Post Title')
                    ->type('url', 'my-post-title')
                    ->type('body', 'My Post Content')
                    ->press('Submit')
                    ->assertPathIs('/admin/dashboard')
                    ->assertSee('My Post Title');
        });
    }
}
