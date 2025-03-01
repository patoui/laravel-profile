<?php

declare(strict_types=1);

namespace App\Builders;

use App\Builders\Traits\Publishes;
use Illuminate\Database\Eloquent\Builder;

final class PostBuilder extends Builder
{
    use Publishes;
}
