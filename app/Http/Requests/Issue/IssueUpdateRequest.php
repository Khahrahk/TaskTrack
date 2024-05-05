<?php

namespace App\Http\Requests\Issue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IssueUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => ['required', Rule::unique('issues')->ignore($this->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Task with this name already exists',
        ];
    }
}
