<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Slug implements ValidationRule
{
    /**
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove all non-alphanumeric excluding hyphens
        $slug = (string) preg_replace(
            '/[^a-z0-9\-]/',
            '',
            $value
        );

        // Replace spaces with hyphens
        $slug = str_replace(' ', '-', $slug);

        if ($value !== $slug) {
            $fail('The :attribute must be a valid slug.');
        }
    }
}
