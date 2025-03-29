<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class);

    Route::prefix('tasks')->group(function () {
        Route::put('{id}/status/{status}', [TaskController::class, 'updateStatus']);
        Route::put('{id}/priority/{priority}', [TaskController::class, 'updatePriority']);
        Route::get('status/{status}', [TaskController::class, 'getByStatus']);
        Route::get('project/{projectId}', [TaskController::class, 'getByProject']);
    });
});
