<?php

declare(strict_types=1);

namespace App\Interfaces;

use Carbon\CarbonInterface;

interface CanPublish
{
    public function getPublishedAt(): ?CarbonInterface;

    public function setPublishedAt(?CarbonInterface $publishedAt = null): void;
}
