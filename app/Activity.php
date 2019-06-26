<?php

declare(strict_types=1);

namespace App;

use function ucwords;
use function data_get;
use function is_string;
use function str_replace;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    /** @var array<string> */
    protected $guarded = [];

    public function subject() : MorphTo
    {
        return $this->morphTo();
    }

    public function getHumanTypeAttribute() : string
    {
        $type = str_replace('_', ' ', $this->type);
        $type = is_string($type) ? $type : '';

        return ucwords($type);
    }

    public function getShortContentAttribute() : string
    {
        return Str::limit(data_get($this, 'subject.body', ''), 50);
    }

    public function getShortCreatedAtAttribute() : ?string
    {
        return $this->created_at
            ? $this->created_at
            ->setTimezone('America/Toronto')
            ->toDayDateTimeString()
            : null;
    }

    public function getSubjectUrlAttribute() : string
    {
        return $this->subject->path;
    }
}
