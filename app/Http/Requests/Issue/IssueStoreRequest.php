<?php

namespace App\Http\Requests\Issue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IssueStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('issues')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Task with this name already exists',
        ];
    }
}
