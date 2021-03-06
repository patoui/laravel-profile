<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReflectionClass;
use function request;
use function sprintf;
use function strtolower;

trait RecordsActivity
{
    protected static function bootRecordsActivity(): void
    {
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(static function ($model) use ($event): void {
                $model->recordActivity($event);
            });
        }

        static::deleting(static function ($model): void {
            $model->activity()->delete();
        });
    }

    /** @return array<string> */
    protected static function getActivitiesToRecord(): array
    {
        return ['created'];
    }

    protected function recordActivity(string $event): void
    {
        $user = Auth::user();

        if (!$user) {
            return;
        }

        $this->activity()->create([
            'user_id' => $user->getAuthIdentifier(),
            'type'    => $this->getActivityType($event),
        ]);
    }

    public function activity(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected function getActivityType(string $event): string
    {
        $type = strtolower((new ReflectionClass($this))->getShortName());

        return sprintf('%s_%s', $event, $type);
    }
}
