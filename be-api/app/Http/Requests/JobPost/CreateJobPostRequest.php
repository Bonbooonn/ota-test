<?php

namespace App\Http\Requests\JobPost;

use App\Enums\EmploymentType;
use App\Enums\Schedule;
use App\Enums\Seniority;
use App\Models\JobBoard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CreateJobPostRequest extends FormRequest
{
    /**
     * @throws \Exception
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'office' => 'required|string',
            'department' => 'required|string',
            'employment_type' => ['required', 'string', Rule::in(EmploymentType::toArray())],
            'experience' => 'required|string',
            'schedule' => ['required', 'string', Rule::in(Schedule::toArray())],
            'seniority' => ['required', 'string', Rule::in(Seniority::toArray())],
            'creator_email' => 'required|email',
            'job_board_id' => 'required|integer|exists:job_boards,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (!$validator->errors()->has('job_board_id')) {
                $jobBoard = JobBoard::findOrFail($this->input('job_board_id'));
                $this->merge([
                    'job_board' => $jobBoard,
                ]);
            }
        });
    }
}
