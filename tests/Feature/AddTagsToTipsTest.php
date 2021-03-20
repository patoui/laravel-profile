<?php

namespace Tests\Feature;

use App\Tip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddTagsToTipsTest extends TestCase
{
    use RefreshDatabase;

    public function testCanAddTagsToATip(): void
    {
        self::markTestSkipped('Need to enable JSON1 extension for tags');

        // Arrange
        $tip = Tip::factory()->published()->create();

        // Act
        $tip->syncTags(['php', 'laravel', 'collection', 'eloquent', 'learning']);

        // Assert
        self::assertEquals(5, $tip->fresh()->tags()->count());
    }
}
