<?php

declare(strict_types=1);

namespace App\Rules;

use function strtolower;
use function str_replace;
use function preg_replace;
use Illuminate\Contracts\Validation\Rule;

class Slug implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed $attribute
     * @param  mixed $value
     */
    public function passes($attribute, $value) : bool
    {
        // Remove all non-alphanumeric excluding hyphens
        $slug = (string) preg_replace(
            '/[^a-zA-Z0-9\-]/',
            '',
            strtolower($value)
        );

        // Replace spaces with hyphens
        $slug = str_replace(' ', '-', $slug);

        return $value === $slug;
    }

    /**
     * Get the validation error message.
     */
    public function message() : string
    {
        return 'The :attribute must be a valid slug.';
    }
}
