<?php

namespace App;

use App\Jobs\ProcessAnalytic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

class Analytic extends Model
{
    /** @var list<string> */
    protected $guarded = [];

    public function analytical(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'analytical_type', 'analytical_id');
    }

    /**
     * @param Request $request
     * @param Model   $model
     */
    public static function process(Request $request, Model $model): void
    {
        ProcessAnalytic::dispatch([
            'headers' => $request->headers->all(),
        ], $model);
    }
}
