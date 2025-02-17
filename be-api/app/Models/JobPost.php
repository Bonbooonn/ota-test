<?php

namespace App\Models;

use App\Enums\EmploymentType;
use App\Enums\Schedule;
use App\Enums\Seniority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property-read JobBoard|null $jobBoard
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost query()
 * @method static create(array $data)
 * @method static where(string $string, mixed $value)
 * @method static find(mixed $id)
 * @property int $id
 * @property int $job_board_id
 * @property string $name
 * @property string $description
 * @property string $creator_email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereCreatorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereJobBoardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereUpdatedAt($value)
 * @property string $office
 * @property string $department
 * @property EmploymentType $employment_type
 * @property string $experience
 * @property Schedule $schedule
 * @property Seniority $seniority
 * @property bool $is_published
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereEmploymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobPost whereSeniority($value)
 * @mixin \Eloquent
 */
class JobPost extends Model
{

    use HasFactory;

    protected $fillable = [
        'job_board_id',
        'name',
        'description',
        'office',
        'department',
        'employment_type',
        'experience',
        'schedule',
        'seniority',
        'creator_email',
    ];

    protected $dispatchesEvents = [
        'created' => \App\Events\JobPostCreated::class,
    ];

    protected function casts(): array
    {
        return [
            'employment_type' => EmploymentType::class,
            'schedule' => Schedule::class,
            'seniority' => Seniority::class,
        ];
    }

    public function jobBoard(): BelongsTo
    {
        return $this->belongsTo(JobBoard::class);
    }
}
