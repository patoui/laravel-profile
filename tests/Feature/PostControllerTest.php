<?php

namespace Tests\Feature;

use App\Comment;
use App\Favourite;
use App\Jobs\ProcessAnalytic;
use App\Post;
use App\User;
use Carbon\Carbon;
use GitDown\Facades\GitDown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShow(): void
    {
        // Arrange
        Bus::fake();
        factory(User::class)->states('me')->create();
        Mail::fake();
        factory(Post::class)->create([
            'title'        => 'First Title',
            'body'         => 'First Body',
            'slug'         => 'first-title',
            'published_at' => Carbon::now()->subDays(2),
        ]);
        /** @var Post $post */
        $post = factory(Post::class)->create([
            'title'        => 'Second Title',
            'body'         => 'Second Body',
            'slug'         => 'second-title',
            'published_at' => Carbon::now()->subDay(),
        ]);
        factory(Post::class)->create([
            'title'        => 'Third Title',
            'body'         => 'Third Body',
            'slug'         => 'third-title',
            'published_at' => Carbon::now(),
        ]);
        /** @var Comment $comment */
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
            'body'    => 'This is a sweet post!',
        ]);
        factory(Favourite::class)->create([
            'favouritable_id'   => $comment->id,
            'favouritable_type' => get_class($comment),
            'user_id'           => factory(User::class)->create()->id,
        ]);
        GitDown::shouldReceive('parseAndCache')->andReturn($post->body);
        GitDown::shouldReceive('styles')->andReturn(null);

        // Act
        $response = $this->get('post/' . $post->slug);

        // Assert
        $response->assertSuccessful()
                 ->assertSee('Second Title')
                 ->assertSee('Second Body')
                 ->assertSee('First Title')
                 ->assertSee('Third Title')
                 ->assertSee($comment->body);

        // Assert
        Bus::assertDispatched(ProcessAnalytic::class);
    }
}
