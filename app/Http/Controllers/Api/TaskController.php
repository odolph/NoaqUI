<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends BaseController
{
    protected TaskService $taskService;

    public function __construct(TaskService $service)
    {
        parent::__construct($service);
        $this->taskService = $service;
    }

    public function index(): AnonymousResourceCollection
    {
        $tasks = $this->taskService->all();
        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create($request->validated());
        return response()->json(new TaskResource($task), 201);
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->find($id);
        return response()->json(new TaskResource($task));
    }

    public function update(TaskRequest $request, int $id): JsonResponse
    {
        $task = $this->taskService->update($id, $request->validated());
        return response()->json(new TaskResource($task));
    }

    public function updateStatus(int $id, string $status): JsonResponse
    {
        $this->taskService->updateTaskStatus($id, $status);
        return response()->json(['message' => 'Task status updated successfully']);
    }

    public function updatePriority(int $id, string $priority): JsonResponse
    {
        $this->taskService->updateTaskPriority($id, $priority);
        return response()->json(['message' => 'Task priority updated successfully']);
    }

    public function getByStatus(string $status): AnonymousResourceCollection
    {
        $tasks = $this->taskService->getTasksByStatus($status);
        return TaskResource::collection($tasks);
    }

    public function getByProject(int $projectId): AnonymousResourceCollection
    {
        $tasks = $this->taskService->getTasksByProject($projectId);
        return TaskResource::collection($tasks);
    }
}
