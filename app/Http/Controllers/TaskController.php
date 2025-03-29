<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        return Inertia::render('Tasks/Index', [
            'tasks' => $this->taskService->all(),
            'projects' => $request->user()->projects,
        ]);
    }
}
