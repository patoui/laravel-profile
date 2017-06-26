<?php

namespace Tests\Browser;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BlogHomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testIndex()
    {
        $blogs = factory(Post::class, 2)->create();

        $this->browse(function (Browser $browser) use ($blogs) {
            $instance = $browser->visit('/blog')
                    ->assertSee('Articles');

            // Ensure articles are displayed on the page
            foreach ($blogs as $blog) {
                $instance->assertSee($blog->title);
            }
        });
    }
}
