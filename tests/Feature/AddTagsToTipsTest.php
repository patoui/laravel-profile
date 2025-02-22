<?php

namespace Tests\Feature;

use App\Tip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddTagsToTipsTest extends TestCase
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
        self::assertEquals(5, $tip->fresh()->tags()->count());
    }
}
