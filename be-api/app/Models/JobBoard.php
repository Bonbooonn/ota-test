<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property-read Collection<int, JobPost> $jobPosts
 * @property-read int|null $job_posts_count
 * @property int $id
 * @property string $title
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBoard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBoard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBoard query()
 * @mixin Eloquent
 * @mixin Builder
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property User $user
 * @method static Builder<static>|JobBoard whereCreatedAt($value)
 * @method static Builder<static>|JobBoard whereDescription($value)
 * @method static Builder<static>|JobBoard whereId($value)
 * @method static Builder<static>|JobBoard whereTitle($value)
 * @method static Builder<static>|JobBoard whereUpdatedAt($value)
 * @property int $user_id
 * @method static Builder<static>|JobBoard whereUserId($value)
 * @mixin \Eloquent
 */
class JobBoard extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
