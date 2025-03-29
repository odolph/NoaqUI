<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class TaskResource extends BaseResource
{
    protected function resourceToArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'user' => new UserResource($this->whenLoaded('user')),
            'project' => new ProjectResource($this->whenLoaded('project')),
            'task_identifier' => $this->task_identifier,
            'due_date' => $this->due_date?->format('Y-m-d H:i:s'),
        ];
    }
}
