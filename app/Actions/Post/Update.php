<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Data\Post\UpdateData;
use App\Repositories\PostRepository;

final class Update
{
    public function __construct(
        private readonly PostRepository $postRepository,
    ) {}

    public function execute(UpdateData $data): void
    {
        $this->postRepository->update($data);
    }
}
