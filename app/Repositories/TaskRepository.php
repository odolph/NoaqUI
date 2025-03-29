<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function getTasksByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)->get();
    }

    public function getTasksByProject(int $projectId): Collection
    {
        return $this->model->where('project_id', $projectId)->get();
    }

    public function getTasksByUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function getTasksByPriority(string $priority): Collection
    {
        return $this->model->where('priority', $priority)->get();
    }
}
