<?php

declare(strict_types=1);

namespace App;

use App\Events\CommentSaved;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use function preg_match_all;

/**
 * Class Comment
 * @package App
 * @property int    $id
 * @property int    $post_id
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int    $comment_id
 * @property int    $user_id
 * @property Post   $post
 *
 * @property-read null|string $path
 *
 * @method static CommentFactory factory(...$parameters)
 */
class Comment extends Model
{
    use RecordsActivity;
    use HasFactory;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string> */
    protected $appends = ['favourites_count'];

    /** @var array<string> */
    protected $dispatchesEvents = ['saved' => CommentSaved::class];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function getShortCreatedAtAttribute(): string
    {
        return $this->created_at
            ->setTimezone('America/Toronto')
            ->toFormattedDateString();
    }

    public function getPathAttribute(): ?string
    {
        return ($this->post->path ?? '') . '#comment' . $this->id;
    }

    public function favourites(): MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getFavouritesCountAttribute(): int
    {
        return $this->favourites()->count();
    }

    /** @return array<string> */
    public function mentionedUsers(): array
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }
}
