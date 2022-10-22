<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;

class TaskController extends Controller
{
    public function list()
    {
        try {
            $tasks = Task::all();

            if (sizeof($tasks) === 0) {
               throw new Exception();
            }
    
            return response()->json([
                'status' => 1,
                'msg' => 'All tasks',
                'data' => $tasks
            ], 200);
        } catch(Exception $e) {
            report($e);

             return response()->json([
                'status' => 0,
                'msg' => 'There are not tasks',
            ], 404);
        }
    }
}
