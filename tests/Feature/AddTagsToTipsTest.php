<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Tip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class AddTagsToTipsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_add_tags_to_a_tip(): void
    {
        // Arrange
        $tip = Tip::factory()->published()->create();

        // Act
        $tip->syncTags(['php', 'laravel', 'collection', 'eloquent', 'learning']);

        // Assert
        self::assertSame(5, $tip->fresh()->tags()->count());
    }
}
