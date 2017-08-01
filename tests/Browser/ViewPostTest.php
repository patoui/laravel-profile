<?php

namespace Tests\Browser;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewPostTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testShow()
    {
        $post = factory(Post::class)->create();
        $comment = $post->createComment([
            'body' => 'Awesome! Hope to see more of this!'
        ]);

        $this->browse(function (Browser $browser) use ($post, $comment) {
            $instance = $browser->visit('/post/' . $post->slug);

            // Ensure post content is displayed on the page
            $instance->assertSee($post->title);
            $instance->assertSee($post->body);
            $instance->assertSee($comment->body);
        });
    }
}
