<?php

namespace App\Http\Requests\JobBoard;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobBoardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
