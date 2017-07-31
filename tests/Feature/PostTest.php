<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function testDuplicatedPostUrls()
    {
        factory(Post::class)->create([
            'title' => 'My Article\'s Title',
            'body' => 'My Article\'s Body',
            'url' => 'my-articles-title',
        ]);

        $this->post(
            'post/create',
            [
                'title' => 'My Article\'s Title',
                'body' => 'My Article\'s Other Body',
            ]
        );

        $this->assertEquals(
            'my-articles-title',
            Post::oldest()->first()->url
        );

        $this->assertEquals(
            'my-articles-title-2',
            Post::latest()->first()->url
        );
    }
}
