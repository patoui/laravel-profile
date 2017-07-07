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

        $this->browse(function (Browser $browser) use ($post) {
            $instance = $browser->visit('/post/' . $post->id);

            // Ensure post content is displayed on the page
            $instance->assertSee($post->title);
            $instance->assertSee($post->body);
        });
    }
}
