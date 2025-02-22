<?php

namespace Tests\Feature;

use App\Rules\Slug;
use Exception;
use Tests\TestCase;

class SlugTest extends TestCase
{
    /**
     * @test
     */
    public function it_passes_validation(): void
    {
        $slugRule = new Slug;
        $fail = function (): void {
            $this->fail('Test should have succeeded.');
        };
        $this->expectNotToPerformAssertions();

        $slugRule->validate(
            fake()->word(),
            fake()->regexify('[a-z0-9]{5}-[a-z0-9]{3}'),
            $fail
        );
    }

    /**
     * @test
     */
    public function it_fails_validation(): void
    {
        $slugRule = new Slug;
        $fail = function (): void {
            throw new Exception('Validation failure');
        };
        $this->expectNotToPerformAssertions();

        try {
            $slugRule->validate(
                fake()->word(),
                fake()->regexify('[A-Z]{5}-[A-Z]{3}'),
                $fail
            );
            $this->fail('Test should have succeeded.');
        } catch (Exception) {
            // expected behaviour
        }
    }
}
