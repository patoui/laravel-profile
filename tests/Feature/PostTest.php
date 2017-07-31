<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testDuplicatedPostUrls()
    {
        factory(Post::class)->create([
            'title' => 'My Article\'s Title',
            'body' => 'My Article\'s Body',
            'url' => 'my-articles-title',
        ]);

        $this->post(
            'admin/post/create',
            [
                'title' => 'My Article\'s Title',
                'body' => 'My Article\'s Other Body',
            ]
        );

        $this->assertStatus(302);
        $this->assertRedirect('admin/dashboard');

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
