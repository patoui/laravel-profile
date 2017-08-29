<?php

namespace Tests\Browser;

use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCommentControllerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateCommentForPost()
    {
        $post = factory(Post::class)->create([
            'slug' => 'awesome-post',
        ]);

        $this->browse(function (Browser $browser) use($post) {
            $instance = $browser->visit('/post/' . $post->slug);

            // Ensure post content is displayed on the page
            $instance->assertSee($post->title);
            $instance->assertSee($post->body);

            // Create and assert comment creation
            $instance->type('body', 'This is an awesome article!')
                ->press('Submit')
                ->assertPathIs('/post/' . $post->slug)
                ->assertSee('This is an awesome article!');
        });
    }
}
