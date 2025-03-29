<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService extends BaseService
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $repository)
    {
        parent::__construct($repository);
        $this->taskRepository = $repository;
    }

    public function getTasksByStatus(string $status): Collection
    {
        return $this->taskRepository->getTasksByStatus($status);
    }

    public function getTasksByProject(int $projectId): Collection
    {
        return $this->taskRepository->getTasksByProject($projectId);
    }

    public function getTasksByUser(int $userId): Collection
    {
        return $this->taskRepository->getTasksByUser($userId);
    }

    public function getTasksByPriority(string $priority): Collection
    {
        return $this->taskRepository->getTasksByPriority($priority);
    }

    public function updateTaskStatus(int $taskId, string $status): void
    {
        $this->update($taskId, ['status' => $status]);
    }

    public function updateTaskPriority(int $taskId, string $priority): void
    {
        $this->update($taskId, ['priority' => $priority]);
    }
}
