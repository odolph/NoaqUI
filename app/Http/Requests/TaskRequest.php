<?php

declare(strict_types=1);

namespace App\Http\Requests;

class TaskRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', 'required', 'string', 'in:todo,in_progress,done'],
            'priority' => ['sometimes', 'required', 'string', 'in:low,medium,high'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'due_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The task title is required.',
            'title.max' => 'The task title must not exceed 255 characters.',
            'status.in' => 'The status must be one of: todo, in_progress, done.',
            'priority.in' => 'The priority must be one of: low, medium, high.',
            'project_id.exists' => 'The selected project does not exist.',
            'due_date.date' => 'The due date must be a valid date.',
        ];
    }
}
