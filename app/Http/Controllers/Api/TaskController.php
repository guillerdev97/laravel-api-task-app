<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Error;
use Throwable;

use function PHPUnit\Framework\throwException;

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
