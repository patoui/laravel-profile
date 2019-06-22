<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    public function getHumanTypeAttribute()
    {
        $type = str_replace('_', ' ', $this->type);
        $type = is_string($type) ? $type : '';

        return ucwords($type);
    }

    public function getShortContentAttribute()
    {
        return str_limit(data_get($this, 'subject.body', ''), 50);
    }

    public function getShortCreatedAtAttribute()
    {
        return $this->created_at
            ? $this->created_at
            ->setTimezone('America/Toronto')
            ->toDayDateTimeString()
            : null;
    }

    public function getSubjectUrlAttribute()
    {
        return $this->subject->path;
    }
}
