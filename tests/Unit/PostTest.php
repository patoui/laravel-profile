<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateComment(): void
    {
        User::factory()->me()->create();
        Mail::fake();
        $post = Post::factory()->create([
            'title' => 'My Article\'s Title',
            'body' => 'My Article\'s Body',
            'slug' => 'my-articles-title',
        ]);

        $post->createComment(['body' => 'Awesome article!']);

        self::assertEquals(
            'Awesome article!',
            $post->fresh()->comments()->latest()->first()->body
        );
    }

    public function testScopeSlug(): void
    {
        $post = Post::factory()->create([
            'title' => 'My Article\'s Title',
            'body' => 'My Article\'s Body',
            'slug' => 'my-articles-title',
        ]);

        $exists = app(Post::class)->slug($post->slug)->exists();

        self::assertNotNull($exists);
    }

    public function testGetShortBodyAttribute(): void
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

        self::assertEquals(
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

    public function testGetShortPublishedAtAttribute(): void
    {
        $post = Post::factory()->create([
            'published_at' => '2017-02-02 06:06:06'
        ]);

        self::assertEquals(
            'Thu, Feb 2, 2017 1:06 AM',
            $post->short_published_at
        );
    }

    public function testTogglePublish(): void
    {
        $post = Post::factory()->create();

        $post->togglePublish();

        self::assertNotNull($post->fresh()->published_at);
    }

    public function testScopePublished(): void
    {
        Post::factory(2)->create();
        Post::factory()->published()->create();

        self::assertEquals(
            1,
            app(Post::class)->published()->count()
        );
    }

    public function testPreviousPublished(): void
    {
        $previousPost = Post::factory()->create([
            'published_at' => Carbon::now()->subDay(),
        ]);
        $post = Post::factory()->create([
            'published_at' => Carbon::now(),
        ]);

        $previousPostFound = $post->previousPublished();

        self::assertEquals($previousPost->title, $previousPostFound->title);
    }

    public function testNextPublished(): void
    {
        $post = Post::factory()->create([
            'published_at' => Carbon::now()->subDay(),
        ]);
        $nextPost = Post::factory()->create([
            'published_at' => Carbon::now(),
        ]);

        $nextPostFound = $post->nextPublished();

        self::assertEquals($nextPost->title, $nextPostFound->title);
    }
}
