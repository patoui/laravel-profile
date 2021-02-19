<?php

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessAnalytic;
use App\Post;
use App\Tip;
use App\Video;
use ClickHouseDB\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProcessAnalyticTest extends TestCase
{
    use RefreshDatabase;

    public function testHandlePost(): void
    {
        // Arrange
        /** @var Post $post */
        $post = factory(Post::class)->create();
        $this->mock(Client::class, function ($mock) {
            $mock->shouldReceive('insert')->once();
        });

        // Act
        (new ProcessAnalytic([], $post))->handle();

        // Assert
        self::assertTrue(
            DB::table('analytics')->where([
                'analytical_id'   => $post->id,
                'analytical_type' => get_class($post),
            ])->exists()
        );
    }

    public function testHandleTip(): void
    {
        // Arrange
        /** @var Tip $tip */
        $tip = factory(Tip::class)->create();
        $this->mock(Client::class, function ($mock) {
            $mock->shouldReceive('insert')->once();
        });

        // Act
        (new ProcessAnalytic([], $tip))->handle();

        // Assert
        self::assertTrue(
            DB::table('analytics')->where([
                'analytical_id'   => $tip->id,
                'analytical_type' => get_class($tip),
            ])->exists()
        );
    }

    public function testHandleVideo(): void
    {
        // Arrange
        /** @var Video $video */
        $video = factory(Video::class)->create();
        $this->mock(Client::class, function ($mock) {
            $mock->shouldReceive('insert')->once();
        });

        // Act
        (new ProcessAnalytic([], $video))->handle();

        // Assert
        self::assertTrue(
            DB::table('analytics')->where([
                'analytical_id'   => $video->id,
                'analytical_type' => get_class($video),
            ])->exists()
        );
    }
}
