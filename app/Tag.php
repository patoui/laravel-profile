<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Tag extends Model
{
    /** @var list<string> */
    protected $guarded = [];
}
