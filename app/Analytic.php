<?php

declare(strict_types=1);

namespace App;

use App\Jobs\ProcessAnalytic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

final class Analytic extends Model
{
    /** @var list<string> */
    protected $guarded = [];

    public static function process(Request $request, Model $model): void
    {
        ProcessAnalytic::dispatch([
            'headers' => $request->headers->all(),
        ], $model);
    }

    public function analytical(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'analytical_type', 'analytical_id');
    }
}
