<?php

declare(strict_types=1);

namespace App\Traits;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property-read string $short_body
 * @property-read string $path
 */
trait Publishes
{
    public function getPublishedAt(): ?CarbonInterface
    {
        return $this->published_at;
    }

    public function setPublishedAt(?CarbonInterface $publishedAt = null): void
    {
        $this->published_at = $publishedAt;
    }

    public function shortPublishedAt(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->getPublishedAt()) {
                    return null;
                }

                return $this->getPublishedAt()
                    ->setTimezone('America/Toronto')
                    ->toDayDateTimeString();
            }
        );
    }
}
