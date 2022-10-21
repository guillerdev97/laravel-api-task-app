<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::all();

        return response()->json([
            'status' => 1,
            'msg' => 'All tasks',
            'data' => $tasks
        ], 200);
    }
}
