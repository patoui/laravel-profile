<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use function data_get;
use function str_replace;
use function ucwords;

/**
 * Class Activity
 *
 * @property int $id
 * @property int $user_id
 * @property int $subject_id
 * @property string $subject_type
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Activity extends Model
{
    /** @var list<string> */
    protected $guarded = [];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function getHumanTypeAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->type));
    }

    public function getShortContentAttribute(): string
    {
        return Str::limit(data_get($this, 'subject.body', ''), 50);
    }

    public function getShortCreatedAtAttribute(): ?string
    {
        return $this->created_at
            ->setTimezone('America/Toronto')
            ->toDayDateTimeString();
    }

    public function getSubjectUrlAttribute(): string
    {
        return $this->subject->path ?? '';
    }
}
