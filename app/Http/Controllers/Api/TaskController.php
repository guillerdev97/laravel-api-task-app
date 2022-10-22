<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        } catch (Exception) {
            return response()->json([
                'status' => 0,
                'msg' => 'There are not tasks',
            ], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            $validations = [
                'name' => 'required|max:50',
                'category_id' => 'required|integer',
                'description' => 'required|max:255'
            ];

            $validator = Validator::make(
                $request->all(),
                $validations
            );

            if ($validator->fails()) {
                throw new Exception();
            }

            $task = Task::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description
            ]);

            return response()->json([
                'status' => 1,
                'msg' => 'Task created successfully',
                'data' => $task
            ], 200);
        } catch (Exception) {
            $errors = $validator->errors();

            return response()->json([
                'status' => 0,
                'msg' => $errors
            ], 400);
        }
    }
}
