<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('TaskController')->group(function () {
    Route::get('/tasks/list', [TaskController::class, 'list'])->name('listTasks');
    Route::post('/tasks/create', [TaskController::class, 'create'])->name('createTask');
});
