<?php

namespace Tests\Feature;

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

    /**
     * @test
     */
    public function show(): void
    {
        // Arrange
        Bus::fake();
        User::factory()->me()->create();
        Mail::fake();
        Post::factory()->create([
            'title' => 'First Title',
            'body' => 'First Body',
            'slug' => 'first-title',
            'published_at' => Carbon::now()->subDays(2),
        ]);
        /** @var Post $post */
        $post = Post::factory()->create([
            'title' => 'Second Title',
            'body' => 'Second Body',
            'slug' => 'second-title',
            'published_at' => Carbon::now()->subDay(),
        ]);
        Post::factory()->create([
            'title' => 'Third Title',
            'body' => 'Third Body',
            'slug' => 'third-title',
            'published_at' => Carbon::now(),
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
            ->assertSee('Third Title');

        // Assert
        Bus::assertDispatched(ProcessAnalytic::class);
    }
}
