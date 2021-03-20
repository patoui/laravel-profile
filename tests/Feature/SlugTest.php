<?php

namespace Tests\Feature;

use App\Rules\Slug;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SlugTest extends TestCase
{
    public function testMessage(): void
    {
        $slugRule = app(Slug::class);

        self::assertEquals(
            'The :attribute must be a valid slug.',
            $slugRule->message()
        );
    }
}
