<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getShortBodyAttribute()
    {
        return substr($this->body, 0, 100);
    }
}
