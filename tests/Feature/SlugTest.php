<?php

namespace Tests\Feature;

use App\Rules\Slug;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SlugTest extends TestCase
{
    public function testMessage()
    {
        $slugRule = app(Slug::class);

        $this->assertEquals(
            'The :attribute must be a valid slug.',
            $slugRule->message()
        );
    }
}
