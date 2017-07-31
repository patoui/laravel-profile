<?php

namespace Tests\Browser;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class EditAndUpdatePostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Testing edit and update a post.
     *
     * @group acceptance
     * @return void
     */
    public function testEditAndUpdate()
    {
        $user = factory(User::class)->create([
            'email' => 'patrique.ouimet@gmail.com',
        ]);

        $post = factory(Post::class)->create([
            'title' => 'My Post Title',
            'body' => 'My Post Content',
        ]);

        $this->browse(function ($browser) use ($user, $post) {
                $browser->loginAs($user)
                    ->visit('/admin/post/' . $post->id . '/edit')
                    ->type('title', 'My Post Title Updated')
                    ->press('Submit')
                    ->assertPathIs('/admin/dashboard')
                    ->assertSee('My Post Title Updated');
        });
    }
}
