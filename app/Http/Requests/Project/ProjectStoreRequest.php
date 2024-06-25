<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('projects')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Группа с таким именем уже существует',
        ];
    }
}
