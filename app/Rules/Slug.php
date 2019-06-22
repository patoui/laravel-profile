<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Slug implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
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
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid slug.';
    }
}
