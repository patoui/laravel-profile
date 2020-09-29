<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Analytic extends Model
{
    /** @var array<string> */
    protected $guarded = [];

    public function analytical(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'analytical_type', 'analytical_id');
    }
}
