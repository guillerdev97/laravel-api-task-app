<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AuthController
Route::post('/login', [AuthController::class, 'login'])->name('login');

// TaskController
Route::get('/tasks/list', [TaskController::class, 'list'])->name('listTasks');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/tasks/create', [TaskController::class, 'create'])->name('createTask');
    Route::delete('/tasks/delete/{id}', [TaskController::class, 'delete'])->name('deleteTask');
    Route::patch('/tasks/update/{id}', [TaskController::class, 'update'])->name('updateTask');
});







