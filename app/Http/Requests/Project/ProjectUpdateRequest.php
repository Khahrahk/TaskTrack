<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => ['required', Rule::unique('projects')->ignore($this->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Группа с таким именем уже существует',
        ];
    }
}
