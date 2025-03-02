<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function scope_slug(): void
    {
        $post = Post::factory()->create([
            'title' => 'My Article\'s Title',
            'body' => 'My Article\'s Body',
            'slug' => 'my-articles-title',
        ]);

        $exists = app(Post::class)->slug($post->slug)->exists();

        self::assertNotNull($exists);
    }

    /**
     * @test
     */
    public function get_short_body_attribute(): void
    {
        $post = Post::factory()->create([
            'title' => 'My Article\'s Title',
            'body' => '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '<span>1111111111</span>'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '2222222222',
            'slug' => 'my-articles-title',
        ]);

        self::assertSame(
            '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111'
                . '1111111111',
            $post->short_body
        );
    }

    /**
     * @test
     */
    public function get_short_published_at_attribute(): void
    {
        $post = Post::factory()->create([
            'published_at' => '2017-02-02 06:06:06',
        ]);

        self::assertSame(
            'Thu, Feb 2, 2017 1:06 AM',
            $post->short_published_at
        );
    }

    /**
     * @test
     */
    public function scope_published(): void
    {
        Post::factory(2)->create();
        Post::factory()->published()->create();

        self::assertSame(
            1,
            app(Post::class)->published()->count()
        );
    }

    /**
     * @test
     */
    public function previous_published(): void
    {
        $previousPost = Post::factory()->create([
            'published_at' => Carbon::now()->subDay(),
        ]);
        $post = Post::factory()->create([
            'published_at' => Carbon::now(),
        ]);

        $previousPostFound = $post->previousPublished($post);

        self::assertSame($previousPost->title, $previousPostFound->value('title'));
    }

    /**
     * @test
     */
    public function next_published(): void
    {
        $post = Post::factory()->create([
            'published_at' => Carbon::now()->subDay(),
        ]);
        $nextPost = Post::factory()->create([
            'published_at' => Carbon::now(),
        ]);

        $nextPostFound = $post->nextPublished($post);

        self::assertSame($nextPost->title, $nextPostFound->value('title'));
    }
}
