<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Data\Post\StoreData;
use App\Repositories\PostRepository;

final class Create
{
    public function __construct(
        private readonly PostRepository $postRepository,
    ) {}

    public function execute(StoreData $data): void
    {
        $this->postRepository->create($data);
    }
}
