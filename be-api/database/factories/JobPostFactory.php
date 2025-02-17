<?php

namespace Database\Factories;

use App\Enums\EmploymentType;
use App\Enums\Schedule;
use App\Enums\Seniority;
use App\Models\JobBoard;
use App\Models\JobPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JobPostFactory extends Factory
{
    protected $model = JobPost::class;

    /**
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'creator_email' => $this->faker->unique()->safeEmail(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'office' => $this->faker->word(),
            'department' => $this->faker->word(),
            'employment_type' => collect(EmploymentType::toArray())->random(),
            'experience' => $this->faker->numberBetween(1, 5) . ' years',
            'schedule' => collect(Schedule::toArray())->random(),
            'seniority' => collect(Seniority::toArray())->random(),
            'is_published' => $this->faker->boolean(),
            'job_board_id' => JobBoard::factory(),
        ];
    }
}
