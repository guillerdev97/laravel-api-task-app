<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::all();

        if (sizeof($tasks) === 0) {
            return response()->json([
                'status' => 0,
                'msg' => 'There are not tasks'
            ], 200);
        }

        return response()->json([
            'status' => 1,
            'msg' => 'All tasks',
            'data' => $tasks
        ], 200);
    }
}
