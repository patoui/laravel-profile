<?php

namespace Tests\Feature;

use App\Rules\Slug;
use Tests\TestCase;

class SlugTest extends TestCase
{
    /**
     * @test
     */
    public function message(): void
    {
        $slugRule = app(Slug::class);

        self::assertEquals(
            'The :attribute must be a valid slug.',
            $slugRule->message()
        );
    }
}
