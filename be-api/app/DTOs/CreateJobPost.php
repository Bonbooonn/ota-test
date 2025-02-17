<?php

namespace App\DTOs;

use App\Models\JobBoard;

readonly class CreateJobPost
{
    public function __construct(
        private string $name,
        private string $description,
        private string $office,
        private string $department,
        private string $employmentType,
        private string $experience,
        private string $schedule,
        private string $seniority,
        private string $creatorEmail,
        private JobBoard $jobBoard
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getOffice(): string
    {
        return $this->office;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getEmploymentType(): string
    {
        return $this->employmentType;
    }

    public function getExperience(): string
    {
        return $this->experience;
    }

    public function getSchedule(): string
    {
        return $this->schedule;
    }

    public function getSeniority(): string
    {
        return $this->seniority;
    }

    public function getCreatorEmail(): string
    {
        return $this->creatorEmail;
    }

    public function getJobBoard(): JobBoard
    {
        return $this->jobBoard;
    }
}
