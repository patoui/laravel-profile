<?php

namespace Tests\Unit;

use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateComment()
    {
        $post = factory(Post::class)->create([
            'title' => 'My Article\'s Title',
            'body' => 'My Article\'s Body',
            'slug' => 'my-articles-title',
        ]);

        $post->createComment(['body' => 'Awesome article!']);

        $this->assertEquals(
            'Awesome article!',
            $post->fresh()->comments()->latest()->first()->body
        );
    }

    public function testFindOrFailBySlug()
    {
        $post = factory(Post::class)->create([
            'title' => 'My Article\'s Title',
            'body' => 'My Article\'s Body',
            'slug' => 'my-articles-title',
        ]);

        $exists = app(Post::class)->findOrFailBySlug($post->slug);

        $this->assertNotNull($exists);
    }

    public function testFindOrFailBySlugFail()
    {
        try {
            $exists = app(Post::class)->findOrFailBySlug('my-articles-title');
        } catch (ModelNotFoundException $e) {
            return;
        }

        $this->fail('Model should throw exception \'ModelNotFoundException\'');
    }

    public function testGetShortBodyAttribute()
    {
        $post = factory(Post::class)->create([
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

        $this->assertEquals(
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

    public function testGetShortPublishedAtAttribute()
    {
        $post = factory(Post::class)->create([
            'published_at' => '2017-02-02 06:06:06'
        ]);

        $this->assertEquals(
            'February 2nd 1:06 AM',
            $post->short_published_at
        );
    }

    public function testTogglePublish()
    {
        $post = factory(Post::class)->create(['published_at' => null]);

        $post->togglePublish();

        $this->assertNotNull($post->fresh()->published_at);
    }

    public function testScopePublished()
    {
        factory(Post::class, 2)->create(['published_at' => null]);
        factory(Post::class)->create(['published_at' => Carbon::yesterday()]);

        $this->assertEquals(
            1,
            app(Post::class)->published()->count()
        );
    }
}
