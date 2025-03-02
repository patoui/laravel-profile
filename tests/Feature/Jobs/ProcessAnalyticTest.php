<?php

declare(strict_types=1);

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessAnalytic;
use App\Post;
use App\Tip;
use App\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

final class ProcessAnalyticTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function handle_post(): void
    {
        // Arrange
        /** @var Post $post */
        $post = Post::factory()->create();

        // Act
        (new ProcessAnalytic([], $post))->handle();

        // Assert
        self::assertTrue(
            DB::table('analytics')->where([
                'analytical_id' => $post->id,
                'analytical_type' => get_class($post),
            ])->exists()
        );
    }

    /**
     * @test
     */
    public function handle_tip(): void
    {
        // Arrange
        /** @var Tip $tip */
        $tip = Tip::factory()->create();

        // Act
        (new ProcessAnalytic([], $tip))->handle();

        // Assert
        self::assertTrue(
            DB::table('analytics')->where([
                'analytical_id' => $tip->id,
                'analytical_type' => get_class($tip),
            ])->exists()
        );
    }

    /**
     * @test
     */
    public function handle_video(): void
    {
        // Arrange
        /** @var Video $video */
        $video = Video::factory()->create();

        // Act
        (new ProcessAnalytic([], $video))->handle();

        // Assert
        self::assertTrue(
            DB::table('analytics')->where([
                'analytical_id' => $video->id,
                'analytical_type' => get_class($video),
            ])->exists()
        );
    }
}
