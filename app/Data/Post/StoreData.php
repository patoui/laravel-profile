<?php

declare(strict_types=1);

namespace App\Data\Post;

use Spatie\LaravelData\Data;

final class StoreData extends Data
{
    public function __construct(
        public string $title,
        public string $body,
        public string $slug,
        public array $tags = [],
    ) {}
}
