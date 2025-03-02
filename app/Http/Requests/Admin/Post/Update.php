<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Post;

use App\Data\Post\UpdateData;
use App\Rules\Slug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class Update extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'body' => 'required|string',
            'slug' => [
                'required',
                new Slug,
                Rule::unique('posts', 'slug'),
            ],
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|alpha_num',
        ];
    }

    public function dto(): UpdateData
    {
        return UpdateData::fromRequest($this);
    }
}
