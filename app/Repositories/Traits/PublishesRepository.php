<?php

declare(strict_types=1);

namespace App\Repositories\Traits;

use App\Interfaces\CanPublish;
use Illuminate\Database\Eloquent\Model;

trait PublishesRepository
{
    public function togglePublish(CanPublish&Model $publishable): void
    {
        $publishable->setPublishedAt($publishable->getPublishedAt() ? null : now());
        $publishable->save();
    }
}
